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
  margin-left: 10%;
  text-align: left;
  max-width: 80%;
  padding: 0 20px;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;

}

@media screen and (max-width: 1300px) {

  h1{
    margin-top: 70px;
  }
  .container {
    max-width: none;
    margin-left: 0;
    margin-right: 0;
    height: 100vh;
  }
}

@media screen and (max-width: 768px) {
  .container{
    height: 100%;
  }
}

</style>
