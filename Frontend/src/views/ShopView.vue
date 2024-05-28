<template>
  <div>
    <navbar></navbar>
    <div class="content">
      <h1>SHOP</h1>
      <div v-if="showCartNotification" class="cart-notification">
        Item successfully added to cart!
      </div>
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
      <div v-if="isAdmin">
        <button class="admin-btns" @click="toggleAddProductForm">Add New Product</button>
        <div v-if="showAddProductForm" class="add-product-form">
          <form @submit.prevent="addProduct">
            <label for="name">Name:</label>
            <input v-model="newProduct.name" required />
            <label for="description">Description:</label>
            <textarea v-model="newProduct.description" required></textarea>
            <label for="price">Price:</label>
            <input type="number" v-model.number="newProduct.price" required />
            <button class="admin-btns" type="submit">Add Product</button>
          </form>
        </div>
      </div>
      <div class="shop">
        <div v-for="product in products" :key="product.id" class="product">
          <div class="card">
            <img :src="getImagePath(product.image?.filepath)" alt="Product image">
            <h2>{{ product.name }}</h2>
            <p class="price">{{ formatCurrency(product.price) }}</p>
            <p class="description">{{ product.description }}</p>
            <button class="addToCart-btn" @click="addToCart(product)">Add to Cart</button>
            <div v-if="isAdmin">
              <button class="admin-btns" @click="editProduct(product)">Edit</button>
              <button class="admin-btns" @click="deleteProduct(product)">Delete</button>
              <div v-if="selectedProduct && selectedProduct.id === product.id">
                <form @submit.prevent="updateProduct">
                  <label for="editName">Name:</label>
                  <input v-model="selectedProduct.name" required />
                  <label for="editDescription">Description:</label>
                  <textarea v-model="selectedProduct.description" required></textarea>
                  <label for="editPrice">Price:</label>
                  <input type="number" v-model.number="selectedProduct.price" required />
                  <button class="admin-btns" type="submit">Save</button>
                  <button class="admin-btns" type="button" @click="cancelEdit">Cancel</button>
                </form>
              </div>
            </div>
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
      showCartNotification: false,
      isAdmin: false, // Admin status
      filtersVisible: false,
      newProduct: {
        name: '',
        description: '',
        price: null,
      },
      showAddProductForm: false,
      selectedProduct: null,
    };
  },
  mounted() {
    this.fetchProducts();
    this.checkAdmin(); // Check admin status
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
            maxPrice: this.maxPrice,
          },
        });
        this.products = response.data.map(product => ({
          ...product,
          price: parseFloat(product.price) // Ensure price is a number
        }));
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async addToCart(product) {
      try {
        const token = localStorage.getItem('userToken');
        await axios.post('/cart', { product_id: product.id, quantity: 1 }, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.showCartNotification = true;
        setTimeout(() => {
          this.showCartNotification = false;
        }, 3000);
      } catch (error) {
        console.error('Error adding to cart:', error);
      }
    },
    toggleFilters() {
      this.filtersVisible = !this.filtersVisible;
    },
    formatCurrency(value) {
      if (typeof value !== 'number') {
        console.error('Value is not a number:', value);
        return '$0.00';
      }
      return `$${value.toFixed(2)}`;
    },
    async addProduct() {
      try {
        const token = localStorage.getItem('userToken');
        await axios.post('/products', this.newProduct, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        this.fetchProducts();
        this.newProduct = {
          name: '',
          description: '',
          price: null,
        };
        this.showAddProductForm = false;
      } catch (error) {
        console.error('Error adding product:', error);
      }
    },
    getImagePath(filepath) {
      return filepath ? `/storage/${filepath}` : '';
    },
    toggleAddProductForm() {
      this.showAddProductForm = !this.showAddProductForm;
    },
    editProduct(product) {
      this.selectedProduct = { ...product, newImage: null }; // Initialize newImage field to null
    },
    async updateProduct() {
      try {
        const token = localStorage.getItem('userToken');
        await axios.put(`/products/${this.selectedProduct.id}`, {
          name: this.selectedProduct.name,
          description: this.selectedProduct.description,
          price: this.selectedProduct.price,
          image_id: this.selectedProduct.image_id // Use existing image ID
        }, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        this.fetchProducts();
        this.selectedProduct = null;
      } catch (error) {
        console.error('Error updating product:', error);
      }
    },
    async deleteProduct(product) {
      try {
        const token = localStorage.getItem('userToken');
        await axios.delete(`/products/${product.id}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.fetchProducts();
      } catch (error) {
        console.error('Error deleting product:', error);
      }
    },
    cancelEdit() {
      this.selectedProduct = null;
    },
    async checkAdmin() {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.get('/profile', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.isAdmin = response.data.data.role === 'admin';
      } catch (error) {
        console.error('Error checking admin role:', error);
      }
    },
  },
};
</script>

<style scoped>
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

.filter-button {
  margin: 20px;
}

.filters {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
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

.addToCart-btn {
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

.admin-btns{
  border-radius: 4%;
  background-color: rgba(3, 3, 3, 0.45);
  width: 90px;
  border-radius: 5px;
  color: #ffffff;
  background-color: #4a0000;
  border: none;
  cursor: pointer;
  padding: 8px 0px;
  transition: background-color 0.2s ease-in;
  margin: 0 5px;
}

button:hover, .card:hover {
  opacity: 0.7;
  box-shadow: 0 30px 30px #4a0000;
}

.cart-notification {
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(3, 3, 3, 0.45);
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  z-index: 1000;
  opacity: 0.9;
  animation: fadeOut 3s ease-in-out; 
}

@keyframes fadeOut {
  0% {
    opacity: 0.9;
  }
  100% {
    opacity: 0;
  }
}

input {
    border-radius: 4%;
    background-color: rgba(3, 3, 3, 0.45);
    border: none;
    color: rgb(156, 154, 154);
    height: 40px;
    width: 250px;
}
textarea{
    border-radius: 4%;
    background-color: rgba(3, 3, 3, 0.45);
    border: none;
    color: rgb(156, 154, 154);
    height: 40px;
    width: 250px;
}

</style>