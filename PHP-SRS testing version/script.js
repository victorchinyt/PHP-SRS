/*global angular */
var app = angular.module('myApp', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider

    .when('/newMedicine', {
       templateUrl: 'newMedicine.html',
       controller: 'NewMedicineCtrl'
    })

    .when('/sale', {
       templateUrl: 'sale.html',
       controller: 'SaleCtrl'
    })

    .when('/stockUpdate', {
       templateUrl: 'stockUpdate.html',
       controller: 'StockUpdateCtrl'
    })

    .otherwise({
       redirectTo: '/newMedicine'
    });
}]);

app.controller('NewMedicineCtrl', function($scope) {
    $scope.message = "This page will be used to display add new medicine form";
});

app.controller('SaleCtrl', function($scope) {
    $scope.message = "This page will be used to display add sale form";
});

app.controller('StockUpdateCtrl', function($scope) {
    $scope.message = "This page will be used to display update stock form";
});

app.controller('appCtrl', function($scope) {
    $scope.greeting = { text: 'Hello' };
});

app.controller('fetchCtrl', function($scope, $http) {
   $http.get("http://www.w3schools.com/angular/customers_mysql.php")
   .then(function (response) {$scope.names = response.data.records;});
});