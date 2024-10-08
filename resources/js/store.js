import { defineStore } from 'pinia';

export const useStore = defineStore('main', {
  state: () => ({
    latestProducts: [],
    allProducts: [],
    categories: [],
    cart: [],
    isLoading: true
  }),
  actions: {
    // Productos y categorías
    setLatestProducts(products) {
      this.latestProducts = products;
    },
    setAllProducts(products) {
      this.allProducts = products;
    },
    setCategories(categories) {
      this.categories = categories;
    },
    
    // Carrito
    initializeCart(cartItems) {
      this.cart = cartItems;
    },
    addToCart(product) {
      const existingItem = this.cart.find(item => item.id === product.id);
      if (existingItem) {
        existingItem.quantity += product.quantity;
      } else {
        this.cart.push(product);
      }
    },
    removeFromCart(productId) {
      this.cart = this.cart.filter(item => item.id !== productId);
    },

     setLoading(loading) {
      this.isLoading = loading;
    },
  }
})
