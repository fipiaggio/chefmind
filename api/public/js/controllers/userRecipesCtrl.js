'use strict';

angular.module('chefmindApp').controller('userRecipesCtrl', function($scope, $http, $state, authUser, toastr, CONFIG, sessionControl) {

	$scope.myRecipes;
	$scope.username = sessionStorage.getItem('username');

	$scope.getMyRecipes = function(){
	    $http.get(CONFIG.APIURL + 'userRecipes').then(function success(response) {
	    	$scope.myRecipes = response.data;
	    }), function(response){
	    	console.log(response)
	    };
	};
	$scope.getMyRecipes();


    $scope.deteleRecipe = function(id){
		$http({
			method: 'DELETE',
			url: CONFIG.APIURL+'recipes/'+id
		}).then(function successCallback(response) {
			$scope.getMyRecipes();
			toastr.info('Receta eliminada');
		}, function errorCallback(response) {
			console.log(response)
		});
    };
});
