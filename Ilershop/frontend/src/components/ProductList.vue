<template>
    <div class="product-list">
      <div v-for="product in products" :key="product.id" class="product-card">
        <img :src="`http://localhost:8000/storage/${product.image}`" :alt="product.name">
        <h3>{{ product.name }}</h3>
        <p>{{ product.price }} €</p>
        <p v-if="product.stock > 0">{{ product.stock }} disponibles</p>
        <p v-else class="stock-out">Agotado</p>
        <button @click="addToCart(product)" :disabled="product.stock === 0">
          Añadir al carrito
        </button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        products: [],
      };
    },
    async created() {
      const response = await axios.get('/api/products');
      this.products = response.data;
    },
    methods: {
      addToCart(product) {
        this.$store.commit('cart/addItem', product);
      },
    },
  };
  </script>
  
  <style scoped>
  .product-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
  }
  .stock-out {
    color: red;
  }
  </style>