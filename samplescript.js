/*global angular */
var app = angular.module('myApp', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider

    .when('/addStudent', {
       templateUrl: 'addStudent.html',
       controller: 'AddStudentController'
    })

    .when('/viewStudents', {
       templateUrl: 'viewStudents.html',
       controller: 'ViewStudentsController'
    })

    .otherwise({
       redirectTo: '/addStudent'
    });
}]);

app.controller('AddStudentController', function($scope) {
    $scope.message = "This page will be used to display add student form";
});

app.controller('ViewStudentsController', function($scope) {
    $scope.message = "This page will be used to display all the students";
});

app.controller('appCtrl', function($scope) {
    $scope.greeting = { text: 'Hello' };
});

app.controller('fetchCtrl', function($scope, $http) {
   $http.get("http://www.w3schools.com/angular/customers_mysql.php")
   .then(function (response) {$scope.names = response.data.records;});
});