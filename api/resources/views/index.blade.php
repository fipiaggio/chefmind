<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>Chef Mind</title>
    <!--Google Icon Font-->
    <link href="css/materialicons.css" rel="stylesheet">
    <!--Materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,all" />
    <!--Material Design Icons -->
    <link href="css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <!-- Notificaciones -->
    <link rel="stylesheet" href="node_modules/angular-toastr/dist/angular-toastr.min.css">
    <link rel="stylesheet" href="css/materialize.clockpicker.css">
    <link rel="stylesheet" href="node_modules/ng-tags-input/build/ng-tags-input.min.css">
    <!-- Chefmind Styles -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body ng-app="chefmindApp">
    <div class="navbar-fixed">
        <nav ng-controller="mainMenuCtrl" class="navbar-principal" role="navigation">
            <div class="nav-wrapper container">
                <a ui-sref="home" class="logo-container">
                    <img class="logo-img" src="img/logo.png" alt="logo de chefmind">
                </a>
                <ul class="right hide-on-med-and-down">
                    <li ui-sref-active="active"><a ui-sref="app">Recetas</a></li>
                    <li ui-sref-active="active"><a ui-sref="categorias">Categorías</a></li>
                    <li ui-sref-active="active"><a ui-sref="contacto">Contacto</a></li>
                    <li ui-sref-active="active"><a ui-sref="faq">FAQ</a></li>
                    <li ui-sref-active="active" ng-hide="isLogged"><a ui-sref="login">Iniciar Sesión</a></li>
                    <li ui-sref-active="active" ng-hide="isLogged"><a ui-sref="registro">Registrarme</a></li>
                    <li ng-if="isLogged" class="upload"><a ui-sref="subirReceta"><i class="material-icons left">mode_edit</i>Subir receta</a></li>
                    <li ui-sref-active="active" ng-if="isLogged"><a ui-sref="admin">Perfil</a></li>
                    <li ui-sref-active="active" ng-if="isLogged"><a ng-click="logout()">Salir</a></li>
                </ul>
                <ul id="nav-mobile" class="side-nav">
                    <li class="active"><a href="index.html">Recetas</a></li>
                    <li><a href="categorias.html">Categorías</a></li>
                    <li><a href="contacto.html">Contacto</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                    <li ng-if="isLogged"><a href="login.html">Iniciar Sesión</a></li>
                    <li><a href="registro.html">Registrarme</a></li>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
    <div ui-view></div>
    <footer class="page-footer footer-principal">
        <div class="container">
            <div class="row">
                <div class="col l4 s12">
                    <h5 class="">¿Quienes sómos?</h5>
                    <p>Chef Mind es el lugar donde podrás compartir tus recetas con  otros usuarios y convertirte en el  mejor cocinero.</p>
                </div>
                <div class="col l3 s12 sitemap">
                    <h5 class="">Secciones</h5>
                    <ul>
                        <li><a class="" href="#!">Recetas</a></li>
                        <li><a class="" href="#!">Categorías</a></li>
                        <li><a class="" href="#!">FAQ</a></li>
                        <li><a class="" href="#!">Contacto</a></li>
                    </ul>
                </div>
                <div class="col l3 s12 social-media">
                    <h5 class="title">Redes Sociales</h5>
                    <ul>
                        <li><a class="" href="#!"><i class="mdi mdi-twitter-circle"></i></a></li>
                        <li><a class="" href="#!"><i class="mdi mdi-facebook-box"></i></a></li>
                        <li><a class="" href="#!"><i class="mdi mdi-pinterest-box"></i></a></li>
                        <li><a class="" href="#!"><i class="mdi mdi-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <span><a class="text-lighten-3" href="#">ChefMind &copy;</a> Todos los derechos reservados</span>
            </div>
        </div>
    </footer>
    <!-- Dependencies -->
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="assets/materialize.min.js"></script>
    <script type="text/javascript" src="assets/materialize.clockpicker.js"></script>
    <script type="text/javascript" src="node_modules/angular/angular.min.js"></script>
    <script type="text/javascript" src="node_modules/angular-animate/angular-animate.min.js"></script>
    <script type="text/javascript" src="node_modules/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script type="text/javascript" src="node_modules/satellizer/satellizer.min.js"></script>
    <script type="text/javascript" src="node_modules/angular-toastr/dist/angular-toastr.tpls.js"></script>
    <script type="text/javascript" src="assets/angular-materialize.min.js"></script>
    <script type="text/javascript" src="node_modules/ng-file-upload/dist/ng-file-upload-shim.min.js"></script>
    <script type="text/javascript" src="node_modules/ng-file-upload/dist/ng-file-upload.min.js"></script>
    <script type="text/javascript" src="node_modules/ng-tags-input/build/ng-tags-input.js"></script>


    <!-- App -->
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/controllers/loginCtrl.js"></script>
    <script type="text/javascript" src="js/controllers/registerCtrl.js"></script>
    <script type="text/javascript" src="js/controllers/uploadRecipeCtrl.js"></script>
    <script type="text/javascript" src="js/controllers/userRecipesCtrl.js"></script>
    <script type="text/javascript" src="js/controllers/editRecipeCtrl.js"></script>
    <script type="text/javascript" src="js/controllers/listRecipesCtrl.js"></script>
    <script type="text/javascript" src="js/controllers/homeCtrl.js"></script>
    <script type="text/javascript" src="js/controllers/recipeCtrl.js"></script>
    <script type="text/javascript" src="js/controllers/mainMenuCtrl.js"></script>
    <script type="text/javascript" src="js/services/authService.js"></script>
    <script>
       /* $(document).ready(function() {
            $(".button-collapse").sideNav();
        });*/
    </script>
</body>

</html>
