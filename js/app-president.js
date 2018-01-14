let listeParents = [];
let listeProduits = [];

let appPresident = new Vue({
   el: "#apero",
    data: {
        selectedTab: 1,
        nouvelUtilisateur: {
            nom: "",
            prenom: "",
            mail: ""
        }
    },
    methods: {
        changeTab: function (event) {
            if((event.target.id) === "ajouterProduit")
            {
                this.selectedTab = 1;
            }
            if((event.target.id) === "listeProduits")
            {
                this.selectedTab = 2;
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
        ajouterUtilisateur: function () {
            $.ajax({
                method: 'POST',
                url: '../controlleur/espace_president.php',
                data: JSON.stringify(this.nouvelUtilisateur),
                success: function (data) {
                    let rep = JSON.parse(data);
                    for(let i = 0; i < rep.length; i++)
                    {
                        let enf = {numEnfant: rep[i]['numEnfant'], prenom: rep[i]['prenom'], solde: rep[i]['solde']};
                        enfantsDuParent.push(enf);
                    }
                }
            });
        }
    }
});