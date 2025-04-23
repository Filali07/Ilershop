export default {
    namespaced: true,
    state: {
      items: [],
    },
    mutations: {
      addItem(state, product) {
        const existingItem = state.items.find(item => item.product.id === product.id);
        if (existingItem) {
          existingItem.quantity++;
        } else {
          state.items.push({ product, quantity: 1 });
        }
      },
      removeItem(state, productId) {
        state.items = state.items.filter(item => item.product.id !== productId);
      },
      clearCart(state) {
        state.items = [];
      },
    },
    getters: {
      totalItems: state => state.items.reduce((total, item) => total + item.quantity, 0),
      totalPrice: state => state.items.reduce((total, item) => total + (item.product.price * item.quantity), 0),
    },
  };