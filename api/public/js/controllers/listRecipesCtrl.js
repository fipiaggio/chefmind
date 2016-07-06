'use strict';

angular.module('chefmindApp').controller('listRecipesCtrl', function($scope, $state, $http, CONFIG, toastr, sessionControl, fileUpload, $q) {

    if($state.params.obj === null){
        $scope.ingredients = JSON.parse(localStorage.getItem('ing'));
    }else{
        $scope.ingredients = $state.params.obj;
        $scope.recipes;
    };

    $scope.getIngredients = function() {
        $http({
            url: 'http://localhost:8000/list',
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            data: $scope.ingredients
        }).then(function successCallback(response) {
            $scope.recipes = response.data;
            // Guardo última búsqueda
            localStorage.setItem('ing', JSON.stringify($scope.ingredients ));
        }, function errorCallback(response) {
            console.log(response);
        })
    }
    $scope.getIngredients();
});
