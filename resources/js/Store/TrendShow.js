import { defineStore } from 'pinia';
import axios from 'axios';

export const useTrendingStore = defineStore('trending', {
  state: () => ({
    trendingItems: [],
    images: [],
    loading: false,
    error: null,
  }),
  actions: {
    async fetchTrendingItems() {
      this.loading = true;
      try {
        const response = await axios.get('/api/trending/show');
        this.trendingItems = response.data;
       
        this.images = response.data.map(item => item.imageUrl);
      } catch (error) {
        this.error = error.message;
      } finally {
        this.loading = false;
      }
    },
  },
});
