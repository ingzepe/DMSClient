<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" typ="text/css" href="css/angular-material.min.css">
        <link rel="stylesheet" typ="text/css" href="css/style.css">
    </head>
    <body ng-app="ws">
        <div ng-controller="changeStatusCtrl" layout="column" ng-cloak class="md-inline-form">
            <md-content layout-gt-sm="row" layout-padding layout-align="center center" >
                <div>
                    <form name="changeStatus" id="login" data-ng-submit="submit()" class="md-whiteframe-4dp">
                        <md-input-container>
                            <label>Estado</label>
                            <md-select ng-model="estado" name="estado" required>
                                <md-option ng-repeat="estado in estados" value="{{estado}}">{{estado}}</md-option>
                            </md-select>
                            <div class="errors" ng-messages="changeStatus.estado.$error" ng-if="changeStatus.$dirty">
                                <div ng-message="required">Required</div>
                            </div>
                        </md-input-container><br>
                        <textarea ng-model="registros" required></textarea><br>
                        <md-input-container>
                            <md-button type="submit" class="md-raised md-primary">ENVIAR</md-button>
                        </md-input-container>
                    </form>
                    <div class="error-login">{{errors}}</div>
                </div>
            </md-content>
        </div>
        <script type="text/javascript" src="js/angular.min.js"></script>
        <script type="text/javascript" src="js/angular-material.min.js"></script>
        <script type="text/javascript" src="js/angular-animate.min.js"></script>
        <script type="text/javascript" src="js/angular-messages.min.js"></script>
        <script type="text/javascript" src="js/angular-aria.min.js"></script>
        <script src="js/changeStatus.js"></script>
    </body>
</html>





