<template>
    <navbar></navbar>
    <div class="container">
      
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


</style>