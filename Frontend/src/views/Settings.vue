<template>
  <navbar></navbar>
  <div class="content">
    <div class="user-info" v-if="user">
      <p> EMAIL: {{ user.email }}</p>
      <p> NAME: {{ user.name }} </p> 
      <p> ROLE: {{ user.role.toUpperCase() }}</p> 
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
  </div>
</template>


<script>
import Navbar from '../components/Navbar.vue';
import axios from 'axios';

export default {
  name: "profile",
  components: {
    Navbar,
  },
  data() {
    return {
      user: null,
      editing: false,
      editForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    };
  },
  created() {
    this.fetchUserProfile();
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

      axios.post('/logout', null, config)
        .then(response => {
          console.log('Logout successful:', response.data);
          localStorage.removeItem('userToken'); 
          this.$router.push('/');
        })
        .catch(error => {
          console.error('Error during logout:', error.response ? error.response.data : 'No response data');
          this.$router.push('/');
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

      axios.delete('/delete', config) 
        .then(response => {
          console.log("User deleted:", response.data);
          localStorage.removeItem('userToken');
          this.$router.push('/');
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

      axios.get('/profile', {
        headers: { 'Authorization': `Bearer ${token}` }
      })
      .then(response => {
        this.user = response.data.data;
        console.log('User data fetched successfully:', this.user);
      })
      .catch(error => {
        console.error('Failed to fetch user data:', error);
      });
    },

    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString('en-US', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
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

      axios.put('/profile', this.editForm, config)
        .then(response => {
          console.log("User updated successfully:", response.data);
          this.user = response.data.data;
          this.editing = false;
        })
        .catch(error => {
          console.error('Error updating user:', error.response ? error.response.data : 'No response data');
          alert('Failed to update account.');
        });
    }
  }
};
</script>

<style scoped>
.content {
  background-color: #00000026;
  height: 100vh;
  margin-left: 10%;
  max-width: 80%;
  padding: 20px;
  display: flex;
  flex-direction: column;
  
}

.user-info {
  margin-bottom: 20px; 
}

.button-container {
  display: flex;
}

button {
  border-radius: 4%;
  background-color: rgba(3, 3, 3, 0.45);
  width: 90px;
  border-radius: 5px;
  color: #ffffff;
  background-color: #4a0000;
  border: none;
  cursor: pointer;
  padding: 8px 0px;
  transition: background-color 0.2s ease-in;
  margin: 0 5px;
}

button:hover {
  background-color: #d5d5d5;
  box-shadow: 0 0 30px #4a0000;
}

input {
    border-radius: 4%;
    background-color: rgba(3, 3, 3, 0.45);
    border: none;
    color: rgb(156, 154, 154);
    height: 40px;
    width: 250px;
}

</style>

