// IndexedDBManager.js

class IndexedDBManager {
    static dbName = 'YourDBName';
    static storeName = 'YourStoreName';
  
    static openDB() {
      return new Promise((resolve, reject) => {
        const request = indexedDB.open(IndexedDBManager.dbName, 1);
  
        request.onerror = (event) => {
          reject('Error opening IndexedDB');
        };
  
        request.onsuccess = (event) => {
          const db = event.target.result;
          resolve(db);
        };
  
        request.onupgradeneeded = (event) => {
          const db = event.target.result;
  
          if (!db.objectStoreNames.contains(IndexedDBManager.storeName)) {
            db.createObjectStore(IndexedDBManager.storeName, { keyPath: 'id' });
          }
        };
      });
    }
  
    static storeData(data) {
      return this.openDB().then((db) => {
        return new Promise((resolve, reject) => {
          const transaction = db.transaction([IndexedDBManager.storeName], 'readwrite');
          const store = transaction.objectStore(IndexedDBManager.storeName);
  
          data.forEach((item) => {
            store.put(item);
          });
  
          transaction.oncomplete = () => {
            resolve('Data stored successfully in IndexedDB');
          };
  
          transaction.onerror = (event) => {
            reject('Error storing data in IndexedDB');
          };
        });
      });
    }
  }
  
  export default IndexedDBManager;
  