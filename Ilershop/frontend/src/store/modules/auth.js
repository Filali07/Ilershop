// frontend/src/store/modules/auth.js
export default {
    namespaced: true,
    state: {
      user: null,
    },
    mutations: {
      setUser(state, user) {
        state.user = user;
      },
    },
    actions: {
      async fetchUser({ commit }) {
        const response = await axios.get('/api/user', {
          headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
        });
        commit('setUser', response.data);
      },
    },
  };