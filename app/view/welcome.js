
const App = new Vue({
   el: '#app',
   data: {
   contador: 0
 }
});
 
setInterval(function() {
    App.contador += 1;
}, 1000);