'use strict';

angular.module('chefmindApp').controller('homeCtrl', function($scope, $state, $http, CONFIG, toastr, sessionControl, fileUpload, $q) {

    $scope.ingredients;

    $scope.search = function(){
    	$state.go('list', {obj: $scope.ingredients});
    };

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
});
