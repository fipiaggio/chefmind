'use strict';

angular.module('chefmindApp').controller('registerCtrl', function($scope, $location, $http, $state, authUser, toastr) {
    $scope.user = {};
    $scope.passwordConfirm;
    $scope.register = function() {
        if($scope.user.name === undefined){
            toastr.error('No ingresaste tu nombre', 'Error'); 
            return false;
        }
        if($scope.user.email === undefined){
            toastr.error('No ingresaste tu contraseña', 'Error'); 
            return false;
        }
        if($scope.user.password === undefined){
            toastr.error('No ingresaste tu contraseña', 'Error'); 
            return false;
        }
        if ($scope.passwordConfirm === $scope.user.password) {
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
                toastr.error(response.data.error); 
                console.log(response);
            })
        }else{
           toastr.error('Las contraseñas no coinciden', 'Error'); 
        }
    }
});
