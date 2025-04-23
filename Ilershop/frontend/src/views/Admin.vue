<template>
    <div class="admin">
      <h1>Admin Panel</h1>
      <ProductManager />
    </div>
  </template>
  
  <script>
  import ProductManager from '@/components/admin/ProductManager.vue'
  
  export default {
    name: 'Admin',
    components: {
      ProductManager
    }
  }
  </script>