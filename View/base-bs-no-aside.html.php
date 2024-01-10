<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./fontawesome-free-6.5.0-web/css/all.css">
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.bundle.js" defer></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
    <style>
    #section-bs {
        min-height: 70vh;
        margin-top: 10vh;
    }

    #section-bs {
        overflow: auto;
        position: relative;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav id="entete" class="navbar navbar-expand-md bg-dark text-light fixed-top">
            <a href="" class="btn"><i class="fa fa-laptop fa-2x text-light"></i></a>
            <a href="#nav" class="btn bg-light navbar-toggler mx-2" data-bs-toggle="collapse"><i
                    class="fa fa-bars"></i></a>
            <div class="collapse navbar-collapse justify-content-between" id="nav">
                <ul class="navbar-nav px-2">
                    <li class="nav-item"><a href="index.php" class="nav-link text-light fw-bold">Accueil</a></li>
                    <li class="nav-item"><a href="article.php" class="nav-link text-light fw-bold">Article</a></li>
                    <li class="nav-item"><a href="article-ajax.php" class="nav-link text-light fw-bold">Article-Ajax</a>
                    </li>
                    <li class="nav-item"><a href="client.php" class="nav-link text-light fw-bold">Client</a></li>
                    <li class="nav-item dropdown"><a href="" class="nav-link text-light fw-bold dropdown-toggle"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside">Commande</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="" class="nav-link text-primary">Devis</a></li>
                            <li class="nav-item"><a href="" class="nav-link text-primary">Facture</a></li>
                            <li class="nav-item dropend"><a href="" class="nav-link text-primary dropdown-toggle"
                                    data-bs-toggle="dropdown">Livraison</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="" class="nav-link">Domicile</a></li>
                                    <li class="nav-item"><a href="" class="nav-link">Magasin</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="" class="nav-link text-light fw-bold">Parametre</a></li>
                </ul>
                <div action="">
                    <div class="input-group">
                        <input onKeyDown="touche(event)" id="mot" name="mot" type="text" class="form-control mx-2"
                            placeholder="Mot à chercher">
                        <a href="javascript:chercher()" class="btn bg-light"><i class="fa fa-search"></i></a>
                        <a href="" class="mx-2 dropdown-toggle text-light" data-bs-toggle="dropdown"><i
                                class="fa fa-bell text-light fa-2x"></i><sup class="text-light">(5)</sup></a>
                        <ul class="dropdown-menu w100 bg_green">

                            <li class="nav-item p-2 w-100">Message - 01</li>
                            <li class="nav-item p-2 w-100">Message - 02</li>
                            <li class="nav-item p-2 w-100">Message - 03</li>
                            <li class="nav-item p-2 w-100">Message - 04</li>
                            <li class="nav-item p-2 w-100">Message - 05</li>
                            <li class="nav-item p-2 w-100">Message - 06</li>
                        </ul>
                        <a href="" class=" dropdown-toggle text-light" data-bs-toggle="dropdown"><i
                                class="fa fa-user fa-2x"></i>JPB</a>
                        <ul class="dropdown-menu w100 bg_blue">
                            <li class="nav-item w100 p-2"><a href="" class="nav-link">Compte</a></li>
                            <li class="nav-item w100 p-2"><a href="" class="nav-link">Changement mot de passe</a></li>
                            <li class="nav-item w100 p-2"><a href="" class="nav-link">Deconnexion</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
        <div class="row">
            <div id="section-bs" class="col-md-12 bg_blue">
                <?=$content?>
            </div>
        </div>
        <footer class="my-2">
            <div class="row bg-dark justify-content-center py-4">
                <div class="col-sm-3 col-md-3 col-lg-3 text-light">
                    <h5 class="text-warning text-uppercase">Nos Produits</h5>
                    <p>Bière</p>
                    <p>Vin</p>
                    <p>Jus</p>
                    <p>Electricité</p>

                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 text-light">
                    <h5 class="text-warning text-uppercase">Qui nous somme?</h5>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim sequi mollitia voluptas recusandae
                        perspiciatis suscipit, possimus assumenda et minus ratione!</p>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 text-light">
                    <h5 class="text-warning text-uppercase">Contacts </h5>
                    <ul>
                        <li><i class="fa fa-home"></i> DWWM</li>
                        <li><i class="fa fa-envelope"></i> dwwm@stage-afpa.fr</li>
                        <li><i class="fa fa-phone"></i> 012 785788</li>
                        <li><i class="fa fa-print"></i> dwwm@stage-afpa.fr</li>
                    </ul>

                </div>
            </div>
            <div class="row bg-dark justify-content-center align-items-center">
                <div class="col-md-4 text-center">
                    <a href="" class="btn"><i class="fab fa-facebook text-light fa-2x"></i></a>
                    <a href="" class="btn"><i class="fab fa-twitter text-light fa-2x"></i></a>
                    <a href="" class="btn"><i class="fab fa-linkedin text-light fa-2x"></i></a>
                </div>
            </div>
            <div class="row my-2 bg-dark">
                <div class="col-12">
                    <h5 class="text-center text-light py-2"> &copy Copyright DWWM 2023</h5>
                </div>

            </div>
        </footer>

    </div>

</body>

</html>