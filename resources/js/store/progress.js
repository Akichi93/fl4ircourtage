import { defineStore } from 'pinia';

export const useProgressStore = defineStore({
  id: 'progress',
  state: () => ({
    percentage: 0,
  }),
  actions: {
    setPercentage(percentage) {
      this.percentage = percentage;
    },
  },
});
