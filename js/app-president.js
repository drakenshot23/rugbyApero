let listeParents = [];

let actionTabs = {AJOUTER: 1, DEFINIR: 2, SUPPRIMER: 3, REINITIALISER: 4 };

let appPresident = new Vue({
   el: "#apero",
    data: {
        selectedTab: actionTabs.AJOUTER,
    },
    methods: {
        changeTab: function (event) {
            if((event.target.id) === "ajouterProduit")
            {
                this.selectedTab = 1;
            }
            if((event.target.id) === "definirUtilisateur") {
                this.selectedTab = 2;
            }
            if((event.target.id) === "supprimerUtilisateur") {
                this.selectedTab = 3;
            }
            if((event.target.id) === "reinitialiser") {
                this.selectedTab = 4;
            }
        },
    }
});