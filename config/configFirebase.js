// configFirebase.js
const firebaseConfig = {
    apiKey: "AIzaSyDBdSRyaboQFVLZslagd8IeD197Ce05ZoM",
    authDomain: "grafico-93b0a.firebaseapp.com",
    projectId: "grafico-93b0a",
    storageBucket: "grafico-93b0a.firebasestorage.app",
    messagingSenderId: "546497332413",
    appId: "1:546497332413:web:9192f88305926aa4b1a3d4"
  };
  
  // Inicializar o Firebase
  const app = firebase.initializeApp(firebaseConfig);
  const db = firebase.firestore();