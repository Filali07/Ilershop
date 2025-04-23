<template>
    <div class="checkout">
      <h2>Finalizar Compra</h2>
      <div v-if="cartItems.length > 0">
        <div v-for="item in cartItems" :key="item.product.id" class="cart-item">
          <span>{{ item.product.name }} x {{ item.quantity }}</span>
          <span>{{ (item.product.price * item.quantity).toFixed(2) }} €</span>
        </div>
        <p>Total: {{ cartTotal }} €</p>
        <button @click="submitOrder">Confirmar Pedido</button>
      </div>
      <div v-else>
        <p>El carrito está vacío</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    computed: {
      cartItems() {
        return this.$store.state.cart.items;
      },
      cartTotal() {
        return this.$store.getters['cart/totalPrice'].toFixed(2);
      },
    },
    methods: {
      async submitOrder() {
        try {
          await axios.post('/api/orders', {
            products: this.cartItems.map(item => ({
              product_id: item.product.id,
              quantity: item.quantity,
            })),
          }, {
            headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` },
          });
          this.$store.commit('cart/clearCart');
          alert('¡Pedido realizado con éxito!');
          this.$router.push('/');
        } catch (error) {
          alert('Error al procesar el pedido: ' + error.response.data.message);
        }
      },
    },
  };
  </script>