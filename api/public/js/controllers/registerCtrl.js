'use strict';

angular.module('chefmindApp').controller('registerCtrl', function($scope, $location, $http, $state, authUser, toastr) {
    $scope.user;
    $scope.passwordConfirm;
    $scope.register = function() {
        $http({
            url: 'http://localhost:8000/users',
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            data: $scope.user
        }).then(function successCallback(response) {
            console.log(response);
            $state.go('login');
            toastr.success('Por favor ingresar sus datos', 'Bienvenido!');
        }, function errorCallback(response) {
            console.log(response);
        })
    }
});
