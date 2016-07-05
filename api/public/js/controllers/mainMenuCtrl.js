'use strict';

angular.module('chefmindApp').controller('mainMenuCtrl', function($scope, $location, authUser){
	$scope.isLogged = authUser.isLoggedIn();
	
	$scope.isActive = function(viewLocation){
		return viewLocation === $location.path();
	}

	$scope.$watch(function(){
		return authUser.isLoggedIn();
	}, function(newVal){
		if(typeof newVal !== 'undefinded'){
			$scope.isLogged = authUser.isLoggedIn();
		};
	});

	$scope.logout = function(){
		authUser.logout();
	};
	
});