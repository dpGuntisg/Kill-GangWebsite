<template>
  <navbar></navbar>
  <div class="content">
    <div v-if="isAuthenticated">
      <div class="user-info" v-if="user">
        <p> EMAIL: {{ user.email }}</p>
        <p> NAME: {{ user.name }} </p>
        <p> ROLE: {{ user.role.toUpperCase() }} </p>
        <p> CREATED AT: {{ formatDate(user.created_at) }}</p>
      </div>

      <div class="button-container">
        <button @click.prevent="logout" class="logout-btn">LOG OUT</button>
        <button @click="deleteUser" class="delete-btn">DELETE</button>
        <button @click="showEditForm" class="edit-btn">EDIT</button>
      </div>

      <div v-if="editing">
        <form @submit.prevent="editUser">
          <label for="name">Name:</label>
          <input type="text" v-model="editForm.name" id="name" required>
          <label for="email">Email:</label>
          <input type="email" v-model="editForm.email" id="email" required>
          <label for="password">Password:</label>
          <input type="password" v-model="editForm.password" id="password">
          <label for="password_confirmation">Confirm Password:</label>
          <input type="password" v-model="editForm.password_confirmation" id="password_confirmation">
          <button type="submit">Save Changes</button>
          <button type="button" @click="cancelEdit">Cancel</button>
        </form>
      </div>

      <div v-if="user.role === 'admin'" class="admin-panel">
        <h2>Admin Panel</h2>
        <div class="users-section">
          <h3>Users</h3>
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users" :key="user.id">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
                <td>
                  <button @click="deleteUserById(user.id)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="statistics-section">
          <h3>Product Statistics</h3>
          <table>
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Times Added to Cart</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="stat in productStats" :key="stat.productId">
                <td>{{ stat.productName }}</td>
                <td>{{ stat.timesAdded }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div v-else>
      <p>Please log in to view your profile.</p>
      <button @click="$router.push('/login')" class="login-btn">LOG IN</button>
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import axios from 'axios';

export default {
  name: "Profile",
  components: {
    Navbar,
  },
  data() {
    return {
      user: null,
      users: [],
      productStats: [],
      editing: false,
      isAuthenticated: false,
      editForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    };
  },
  created() {
    this.checkAuthentication();
  },
  methods: {
    logout() {
      const token = localStorage.getItem('userToken');
      if (!token) {
        console.error('No token found, user might be already logged out or session expired');
        return;
      }

      const config = {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      };

      axios.post('http://127.0.0.1:8000/api/logout', null, config)
        .then(response => {
          console.log('Logout successful:', response.data);
          localStorage.removeItem('userToken');
          this.$router.push('/login');
        })
        .catch(error => {
          console.error('Error during logout:', error.response ? error.response.data : 'No response data');
          this.$router.push('/login');
        });
    },

    deleteUser() {
      const token = localStorage.getItem('userToken');
      if (!token) {
        console.error('Authentication token not found');
        alert('Please log in to delete your account.');
        this.$router.push('/login');
        return;
      }

      const config = {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      };

      axios.delete('http://127.0.0.1:8000/api/profile', config)
        .then(response => {
          console.log("User deleted:", response.data);
          localStorage.removeItem('userToken');
          this.$router.push('/login');
        })
        .catch(error => {
          console.error('Error deleting user:', error.response ? error.response.data : 'No response data');
          alert('Failed to delete account.');
        });
    },

    fetchUserProfile() {
      const token = localStorage.getItem('userToken');
      if (!token) {
        console.error('Authentication token not found');
        this.$router.push('/login');
        return;
      }

      axios.get('http://127.0.0.1:8000/api/profile', {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        })
        .then(response => {
          this.user = response.data.data;
          console.log('User data fetched successfully:', this.user);
          this.fetchAllUsers();
          this.fetchProductStats();
        })
        .catch(error => {
          console.error('Failed to fetch user data:', error);
        });
    },

    fetchAllUsers() {
      const token = localStorage.getItem('userToken');
      axios.get('http://127.0.0.1:8000/api/users', {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        })
        .then(response => {
          this.users = response.data;
        })
        .catch(error => {
          console.error('Failed to fetch users:', error);
        });
    },

    fetchProductStats() {
      const token = localStorage.getItem('userToken');
      axios.get('http://127.0.0.1:8000/api/product-stats', {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        })
        .then(response => {
          this.productStats = response.data;
        })
        .catch(error => {
          console.error('Failed to fetch product stats:', error);
        });
    },

    deleteUserById(userId) {
      const token = localStorage.getItem('userToken');
      axios.delete(`http://127.0.0.1:8000/api/users/${userId}`, {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        })
        .then(response => {
          console.log("User deleted:", response.data);
          this.fetchAllUsers();
        })
        .catch(error => {
          console.error('Error deleting user:', error);
          alert('Failed to delete user.');
        });
    },

    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    },

    showEditForm() {
      this.editing = true;
      this.editForm.name = this.user.name;
      this.editForm.email = this.user.email;
    },

    cancelEdit() {
      this.editing = false;
    },

    editUser() {
      const token = localStorage.getItem('userToken');
      if (!token) {
        console.error('Authentication token not found');
        alert('Please log in to edit your account.');
        this.$router.push('/login');
        return;
      }

      const config = {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      };

      axios.put('http://127.0.0.1:8000/api/profile', this.editForm, config)
        .then(response => {
          console.log("User updated successfully:", response.data);
          this.user = response.data.data;
          this.editing = false;
        })
        .catch(error => {
          console.error('Error updating user:', error.response ? error.response.data : 'No response data');
          alert('Failed to update account.');
        });
    },

    checkAuthentication() {
      const token = localStorage.getItem('userToken');
      if (token) {
        this.isAuthenticated = true;
        this.fetchUserProfile();
      } else {
        this.isAuthenticated = false;
      }
    }
  }
};
</script>

<style scoped>

button{
  margin-right: 5px;
}

.content {
  background-color: #00000026;
  height: auto;
  margin-left: 10%;
  max-width: 80%;
  padding: 20px;
  display: flex;
  flex-direction: column;
  height: 100vh;
}

.user-info {
  margin-bottom: 20px;
}

.button-container {
  display: flex;
}

.admin-panel {
  margin-top: 20px;
}

.users-section,
.statistics-section {
  margin-top: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table th,
table td {
  padding: 10px;
  border: 1px solid #ddd;
}

@media screen and (max-width: 768px) {
    .content {
      width: 100%;
      padding: 0 20px;
      max-width: none;
      margin-left: 0;
      margin-right: 0;
      background: none;
    }
}

</style>
