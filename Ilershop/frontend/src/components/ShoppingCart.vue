<!-- frontend/src/components/ShoppingCart.vue -->
<template>
    <div class="cart">
      <h3>Carrito ({{ cart.length }})</h3>
      <div v-for="item in cart" :key="item.product.id" class="cart-item">
        <img :src="`http://localhost:8000/storage/${item.product.image}`" width="50">
        <div>
          <p>{{ item.product.name }}</p>
          <p>{{ item.quantity }} x {{ item.product.price }} €</p>
          <button @click="removeFromCart(item.product.id)">Eliminar</button>
        </div>
      </div>
      <p>Total: {{ cartTotal }} €</p>
      <button @click="checkout" :disabled="cart.length === 0">Finalizar Compra</button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    computed: {
      cart() {
        return this.$store.state.cart;
      },
      cartTotal() {
        return this.cart.reduce((total, item) => {
          return total + (item.product.price * item.quantity);
        }, 0).toFixed(2);
      },
    },
    methods: {
      removeFromCart(productId) {
        this.$store.commit('removeFromCart', productId);
      },
      async checkout() {
        try {
          await axios.post('/api/orders', {
            products: this.cart.map(item => ({
              product_id: item.product.id,
              quantity: item.quantity,
            })),
          }, {
            headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
          });
          alert('¡Compra realizada con éxito!');
          this.$store.commit('clearCart');
        } catch (error) {
          alert('Error: ' + error.response.data.message);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .cart {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
  }
  .cart-item {
    display: flex;
    margin: 10px 0;
  }
  </style>