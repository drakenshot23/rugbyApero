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
    beforeCreate: function() // se lance avant que le DOM soit initialisé
    {
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
                //alert(liste[0]['prenom']);
            }
        });
    },
    mounted: function () { // Se lance une fois que le DOM est initialisé
        this.listeEnfants = liste;


    },
    beforeUpdate: function () {
        this.enfantSelectionne = liste[0]['prenom'] + " Solde: " + liste[0]['solde'];
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
    }
});