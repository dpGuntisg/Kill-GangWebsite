<template>
  <div>
    <navbar></navbar>
    <div class="content">
      <h1>Shopping Cart</h1>
      <div v-if="cartItems.length > 0" class="cart-items">
        <div v-for="item in cartItems" :key="item.id" class="cart-item">
          <img :src="item.product.image" alt="Product image">
          <div class="details">
            <h2>{{ item.product.name }}</h2>
            <p class="price">{{ formatCurrency(item.product.price) }}</p>
            <p class="quantity">Quantity: {{ item.quantity }}</p>
            <button @click="removeFromCart(item.product.id)">Remove</button>
          </div>
        </div>
      </div>
      <div v-else>
        <p>Your cart is empty.</p>
      </div>
      <p>Total: {{ formatCurrency(cartTotal) }}</p>
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import axios from 'axios';

export default {
  name: 'Cart',
  components: {
    Navbar,
  },
  data() {
    return {
      cartItems: [],
      cartTotal: 0,
    };
  },
  mounted() {
    this.fetchCartItems();
  },
  methods: {
    async fetchCartItems() {
      try {
        const token = localStorage.getItem('userToken');
        const response = await axios.get('/cart', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.cartItems = response.data;
        this.calculateTotal();
      } catch (error) {
        console.error('Error fetching cart items:', error);
      }
    },
    async removeFromCart(productId) {
      try {
        const token = localStorage.getItem('userToken');
        await axios.delete(`/cart/${productId}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.fetchCartItems();
      } catch (error) {
        console.error('Error removing item from cart:', error);
      }
    },
    calculateTotal() {
      this.cartTotal = this.cartItems.reduce((total, item) => total + item.product.price * item.quantity, 0);
    },
    formatCurrency(value) {
      return `$${parseFloat(value).toFixed(2)}`;
    }
  }
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

h1 {
  margin-top: 50px;
  position: relative;
  z-index: 2;
}

.cart-items {
  width: 100%;
  display: flex;
  flex-direction: column;
}

.cart-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
  padding: 10px 0;
}

.cart-item img {
  width: 100px;
  height: 100px;
  object-fit: cover;
}

.details {
  flex: 1;
  padding: 0 20px;
}

.details h2 {
  margin: 0;
}

.details .price, .details .quantity {
  margin: 5px 0;
}

button {
  height: 30px;
  border: none;
  outline: 0;
  cursor: pointer;
  background-color: black;
  color: aliceblue;
  padding: 5px 10px;
}

button:hover {
  opacity: 0.7;
}

@media screen and (max-width: 768px) {
    .content {
      width: 100%;
      padding: 0 20px;
      max-width: none;
      margin-left: 0;
      margin-right: 0;
      background: none;
    }
  }
</style>
