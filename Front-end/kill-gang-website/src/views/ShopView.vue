<template>
    <navbar></navbar>
    <div class="container">
      <h1>SHOP</h1>
      <shop></shop>
    </div>
    
</template>

<script>
import Navbar from '../components/Navbar.vue';
import Shop from '../components/Shop.Vue';

export default {
name: "home",
components: {
  Navbar,
  'shop': Shop,
}
};

</script>

<style scoped>
.container{
  background-color: #360e0e;
  margin: 0 auto;
  text-align: left;
  max-width: 70vw;
  padding: 0 20px;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

@media screen and (max-width: 768px) {
  .container {
    padding: 0 20px;
    max-width: 100%;
    height: auto;
    align-items: flex-start;
    justify-content: flex-start;
  }
}

</style>
