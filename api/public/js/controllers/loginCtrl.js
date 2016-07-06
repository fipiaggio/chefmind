'use strict';

angular.module('chefmindApp').controller('loginCtrl', function($scope, authUser){
	$scope.loginForm = {};
	$scope.login = function(){
		authUser.loginApi($scope.loginForm);
	};
});