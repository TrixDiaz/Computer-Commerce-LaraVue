import { defineStore } from 'pinia';
import axios from 'axios';

export const useSearchStore = defineStore('search', {
  state: () => ({
    searchResults: [],
    isLoading: false,
    error: null,
  }),
  actions: {
    async searchProducts(query) {
      this.isLoading = true;
      this.error = null;
      try {
        const response = await axios.get('/api/search', { params: { query } });
        this.searchResults = response.data.data;
      } catch (error) {
        this.error = error.message;
      } finally {
        this.isLoading = false;
      }
    },
  },
});