<template>
    <div class="shop">
      <div v-for="product in products" :key="product.id" class="product">
        <div class="card">
          <img :src ="product.image" alt="Product image">
          <h2>{{ product.name }}</h2>
          <p class="price">{{ product.price }}</p>
          <p class="description">{{ product.description }}</p>
          <p><button> Add to Cart</button></p>
        </div>
      </div>
    </div>
  </template>

<script>
export default {
  name: 'Shop',
  data() {
    return {
      products: [
        { id: 1, name: 'Product 1', description: 'balls', price: '\$100', image: '/assets/award.png' },
        { id: 2, name: 'Product 2', price: '\$200', image: '/assets/award.png' },
        // Add more products as needed
      ],
    };
  },
};
</script>

<style scoped>

@media screen and (max-width: 768px) {
  .card{
    margin: 20px 0; /* Adjust margins for smaller screens */
    width: calc(100% - 40px); /* Adjust margin for smaller screens */
    max-width: calc(100% - 40px); /* Adjust margin for smaller screens */
  }
  .shop{
    width: 100%;
  }
}

.shop {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}
.card {
  outline-style: solid;
  outline-color: black;
  outline-width: 2px;
  max-width: 300px;
  margin: 20px;
  text-align: center;
  font-family: arial;
}

h1{
    margin-top: 50px;
    position: relative;
    z-index: 2;
}

.product {
    margin-top: 50px;
    margin: 50px;
}

.product img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

button {
  height: 20px;
  border: none;
  outline: 0;
  cursor: pointer;
  width: 100%;
  background-color: black;
  color: aliceblue;
}

button:hover{
  opacity: 0.7;
}

</style>