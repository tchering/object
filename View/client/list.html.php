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
        <tbody id="tbody_art" class="">
        </tbody>
        <tfoot id="tfoot_art">
            <tr>
                <th colspan="5" class="text-center bg-success" id="nbre_art">Nombre article...</th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    let clients = <?= $clients ?>

    function afficher(tableName) {
        let template = clients.map((client) => {
            return `
                <tr>
                    <td class = "w10"> ${client.id}</td>
                    <td class = "w20">${client.numClient}</td>
                    <td class = "w40">${client.nomClient}</td>
                    <td class = "w10">${client.adresseClient}</td>
                    <td class=" w20 buttons gap-sm-2  d-flex justify-content-between">
                        <button class="btn btn-sm btn-success">Afficher</button>
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                        <button class="btn btn-sm btn-primary">Modifier</button>
                    </td>
                </tr>
            `
        }).join('');
        tbody_art.innerHTML = template;
        let nbre = `Total Clients: ${clients.length}`;
        nbre_art.innerHTML = nbre;
    }
    afficher(clients);
</script>