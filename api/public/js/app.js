'use strict';

angular
    .module('chefmindApp', [
        'ui.materialize',
        'ui.router',
        'satellizer',
        'ngAnimate',
        'toastr',
        'authService',
        'ngTagsInput',
        'ngFileUpload'
    ])
    .config(function($stateProvider, $urlRouterProvider, $authProvider) {
        $authProvider.loginUrl = 'http://localhost:8000/auth_login';
        $stateProvider
            .state('app', {
                url: '/',
                templateUrl: 'views/home.html',
                controller: 'homeCtrl'
            })
            .state('categorias', {
                url: '/categorias',
                templateUrl: 'views/categorias.html'
            })
            .state('contacto', {
                url: '/contacto',
                templateUrl: 'views/contacto.html'
            })
            .state('faq', {
                url: '/faq',
                templateUrl: 'views/faq.html'
            })
            .state('login', {
                url: '/login',
                templateUrl: 'views/login.html',
                controller: 'loginCtrl'
            })
            .state('registro', {
                url: '/registro',
                templateUrl: 'views/registro.html'
            })
            .state('admin', {
                url: '/admin',
                templateUrl: 'views/misrecetas.html',
                controller: 'uploadRecipeCtrl'
            })
            /*.state('misrecetas', {
                url: '/misrecetas',
                templateUrl: 'views/misrecetas.html'
            })*/
            .state('configuracion', {
                url: '/configuracion',
                templateUrl: 'views/configuracion.html',
                controller: 'userConfigurateCtrl'
            })
            .state('subirReceta', {
                url: '/subir-receta',
                templateUrl: 'views/subir-receta.html',
                controller: 'uploadRecipeCtrl'
            })
            .state('recipe',{
                url: '/recipe/:id',
                templateUrl: 'views/receta.html',
                controller: 'recipeCtrl'
            })
            .state('edit',{
                url: '/edit/:id',
                templateUrl: 'views/edit.html',
                controller: 'editRecipeCtrl'
            })
            .state('list',{
                url: '/list',
                params:{
                    obj:null
                },
                templateUrl: 'views/listado.html',
                controller: 'listRecipesCtrl'
            })
        $urlRouterProvider.otherwise('/');
    })
    .run(function($rootScope, $location, authUser, $state) {
        var rutasPrivadas = ['/admin'];
        $rootScope.$on('$stateChangeStart', function() {
            if (($.inArray($location.path(), rutasPrivadas) !== -1) && !authUser.isLoggedIn()) {
                $location.path('login');
                $state.go('login');
            };
        });
    })
    .constant('CONFIG', {
        APIURL: "http://localhost:8000/"
    })
    .directive('fileModel', ['$parse', function($parse) {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;

                element.bind('change', function() {
                    scope.$apply(function() {
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }])
    .service('fileUpload', function($http, toastr, $state) {
        this.uploadFileToUrl = function(file, uploadUrl, data, steps, ing) {
            var fd = new FormData();
            fd.append('file', file);
            fd.append('steps', JSON.stringify(steps));
            fd.append('ingredients', JSON.stringify(ing));
            for (var key in data) {
                fd.append(key, data[key]);
            }
            $http.post(uploadUrl, fd, {
                    transformRequest: angular.identity,
                    headers: { 'Content-Type': undefined }
                })
                .success(function(response) {
                    $state.go('admin');
                    toastr.success('Receta creada con éxito', 'Gracias!');
                    console.log(response);
                })
                .error(function(response) {
                    console.log(response);
                    toastr.info('Debes cargar una imagen');
                });
        }
    })
    .service('fileEditUpload', function($http, toastr, $state, $rootScope) {
        this.uploadFileToUrl = function(file, uploadUrl, fileName) {
            var fd = new FormData();
            fd.append('file', file);
            fd.append('name', fileName);
            $http.post(uploadUrl, fd, {
                    transformRequest: angular.identity,
                    headers: { 'Content-Type': undefined }
                })
                .success(function(response) {
                    //$state.go('admin');
                    toastr.success('Foto actualizada');
                    $rootScope.$emit('fotoActualizada');
                    console.log(response);
                })
                .error(function(response) {
                    console.log(response);
                    //toastr.error(response.data.error);
                });
        }
    })
    