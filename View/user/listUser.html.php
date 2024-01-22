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
    <h1 class="titre center text-light">Liste User</h1>
    <div class="div_btn">
        <a href="user&action=insert" class="btn btn-md btn-success mb-2 print-none">Ajouter User</a>
        <a href="javascript:window.print()" class="btn btn-md btn-primary mb-2 print-none">Imprimer</a>
    </div>
    <table class="table w100">
        <thead id="thead_art">
            <tr class="bg-success">
                <th class="w10">CODE</th>
                <th class="w10">USERNAME</th>
                <th class="w20">DATECREATION</th>
                <th class="w30">ROLES</th>
                <th class="w30">ACTION</th>
            </tr>
        </thead>
        <tbody id="tbody_art" class="">
           //! <!------------------------------------method php ---------------------->
            <?php foreach($listUsers as $user):?>
            <tr>
               <td class="w10"><?=$user['id']?></td>
               <td class="w10"><?=$user['username']?></td>
               <td class="w20"><?=$user['dateCreation']?></td>
               <td class="w30"><?=$user['roles']?></td>
               <td class=" w30 d-flex justify-content-between">
                    <a href="user&action=show&id=<?=$user['id']?>" class="btn btn-sm btn-success mx-2">Afficher</a>
                    <a href="user&action=update&id=<?=$user['id']?>" class="btn btn-sm btn-primary mx-2">Modifier</a>
                    <button class="btn btn-sm btn-danger mx-2" onclick="supprimer(<?=$user['id']?>)">Supprimer</button>
               </td>
            </tr>
            <?php endforeach; ?>
            //!<!--------------------------------method php ends here ---------------------->
        </tbody>
        <tfoot id="tfoot_art">
            <tr>
                <th colspan="5" class="text-center bg-success" id="nbre_art"><h3>Total users : <?=$nbre?></h3></th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    //!--------------------------------method js ---------------------->
    // let listUsers = <?=json_encode($listUsers)?>;
    // afficher(listUsers);
    
    // function afficher(tableName) {
    //     let template = tableName.map((user) => {
    //         return `
    //             <tr>
    //                 <td class="w10">${user.id}</td>
    //                 <td class="w10">${user.username}</td>
    //                 <td class="w20">${user.dateCreation}</td>
    //                 <td class="w30">${user.roles}</td>
    //                 <td class="w30 buttons gap-sm-2 d-flex justify-content-between">
    //                     <a href="user&action=show&id=${user.id}" class="btn btn-sm btn-success">Afficher</a>
    //                     <a href="user&action=update&id=${user.id}" class="btn btn-sm btn-primary">Modifier</a>
    //                     <button class="btn btn-sm btn-danger" onclick="supprimer(${user.id})">Supprimer</button>
    //                 </td>
    //             </tr>
    //         `;
    //     }).join('');
    //     document.getElementById('tbody_art').innerHTML = template;
    //     let nbre = `Total Users: ${tableName.length}`;
    //     document.getElementById('nbre_art').innerHTML = nbre;
    // }
      //!--------------------------------method js ---------------------->


    function supprimer(id) {
        const response = confirm("Voulez-vous bien supprimer ce user?");
        if (response) {
            document.location.href = `user&action=delete&id=${id}`;
        }
    }

    function chercher() {
        const mot = document.getElementById('mot').value;
        document.location.href = `user&action=search&mot=${mot}`;
    }

    function touche(event) {
        if (event.key === "Enter") {
            chercher();
        }
    }
</script>