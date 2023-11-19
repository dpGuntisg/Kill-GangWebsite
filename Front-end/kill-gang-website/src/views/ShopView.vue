<template>
    <navbar></navbar>
    <div class="container">
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
  margin-left: auto;
  margin-right: auto;
  text-align: left;
  max-width: 70vw;
  padding: 0 20px;
  height: 100vh;
  display: flex;
  
}

@media screen and (max-width: 768px) {
  .container {
    text-align: left;
    width: 100%;
    padding: 0;
    height: auto;
    display: block;
  }
}


</style>
