import { createStore } from 'vuex'

export default createStore({
  state: {
    user: null,
    cart: []
  },
  mutations: {
    setUser(state, user) {
      state.user = user
    },
    addToCart(state, product) {
      const existingItem = state.cart.find(item => item.product.id === product.id)
      if (existingItem) {
        existingItem.quantity++
      } else {
        state.cart.push({ product, quantity: 1 })
      }
    },
    removeFromCart(state, productId) {
      state.cart = state.cart.filter(item => item.product.id !== productId)
    },
    clearCart(state) {
      state.cart = []
    }
  },
  actions: {
    async fetchUser({ commit }) {
      const response = await fetch('http://localhost:8000/api/user', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
      })
      const user = await response.json()
      commit('setUser', user)
    }
  },
  getters: {
    cartTotal: state => {
      return state.cart.reduce((total, item) => {
        return total + (item.product.price * item.quantity)
      }, 0).toFixed(2)
    }
  }
})