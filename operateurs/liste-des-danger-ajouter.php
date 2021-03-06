<?php
// Initialize the session
session_start();
 
// Vérifions si l'utilisateur est connecté, sinon redirigeons-le vers la page de connexion
if(!isset($_SESSION["connecter"]) || $_SESSION["connecter"] !== true){
    header("location: ../index.php");
    exit;
}

require_once "../php/db.php";

?>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Danger View - Opérateurs | Liste des informations</title>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../include/jquery-3.5.1.min.js"></script>
        <script src='../include/bootbox.min.js' type='text/javascript'></script>
        <script src='../include/delete-jq-danger.js' type='text/javascript'></script>
        <link rel="icon" type="image/png" href="../img/logo1.png" />
    </head>

    <body>
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #000 !important;">
                <span class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon" style="cursor: pointer;">
                    <i class="fa fa-list" aria-hidden="true" id="sidebarToggle"></i>
                  </div>
                <div class="sidebar-brand-text">
                   &nbsp;&nbsp;&nbsp; Danger <b style="color: #ff1300;">view</b>
                </div>
              </span>
                <hr class="sidebar-divider my-0">

                <li class="nav-item">
                    <a class="nav-link" href="./operateur_home.php">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span>Accueil</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./ajouter-danger.php">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                        <span>Ajouter un danger</span>
                    </a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="./liste-des-danger-ajouter.php">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span>Liste des danger ajouter</span></a>
                </li>
            </ul>
            <!-- / Sidebar -->

            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="background: #ffc500 !important;font-weight: 700;">
                        <strong id="sidebarToggleTop" class="d-md-none" style="color: #fff !important;font-weight: 900;">
                      Danger <span style="color:#000">View</span>
                    </strong>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope fa-fw" style="color: #fff !important;font-weight: bold;"></i>
                                    <span class="d-none d-lg-inline text-gray-600 small" style="color: #fff !important;font-weight: 500;">Notifications</span>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Messages
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="../img/logo.png" alt="">
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Bonjour</div>
                                            <div class="small text-gray-500">Nom Visiteur · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Lire plus de messages</a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="img-profile rounded-circle" src="https://cdn.pixabay.com/photo/2013/07/13/10/07/man-156584_960_720.png">&nbsp;&nbsp;
                                    <span class="d-none d-lg-inline text-gray-600 small" style="color: #fff !important;font-weight: 800;">
                                    <?= htmlspecialchars($_SESSION["prenom"]); ?>
                                </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-user fa-sm fa-fw mr-2"></i> Mon Profil
                                    </a>
                                    <a class="dropdown-item" href="../php/logout.php">
                                        <i class="fa fa-sign-out fa-sm fa-fw mr-2"></i> Déconnexion
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- / Topbar -->

                    <!-- Contenue de la page -->
                    <div class="container-fluid">
                        <!--     <?php if($errorMsg != ""): ?>
                      <div class="alert alert-success" role="alert">
                          <?php echo $errorMsg; ?>
                      </div>
                      <?php endif ?> -->
                        <div class="card mb-4">
                            <div class="h4 card-header font-weight-normal" style="background: #a19e9e !important">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="mt-2 text-white">Les informations que vous avez ajouter</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="ajouter-danger.php">
                                            <button type="button" class="btn btn-danger m-1 float-right" style="background: #ff1300!important; color:#fff;">
                                                <i class="fa fa-plus-square fa-lg"></i>
                                                &nbsp;&nbsp; Ajouter
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php
                                // On détermine sur quelle page on se trouve
                                if(isset($_GET['page']) && !empty($_GET['page'])){
                                    $currentPage = (int) strip_tags($_GET['page']);
                                }else{
                                    $currentPage = 1;
                                }
                                // On se connecte à là base de données
                                require_once '../php/db.php';
                                $idUser = $_SESSION["id"];

                                // On détermine le nombre total d'informations
                                $sql = "SELECT COUNT(*) AS nb_dangers FROM danger WHERE idUtilisateur={$idUser}";
                                // On prépare la requête
                                $query = $db->prepare($sql);
                                // On exécute
                                $query->execute();
                                // On récupère le nombre d'informations
                                $result = $query->fetch();
                                $nbDangers = (int) $result['nb_dangers'];
                                // On détermine le nombre d'informations par page
                                $parPage = 3;
                                // On calcule le nombre de pages total
                                $pages = ceil($nbDangers / $parPage);
                                // Calcul de la première information de la page
                                $premier = ($currentPage * $parPage) - $parPage;

                                $sql = 'SELECT * FROM danger WHERE idUtilisateur=:userId ORDER BY dateAjout DESC LIMIT :premier, :parpage;';
                                // On prépare la requête
                                $query = $db->prepare($sql);

                                $query->bindValue(':premier', $premier, PDO::PARAM_INT);
                                $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
                                $query->bindValue(':userId', $idUser, PDO::PARAM_INT);

                                // On exécute
                                $query->execute();
                                // On récupère les valeurs dans un tableau associatif
                                $dangers = $query->fetchAll(PDO::FETCH_ASSOC);

                                $d_nb = count($dangers);
                                //var_dump($d_nb);exit();
                            ?>
                                <div class="card-body">
                                    <?php if($d_nb === 0): ?>
                                    <center>
                                        <strong class="mt-4 mb-4">
                                            Pas d'informations disponible
                                        </strong>
                                    </center>
                                    <?php else: ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-1">
                                                <div class="table-responsive">
                                                    <table id="user_data" class="table table-striped table-sm table-bordered" style="color: #fff;">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>Id</th>
                                                                <th>Numero d'ordre</th>
                                                                <th>Source</th>
                                                                <th>Sexe victime</th>
                                                                <th>Sexe responsable</th>
                                                                <th>Type de danger</th>
                                                                <th>Lieu</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tbody class="text-center text-secondary">
                                                                <?php  foreach($dangers as $danger): ?>
                                                                <tr>
                                                                    <td>
                                                                        <?= $danger['id']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $danger["numeroOrdre"]; ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="<?=  $danger["source"]; ?>" target="_blank">
                                                                            Lien
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <?=  $danger["sexeVictime"]; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?=  $danger["sexeResponsable"]; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?=  $danger["dangerType"]; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?=  $danger["ville"]; ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="mettre-danger-a-jour.php?id=<?php echo htmlentities($danger["id"]); ?>" type="button" class="text-primary">
                                                                            <i class="fa fa-edit fa-lg"></i>
                                                                        </a>&nbsp;&nbsp;
                                                                        <a class="delete text-danger" id='del_<?= $danger["id"] ?>' data-id='<?= $danger["id"] ?>'>
                                                                            <i class="fa fa-trash fa-lg"></i>
                                                                        </a>&nbsp;&nbsp;
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                    </table>
                                                    
                                                    <nav aria-label="pagination" >
                                                        
                                                        <ul class="pagination justify-content-center">

                                                            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "text-danger" ?>">
                                                                <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                                <span class="sr-only">Previous</span>
                                                                </a>
                                                            </li>

                                                            <?php for($page = 1; $page <= $pages; $page++): ?>
                                                                <li class="page-item <?= ($currentPage == $page) ? "active text-danger" : "" ?>">
                                                                    <a class="page-link" href="?page=<?= $page ?>">
                                                                        <?= $page ?>
                                                                    </a>
                                                                </li>
                                                            <?php endfor; ?>

                                                            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "text-danger" ?>">
                                                                <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                                <span class="sr-only">Next</span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>
                        </div>
                    </div>
                    <!-- ./Contenue de la page -->

                    <!-- Footer -->
                    <br>
                    <br>
                    <br>
                    <br>
                    <footer class="sticky-footer bg-jaune" style="background: #ffc500 !important">
                        <div class="container">
                            <div class="copyright text-center">
                                <span>Copyright &copy; 2020, design by Sheila Melissa</span>
                            </div>
                        </div>
                    </footer>
                    <!-- ./ Footer -->
                </div>
            </div>
            <!-- ./ Wrapper -->           

            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script type="text/javascript">
                ! function(t) {
                    "use strict";
                    t("#sidebarToggle, #sidebarToggleTop").on("click", function(o) {
                            t("body").toggleClass("sidebar-toggled"),
                                t(".sidebar").toggleClass("toggled"),
                                t(".sidebar").hasClass("toggled") &&
                                t(".sidebar .collapse").collapse("hide")
                        }),
                        t(window).resize(function() {
                            t(window).width() < 768 &&
                                t(".sidebar .collapse").collapse("hide")
                        }),
                        t("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function(o) {
                            if (768 < t(window).width()) {
                                var e = o.originalEvent,
                                    l = e.wheelDelta || -e.detail;
                                this.scrollTop += 30 * (l < 0 ? 1 : -1), o.preventDefault()
                            }
                        }), t(document).on("scroll", function() {
                            100 < t(this).scrollTop() ? t(".scroll-to-top").fadeIn() :
                                t(".scroll-to-top").fadeOut()
                        }),
                        t(document).on("click", "a.scroll-to-top", function(o) {
                            var e = t(this);
                            t("html, body").stop().animate({
                                    scrollTop: t(e.attr("href")).offset().top
                                }, 1e3, "easeInOutExpo"),
                                o.preventDefault()
                        })
                }(jQuery);
            </script>
    </body>
