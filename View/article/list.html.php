<div class="col-sm-12">
    <h1 class="titre center text-light">Liste Article</h1>
    <table class="table w-auto col-sm-12">
        <thead id="thead_art">
            <tr class="bg-success">
                <th class ="w10">ID</th>
                <th class ="w10">CODE</th>
                <th class ="w40">DESIGNATION</th>
                <th class ="w10">PU</th>
                <th class ="w30">ACTION</th>
        <tbody id="tbody_art" class="m-sm-0 p-sm-0">
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
    //!function to show the page in table body
    function afficher(tableName) {

        let html = articles.map((article) => {
            return `
                <tr class="">
                    <td>${article.id} </td>
                    <td>${article.numArticle} </td>
                    <td>${article.designation} </td>
                    <td>${article.prixUnitaire}</td>
                    <td class="buttons gap-sm-2 d-grid d-md-flex justify-content-around">
                        <button class="btn btn-sm btn-success">Afficher</button>
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                        <button class="btn btn-sm btn-primary">Modifier</button>
                    </td>
                </tr>
            `
        }).join('');
        // The .join('') method in JavaScript is used to join all elements of an array into a string. The argument you pass to .join() determines what goes between the elements when they are joined. If you don't pass any argument, the default is a comma (,).
        console.log(html);
        tbody_art.innerHTML = html;
        //! to show total number of articles.
        const nbre = articles.length;
        nbre_art.innerHTML = `Nombre d'articles : ${nbre}`;
    };
    //!calling the function afficher with param articles.
    afficher(articles);
</script>