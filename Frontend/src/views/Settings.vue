<template>
  <navbar></navbar>
  <div class="container">
    <button @click.prevent="logout" class="logout-btn">LOG OUT</button>
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
    profilePicture: '/assets/monkey.jpg',
    userName: 'User Name'
  };
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
