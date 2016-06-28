'use strict';

angular.module('chefmindApp').controller('loginCtrl', function($scope, authUser){
	$scope.loginForm = {
		email:'admin@admin.com',
		password:'1234'
	};
	$scope.login = function(){
		authUser.loginApi($scope.loginForm);
	};
});