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
    <h1 class="titre center text-light">Liste ROLES</h1>
    <div class="div_btn">
        <a href="role&action=insert" class="btn btn-md btn-success mb-2 print-none"><i class="fa fa-plus"></i>Ajourter</a>
        <a href="role&action=show" class="btn btn-md btn-secondary mb-2 print-none"> <i class="fa fa-eye"></i>Afficher</a>
        <button class="btn btn-md btn-dark mb-2 print-none" onclick="modifierRole()"><i class="fa-solid fa-gear"></i>Modifier </button>
        <a href="role&action=insert" class="btn btn-md btn-danger mb-2 print-none"><i class="fa-solid fa-trash"></i>Supprimer</a>
        <a href="javascript:window.print()" class="btn btn-md btn-primary mb-2 print-none"> <i class="fa fa-print"></i> Imprimer</a>
    </div>
    <table class="table w100 table-responsive">
        <thead id="thead_art">
            <tr class="bg-success">
                <th class="w10"></th>
                <th class="w20">ID</th>
                <th class='w30'>RANG</th>
                <th class='w30'>LIBELLE</th>
            </tr>
        </thead>
        <tbody id="tbody_art" class=" w-100">
            <!------------------------------------method php -------------------- -->
            <!-- <?php foreach ($listUsers as $user) : ?>
                <tr>
                    <td class="w10"><input type="checkbox" id="<?= $user['id'] ?>" name="role" value="<?= $user['id'] ?>" onclick="onlyOne(this)"></td>
                    <td class="w10"> <label for="<?= $user['id'] ?>"><?= $user['id'] ?></td></label>  
                    <td class="w10"> <label for="<?= $user['id'] ?>"><?= $user['rang'] ?></td></label>  
                    <td class="w10"> <label for="<?= $user['id'] ?>"><?= $user['libelle'] ?></td></label>  

                </tr>
            <?php endforeach; ?> -->
            <!--------------------------------method php ends here ---------------------->
        </tbody>
        <tfoot id="tfoot_art">
            <tr>
                <th colspan="5" class="text-center bg-success" id="nbre_art">
                    <h3>Total users : <?= $nbre ?></h3>
                </th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    //!--------------------------------method js ---------------------->
    let listUsers = <?= json_encode($listUsers) ?>;
    afficher(listUsers);

    function afficher(tableName) {
        let template = tableName.map((user) => {
            return `
                <tr class="">
                <td class="w10"><input type="checkbox" id="${user.id}" name="role" value="${user.id}" onclick="onlyOne(this)"></td>
                    <td class="w20">${user.id}</td>
                    <td class="w30">${user.rang}</td>
                    <td class="w30">  <label for ="${user.id}"> ${user.libelle}</label></td>
                    
                </tr>
            `;
        }).join('');
        document.getElementById('tbody_art').innerHTML = template;
        let nbre = `Total Users: ${tableName.length}`;
        document.getElementById('nbre_art').innerHTML = `<h3>${nbre}</h3>`;
    }
    //!--------------------------------method js ---------------------->  
    //new fnc added modifier  
    modifierRole = () => {
        let checkboxes = document.getElementsByName('role');
        let id = 0;
        checkboxes.forEach((item) => {
            if (item.checked == true) id = item.value;
        })
        if (id == 0) {
            alert('Please select role');
        } else {
            document.location.href=`role&action=update&id=${id}`;
            // document.location.href="role&action=update&id="+id; 
        }
    }
    //this function allow user to check only 1 role.Same  user cannot have many roles . 
    const onlyOne = (checkbox) => {
        let checkboxes = document.getElementsByName(checkbox.name);
        checkboxes.forEach((item) => {
            if (item !== checkbox) {
                item.checked = false;
            }
        });
        checkbox.checked = true;
    }

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