WS = angular.module('ws', ['ngMaterial', 'ngMessages']);

WS.controller('changeStatusCtrl', ['$scope', '$http', function ($scope, $http) {
        $scope.estados = [
                    "[8] Cintillo Recolectado", 
                    "[9] Cintillo Recivido en Plaza"];
        $scope.submit = function () {

        };
    }]);