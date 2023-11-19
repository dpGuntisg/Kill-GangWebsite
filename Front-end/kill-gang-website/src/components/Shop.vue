<template>
    <h1>Shop</h1>
    <div class="shop">
      <div v-for="product in products" :key="product.id" class="product">
        <h2>{{ product.name }}</h2>
        <p>{{ product.price }}</p>
        <img :src ="product.image" alt="Product image">
      </div>
    </div>
  </template>

<script>
export default {
  name: 'Shop',
  data() {
    return {
      products: [
        { id: 1, name: 'Product 1', price: '\$100', image: '/assets/award.png' },
        { id: 2, name: 'Product 2', price: '\$200', image: '/assets/award.png' },
        // Add more products as needed
      ],
    };
  },
};
</script>

<style scoped>
.shop {
  margin-top:5%;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
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
    width: 200px;
    height: 200px;
    object-fit: cover;
}

</style>