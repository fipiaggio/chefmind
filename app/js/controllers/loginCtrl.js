'use strict';

angular.module('chefmindApp').controller('loginCtrl', function($scope, authUser){
	$scope.loginForm = {
		email:'fran@gmail.com',
		password:'12345678'
	};
	$scope.login = function(){
		authUser.loginApi($scope.loginForm);
	};
});