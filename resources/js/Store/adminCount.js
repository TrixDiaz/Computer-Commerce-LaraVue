import { defineStore } from 'pinia';
import axios from 'axios';

export const useAdminCount = defineStore('admin', {
  state: () => ({
    totalUsers: 0,
    totalAnnouncements: 0,
  }),
  actions: {
    async fetchTotals() {
      try {
        const response = await axios.get('/api/admin/totals');
        this.totalUsers = response.data.totalUsers;
        this.totalAnnouncements = response.data.totalAnnouncements;
      } catch (error) {
        console.error('Error fetching totals:', error);
      }
    },
  },
});