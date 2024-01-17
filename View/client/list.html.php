<style>
    #tbody_art {
        display: block;
        width: 100%;
        height: 200px;
        overflow: auto;
    }

    #thead_art,
    #tbody_art tr,
    #tfoot_art {
        display: table;
        width: 100%;
    }
</style>
<div class="">
    <h1 class="titre center text-light">Liste Client</h1>
    <div class="div_btn">
        <a href="client&action=insert" class="btn btn-md btn-success mb-2 print-none">Ajourter Client</a>
        <a href="javascript:window.print()" class="btn btn-md btn-primary mb-2 print-none">Imprimer</a>
    </div>
    <table class="table w100">
        <thead id="thead_art">
            <tr class="bg-success">
                <th class="w20">CODE</th>
                <th class="w20">N° CLIENT</th>
                <th class="w40">NOM</th>
                <th class="w10">Addresse</th>
                <th class="w20">ACTION</th>
            </tr>
        </thead>
        <tbody id="tbody_art" class=""></tbody>
        <tfoot id="tfoot_art">
            <tr>
                <th colspan="5" class="text-center bg-success" id="nbre_art">Nombre article...</th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    //! I transformed in json_encode because without it was not working for search method.
    let clients = <?= json_encode($clients) ?>

    function afficher(tableName) {
        let template = clients.map((client) => {
            return `
                <tr>
                    <td class="w10">${client.id}</td>
                    <td class="w20">${client.numClient}</td>
                    <td class="w40">${client.nomClient}</td>
                    <td class="w10">${client.adresseClient}</td>
                    <td class="w20 buttons gap-sm-2 d-flex justify-content-between">
                        <a href="client&action=show&id=${client.id}" class="btn btn-sm btn-success">Afficher</a>
                        <a href="client&action=update&id=${client.id}" class="btn btn-sm btn-primary">Modifier</a>
                        <button class="btn btn-sm btn-danger" onclick="supprimer(${client.id})">Supprimer</button>
                    </td>
                </tr>
            `;
        }).join('');
        tbody_art.innerHTML = template;
        let nbre = `Total Clients: ${clients.length}`;
        nbre_art.innerHTML = nbre;
    }
    afficher(clients);
//!here we wrote function instead of writing like this <a href="client&action=delete&id=${client.id}" because we want to show confirmation before delete
    function supprimer(id) {
        const response = confirm("Voulez-vous bien supprimer ce client?");
        if (response) {
            document.location.href = `client&action=delete&id=${id}`;
        }
    }
//! function search is called via javascript;
    function chercher(){
        document.location.href="client&action=search&mot="+mot.value;
    }
    //! when enter key is pressed the chercher() is called.
    function touche(event){
        document.getElementById('mot').addEventListener('keydown',(event) => {
            if(event.key === "Enter"){
                chercher();
            }
        })
    }
</script>