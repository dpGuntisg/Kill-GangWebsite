<template>
  <div>
    <navbar></navbar>
    <main class="content">
      <h1>SHOP</h1>
      <div v-if="showCartNotification" class="cart-notification" role="alert" aria-live="assertive">
        Item successfully added to cart!
      </div>
      <button @click="toggleFilters" class="filter-button" aria-expanded="filtersVisible">
        Toggle Filters
      </button>
      <div class="filters" v-if="filtersVisible && !selectedProduct">
        <input v-model="searchQuery" placeholder="Search for products..." @input="fetchProducts" aria-label="Search for products" />
        <label for="sort">Sort by:</label>
        <select v-model="sortKey" @change="fetchProducts" aria-label="Sort products by">
          <option value="name">Name</option>
          <option value="price">Price</option>
        </select>
        <label for="sortOrder">Order:</label>
        <select v-model="sortOrder" @change="fetchProducts" aria-label="Sort order">
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
        </select>
        <label for="minPrice">Min Price:</label>
        <input type="number" step="0.01" v-model.number="minPrice" @input="fetchProducts" aria-label="Minimum price" />
        <label for="maxPrice">Max Price:</label>
        <input type="number" step="0.01" v-model.number="maxPrice" @input="fetchProducts" aria-label="Maximum price" />
      </div>
      <div v-if="isAdmin">
        <button class="addButton" @click="toggleAddProductForm">Add New Product</button>
        <div v-if="showAddProductForm" class="add-product-form">
          <form @submit.prevent="addProduct">
            <label for="name">Name:</label>
            <input v-model="newProduct.name" id="name" required />
            <label for="description">Description:</label>
            <textarea v-model="newProduct.description" id="description" required></textarea>
            <label for="price">Price:</label>
            <input type="number" step="0.01" v-model.number="newProduct.price" id="price" required />
            <button class="saveButton" type="submit">Add Product</button>
            <button class="cancelButton" type="button" @click="cancelAddProduct">Cancel</button>
          </form>
        </div>
      </div>
      <div class="shop">
        <div v-for="product in products" :key="product.id" class="product">
          <article class="card">
            <img v-if="product.image && product.image.filepath" :src="getImagePath(product.image?.filepath)" alt="Product image">
            <h2>{{ product.name }}</h2>
            <p class="price">{{ formatCurrency(product.price) }}</p>
            <p class="description">{{ product.description }}</p>
            <button v-if="!selectedProduct" class="addToCart-btn" @click="addToCart(product)">Add to Cart</button>
            <div v-if="isAdmin && !selectedProduct" class="admin-buttons">
              <button class="editButton" @click="editProduct(product)">Edit</button>
              <button class="deleteButton" @click="deleteProduct(product)">Delete</button>
            </div>
          </article>
          <form v-if="selectedProduct && selectedProduct.id === product.id" class="edit-form" @submit.prevent="updateProduct">
            <label for="editName">Name:</label>
            <input v-model="selectedProduct.name" id="editName" required />
            <label for="editDescription">Description:</label>
            <textarea v-model="selectedProduct.description" id="editDescription" required></textarea>
            <label for="editPrice">Price:</label>
            <input type="number" step="0.01" v-model.number="selectedProduct.price" id="editPrice" required />
            <button class="saveButton" type="submit">Save</button>
            <button class="cancelButton" type="button" @click="cancelEdit">Cancel</button>
          </form>
        </div>
      </div>
    </main>
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
      isAdmin: false,
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
    this.checkAdmin();
  },
  methods: {
    async fetchProducts() {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.get('api/products', {
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
          price: parseFloat(product.price) 
        }));
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async addToCart(product) {
      try {
        const token = localStorage.getItem('userToken');
        await axios.post('api/cart', { product_id: product.id, quantity: 1 }, {
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
        await axios.post('api/products', this.newProduct, {
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
        await axios.put(`api/products/${this.selectedProduct.id}`, {
          name: this.selectedProduct.name,
          description: this.selectedProduct.description,
          price: this.selectedProduct.price,
          image_id: this.selectedProduct.image_id 
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
        await axios.delete(`api/products/${product.id}`, {
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
        const response = await axios.get('api/profile', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.isAdmin = response.data.data.role === 'admin';
      } catch (error) {
        console.error('Error checking admin role:', error);
      }
    },
    cancelAddProduct() {
      this.showAddProductForm = false;
    },
  },
};
</script>


<style scoped>
.content {
  background-color: #00000026;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  max-width: 80%;
  margin: 0 auto;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  height: 100vh;
}

h1 {
  margin-top: 40px;
  font-weight: 800;
  font-size: 4rem;
  color: #ffffff;
  text-align: center;
}

.filter-button {
  margin: 20px;
  padding: 10px 20px;
  background-color: black;
  color: aliceblue;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s ease-in;
}

.filter-button:hover {
  background-color: #333;
}

.filters {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-bottom: 20px;
  gap: 10px;
}

.filters input,
.filters select {
  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 4px;
  flex: 1;
}

.filters label {
  margin: 5px 10px 0 0;
  color: #ffffff;
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
  outline: 2px solid black;
  width: 300px;
  text-align: center;
  font-family: Arial, sans-serif;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 400px;
  background-color: none;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s ease-in-out;
}

.card:hover {
  transform: translateY(-5px);
}

.product img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.cart-notification {
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(0, 0, 0, 0.7);
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

select {
  border-radius: 4px;
  background-color: rgba(3, 3, 3, 0.45);
  border: none;
  color: rgb(156, 154, 154);
  height: 40px;
  width: 100%;
  padding: 10px;
  transition: background-color 0.2s ease-in, border-color 0.2s ease-in;
}

.add-product-form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.add-product-form form {
  display: flex;
  flex-direction: column;
  width: 300px;
}

.add-product-form form label {
  margin-bottom: 5px;
  color: #ffffff;
}

.add-product-form form input,
.add-product-form form textarea {
  margin-bottom: 10px;
}

.add-product-form form button {
  align-self: center;
}

@media (max-width: 768px) {
  .content {
    width: 100%;
    padding: 0 20px;
    max-width: none;
    margin-left: none;
    margin-right: none;
  }

  .card {
    margin-left: 0;
    margin-right: 0;
  }

  .shop {
    flex-direction: column;
    align-items: center;
  }

  .filters {
    flex-direction: column;
    align-items: center;
  }
}

.addToCart-btn {
  height: 40px;
  border: none;
  outline: 0;
  cursor: pointer;
  width: 100%;
  background-color: black;
  color: aliceblue;
  position: absolute;
  bottom: 0;
  left: 0;
}

.admin-buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
  margin-bottom: 40px; 
}

.admin-buttons button {
  flex: 1;
  margin: 5px;
  padding: 10px;
  border: none;
  border-radius: 4px;
  background-color: #4a0000;
  color: white;
  cursor: pointer;
  transition: background-color 0.2s ease-in;
  z-index: 1;
}

.admin-buttons button:hover {
  background-color: #333;
}

button:hover,
.card:hover {
  opacity: 0.7;
  box-shadow: 0 30px 30px #4a0000;
}
</style>