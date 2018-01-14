let listeParents = [];
let listeProduits = [];

let appPresident = new Vue({
   el: "#apero",
    data: {
        selectedTab: 1,
    },
    methods: {
        changeTab: function (event) {
            if((event.target.id) === "ajouterProduit")
            {
                this.selectedTab = 1;
            }
            if((event.target.id) === "listeProduits")
            {
                this.selectedTab =2;
            }
            if((event.target.id) === "definirUtilisateur") {
                this.selectedTab = 3;
            }
            if((event.target.id) === "supprimerUtilisateur") {
                this.selectedTab = 4;
            }
            if((event.target.id) === "reinitialiser") {
                this.selectedTab = 5;
            }
        },
    }
});