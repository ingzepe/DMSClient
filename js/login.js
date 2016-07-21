WS = angular.module('ws', ['ngMaterial', 'ngMessages']);

WS.controller('loginCtrl', ['$scope', '$http', function ($scope, $http) {
        $scope.switch = false;
        $scope.deshabiliarCausas = true;
        $scope.deshabiliarCintillo = true;
        $scope.cintilloRequired = false;
        $scope.causaRequired = false;
        $scope.login = {
            url: 'http://localhost/dmstest/public/courier-tracking?WSDL',
            flujo: 'Tradicional'
        };
        var flujoTradicional = [
            {categoria: 'cintillo', estado: 8, texto: "[8] Cintillo Recolectado"},
            {categoria: 'cintillo', estado: 9, texto: "[9] Cintillo Recibido en Plaza"},
            {categoria: 'cintillo', estado: 12, texto: "[12] Cintillo en Tránsito"},
            {categoria: 'cintillo', estado: 13, texto: "[13] Cintillo Recibido en Plaza"},
            {categoria: 'cintillo', estado: '15c', texto: "[15] Sobre Asignado a Ruta"},
            {categoria: 'cintillo', estado: 18, texto: "[18] Acuse en Proceso de Retorno"},
            {categoria: 'cintillo', estado: '20c', texto: "[20] Acuse Recibido en Plaza"},
            {categoria: 'cintillo', estado: '19c', texto: "[19] Acuse en Tránsito"},
            {categoria: 'cintillo', estado: 27, texto: "[27] Acuse Entregado"},
            {categoria: 'cintillo', estado: 23, texto: "[23] Devolución en Tránsito"},
            {categoria: 'cintillo', estado: 24, texto: "[24] Devolución Recibida en Plaza"},
            {categoria: 'cintillo', estado: 26, texto: "[26] Devolución Entregada a Captura"},
            {categoria: 'sobre', estado: 34, texto: "[34] Devolución Inmediata"},
            {categoria: 'sobre', estado: 15, texto: "[15] Sobre Asignado a Ruta"},
            {categoria: 'sobre', estado: 16, texto: "[16] Entregado"},
            {categoria: 'sobre', estado: 17, texto: "[17] Tarjeta Devuelta"},
            {categoria: 'sobre', estado: '20', texto: "[20] Acuse Recibido en Plaza"},
            {categoria: 'armado', estado: 22, texto: "[22] Devolución en Proceso Devolución"},
            {categoria: 'armado', estado: '23a', texto: "[23] Devolución en Tránsito"},
            {categoria: 'armado', estado: 19, texto: "[19] Acuse en Tránsito"},
        ];
        var flujoPremium = [
            {categoria: 'cintillo', estado: 8, texto: "[8] Cintillo Recolectado"},
            {categoria: 'cintillo', estado: 9, texto: "[9] Cintillo Recibido en Plaza"},
            {categoria: 'cintillo', estado: 29, texto: "[29] Devolución Inmediata Entregada a Captura"},
            {categoria: 'cintillo', estado: 45, texto: "[45] Guía de Devolución Entragada a Captura"},
            {categoria: 'sobre', estado: 25, texto: "[25] Cintillo en Tránsito"},
            {categoria: 'sobre', estado: 30, texto: "[30] Cintillo Recibido en Plaza"},
            {categoria: 'sobre', estado: 15, texto: "[15] Sobre Asignado a Ruta"},
            {categoria: 'sobre', estado: 16, texto: "[16] Entregado"},
            {categoria: 'sobre', estado: 17, texto: "[17] Tarjeta Devuelta"},
            {categoria: 'sobre', estado: 42, texto: "[42] Guía en Proceso de Devolución"},
            {categoria: 'sobre', estado: 43, texto: "[43] Guía de Devolución Recibida en Plaza"},
            {categoria: 'armado', estado: 44, texto: "[44] Guía de Devolución en Tránsito"},
            {categoria: 'armado', estado: 28, texto: "[28] Devolución Inmediata en Proceso de Retorno"},
        ];
        $scope.causas = [
            {codigo: 1, texto: "[1] Cliente se niega a identificar"},
            {codigo: 2, texto: "[2] No hay quién reciba"},
            {codigo: 3, texto: "[3] Persona/Identificación no autorizada para recibir"},
            {codigo: 4, texto: "[4] Cambio de domicilio"},
            {codigo: 5, texto: "[5] Domicilio Incorrecto y/o Incompleto"},
            {codigo: 6, texto: "[6] Sin acceso al domicilio"},
            {codigo: 7, texto: "[7] Desconocido en el domicilio"},
            {codigo: 8, texto: "[8] Cliente fallecido"},
            {codigo: 9, texto: "[9] Tarjeta Devuelta"},
            {codigo: 10, texto: "[10] Casa abandonada o deshabitada"},
            {codigo: 11, texto: "[11] Mal Grabada"},
            {codigo: 12, texto: "[12] Duplicada"},
            {codigo: 13, texto: "[13] Sin Causa /No trabajada"},
            {codigo: 14, texto: "[14] Robo  / Extravío"},
            {codigo: 15, texto: "[15] Rescate"},
            {codigo: 16, texto: "[16] Devolución Inmediata"},
            {codigo: 17, texto: "[17] Entregada"}
        ];
        $scope.estados = flujoTradicional;

        $scope.cambiaEstados = function (flujo) {
            if (flujo === "Premium") {
                $scope.estados = flujoPremium;
            } else {
                $scope.estados = flujoTradicional;
            }
        };
        var listaCausas = [17, 16];
        var listaCintillo = [22, 19, '23a', 44, 28];
        $scope.habilitarCampos = function (estado) {
            if (listaCausas.indexOf(estado) !== -1) {
                $scope.deshabiliarCausas = false;
                $scope.causaRequired = false;
            } else {
                $scope.deshabiliarCausas = true;
                $scope.causaRequired = true;
            }
            if (listaCintillo.indexOf(estado) !== -1) {
                $scope.deshabiliarCintillo = false;
                $scope.cintilloRequired = false;
            } else {
                $scope.deshabiliarCintillo = true;
                $scope.cintilloRequired = true;
            }
        };

        $scope.submit = function () {
            $scope.inicio = Date.now();
            $scope.final = '';
            $scope.switch = !$scope.switch;
            $scope.errors = [];

            var datos;
            $scope.login.token = null;
            var datosLogin = this.login;

            datos = angular.toJson(datosLogin);
            $http({
                method: 'POST',
                url: 'login.php',
                //async: false,
                data: datos
            }).then(function (respuesta) {
                if (respuesta.data.code === 200) {
                    datosLogin.token = respuesta.data.token;
                    $scope.errors.push(respuesta.data.message);
                } else {
                    $scope.errors.push(respuesta.data.message);
                    $scope.switch = false;
                }
                var reg = $scope.login.registros.split(',');
                angular.forEach(reg, function (valor, i) {
                    datosLogin.registro = valor;
                    datos = angular.toJson(datosLogin);
                    $scope.errors.push('...');
                    $http({
                        method: 'POST',
                        url: 'login.php',
//                        async: false,
                        data: datos
                    }).then(function (respuesta) {
                        $scope.final = Date.now();
                        $scope.switch = false;
                        $scope.errors[i+1] = valor + '(' + respuesta.data.code + ')' + respuesta.data.message;
                        $scope.cantidad = i + 1;
                    }, function (response) {
                        alert(response);
                    });
                });
            });

        };
    }]);