<template>
      <button @click="exportToCSV">Export to CSV</button>
</template>
<script>
export default {
      methods: {
            exportToCSV() {
                  const header = Object.keys(this.clients.data[0]).join(',');
                  const rows = this.clients.data.map(row => Object.values(row).join(','));

                  const csvContent = `${header}\n${rows.join('\n')}`;

                  const blob = new Blob([csvContent], { type: 'text/csv' });
                  const link = document.createElement('a');
                  link.href = window.URL.createObjectURL(blob);
                  link.download = 'data.csv';
                  link.click();
            },
      }
}
</script>