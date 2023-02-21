window.onload = () => {
    document.getElementById("bouton_ajax").addEventListener("click", function() {
        callAjax("testAjax&nom=JF");
    });
    
    document.getElementById("formAjouterProduit").addEventListener("submit", preventForm);

    document.getElementById("boutonAjouterProduit").addEventListener("click", afficherFormProduit);
}

function callAjax(bodyRequest) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            if (this.status === 200) {
                //document.getElementById("reponse_ajax").innerHTML = this.responseText;
                alert("Fonctionne");
            }
            else if (this.status === 400)
                //alert(this.responseText);
                alert("Fonctionne pas");
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
}

function preventForm(event) {

   // print_r(event);

    //callAjax(method, url, action);
    event.preventDefault();
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