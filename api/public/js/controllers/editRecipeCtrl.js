'use strict';

angular.module('chefmindApp').controller('editRecipeCtrl', function($scope, authUser, $stateParams, $http, CONFIG, $q, fileEditUpload, $rootScope) {
    $scope.recipe = {};
    $scope.showData = {};
    $scope.ingredients = [];
    $scope.selectedCategory = 'Seleccionar categoría';
    $scope.steps;
    $scope.upload = false;
    $scope.image;
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
    $scope.changeImage = function() {
        var uploadUrl = CONFIG.APIURL + 'replaceImage';
        var file = $scope.image;
        var id = $scope.recipe.id;
        fileEditUpload.uploadFileToUrl(file, uploadUrl, id);
    }
    $rootScope.$on('fotoActualizada', function() {
        $scope.getSelectedRecipe();
        $scope.showNewImage = true;
    });
    $scope.getSelectedRecipe = function() {
        $http.get(CONFIG.APIURL + 'recipes/' + $stateParams.id).then(function success(response) {
                $scope.recipe = response.data;
                $scope.showData = response.data;
                $scope.newUrl = '/image/' + $scope.recipe.img;

                $http.get(CONFIG.APIURL + 'recipeIngredients/' + $scope.recipe.id).then(function success(response) {
                	$scope.ingredients = '';
                	$scope.ingredients = [];
                    angular.forEach(response.data, function(value) {
                        $scope.ingredients.push({ "text": value.name });
                    });
                });

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
    }
    $scope.getSelectedRecipe();
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
    $scope.addStep = function(index, description) {
        if (!$scope.stepIsEmpty) {
            $scope.steps.push({ 'description': $scope.step });
            $scope.step = '';
        }
    };
    $scope.deleteStep = function(index) {
        $scope.steps.splice(index, 1);
    };
    $scope.saveRecipe = function() {
    	if($scope.image != undefined){
    		$scope.changeImage();
    	};
        $http.put(CONFIG.APIURL + 'ingredients/' + $scope.recipe.id, $scope.ingredients)
        .success(function(response) {
        	console.log(response);
        }).
        error(function(response) {
        	console.log(response);
        });
        /*$http.put(CONFIG.APIURL + 'steps/' + $scope.recipe.id, $scope.steps)
        .success(function(response) {
        	console.log(response);
        }).
        error(function(response) {
        	console.log(response);
        });
        $http.put(CONFIG.APIURL + 'recipes/' + $scope.recipe.id, $scope.recipe)
        .success(function(response) {
            $scope.getSelectedRecipe();
        })
        .error(function(response) {
            console.log(response)
        });*/
    };
});
