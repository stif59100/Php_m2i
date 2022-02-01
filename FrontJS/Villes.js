/**
*
* @returns {undefined}
*/
function afficherVilles() {
    console.log("afficherVilles")
    // CALL ASYNC REQUEST (API REST PHP)
    // FETCH
    fetch("http://127.0.0.1/PourFrontJS2022/controls/VillesCTRLSelectAll.php").then((response) => {
        console.log("response")
        console.log(response)
        return response.json();
    }).then((data) => {
        console.log("data")
        console.log(data)
        let contents = "";
        for (let i = 0; i < data.length; i++) {
            contents += data[i]["cp"] + ":" + data[i]["nom_ville"] + ":" + data[i]["site"] + ":" + data[i]["photo"] + ":" + data[i]["id_pays"] + "<br>"
        }
        document.getElementById("resultats").innerHTML = contents
    }).catch((error) => {
        console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
    });



    // PROMISE





    // ASYNC/AWAIT





}
/// afficherVilles
// -------------------------

function afficherVille(cp) {
    console.log("afficherVille")
    // CALL ASYNC REQUEST (API REST PHP)
    // FETCH
    fetch("http://127.0.0.1/PourFrontJS2022/controls/VillesCTRLSelectOne.php?cp=" + cp).then((response) => {
        console.log("response")
        console.log(response)
        return response.json();
    }).then((data) => {
        console.log("data")
        console.log(data)
        let contents = "";

        for (let i = 0; i < data.length; i++) {
            contents += data[i]["cp"] + ":" + data[i]["nom_ville"] + ":" + data[i]["site"] + ":" + data[i]["photo"] + ":" + data[i]["id_pays"] + "<br>"
        }

        document.getElementById("resultats").innerHTML = contents
    }).catch((error) => {
        console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
    });


    // AfficherCP

}

function deleteVille(event) {
    // CALL ASYNC REQUEST (API REST PHP)
    url = this.form.action
    formdata = new FormData(this.form)



    fetch(url, { method: 'POST', body: formdata })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`${response.status} ${response.statusText} ${response.url}`)
            } else { return response.json() }
        })

        .then((data) => {
            console.log("data", data)
            let contents = `${data.suppression} enregistrement(s) supprimé(s)`
            document.getElementById("resultats").innerHTML = contents
        }).catch((error) => {
            console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
        })
        
}

function insertVille(event) {
    // CALL ASYNC REQUEST (API REST PHP)
    url = this.form.action
    formdata = new FormData(this.form)



    fetch(url, { method: 'POST', body: formdata })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`${response.status} ${response.statusText} ${response.url}`)
            } else { return response.json() }
        })

        .then((data) => {
            console.log("data", data)
            let contents = `${data.ajout} ajout(s) effectué(s)`
            document.getElementById("resultats").innerHTML = contents
        }).catch((error) => {
            console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
        })
        
}


window.onload = () => {
    // CALL FUNCTION-PROCEDURE WITHOUT PARAMETER
    document.getElementById("btVillesSelectAll").addEventListener("click", afficherVilles)



    // CALL FUNCTION-PROCEDURE WITH PARAMETER AND MANY INSTRUCTIONS
    document.getElementById("btVillesSelectOne").addEventListener("click", () => {
        console.log("btVillesSelectOne")
        let cp = document.getElementById("cpSelectOne").value
        console.log(cp)
        afficherVille(cp)
    })



    //document.getElementById("btVillesDelete").addEventListener("click", () => {
      //  console.log("btVillesDelete")
        //let cp = document.getElementById("cpDelete").value
        //console.log(cp)
        //deleteVille(cp)
    //})

    document.getElementById("btVillesDelete").addEventListener("click", deleteVille)

    document.getElementById("btVillesInsert").addEventListener("click", insertVille)



    // $("#btVillesInsert").on("click", () => {
    // console.log("btVillesInsert")
    // let cp = $("#cpInsert").val()
    // let nomVille = $("#nomVille").val()
    // let site = $("#site").val()
    // let photo = $("#photo").val()
    // let idPays = $("#idPays").val()
    // console.log(cp)
    // console.log(nomVille)
    // console.log(site)
    // console.log(photo)
    // console.log(idPays)
    //
    // insertVille(cp, nomVille, site, photo, idPays)
    // })
    //})
}
