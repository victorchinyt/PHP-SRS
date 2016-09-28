var app = angular.module("myApp", []);
    app.controller('postCtrl', ['$scope', 
        function($scope){        
          $scope.stats1 = [];

          $scope.addCode = function(stat1){
            $scope.stats1.push(stat1);
            $scope.newCode = null;
          }
          
          $scope.stats2 = [];

          $scope.addName = function(stat2){
            $scope.stats2.push(stat2);
            $scope.newName = null;
          }
          
          $scope.stats3 = [];

          $scope.addQty = function(stat3){
            $scope.stats3.push(stat3);
            $scope.newQty = null;
          }
          
          $scope.stats4 = [];

          $scope.addUp = function(stat4){
            $scope.stats4.push(stat4);
            $scope.newUp = null;
          }
          
          

          $scope.removeStat = function(index){
            $scope.stats.splice(index, 1);
          }
}]);