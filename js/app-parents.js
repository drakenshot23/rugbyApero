var liste = [];

let actionTabs = {AJOUTER: 1, INSCRIRE: 2};

let app = new Vue({
    el: '#apero',
    data: {
        nouvelEnfant: {
            commande: "inscription",
            nom: "",
            prenom: "",
            age: "",
            telParent: "",
            categorie: ""
        },
        montant: "",
        listeEnfants: liste,
        afficherAjouterArgent: true,
        enfantSelectionne: "",
        selectedTab: actionTabs.AJOUTER
    },
    beforeCreate: function() // se lance avant que le DOM soit crée
    {
        // Recuperer la liste des enfants depuis la base de donnée
        $.ajax({
            method: 'POST',
            url: '../controlleur/espace_parents.php',
            data: JSON.stringify({commande: "afficherEnfant"}),
            success: function (data) {
                let rep = JSON.parse(data);
                for(let i = 0; i < rep.length; i++)
                {
                    let enf = {numEnfant: rep[i]['numEnfant'], prenom: rep[i]['prenom'], solde: rep[i]['solde']};
                    liste.push(enf);
                }
            }
        });
    },
    beforeMount: function() // se lance avant que le DOM soit initialisé
    {
        this.listeEnfants = liste;
    },
    mounted: function () { // Se lance une fois que le DOM est initialisé

    },
    beforeUpdate: function () {

      this.listeEnfants = liste;
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
                data: JSON.stringify(this.nouvelEnfant),
                success: function (data) {
                    let rep = JSON.parse(data);
                    for(let i = 0; i < rep.length; i++)
                    {
                        let enf = {numEnfant: rep[i]['numEnfant'], prenom: rep[i]['prenom'], solde: rep[i]['solde']};
                        liste.push(enf);
                    }
                }
            });
        },
        ajouterArgent: function () {
            $.ajax({
                method: 'POST',
                url: '../controlleur/espace_parents.php',
                data: JSON.stringify({commande: "ajouterArgent", }), // envoyer le
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

        },
        supprimerEnfant: function () {
            console.log("Delete successful!");
        },
        confirmation: function () {
            if(window.confirm("Voulez vous supprimer l'enfant ?") === true)
            {
                this.supprimerEnfant();
            }
        }
    }
});