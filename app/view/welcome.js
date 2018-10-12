new Vue({
    el: '#app',
    data: {
    contador: 0
  },
  mounted()  {
     setInterval(()=> {
        this.contador += 1;
     }, 1000);
   }
 })