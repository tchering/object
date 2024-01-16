<style>
    #tbody_art {
        display: block;
        width: 100%;
        height: 2
        00px;
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
    <h1 class="titre center text-light">Liste Article</h1>
    <table class="table w100">
        <thead id="thead_art">
            <tr class="bg-success">
                <th class="w10">ID</th>
                <th class="w20">CODE</th>
                <th class="w40">DESIGNATION</th>
                <th class="w10">PU</th>
                <th class="w20">ACTION</th>
            </tr>
        </thead>
        <tbody id="tbody_art" class="">
        </tbody>
        <tfoot id="tfoot_art">
            <tr>
                <th colspan="5" class="text-center bg-success" id="nbre_art"></th>
            </tr>
        </tfoot>
    

    </table>
</div>

<script>
    let articles = <?= $articles ?>;
    //!function to show the page in table body
    function afficher(tableName) {

        let html = articles.map((article) => {
            return `
                <tr class="">
                    <td class="w10">${article.id} </td>
                    <td class="w20">${article.numArticle} </td>
                    <td class="w40">${article.designation} </td>
                    <td class="w10">${article.prixUnitaire}</td>
                    <td class=" w20 buttons gap-sm-2  d-flex justify-content-between">
                        <a href="article&action=show&id=${article.id}" class="btn btn-sm btn-success">Afficher</a>
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
        tbody_art.scrollTop = tbody_art.scrollHeight;
    };
    //!calling the function afficher with param articles.
    afficher(articles);
</script>