<template>
    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/admin" v-if="user?.isAdmin">Admin</router-link> |
      <router-link to="/login" v-if="!user">Login</router-link>
      <button v-else @click="logout">Logout</button>
    </nav>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    computed: {
      user() {
        return this.$store.state.user
      }
    },
    methods: {
      async logout() {
        await axios.post('http://localhost:8000/api/logout', {}, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
          }
        })
        localStorage.removeItem('token')
        this.$store.commit('setUser', null)
        this.$router.push('/login')
      }
    }
  }
  </script>