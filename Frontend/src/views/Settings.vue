<template>
  <navbar></navbar>
  <div class="container">
    <div v-if="user">
      <p> EMAIL: {{ user.email }}</p>
      <p> NAME: {{ user.name }} </p> 
      <p> CREATED AT: {{ formatDate(user.created_at) }}</p>
    </div>
    <button @click.prevent="logout" class="logout-btn">LOG OUT</button>
    <button @click="deleteUser" class="delete-btn">DELETE</button> 
    <button @click="edit" class="delete-btn">EDIT</button> 
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
      user: null  
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
    }
  }


};
</script>

<style scoped>
.container {
background-color: #00000026;
margin-left: 10%;
max-width: 80%;
padding: 0 20px;
height: 100vh;
display: flex;
align-items: center;
justify-content: center;
}
</style>
