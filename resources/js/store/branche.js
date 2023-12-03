import { defineStore } from 'pinia';

export const useBranchesStore = defineStore({
  id: 'branches',
  state: () => ({
    branches: [],
  }),
  actions: {
    addBranch(branch) {
      this.branches.push(branch);
    },
    // Autres actions pour la gestion des branches
  },
});
