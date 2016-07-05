'use strict';

angular.module('chefmindApp').controller('editRecipeCtrl', function($scope, authUser, $stateParams, $http, CONFIG, $q, fileEditUpload) {
    $scope.recipe = {};
    $scope.showData = {};
    $scope.ingredients = [];
    $scope.selectedCategory = 'Seleccionar categoría';
    $scope.steps;
    $scope.upload = false;
    $scope.select = {
        value: "Option1",
        choices: ["Fácil", "Medio", "Dificil"],
        cost: ["Bajo", "Medio", "Alto"],
        personas: ["1 persona", "2 personas", "3 personas", "4 personas", "5 personas", "Más de 5 personas"]
    };
    $scope.searchById = function(id, obj) {
        angular.forEach(obj, function(key) {
            if (id === key.id) {
                $scope.selectedCategory = key.name;
            };
        });
    };
    $http.get(CONFIG.APIURL + 'recipes/' + $stateParams.id).then(function success(response) {
            $scope.recipe = response.data;
            $scope.showData = response.data;
            if ($scope.recipe.people === null) {
                $scope.recipe.people = 'Seleccionar cantidad de personas';
            };
            if ($scope.recipe.dificulty === null) {
                $scope.recipe.dificulty = 'Seleccionar dificultad';
            };
            if ($scope.recipe.cost === null) {
                $scope.recipe.cost = 'Seleccionar dificultad';
            };
            $http.get(CONFIG.APIURL + 'recipeIngredients/' + $scope.recipe.id).then(function success(response) {
                angular.forEach(response.data, function(value) {
                    $scope.ingredients.push({ "text": value.name });
                });
            })
            $http.get(CONFIG.APIURL + 'stepRecipes/' + $scope.recipe.id).then(function success(response) {
                $scope.steps = response.data;
            })
            $http.get(CONFIG.APIURL + 'categories').then(function success(response) {
                $scope.categories = response.data;
                if ($scope.recipe.id != null) {
                    $scope.searchById($scope.id, $scope.categories);
                };

            }, function error(response) {
                console.log(response)
            });
        }),
        function(response) {
            console.log(response)
        };
    $scope.loadTags = function(query) {
        var defered = $q.defer();
        var matchIngredients = [];
        $http.get(CONFIG.APIURL + 'ingredient/' + query).success(function(response) {
                angular.forEach(response, function(value, key) {
                    matchIngredients.push({ "text": value.name })
                })
                defered.resolve(matchIngredients);
            }),
            function(err) {
                defered.reject(err);
            };
        return defered.promise;
    };
    $scope.saveRecipe = function() {
        $http.put(CONFIG.APIURL + 'ingredient/' + $scope.recipe.id, $scope.recipe)
            .success(function(data, status, headers, config) {
                //
            })
            .error(function(data, status, headers, config) {
                //
        	});
    };
});
