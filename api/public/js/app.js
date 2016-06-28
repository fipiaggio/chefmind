'use strict';

angular
    .module('chefmindApp', [
        'ui.materialize',
        'ui.router',
        'satellizer',
        'ngAnimate',
        'toastr',
        'authService',
        'ngFileUpload'
    ])
    .config(function($stateProvider, $urlRouterProvider, $authProvider) {
        $authProvider.loginUrl = 'http://localhost:8000/auth_login';
        $stateProvider
            .state('app', {
                url: '/',
                templateUrl: 'views/home.html'
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
                templateUrl: 'views/misrecetas.html'
            })
            .state('misrecetas', {
                url: '/misrecetas',
                templateUrl: 'views/misrecetas.html'
            })
            .state('configuracion', {
                url: '/configuracion',
                templateUrl: 'views/configuracion.html'
            })
            .state('subirReceta', {
                url: '/subir-receta',
                templateUrl: 'views/subir-receta.html',
                controller: 'uploadRecipeCtrl'
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
    .directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    }
}])
.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
            
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}])
.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl, data){
        var fd = new FormData();
        fd.append('file', file);
        $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        })
        .success(function(response){
        	console.log(response)
        })
        .error(function(response){
        	console.log(response)
        });
    }
}]);
