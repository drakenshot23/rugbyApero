/*Vue.component('liste-enfants', {
    template: '<li>{{ nom }} <span class="badge badge-primary">{{ solde }}</span>'
});*/

var app = new Vue({
    el: '#app',
    data: {
        price: 25
    },
    mounted: function () {
        console.log("Hello World");
    }
});