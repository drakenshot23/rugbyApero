let liste = [{
    nom: "Lucas",
    solde: 10,
    id: null
},{
    nom: "Boby",
    solde: 15,
    id: null
}];

let actionTabs = {AJOUTER: 1, INSCRIRE: 2};

let app = new Vue({
    el: '#apero',
    data: {
        montant: $("montantEnfant").val(),
        nom: $("nom"),
        prenom: $("prenom"),

        listeEnfants: liste,
        afficherAjouterArgent: true,
        enfantSelectionne: liste[1].nom + " Solde : " + liste[1].solde + "€",
        selectedTab: actionTabs.AJOUTER
    },
    methods: {
        changeTab: function (event) {
            if((event.target.id) === "ajoutArgent")
            {
                this.selectedTab = actionTabs.AJOUTER;
            }
            if((event.target.id) === "inscriptionEnfant") {
                this.selectedTab = actionTabs.INSCRIRE;
            }
        },
        inscrireEnfant: function () {
            $.ajax({
                method: 'POST',
                url: '../controlleur/espace_parents.php',
                data: JSON.stringify({nom: $('#nom').val(), prenom: $('#prenom').val(), age: $('#age').val(), categorie: $('#categorie').val()}),
                success: function (data) {
                    let rep = JSON.parse(data);
                    // Ajouter l'enfant dans la liste des enfants pour être affiché dans le HTML
                }
            });
        },
        ajouterArgent: function () {
            $.ajax({
                method: 'POST',
                url: '../controlleur/espace_parents.php',
                data: JSON.stringify({}), // envoyer le
                success: function (data) {
                    let rep = JSON.parse(data);
                    // Modifier le solde de l'enfant
                }
            })
        },
        selectionnerEnfant: function (event) {
            // Selectionne l'enfant auquel on ajoutera l'argent
            let text = $(event.target).text();
            this.enfantSelectionne = text;

        }
    },
    beforeCreate: function() // se lance avant que le DOM soit initialisé
    {

    },
    mounted: function () { // Se lance une fois que le DOM est initialisé
        // initialiser les valeurs dans le HTML
    }
});