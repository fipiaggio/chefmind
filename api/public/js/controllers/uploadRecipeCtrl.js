'use strict';

angular.module('chefmindApp').controller('uploadRecipeCtrl', function($scope, $state, $http, CONFIG, toastr, sessionControl, fileUpload, $q) {

    $scope.recipe = {};
    $scope.steps = [];
    $scope.step = '';
    $scope.ingredients;
    $scope.image;
    $scope.recipe.user_id = sessionControl.get('userID');


    $http.get(CONFIG.APIURL + 'categories').then(function success(response) {
        $scope.categories = response.data;
    }, function error(response) {
        console.log(response)
    });

    $scope.loadTags = function(query) {
        var defered = $q.defer();
        var matchIngredients = [];
        $http.get(CONFIG.APIURL + 'ingredient/' + query).success(function(response) {
            angular.forEach(response, function(value, key){
                matchIngredients.push({"text":value.name})
            })
            defered.resolve(matchIngredients);
        }), function(err){
            defered.reject(err);
        };
        return defered.promise;

    };

    $scope.saveRecipe = function() {
        // Upload de la imagen
        var uploadUrl = CONFIG.APIURL + 'recipes';
        var file = $scope.image;
        fileUpload.uploadFileToUrl(file, uploadUrl, $scope.recipe, $scope.steps, $scope.ingredients);
    };

    $scope.select = {
        value: "Option1",
        choices: ["Fácil", "Medio", "Dificil"],
        cost: ["Bajo", "Medio", "Alto"],
        personas: ["1 persona", "2 personas", "3 personas", "4 personas", "5 personas", "Más de 5 personas"]
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

});
