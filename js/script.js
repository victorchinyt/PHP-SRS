var app = angular.module("myApp",[]);
    app.controller("getCtrl", function($scope, $http) {
        $http.get('srs_db.sql')
        .then (
            function(response) {
                $scope.sales = response.data;
            },
            function(response) {
            // error handling routine
            });
    });
