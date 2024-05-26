<template>
  <div>
    <navbar></navbar>
    <div class="content">
      <h1>SHOP</h1>
      <button @click="toggleFilters" class="filter-button">Toggle Filters</button>
      <div class="filters" v-if="filtersVisible">
        <input v-model="searchQuery" placeholder="Search for products..." @input="fetchProducts" />
        <label for="sort">Sort by:</label>
        <select v-model="sortKey" @change="fetchProducts">
          <option value="name">Name</option>
          <option value="price">Price</option>
        </select>
        <label for="sortOrder">Order:</label>
        <select v-model="sortOrder" @change="fetchProducts">
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
        </select>
        <label for="minPrice">Min Price:</label>
        <input type="number" v-model.number="minPrice" @input="fetchProducts" />
        <label for="maxPrice">Max Price:</label>
        <input type="number" v-model.number="maxPrice" @input="fetchProducts" />
      </div>
      <div class="shop">
        <div v-for="product in products" :key="product.id" class="product">
          <div class="card">
            <img :src="product.image" alt="Product image">
            <h2>{{ product.name }}</h2>
            <p class="price">{{ formatCurrency(product.price) }}</p>
            <p class="description">{{ product.description }}</p>
            <button @click="addToCart(product)">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import axios from 'axios';

export default {
  name: 'StoreView',
  components: {
    Navbar,
  },
  data() {
    return {
      products: [],
      searchQuery: '',
      sortKey: 'name',
      sortOrder: 'asc',
      minPrice: 0,
      maxPrice: 999999.99,
      filtersVisible: false,
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.get('/products', {
          headers: {
            Authorization: `Bearer ${token}`
          },
          params: {
            search: this.searchQuery,
            sortKey: this.sortKey,
            sortOrder: this.sortOrder,
            minPrice: this.minPrice,
            maxPrice: this.maxPrice
          }
        });
        this.products = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async addToCart(product) {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.post('/cart', {
          product_id: product.id,
          quantity: 1 
        }, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        console.log('Product added to cart:', response.data);
      } catch (error) {
        console.error('Error adding to cart:', error);
      }
    },
    formatCurrency(value) {
      return `$${parseFloat(value).toFixed(2)}`;
    },
    toggleFilters() {
      this.filtersVisible = !this.filtersVisible;
    }
  }
};
</script>

<style scoped>

input {
    border-radius: 4%;
    background-color: rgba(3, 3, 3, 0.45);
    border: none;
    color: rgb(156, 154, 154);
    height: 40px;
    width: 250px;
}

select {
  border-radius: 4%;
  background-color: rgba(3, 3, 3, 0.45);
  border: none;
  color: white;
  height: 40px;
  width: 250px;
}

.content {
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

.filter-button {
  width: 100%;
  margin-bottom: 20px;
  padding: 10px 20px;
  background-color: black;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 5px;
}

.filter-button:hover {
  opacity: 0.7;
}

.filters {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
  width: 100%;
}

.filters input, .filters select {
  margin-right: 10px;
  padding: 5px;
  flex: 1;
}

.filters label {
  margin: 5px 10px 0 0;
}

.shop {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  width: 100%;
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
