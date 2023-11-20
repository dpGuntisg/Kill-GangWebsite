<template>
    <navbar></navbar>
    <div class="container">
      <div class="profile-box">

        <div class="profile-picture"></div>
        <div class="user-name"></div>
        
      </div>
    </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';

export default {
name: "home",
components: {
  Navbar,
 }
}

</script>

<style scoped>
.container{
  background-color: #360e0e;
  margin-left: auto;
  margin-right: auto;
  text-align: left;
  max-width: 70vw;
  padding: 0 20px;
  height: 100vh;
  display: flex;
  align-items: left;
  justify-content: center;
  flex-direction: column;
}

.profile-box{
  width: 50%;
  height: 80%;
  background-color: #220909b2;
}

</style>