<template>
    <div class="home">
      <ProductList />
      <ShoppingCart />
    </div>
  </template>
  
  <script>
  import ProductList from '@/components/ProductList.vue'
  import ShoppingCart from '@/components/ShoppingCart.vue'
  
  export default {
    name: 'Home',
    components: {
      ProductList,
      ShoppingCart
    }
  }
  </script>