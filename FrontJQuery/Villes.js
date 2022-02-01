/* 
 * Villes.js
 */

/**
 * 
 * @returns {undefined}
 */
function afficherVilles() {
    // CALL ASYNC REQUEST (API REST PHP)
    let xhr = $.get(
            "http://127.0.0.1/PourFrontJS2022/controls/VillesCTRLSelectAll.php"
            )
    xhr.done(function (data) {
        $("#resultats").html(data)
    })
    xhr.fail(function (xhr, statut, erreur) {
        $("#resultats").html(xhr)
    })
} /// afficherVilles

/**
 * 
 * @param {type} cp
 * @returns {undefined}
 */
function afficherVille(cp) {
    let xhr = $.get(
            "http://127.0.0.1/PourFrontJS2022/controls/VillesCTRLSelectOne.php",
            {cp: cp}
    )
    xhr.done(function (data) {
        $("#resultats").html(data)
    })
    xhr.fail(function (xhr, statut, erreur) {
        $("#resultats").html(xhr)
    })
} /// afficherVille

/**
 * 
 * @param {type} cp
 * @returns {undefined}
 */
function deleteVille(cp) {
    let xhr = $.post(
            "http://127.0.0.1/PourFrontJS2022/controls/VillesCTRLDelete.php",
            {cp: cp}
    )
    xhr.done(function (data) {
        $("#resultats").html(data)
    })
    xhr.fail(function (xhr, statut, erreur) {
        $("#resultats").html(xhr)
    })
} /// deleteVille

/**
 * 
 * @param {type} cp
 * @param {type} nomVille
 * @param {type} site
 * @param {type} photo
 * @param {type} idPays
 * @returns {undefined}
 */
function insertVille(cp, nomVille, site, photo, idPays) {
    let xhr = $.post(
            "http://127.0.0.1/PourFrontJS2022/controls/VillesCTRLInsert.php",
            {cp: cp, nomVille: nomVille, site: site, photo: photo, idPays: idPays}
    )
    xhr.done(function (data) {
        $("#resultats").html(data)
    })
    xhr.fail(function (xhr, statut, erreur) {
        $("#resultats").html(xhr)
    })
} /// insertVille

// -------------------------
$(document).ready(function () {
    // CALL FUNCTION-PROCEDURE WITHOUT PARAMETER
    $("#btVillesSelectAll").on("click", afficherVilles)

    // CALL FUNCTION-PROCEDURE WITH PARAMETER AND MANY INSTRUCTIONS
    $("#btVillesSelectOne").on("click", () => {
        console.log("btVillesSelectOne")
        let cp = $("#cpSelectOne").val()
        console.log(cp)
        afficherVille(cp)
    })

    $("#btVillesDelete").on("click", () => {
        console.log("btVillesDelete")
        let cp = $("#cpDelete").val()
        console.log(cp)
        deleteVille(cp)
    })

    $("#btVillesInsert").on("click", () => {
        console.log("btVillesInsert")
        let cp = $("#cpInsert").val()
        let nomVille = $("#nomVille").val()
        let site = $("#site").val()
        let photo = $("#photo").val()
        let idPays = $("#idPays").val()
        console.log(cp)
        console.log(nomVille)
        console.log(site)
        console.log(photo)
        console.log(idPays)

        insertVille(cp, nomVille, site, photo, idPays)
    })
})
