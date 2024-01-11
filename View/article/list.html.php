<div class="w90 auto">
    <h1 class="titre center text-light">Liste Article</h1>
    <table class="table w-100">
        <thead id="thead_art">
            <tr class="bg-success">
                <th>ID</th>
                <th>CODE</th>
                <th>DESIGNATION</th>
                <th>PU</th>
                <th>ACTION</th>
        <tbody id="tbody_art">
        </tbody>
        <tfoot id="tfoot_art">
            <tr class="bg-success">
                <th colspan="5" class="text-center" id="nbre_art">Nombre article...</th>
            </tr>
        </tfoot>
        </tr>
        </thead>
    </table>
</div>

<script>
    let articles = <?= $articles ?>;
    console.log(articles);
    //!function to show the page in table body
    function afficher(tableName) {
        let html = articles.map((article) => {
            return `
                <tr>
                    <td>${article.id} </td>
                    <td>${article.numArticle} </td>
                    <td>${article.designation} </td>
                    <td>${article.prixUnitaire}</td>
                    <td>
                        <button class="btn btn-sm btn-success">Afficher</button>
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                        <button class="btn btn-sm btn-primary">Modifier</button>
                    </td>
                </tr>
            `
        })
        tbody_art.innerHTML = html;
    };
    afficher(articles);
</script>