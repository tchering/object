<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="page/cv/css/style1.css" />
    <title>Document</title>
</head>

<body>
    <div id="header">
        <ul class="niveau-h1">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="article.php">Article</a></li>
            <li><a href="client.php">Client</a></li>
            <li><a href="">Commande <span>&#9660;</span></a>
                <ul class="niveau-h2">
                    <li><a href="">Facture</a></li>
                    <li><a href="">Appro</a></li>
                    <li><a href="">Devis</a></li>
                </ul>
            </li>
            <li><a href="">Parametre</a></li>
            <li><a href="cv.php">CV</a></li>
            <li><a href="#modal_cv">Modal - CV</a></li>
        </ul>
    </div>
    <div id="main">
        <div id="aside">
            <div class="center" id="logo">
                <img src="img/Logo_Afpa.jpg" width="75%" alt="">
            </div>
            <ul class="niveau-v1">
                <li><a href="">Caisse</a></li>
                <li><a href="">Controle<span>&#9660;</span></a>
                    <ul class="niveau-v2">
                        <li><a href="">Caisse</a></li>
                        <li><a href="">Stock</a></li>
                        <li><a href="">Cheque</a></li>
                    </ul>

                </li>
                <li><a href="">Inventaire</a></li>
                <li><a href="">Fermerture</a></li>
            </ul>

        </div>
        <div id="section">
            <?=$content?>
        </div>
    </div>
    <div id="footer">
        <h2>&copy Copyright DWWM 2023</h2>
    </div>

    <div id="modal_cv">
        <?php require('page/cv/index1.html');?>
    </div>

</body>

</html>