<template>
    <div class="counter-card">
      <div v-for="(digit, index) in digitArray" :key="index" class="digit">
        {{ digit }}
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      targetNumber: {
        type: Number,
        required: true,
      },
    },
    data() {
      return {
        digitArray: [],
      };
    },
    methods: {
      startAnimation() {
        const delay = 0; // Ajustez le délai selon vos besoins
        let currentNumber = 0;
  
        const intervalId = setInterval(() => {
          this.digitArray = currentNumber
            .toString()
            .split("")
            .map(Number);
  
          currentNumber++;
  
          if (currentNumber > this.targetNumber) {
            clearInterval(intervalId);
          }
        }, delay);
      },
    },
    mounted() {
      this.startAnimation();
    },
  };
  </script>
  
  <style scoped>
  .counter-card {
    display: flex;
  }
  h2{
    display: flex;
  }
  
  .digit {
    font-size: 3rem; 
    margin-right: 5px; 
  }
  </style>
  