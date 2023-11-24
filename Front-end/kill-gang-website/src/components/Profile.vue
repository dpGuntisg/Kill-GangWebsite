<template>
    <div class="profile-box">
      <img :src="profilePicture" alt="Profile Picture" class="profile-picture">
      <h1 class="user-name">{{ userName }}</h1>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Profile',
    data() {
      return {
        profilePicture: '/assets/monkey.jpg',
        userName: 'User Name'
      };
    }
  };
  </script>
  
  <style scoped>
  .profile-box {
    width: 100%;
    height: 80%;
    background-color: #220909b2;
  }
  
  .profile-picture {
    width: 200px;
    height: 200px;
    position: relative;
  }
  
  .user-name {
    margin-top: 20px;
    font-size: 24px;
  }
  </style>