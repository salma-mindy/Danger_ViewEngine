<?php
// Initialize the session
session_start();
 
// Vérifions si l'utilisateur est connecté, sinon redirigeons-le vers la page de connexion
if(!isset($_SESSION["connecter"]) || $_SESSION["connecter"] !== true){
    header("location: ../index.php");
    exit;
}

require_once "../php/db.php";

$numeroOrdre = $description = $date = $source = $Lieu = $dangerType = $descripendroit = $pays = "";
$ville = $longitude = $latitude = $typeActeur = $sexeVictime = $sexeResponsable = "";
$ville_err = $longitude_err = $latitude_err = $typeActeur_err = $sexeVictime_err = $sexeResponsable_err = "";
$numeroOrdre_err = $description_err = $date_err = $source_err = $Lieu_err = $dangerType_err = $descripendroit_err = $pays_err = "";
$errorMsg = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $idUser = $_SESSION["id"];

    //var_dump($idUser);exit();
    if (empty($_POST["numeroOrdre"])) {
        $numeroOrdre_err = "Le numeroOrdre est obligatoire";
      } else {
        $numeroOrdre = trim($_POST["numeroOrdre"]);
      }

      if (empty($_POST["description"])) {
        $description_err = "La description du danger est obligatoire";
      } else {
        $description = trim($_POST["description"]);
      }
    // validation date
      if (empty($_POST["date"])) {
        $date_err = "Le date est obligatoire";
      } else {
        $date = trim($_POST["date"]);
        $test_arr  = explode('/', $date);
        if (count($test_arr) == 3) {
            if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
                $date = trim($_POST["date"]);
            } else {
                $date_err = "Le format de la date est incorrecte";
            }
        }
      }
    
      if (empty($_POST["source"])) {
        $source_err = "La source est obligatoire";
      } else {
        $source = trim($_POST["source"]);
      }

    if (empty($_POST["Lieu"])) {
        $Lieu_err = "Le Lieu est oblidatoire";
      } else {
        $Lieu = trim($_POST["Lieu"]);
      }


    if(empty(trim($_POST["dangerType"]))){
        $dangerType_err = "Veuillez selectionner un type de danger.";
    } else{
        $dangerType = trim($_POST["dangerType"]);
    }
    
    if(empty(trim($_POST["descripendroit"]))){
        $descripendroit_err = "Veuillez décrire l'endroit.";     
    } else{
        $descripendroit = trim($_POST["descripendroit"]);
    }

    if(empty(trim($_POST["pays"]))){
        $pays_err = "Veuillez selectionner le pays.";     
    } else{
        $pays = trim($_POST["pays"]);
    }

    if(empty(trim($_POST["ville"]))){
        $ville_err = "Veuillez selectionner la ville.";     
    } else{
        $ville = trim($_POST["ville"]);
    }

    if(empty(trim($_POST["longitude"]))){
        $longitude_err = "Veuillez selectionner la longitude.";     
    } else{
        $longitude = trim($_POST["longitude"]);
    }

    if(empty(trim($_POST["latitude"]))){
        $latitude_err = "Veuillez selectionner la latitude.";     
    } else{
        $latitude = trim($_POST["latitude"]);
    }

    if(empty(trim($_POST["typeActeur"]))){
        $typeActeur_err = "Veuillez selectionner le type d'acteur.";     
    } else{
        $typeActeur = trim($_POST["typeActeur"]);
    }

    if(empty(trim($_POST["sexeVictime"]))){
        $sexeVictime_err = "Veuillez selectionner le sexe victime.";     
    } else{
        $sexeVictime = trim($_POST["sexeVictime"]);
    }

    if(empty(trim($_POST["sexeResponsable"]))){
        $sexeResponsable_err = "Veuillez selectionner le sexe responsable.";     
    } else{
        $sexeResponsable = trim($_POST["sexeResponsable"]);
    }
    
    // Vérification des erreurs de saisie avant l'insertion dans la base de données
    if(empty($numeroOrdre_err) && 
       empty($description_err) && 
       empty($date_err) && 
       empty($source_err) &&
       empty($Lieu_err) &&
       empty($dangerType_err) &&
       empty($descripendroit_err) &&
       empty($pays_err) &&
       empty($ville_err) &&
       empty($longitude_err) &&
       empty($latitude_err) &&
       empty($typeActeur_err) &&
       empty($sexeVictime_err) &&
       empty($sexeResponsable_err)){
        
        // Préparons une instruction d'insertion
        $sql = "INSERT INTO danger (numeroOrdre, description, date, source, Lieu, dangerType, descripendroit, pays, ville, longitude, latitude, typeActeur, sexeVictime, sexeResponsable, idUtilisateur) 
                VALUES (:numeroOrdre, :description, :date, :source, :Lieu, :dangerType, :descripendroit, :pays, :ville, :longitude, :latitude, :typeActeur, :sexeVictime, :sexeResponsable, {$idUser})";
         
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":numeroOrdre", $param_numeroOrdre, PDO::PARAM_STR);
            $stmt->bindParam(":description", $param_description, PDO::PARAM_STR);
            $stmt->bindParam(":date", $param_date, PDO::PARAM_STR);
            $stmt->bindParam(":source", $param_source, PDO::PARAM_STR);
            $stmt->bindParam(":Lieu", $param_Lieu, PDO::PARAM_STR);
            $stmt->bindParam(":dangerType", $param_dangerType, PDO::PARAM_STR);
            $stmt->bindParam(":descripendroit", $param_descripendroit, PDO::PARAM_STR);
            $stmt->bindParam(":pays", $param_pays, PDO::PARAM_STR);
            $stmt->bindParam(":ville", $param_ville, PDO::PARAM_STR);
            $stmt->bindParam(":longitude", $param_longitude, PDO::PARAM_STR);
            $stmt->bindParam(":latitude", $param_latitude, PDO::PARAM_STR);
            $stmt->bindParam(":typeActeur", $param_typeActeur, PDO::PARAM_STR);
            $stmt->bindParam(":sexeVictime", $param_sexeVictime, PDO::PARAM_STR);
            $stmt->bindParam(":sexeResponsable", $param_sexeResponsable, PDO::PARAM_STR);
            
            // Set parameters
            $param_numeroOrdre = $numeroOrdre;
            $param_description = $description;
            $param_date = $date;
            $param_source = $source;
            $param_Lieu = $Lieu;
            $param_dangerType = $dangerType;
            $param_descripendroit = $descripendroit;
            $param_pays = $pays;
            $param_ville = $ville;
            $param_longitude = $longitude;
            $param_latitude = $latitude;
            $param_typeActeur = $typeActeur;
            $param_sexeVictime = $sexeVictime;
            $param_sexeResponsable = $sexeResponsable;

            if($stmt->execute()){
               $errorMsg = "success";
            } else{
                $errorMsg = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Danger View - Admin | Ajouter</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="../include/jquery-3.5.1.min.js"></script>
    <script>
        function comboInit(paysId){
            pays = document.getElementById(pays);  
            var idx = paysId.selectedIndex;
            var content = paysId.options[idx].innerHTML;
            if(pays.value == "")
                pays.value = content;	
        }

        function combo(paysId, pays){
            pays = document.getElementById(pays);  
            var idx = paysId.selectedIndex;
            var content = paysId.options[idx].innerHTML;
            pays.value = content;	
        }
        $(function() {
            $("#paysId").bind("change", function() {
                $.ajax({
                    type: "GET", 
                    url: "change.php",
                    data: "paysId="+$("#paysId").val(),
                    success: function(html) {
                        $("#ville").html(html);
                    }
                });
            });
            $("#ville").bind("change", function() {
                $.ajax({
                    type: "GET", 
                    url: "change-lng.php",
                    data: "ville="+$("#ville").val(),
                    success: function(html) {
                        $("#latLng").html(html);
                    }
                });
            });
        });
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->
    <?php 
        if($errorMsg === "success"){
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                              toast.addEventListener("mouseenter", Swal.stopTimer)
                              toast.addEventListener("mouseleave", Swal.resumeTimer)
                            }
                          })
                          
                          Toast.fire({
                            icon: "success",
                            title: "Danger ajouté avec succès!"
                          })
                    });
                </script>';
        }elseif($errorMsg === "error"){
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                              toast.addEventListener("mouseenter", Swal.stopTimer)
                              toast.addEventListener("mouseleave", Swal.resumeTimer)
                            }
                          })
                          
                          Toast.fire({
                            icon: "error",
                            title: "Une erreur s\'est produite lors de l\'ajout, veillez réessayer svp!"
                          })
                    });
                </script>';
        }
    ?>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/logo1.png" />
    
</head>

<body id="page-top">
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

            <li class="nav-item active">
                <a class="nav-link" href="./ajouter-danger.php">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                    <span>Ajouter un danger</span>
                </a>
            </li>

            <li class="nav-item">
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
                    
                    <div class="card mb-4">
                        <h5 class=" h4 card-header" style="background: #a19e9e !important">
                            <center>Ajout d'informations</center>
                        </h5>
                        <div class="card-body">
                        <div class="row">
          <div class="col-lg-12">
            <div class="p-1">
              <form method="post" class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="">
                    <h5 style="color: #ffc500">Informations générale</h5>
                </div>
                <hr>
                <div class="form-group row ">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="numeroOrdre" name="numeroOrdre" placeholder="Numero d'ordre">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                           
                        </span>
                    </small>
                  </div>
                  
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="source" name="source" placeholder="Veuillez indiquer la Source">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                            
                        </span>
                    </small> 
                 </div>
                 </div>

                 <div class="form-group row ">
                  <div class="col-sm-6 mb-3">
                    <input type="date" class="form-control form-control-user" id="date" name="date" placeholder="Indiquez la date">
                    <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $date_err; ?></i>
                        </center>
                    </small>
                  </div>
                  <?php
                    require_once "../php/db.php";

                    $sql_td = "SELECT * FROM dangertype";
                    $query_td = $db->prepare($sql_td);
                    $query_td->execute();
                    $data_td = $query_td->fetchAll();
                ?>  
                  <div class="col-sm-6">
                    <input type="text" list=dangertype class="form-control form-control-user" id="dangerType" name="dangerType" placeholder="Type de danger">
                    <datalist id="dangertype" >
                        <?php  foreach($data_td as $res_td): ?>
                            <option> <?= ucfirst($res_td["intitule"]); ?>
                        <?php endforeach; ?>
                    </datalist>
                    <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $dangerType_err; ?></i>
                        </center>
                    </small>
                  </div>
                  </div>
                
                <div class="form-group">
                  <textarea class="form-control " rows="5" id="description" name="description" placeholder="Description..." style="resize:none"></textarea>
                  <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $description_err; ?></i>
                        </center>
                  </small>
                </div>
                <div class="mt-3">
                    <h5 style="color: #ffc500">Description du lieu</h5>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="Lieu" name="Lieu" placeholder="Nom de l'endroit">
                    <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $Lieu_err; ?></i>
                        </center>
                    </small>
                  </div>
                  <div class="col-sm-8 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="descripendroit" name="descripendroit" placeholder="Décrivez l'endroit">
                    <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $descripendroit_err; ?></i>
                        </center>
                    </small> 
                 </div>
                </div>
                <div class="form-group row mb-2">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div style="border-radius:10rem;display:inline-block;overflow:hidden;background:#464141;border:1px solid #000;padding: .7rem 1.5rem">
                        <select name="paysId" id="paysId"  onChange="combo(this, 'pays')" onMouseOut="comboInit(this, 'pays')" style="width:100%;height:100%;border:0px;outline:none;background:#464141;color:#fff;font-size: .8rem;">
                            <option>-- Choisir le pays --</option>
                            <?php
                                require_once "../php/db.php";
                                $stmt = $db->query('SELECT id,nom FROM pays ORDER BY nom');
                                while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    echo "<option value='$row->id'>$row->nom</option>";
                                }
                            ?>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="pays" name="pays" placeholder="Saisir le pays"/>
                  </div>
                  <div class="col-sm-4 mb-1 mb-sm-0" >
                    <div style="border-radius:10rem;display:inline-block;overflow:hidden;background:#464141;border:1px solid #000;padding: .7rem 1.5rem">
                        <select id="ville" name="ville" style="width:100%;height:100%;border:0px;outline:none;background:#464141;color:#fff;font-size: .8rem;">
                            <option>-- Choisir la ville --</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="form-group row" id="latLng">
                    <div class="col-sm-4 mt-2">
                        
                    </div>
                   <div class="col-sm-4 mt-2">

                   </div>
                </div>
                <div class="mt-3">
                    <h5 style="color: #ffc500">Information sur les différents acteurs</h5>
                </div>
                <hr>
                <div class="form-group row ">
                <?php
                    require_once "../php/db.php";

                    $sql_a = "SELECT * FROM acteurs";
                    $query_a = $db->prepare($sql_a);
                    $query_a->execute();
                    $data_a = $query_a->fetchAll();
                ?>  
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" list="persons" class="form-control form-control-user" id="typeActeur" name="typeActeur" placeholder="Type d'acteur">
                    <datalist id="persons" >
                        <?php  foreach($data_a as $res_a): ?>
                            <option> <?= ucfirst($res_a["intitule"]); ?>
                        <?php endforeach; ?>
                    </datalist>
                    <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $typeActeur_err; ?></i>
                        </center>
                    </small>
                  </div>
                  
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" list="sexe" class="form-control form-control-user" id="sexeVictime" name="sexeVictime" placeholder="Sexe Victimes">
                    <datalist id="sexe" >
                        <option> Masculin </option>
                        <option> Feminin </option>
                    </datalist>
                    <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $sexeVictime_err; ?></i>
                        </center>
                    </small> 
                 </div>
                  <div class="col-sm-4">
                    <input type="text" list=Sresp class="form-control form-control-user" id="sexeResponsable" name="sexeResponsable" placeholder="Sexe Responsables">
                        <datalist id="Sresp" >
                            <option> Masculin </option>
                            <option> Feminin </option>
                        </datalist>             
                        <small style="color: #ff1300 !important">
                            <center>
                                <i><?php echo $sexeResponsable_err; ?></i>
                            </center>
                        </small>
                  </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-primary btn-user btn-block" style="background: #ff1300!important; color:#fff;" value="Enregister">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
                        </div>
                    </div>
                </div>
                <!-- /Contenue de la page -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white" style="background: #ffc500 !important">
                <div class="container">
                    <div class="copyright text-center">
                        <span>Copyright &copy; 2020, design by Sheila Melissa</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

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

</html>
