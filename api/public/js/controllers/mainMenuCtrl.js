'use strict';

angular.module('chefmindApp').controller('mainMenuCtrl', function($scope, $location, authUser){
	$scope.isActive = function(viewLocation){
		return viewLocation === $location.path();
	}
	$scope.isLogged = authUser.isLoggedIn();

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