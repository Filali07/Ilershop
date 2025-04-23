<!-- frontend/src/views/Login.vue -->
<template>
    <div class="login">
      <h2>Iniciar Sesión</h2>
      <form @submit.prevent="handleLogin">
        <input v-model="email" type="email" placeholder="Email" required>
        <input v-model="password" type="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
      </form>
      <p v-if="error" class="error">{{ error }}</p>
      <router-link to="/register">¿No tienes cuenta? Regístrate</router-link>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        email: '',
        password: '',
        error: '',
      };
    },
    methods: {
      async handleLogin() {
        try {
          const response = await axios.post('http://localhost:8000/api/login', {
            email: this.email,
            password: this.password,
          });
          localStorage.setItem('token', response.data.access_token);
          this.$store.commit('setUser', response.data.user);
          this.$router.push('/');
        } catch (err) {
          this.error = 'Credenciales incorrectas';
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .login {
    max-width: 400px;
    margin: 0 auto;
  }
  .error {
    color: red;
  }
  </style>