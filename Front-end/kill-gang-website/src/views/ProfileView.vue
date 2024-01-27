<template>
    <navbar></navbar>
    <div class="container">
      <div class="profile-box">
      <div class="User">
        <img :src="profilePicture" alt="Profile Picture" class="profile-picture">
        <div class="usernamebox">
          <h1 class="user-name">{{ userName }}</h1>
          <button class="edit-btn">EDIT</button>
        </div>
      </div>
      <div class="liked">
        <h1 class="liked-txt">LIKED VIDEOS AND SONGS</h1>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';

export default {
  name: "profile",
  components: {
    Navbar,
  },
  data(){
    return{
      profilePicture: '/assets/monkey.jpg',
      userName: 'User Name'
    };
  }
};
</script>

<style scoped>
.container {
  background-color: #360e0e;
  margin-left: 10%;
  max-width: 80%;
  padding: 0 20px;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center
}
.profile-box {
  flex-direction: column;
  display: flex;
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

  .User{
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

.liked{
  display: flex;
  flex-direction: row;
  max-width: 1200px;
  height: 200px;
  background-color: black;
  margin-left: 6rem;
  border-radius: 5px;
  height: 65%;
}

.liked-txt{
  margin-left: 0.5em;
  font-size: 1.5em;
}

</style>