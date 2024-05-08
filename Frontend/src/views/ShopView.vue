<template>
  <div>
    <navbar></navbar>
    <div class="container">
      <h1>SHOP</h1>
      <div class="shop">
        <div v-for="product in products" :key="product.id" class="product">
          <div class="card">
            <img :src="product.image" alt="Product image">
            <h2>{{ product.name }}</h2>
            <p class="price">{{ product.price }}</p>
            <p class="description">{{ product.description }}</p>
            <button>Add to Cart</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue'; 

export default {
  name: 'StoreView',
  components: {
    Navbar,
  },
  data() {
    return {
      products: [
        { id: 1, name: 'Product 1', description: 'balls', price: '$100', image: '/assets/award.png' },
        { id: 2, name: 'Product 2', description: 'balls', price: '$200', image: '/assets/award.png' },
        { id: 3, name: 'Product 3', description: 'balls', price: '$300', image: '/assets/award.png' },
      ],
    };
  },
};
</script>

<style scoped>
.container {
  background-color: #00000026;
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

h1 {
  margin-top: 50px;
  position: relative;
  z-index: 2;
}

.shop {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

.card {
  margin: 20px;
  position: relative;
  outline-style: solid;
  outline-color: black;
  outline-width: 2px;
  width: 300px;
  text-align: center;
  font-family: Arial;
  display: flex;
  flex-direction: column;
  height: 400px;
}

.product img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

button {
  height: 30px;
  border: none;
  outline: 0;
  cursor: pointer;
  width: 100%;
  background-color: black;
  color: aliceblue;
  position: absolute;
  bottom: 0;
}

button:hover, .card:hover {
  opacity: 0.7;
  box-shadow: 0 30px 30px #4a0000;
}

@media screen and (max-width: 1300px) {
  .container {
    max-width: none;
    margin-left: 0;
    margin-right: 0;
    height: 100vh;
  }

  h1 {
    margin-top: 70px;
  }
}

@media screen and (max-width: 768px) {
  .container {
    height: 100%;
    margin-left: 0;
    margin-right: 0;
    width: 100%;
  }
}
</style>
