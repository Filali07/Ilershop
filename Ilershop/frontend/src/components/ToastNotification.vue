<template>
    <div class="toast" :class="type" v-if="show">
      {{ message }}
      <button @click="close">×</button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        show: false,
        message: '',
        type: 'success'
      };
    },
    methods: {
      showToast(message, type = 'success') {
        this.message = message;
        this.type = type;
        this.show = true;
        setTimeout(() => this.close(), 5000);
      },
      close() {
        this.show = false;
      }
    }
  };
  </script>
  
  <style scoped>
  .toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 15px 20px;
    color: white;
    border-radius: 4px;
    display: flex;
    align-items: center;
    z-index: 1000;
  }
  
  .toast.success {
    background-color: #4CAF50;
  }
  
  .toast.error {
    background-color: #F44336;
  }
  
  .toast button {
    margin-left: 15px;
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
  }
  </style>