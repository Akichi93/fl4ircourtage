export default {
    addToQueue(task) {
      const queue = JSON.parse(localStorage.getItem('syncQueue')) || [];
      queue.push(task);
      localStorage.setItem('syncQueue', JSON.stringify(queue));
    },
    syncQueueWithServer() {
      const queue = JSON.parse(localStorage.getItem('syncQueue'));
      if (queue && queue.length > 0) {
        return fetch('/api/sync-tasks', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(queue),
        })
          .then((response) => {
            if (response.ok) {
              localStorage.removeItem('syncQueue');
              console.log('Sync successful');
              return true;
            } else {
              console.error('Sync failed');
              return false;
            }
          })
          .catch((error) => {
            console.error('Error syncing:', error);
            return false;
          });
      } else {
        return Promise.resolve(true); // Renvoie une promesse résolue si la file d'attente est vide
      }
    },
  };
  