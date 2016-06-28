'use strict';

angular.module('authService', [])
    .factory('sessionControl', function() {
        return {
            get: function(key) {
                return sessionStorage.getItem(key);
            },
            set: function(key, val) {
                return sessionStorage.setItem(key, val);
            },
            unset: function(key) {
                return sessionStorage.removeItem(key);
            }
        }
    })
    .factory('authUser', function($auth, $state, sessionControl, toastr) {

        var cacheSession = function(id, email, username, avatar) {
            sessionControl.set('userID', id);
            sessionControl.set('email', email);
            sessionControl.set('username', username);
            sessionControl.set('avatar', avatar);
            sessionControl.set('userIsLogged', true);
        };

        var unCacheSession = function() {
            sessionControl.unset('userIsLogged');
            sessionControl.unset('userID');
            sessionControl.unset('email');
            sessionControl.unset('username');
            sessionControl.unset('avatar');
        };

        var login = function(loginForm) {
            $auth.login(loginForm).then(
                function(response) {
                    console.log(response);
                    cacheSession(response.data.user.id, response.data.user.email, response.data.user.name, loginForm.avatar);
                    $state.go('admin');
                    toastr.success('Bienvenido!', 'Chefmind');

                },
                function(error) {
                    console.log(error);
                    unCacheSession();
                    toastr.error('Usuario o contraseña inválidos', 'Ups!');
                }
            );
        };
        var logout = function(){
            unCacheSession();
        }
        return {
            loginApi: function(loginForm) {
                login(loginForm)
            },
            isLoggedIn: function(){
                return sessionControl.get('userIsLogged') !== null;
            },
            logout: function(){
                $auth.logout();
                unCacheSession();
                $state.go('app');
            }
        };
    });
