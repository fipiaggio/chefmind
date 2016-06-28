'use strict';

angular.module('chefmindApp').controller('registerCtrl', function($scope, $location, $http, authUser) {
    $scope.newUser;
    $scope.passwordConfirm;
    $scope.register = function() {
        /*$http({
            method: "POST",
            url: "http://localhost:8000/auth_register",
            data: $scope.newUser,
            headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
        }).then(function mySucces(response) {
            console.log(response);
        }, function myError(response) {
            console.log(response);
        });*/
        $http({
            url: 'http://localhost:8000/auth_register',
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            data: $scope.newUser
        })/*
        $http.get('http://localhost:8000/recipes').then(function successCallback(response) {
            console.log(response);
        }, function errorCallback(response) {
            console.log(response);
        });*/
    }
});
