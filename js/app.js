let liste = [{
    nom: "Lucas",
    solde: 10
},{
    nom: "Boby",
    solde: 15
}];

let app = new Vue({
    el: '#apero',
    data: {
        listeEnfants: liste,
        afficherAjouterArgent: true,
        enfantSelectionne: liste[1].nom

    },
    methods: {
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
        selectionnerEnfant: function () {
            // Selectionne l'enfant auquel on ajoutera l'argent
            alert("Enfant selectionnée");
        },
        afficher: function () {

        }
    },
    beforeCreate: function() // se lance avant que le DOM soit initialisé
    {
        // Recuperer la liste des enfants et la stocker dans la liste
    },
    mounted: function () { // Se lance une fois que le DOM est initialisé
        // initialiser les valeurs dans le HTML
    }
});