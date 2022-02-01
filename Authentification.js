/*
 Authentification.js
 */

var langue = 'fr';
var fr = ['Authentification', 'Mot de passe visible', 'Masquer le mot de passe', 'Valider']
var it = ['Autenticazione', 'Password visibile', 'Masquerare il password', 'Validare']

function initAuthentification() {
    // Quand l'utilisateur clique sur le bouton "valider"
    // On sollicite la fonction valider
    document.getElementById("lblMessage").innerHTML = ''
    document.getElementById("pseudo").value = 'matieu'
    document.getElementById("mdp").value = 'azerty'
    document.getElementById("btValider").onclick = valider
    document.getElementById('chkVisibilite').addEventListener("click", masquerAfficherMDP)
    document.getElementById("francais").onclick = () => { changerTexte('fr') }
    document.getElementById('italien').addEventListener("click", () => { changerTexte('it') })
} /// init

/**
 * 
 * @returns {undefined}
 */
function changerTexte(pLangue) {

    document.getElementById("lblMessage").innerHTML = ""

    langue = pLangue
    // CHOIX DISCUTABLE
    document.getElementById('chkVisibilite').checked = false
    document.getElementById('mdp').type = "password"

    if (langue == 'fr') {
        document.getElementById('titre').innerHTML = fr[0]
        document.getElementById('lblVisible').innerHTML = fr[1]
        document.getElementById('btValider').value = fr[3]
    }
    if (langue == 'it') {
        document.getElementById('titre').innerHTML = it[0]
        document.getElementById('lblVisible').innerHTML = it[1]
        document.getElementById('btValider').value = it[3]
    }
} /// changerTexte

/**
 * 
 * @returns {undefined}
 */
function masquerAfficherMDP() {
    let password = document.getElementById('mdp')
    console.log('masquerAfficherMDP')
    let chkVisibilite = document.getElementById('chkVisibilite')

    if (chkVisibilite.checked) {
        password.type = "text"
        console.log("etat : " + document.getElementById('chkVisibilite').checked)
        if (langue == 'fr') {
            document.getElementById('lblVisible').innerHTML = fr[2]
        }
        if (langue == 'it') {
            document.getElementById('lblVisible').innerHTML = it[2]
        }
    } else {
        password.type = 'password'
        console.log("etat : " + document.getElementById('chkVisibilite').checked)
        if (langue == 'fr') {
            document.getElementById('lblVisible').innerHTML = fr[1]
        }
        if (langue == 'it') {
            document.getElementById('lblVisible').innerHTML = it[1]
        }
    }
} /// masquerAfficherMDP

/**
 * 
 * @returns {undefined}
 */
function valider() {
    // Déclaration d'une variable et affectation d'une valeur
    let message = "0K"

    // Récupération d'une saisie de l'utilisateur
    let pseudo = document.getElementById("pseudo").value
    let mdp = document.getElementById("mdp").value
    // Test des valeurs saisies
    // trim() enlève les espaces avant et après
    // Si le pseudo est vide ou si le mdp est vide alors

    if (pseudo.trim() === "" || mdp.trim() === "") {
        // Affectation de "Il faut tout saisir" à la variable message
        message = "Il faut tout saisir"
    }

    // Affichage d'une valeur (0K ou Il faut tout saisir) dans le <label>
    document.getElementById("lblMessage").innerHTML = message
} /// valider

/*
 MAIN
 Au chargement de la page et de la lecture du fichier js on sollicite la fonction init
 */
window.onload = initAuthentification
