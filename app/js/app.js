'use strict';

angular
	.module('chefmindApp', [
		'ui.router',
		'satellizer',
		'ngAnimate',
		'toastr',
		'authService'
	])
	.config(function($stateProvider, $urlRouterProvider, $authProvider){
		$authProvider.loginUrl = 'http://localhost:8000/auth_login';
		$stateProvider
		.state('app',{
			url:'/',
			templateUrl: 'views/home.html'
		})
		.state('categorias',{
			url:'/categorias',
			templateUrl: 'views/categorias.html'
		})
		.state('contacto',{
			url:'/contacto',
			templateUrl: 'views/contacto.html'
		})
		.state('faq',{
			url:'/faq',
			templateUrl: 'views/faq.html'
		})
		.state('login',{
			url:'/login',
			templateUrl: 'views/login.html',
			controller: 'loginCtrl'
		})
		.state('registro',{
			url:'/registro',
			templateUrl: 'views/registro.html'
		})
		.state('admin',{
			url:'/admin',
			templateUrl: 'views/admin.html'
		})
		.state('misrecetas',{
			url:'/misrecetas',
			templateUrl: 'views/misrecetas.html'
		})
		.state('configuracion',{
			url:'/configuracion',
			templateUrl: 'views/configuracion.html'
		})
		$urlRouterProvider.otherwise('/');
	})
	.run(function($rootScope, $location, authUser, $state){
		var rutasPrivadas = ['/admin'];
		$rootScope.$on('$stateChangeStart', function(){
			if(($.inArray($location.path(), rutasPrivadas) !== -1) && !authUser.isLoggedIn()){
				$location.path('login');
				$state.go('login');
			};
		});
	});