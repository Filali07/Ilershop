<template>
    <div class="register">
      <h2>Registro</h2>
      <form @submit.prevent="handleRegister">
        <input v-model="form.name" placeholder="Nombre" required>
        <input v-model="form.email" type="email" placeholder="Email" required>
        <input v-model="form.password" type="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
      </form>
      <router-link to="/login">¿Ya tienes cuenta? Inicia sesión</router-link>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          password: '',
        },
      };
    },
    methods: {
      async handleRegister() {
        try {
          await axios.post('/api/register', this.form);
          this.$router.push('/login');
        } catch (error) {
          alert('Error en el registro: ' + error.response.data.message);
        }
      },
    },
  };
  </script>