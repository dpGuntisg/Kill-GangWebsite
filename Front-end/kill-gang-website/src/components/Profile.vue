<template>
    <div class="profile-box">
      <div class="wrapper">
        <img :src="profilePicture" alt="Profile Picture" class="profile-picture">
        <div class="usernamebox">
          <h1 class="user-name">{{ userName }}</h1>
          <button class="edit-btn">EDIT</button>
        </div>
      </div>
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
    border-radius: 10px;
    width: 100%;
    height: 80%;
    background-color: #220909b2;
  }
  
  .profile-picture {
    border-radius: 10px;
    float: left;
    margin-right: 2rem;
    max-width: 200px;
    max-height: 200px;
    position: relative;
  }

  .wrapper{
    margin: 4rem auto;
    width: 90%;
  }
  
  .user-name {
    font-size: 1.5em;
    position: relative;
  }

 .usernamebox{
  display:flex;
  flex-direction: row;
 }

 .edit-btn{
  position: relative;
  max-width: 3rem;
  max-height: 1.5rem;
  left: 5rem;
  top: 0.5rem;
  border: none;
  color: white;
  background: none;
 }

 .edit-btn:hover{
  color: gray;
 }
  </style>