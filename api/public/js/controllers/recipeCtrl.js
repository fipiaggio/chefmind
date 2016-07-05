'use strict';

angular.module('chefmindApp').controller('recipeCtrl', function($scope, $location, $stateParams, $http, CONFIG) {
    $scope.recipe;
    $scope.author;
    $scope.ingredients;
    $scope.steps;
    $http.get(CONFIG.APIURL + 'recipes/' + $stateParams.id).then(function success(response) {
            $scope.recipe = response.data;
            $http.get(CONFIG.APIURL + 'users/' + $scope.recipe.user_id)
            .then(function success(response) {
                $scope.author = response.data.name;
            })
            $http.get(CONFIG.APIURL + 'recipeIngredients/' + $scope.recipe.id)
            .then(function success(response) {
                console.log(response)
                $scope.ingredients = response.data;
            })
            $http.get(CONFIG.APIURL + 'stepRecipes/' + $scope.recipe.id)
            .then(function success(response) {
                console.log(response)
                $scope.steps = response.data;
            })
        }),
        function(response) {
            console.log(response)
        };
});
