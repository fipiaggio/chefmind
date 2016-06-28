'use strict';

angular.module('chefmindApp').controller('uploadRecipeCtrl', function($scope, $state, $http, CONFIG, toastr, sessionControl, fileUpload) {
    $scope.recipe = {};
    $scope.ingredients;
    $scope.image;
    $scope.recipe.user_id = sessionControl.get('userID');


    $http.get(CONFIG.APIURL + 'categories').then(function success(response) {
        $scope.categories = response.data;
    }, function error(response) {
        console.log(response)
    });
    $scope.saveRecipe = function() {
    	// Upload de la imagen
        var uploadUrl = CONFIG.APIURL + 'recipes';
        var file = $scope.image;
		fileUpload.uploadFileToUrl(file, uploadUrl);

        //console.log($scope.recipe)
        /*$http({
            url: CONFIG.APIURL+'recipes',
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            data: $scope.recipe
        }).then(function successCallback(response) {
            $state.go('admin');
            toastr.success('Receta creada con éxito', 'Gracias!');
            
            console.log(response);
        }, function errorCallback(response) {
        	console.log(response);
            toastr.error(response.data.error);
        })*/

    };

    $scope.select = {
        value: "Option1",
        choices: ["Fácil", "Medio", "Dificil"],
        cost: ["Bajo", "Medio", "Alto"],
        personas: ["1 persona", "2 personas", "3 personas", "4 personas", "5 personas", "Más de 5 personas"]
    };

});
