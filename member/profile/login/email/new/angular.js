var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('memberdata',function($scope, $http, $window){
	$scope.AddModal = false;
    $scope.EditModal = false;
    $scope.DeleteModal = false;

    $scope.errorFirstname = false;

    $scope.showAdd = function(){
    	$scope.email = null;
    	$scope.errorEmail = false;
    	$scope.AddModal = true;
    }
  
    $scope.fetch = function(){
    	$http.get("fetch.php").success(function(data){ 
	        $scope.members = data; 
	    });
    }

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   
        $scope.reverse = !$scope.reverse;
    }

    $scope.clearMessage = function(){
    	$scope.success = false;
    	$scope.error = false;
    }

    $scope.addnew = function(){
    	$http.post(
            "add.php", {
                'name': $scope.name,
            }
        ).success(function(data) {
        	if(data.name){
        		$scope.errorEmail = true;
        		$scope.errorMessage = data.message;
        		$window.document.getElementById('name').focus();
        	}
        	else if(data.error){
        		$scope.errorEmail = false;
        		$scope.errorMessage = data.message;
        	}
        	else{
        		$scope.AddModal = false;
        		$scope.success = true;
        		$scope.successMessage = data.message;
        		$scope.fetch();
        	}
        });
    }

    $scope.selectMember = function(member){
    	$scope.clickMember = member;
    }

    $scope.showEdit = function(){
    	$scope.EditModal = true;
    }

    $scope.updateMember = function(){
        console.log($scope.clickMember);
    	$http.post("edit.php", $scope.clickMember)
    	.success(function(data) {
        	if(data.error){
        		$scope.error = true;
        		$scope.errorMessage = data.message;
        		$scope.fetch();
        	}
        	else{
        		$scope.success = true;
        		$scope.successMessage = data.message;
        	}
        });
    }

    $scope.showDelete = function(){
    	$scope.DeleteModal = true;
    }

    $scope.deleteMember = function(){
    	$http.post("delete.php", $scope.clickMember)
    	.success(function(data) {
        	if(data.error){
        		$scope.error = true;
        		$scope.errorMessage = data.message;
        	}
        	else{
        		$scope.success = true;
        		$scope.successMessage = data.message;
        		$scope.fetch();
        	}
        });
    }

});