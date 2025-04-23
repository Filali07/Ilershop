<template>
    <div class="product-form">
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label>Nombre</label>
          <input v-model="form.name" required>
        </div>
  
        <div class="form-group">
          <label>Precio</label>
          <input v-model="form.price" type="number" step="0.01" required>
        </div>
  
        <div class="form-group">
          <label>Stock</label>
          <input v-model="form.stock" type="number" required>
        </div>
  
        <div class="form-group">
          <label>Imagen</label>
          <input type="file" @change="handleImageUpload">
          <img v-if="form.image_url" :src="form.image_url" width="100">
        </div>
  
        <button type="submit">{{ isEditing ? 'Actualizar' : 'Crear' }}</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      product: {
        type: Object,
        default: null
      }
    },
    data() {
      return {
        form: {
          name: '',
          price: 0,
          stock: 0,
          image: null,
          image_url: null
        },
        isEditing: false
      }
    },
    created() {
      if (this.product) {
        this.form = {
          name: this.product.name,
          price: this.product.price,
          stock: this.product.stock,
          image_url: `/storage/${this.product.image}`
        };
        this.isEditing = true;
      }
    },
    methods: {
      handleImageUpload(event) {
        this.form.image = event.target.files[0];
        this.form.image_url = URL.createObjectURL(this.form.image);
      },
      async handleSubmit() {
        const formData = new FormData();
        formData.append('name', this.form.name);
        formData.append('price', this.form.price);
        formData.append('stock', this.form.stock);
        if (this.form.image) {
          formData.append('image', this.form.image);
        }
  
        try {
          const url = this.isEditing 
            ? `/api/products/${this.product.id}`
            : '/api/products';
          const method = this.isEditing ? 'put' : 'post';
  
          await axios[method](url, formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
              'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
          });
  
          this.$emit('saved');
        } catch (error) {
          console.error('Error:', error.response.data);
        }
      }
    }
  }
  </script>
  
  <style scoped>
  .product-form {
    max-width: 500px;
    margin: 0 auto;
  }
  .form-group {
    margin-bottom: 1rem;
  }
  </style>