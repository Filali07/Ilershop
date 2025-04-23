<template>
    <div class="user-profile">
      <h2>Mi Perfil</h2>
      
      <div class="user-info">
        <p><strong>Nombre:</strong> {{ user.name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
      </div>
  
      <h3>Mis Pedidos</h3>
      <div v-if="orders.length > 0" class="orders-list">
        <div v-for="order in orders" :key="order.id" class="order-card">
          <p>Pedido #{{ order.id }} - Total: {{ order.total }} €</p>
          <p>Estado: {{ order.status }}</p>
        </div>
      </div>
      <p v-else>No tienes pedidos recientes</p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        user: {},
        orders: []
      }
    },
    async created() {
      await this.fetchUserData();
      await this.fetchOrders();
    },
    methods: {
      async fetchUserData() {
        const response = await axios.get('/api/user', {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
          }
        });
        this.user = response.data;
      },
      async fetchOrders() {
        const response = await axios.get('/api/orders', {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
          }
        });
        this.orders = response.data;
      }
    }
  }
  </script>
  
  <style scoped>
  .user-profile {
    max-width: 800px;
    margin: 0 auto;
  }
  .order-card {
    border: 1px solid #ddd;
    padding: 1rem;
    margin-bottom: 1rem;
  }
  </style>