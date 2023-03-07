window.onload = () => {
    document.getElementById("bouton_ajax").addEventListener("click", function() {
        callAjax("testAjax&nom=JF");
    });
    
    document.getElementById("formAjouterProduit").addEventListener("submit", ajouterProduitBD);

    document.getElementById("boutonAjouterProduit").addEventListener("click", afficherFormProduit);

    for (let i = 0; i < document.getElementsByClassName("boutonSupprimerProduit").length; i++) {
        document.getElementsByClassName("boutonSupprimerProduit")[i].addEventListener("click", supprimerProduit);
    }
}

function callAjax(bodyRequest, action) {
    var xhttp = new XMLHttpRequest();
    var id;
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            if (this.status === 200) {
                
                // Listes des requêtes
                if (action == "ajouterProduit") {
                    alert("L'ajout a été fait avec succès");
                    let tableau = new URLSearchParams(bodyRequest);
                    // Afficher le produit sans reload la page
                    
                    afficherProduit(tableau.get('nomProduit'), tableau.get('description'), this.response);
                    insertionReussie();


                }
                else if (action == "supprimerProduit") {
                    alert("La suppression a été faite avec succès");
                    //enleverProduit();
                }
                
            }
            else if (this.status === 400)

                alert("Une erreur est survenue");
        }
    };

    /************************************************************/
    /* REQUÊTE AJAX AVEC LA MÉTHODE GET        */
    /************************************************************/
    //xhttp.open("get", "./index.php?action=testAjax", true);
    //xhttp.send();

    /************************************************************/
    /* REQUÊTE AJAX AVEC LA MÉTHODE POST       */
    /************************************************************/
    xhttp.open("post", "./index.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=" + bodyRequest);
    console.log(id);
}

function ajouterProduitBD(event) {

    // Prevent l'envoi du formulaire
    event.preventDefault();

    // Récupère les infos du formulaire 
    nomProduit = document.getElementById("produit").value;
    categorie = document.getElementById("categorie").value;
    description = document.getElementById("description").value;

    // Vérifications si vide
    if (nomProduit != "" && description != "") {
        
        // Créer la requête à passer dans le callAjax
        requete = "ajouterProduit&nomProduit=" + nomProduit + "&categorie=" + categorie + "&description=" + description;
        idProduit = callAjax(requete, "ajouterProduit");

        
    }
    // Au moins un champs vide
    else {
        alert("Assurez vous de remplir tous les champs!");
    }
}

function insertionReussie() {

    // Effacer données du formulaire
    document.getElementById("produit").value = "";
    document.getElementById("categorie").value = 1;
    document.getElementById("description").value = "";

    // Faire disparaître le formulaire
    let formAjouterProduit = document.getElementById('formAjouterProduit');
    formAjouterProduit.classList.add("hidden");
}

function afficherProduit(nomProduit, description, idProduit) {

    console.log(description);

    // Print d'un produit

    let apres = document.getElementById("formAjouterProduit");

    let div = document.createElement("div");
    let h3 = document.createElement("h3");
    let input = document.createElement("input");
    let p = document.createElement("p");

    div.classList.add("sectionProduit");

    h3.innerHTML = "Produit: " + nomProduit;

    input.className = "littleIcon boutonSupprimerProduit";
    input.addEventListener("click", supprimerProduit);
    input.type = "image";
    input.src = "./inc/img/delete-icon.png";
    input.alt = "Supprimer un produit";
    input.value = idProduit; //Comment prendre dernier id de la bd?

    p.innerHTML = "Description : " + description;

    apres.parentNode.insertBefore(div, apres.nextElementSibling);
    div.appendChild(h3);
    div.appendChild(input);
    div.appendChild(p);

}

function enleverProduit(event) {

    // Enlever la section du produit
    event.target.parentNode.remove();

}

function supprimerProduit(event) {

    if(confirm("Voulez-vous vraiment supprimer ce produit?")) {

        // Récupère le idProduit
        let idProduit = event.target.value

        // Créer la requête à passer dans le callAjax
        requete = "supprimerProduit&idProduit=" + idProduit;
        callAjax(requete, "supprimerProduit");

        // Enlever le produit sans reload la page
        enleverProduit(event);
    }
    
}

function afficherFormProduit() {

    let formAjouterProduit = document.getElementById('formAjouterProduit');

    if(formAjouterProduit.classList.contains("hidden")) {
        formAjouterProduit.classList.remove("hidden");
    }
    else {
        formAjouterProduit.classList.add("hidden");
    }
}