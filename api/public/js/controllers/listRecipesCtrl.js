'use strict';

angular.module('chefmindApp').controller('listRecipesCtrl', function($scope, $state, $http, CONFIG, toastr, sessionControl, fileUpload, $q) {
    $scope.ingredients = $state.params.obj;
    $scope.recipes;
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
        }, function errorCallback(response) {
            console.log(response);
        })
    }
    $scope.getIngredients();
});
