<template>
  <div class="order-detail">
    <h2>Detalle del Pedido #{{ order.id }}</h2>
    
    <div class="order-info">
      <p><strong>Fecha:</strong> {{ new Date(order.created_at).toLocaleString() }}</p>
      <p><strong>Total:</strong> {{ order.total }} €</p>
      <p><strong>Estado:</strong> {{ order.status }}</p>
    </div>

    <h3>Productos</h3>
    <div class="products-list">
      <div v-for="item in order.products" :key="item.id" class="product-item">
        <img :src="`http://localhost:8000/storage/${item.image}`" width="80">
        <div>
          <h4>{{ item.name }}</h4>
          <p>{{ item.pivot.quantity }} x {{ item.pivot.price_at_purchase }} €</p>
        </div>
      </div>
    </div>

    <button @click="$router.go(-1)">Volver</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      order: {}
    };
  },
  async created() {
    const orderId = this.$route.params.id;
    const response = await axios.get(`/api/orders/${orderId}`, {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });
    this.order = response.data;
  }
};
</script>

<style scoped>
.order-detail {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.product-item {
  display: flex;
  margin-bottom: 15px;
  border-bottom: 1px solid #eee;
  padding-bottom: 15px;
}

.product-item img {
  margin-right: 20px;
}
</style>