window.onload = () => {
    document.getElementById("bouton_ajax").addEventListener("click", callAjax);
    document.getElementByID("addProduitForm").addEventListener("submit", preventForm);
}

function callAjax() {
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
    xhttp.send("action=testAjax&nom=JF");
}

function preventForm(event) {
    event.preventDefault();
}