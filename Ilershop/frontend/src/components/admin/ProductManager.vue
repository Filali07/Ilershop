<!-- frontend/src/components/admin/ProductManager.vue -->
<template>
    <div>
      <button @click="showForm = true">Añadir Producto</button>
      <table>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.name }}</td>
          <td><button @click="editProduct(product)">Editar</button></td>
        </tr>
      </table>
    </div>
  </template>