'use strict';

angular.module('chefmindApp').controller('userConfigurateCtrl', function($scope, authUser, $http, CONFIG, toastr) {

    $scope.iduser = sessionStorage.getItem('userID');
    $scope.user = {};
    $http.get(CONFIG.APIURL + 'users/' + $scope.iduser).then(function success(response) {
        console.log(response);
        $scope.user = response.data;
    }, function error(response) {

    });

    $scope.updateRecipe = function() {
    	if($scope.password != $scope.checkPassword){
    		toastr.error('Las contraseñas no coinciden');
    	}
        $http.put(CONFIG.APIURL + 'users/' + $scope.recipe.id, $scope.user)
            .success(function(response) {
                console.log(response);
            }).
    }

});
