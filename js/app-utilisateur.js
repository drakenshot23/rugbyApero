

let app = new Vue({
   el: '#apero',
   data: {
       selectedTab: 1,

   },
    methods: {
       changeTab: function (event) {
           if((event.target.id) === "ajouterCourses")
           {
               this.selectedTab = 1;
           }
           if((event.target.id) === "creerGouter")
           {
               this.selectedTab = 2;
           }
       },
        updateProduit: function () {
            
        }
    }
});