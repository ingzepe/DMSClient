<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" typ="text/css" href="css/angular-material.min.css">
        <link rel="stylesheet" typ="text/css" href="css/style.css">
    </head>
    <body ng-app="ws">
        <div ng-controller="loginCtrl" layout="column" ng-cloak class="md-inline-form">
            <md-content layout-gt-sm="row" layout-padding layout-align="center center" >
                <form data-ng-submit="submit()" class="md-whiteframe-4dp" flex="70" layout-padding name="loginForm">
                    <md-input-container class="md-block" flex-gt-xs>
                        <label>URL</label>
                        <input ng-model="login.url" required>
                        <div ng-messages="login.url.$error">
                            <div ng-message="required">This is required.</div>
                        </div>
                    </md-input-container>
                    <md-input-container>
                        <label>Usuario</label>
                        <input ng-model="login.user" name="user" required>
                        <div ng-messages="loginForm.user.$error">
                            <div ng-message="required">This is required.</div>
                        </div>
                    </md-input-container>
                    <md-input-container>
                        <label>Password</label>
                        <input ng-model="login.pass" name="pass" required>
                        <div ng-messages="loginForm.pass.$error">
                            <div ng-message="required">This is required.</div>
                        </div>
                    </md-input-container><br>
                    <md-radio-group ng-model="login.flujo" ng-click="cambiaEstados(login.flujo)">
                        <md-radio-button value="Tradicional"> Tradicional </md-radio-button>
                        <md-radio-button value="Premium" class="md-primary"> Premium </md-radio-button>
                    </md-radio-group><br>
                    <md-input-container>
                        <label>Estado</label>
                        <md-select ng-model="login.estado" name="estado" ng-change="habilitarCampos(login.estado)" required>
                            <md-optgroup label="cintillo">
                                <md-option ng-value="estado.estado" ng-repeat="estado in estados| filter: {categoria: 'cintillo' }">
                                    {{estado.texto}}
                                </md-option>
                            </md-optgroup>
                            <md-optgroup label="sobre">
                                <md-option ng-value="estado.estado" ng-repeat="estado in estados| filter: {categoria: 'sobre' }">
                                    {{estado.texto}}
                                </md-option>
                            </md-optgroup>
                            <md-optgroup label="armado">
                                <md-option ng-value="estado.estado" ng-repeat="estado in estados| filter: {categoria: 'armado' }">
                                    {{estado.texto}}
                                </md-option>
                            </md-optgroup>
                        </md-select>
                        <div ng-messages="loginForm.estado.$error">
                            <div ng-message="required">This is required.</div>
                        </div>
                    </md-input-container>
                    <md-input-container>
                        <label>Causa</label>
                        <md-select ng-model="login.causa.codigo" ng-disabled="deshabiliarCausas" ng-if="!causaRequired" required>
                            <md-option ng-value="causa.codigo" ng-repeat="causa in causas ">
                                {{causa.texto}}
                            </md-option>
                        </md-select>
                    </md-input-container><br>
                    <label>Registros</label><br>
                    <textarea ng-model="login.registros" cols="45" rows="5" required></textarea>
                    <md-input-container>
                        <label>Nuevo Cintillo</label>
                        <input ng-model="login.newCintillo" name="newCintillo" ng-disabled="deshabiliarCintillo" ng-if="!cintilloRequired" required>
                        <div ng-messages="loginForm.newCintillo.$error">
                            <div ng-message="required">This is required.</div>
                        </div>
                    </md-input-container><br>
                    <md-input-container>
                        <md-button type="submit" class="md-raised md-primary" ng-disabled="loginForm.$invalid">ENVIAR</md-button>
                        <span>{{ inicio | date:'HH:mm:ss'}}</span> || <span>{{ final | date:'HH:mm:ss'}}</span><br>
                        <span>Registros: {{ cantidad}}</span>
                    </md-input-container>
                </form>
                <div class="md-whiteframe-4dp error-login" flex="30" layout="row" layout-align="center center" style="max-height: 600px; overflow-y: auto">
                    <md-progress-circular ng-show="switch" class="md-warn" md-diameter="80"></md-progress-circular>
                    <md-list>
                        <md-list-item ng-repeat="error in errors track by $index">
                            {{error}}
                            <md-divider ng-if="!$last"></md-divider>
                        </md-list-item>
                    </md-list>
                </div>
            </md-content>
        </div>
        <script type="text/javascript" src="js/angular.min.js"></script>
        <script type="text/javascript" src="js/angular-material.min.js"></script>
        <script type="text/javascript" src="js/angular-animate.min.js"></script>
        <script type="text/javascript" src="js/angular-messages.min.js"></script>
        <script type="text/javascript" src="js/angular-aria.min.js"></script>
        <script src="js/login.js"></script>
    </body>
</html>





