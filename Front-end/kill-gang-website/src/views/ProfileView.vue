<template>
  <div>
    <navbar></navbar>
    <div class="container">
      <Profile />
      <div class="liked">
        
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import Profile from '../components/Profile.vue';

export default {
  name: "home",
  components: {
    Navbar,
    Profile
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