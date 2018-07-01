<?php include "includes/header.php"; 
	
?>

<div ng-app = "studentsApp">
	<div class="container">

		<div ng-view></div>    <!-- partial pages go here -->
	</div>       <!-- end class='container' -->
</div>		 <!-- end studentsApp -->
<script>
	var app = angular.module('studentsApp', ['ngRoute']);

	app.config(function($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl : 'partials/all_students.html',		// route for the home page
				controller : 'allCtrl'
			})
			.when('/all_students', {
				templateUrl : 'partials/all_students.html', 	
				controller : 'allCtrl'
			})
			.when('/gpa', {
				templateUrl : 'partials/gpa.html', 			   // route for gpa page
				controller : 'gpaCtrl'
			})
			.when('/add_student', {
				templateUrl : 'partials/add_student.html',     // add a student to db
				controller : 'addCtrl'
			})
			.when('/edit_student', {
				templateUrl : 'partials/edit_student.html',    // edit a student record	
				controller : 'editCtrl'
			})
			.otherwise({
				redirectTo: 'partials/all_students.html',      // any other URL goes to home page
			});
	});

	app.controller('allCtrl', function($scope, $http) {
    
	   $http.get("all.php").then(function (response) {		// get all of the students table
		    $scope.students = response.data;  
	     });

	});

	app.controller('gpaCtrl', function($scope, $http){

		$http.get("gpa.php").then(function (response) {
				$scope.students = response.data
			});
	});

	app.controller('addCtrl', function($scope, $http) {

		$scope.addStudent = function() {
			params = "sql=insert";
			params += "&student_id=" + $scope.student_id;
			params += "&first_name=" + $scope.first_name;
			params += "&last_name=" + $scope.last_name;
			params += "&hrs_completed=" + $scope.hrs_completed;
			params += "&hrs_attempted=" + $scope.hrs_attempted;
			params += "&gpa_points=" + $scope.gpa_points;
			params += "&major=" + $scope.major;
			params += "&advisor_id=" + $scope.advisor_id;
			params += "&email=" + $scope.email;

			url = "create.php?" + params;

			$http.get(url).then(function(response) {
					$scope.students = response.data;
				});
		};
	});

	app.controller('editCtrl', function($scope, $http) {
		$scope.status = null;
		$scope.returnStudents = function() {
			params = "sql=fetch&student_id=" + $scope.student_id;
			url = "edit.php?" + params;
			$http.get(url).then(function(response) {
				$scope.first_name = response.data.first_name;
				$scope.last_name = response.data.last_name;
				$scope.hrs_completed = response.data.hrs_completed;
				$scope.hrs_attempted = response.data.hrs_attempted;
				$scope.gpa_points = response.data.gpa_points;
				$scope.major = response.data.major;
				$scope.advisor_id = response.data.advisor_id;
				$scope.email = response.data.email;
				

			});
		}

			$scope.editRecord = function() {
				params = "sql=update";
				params += "&student_id=" + $scope.student_id;
				params += "&first_name=" + $scope.first_name;
				params += "&last_name=" + $scope.last_name;
				params += "&hrs_completed=" + $scope.hrs_completed;
				params += "&hrs_attempted=" + $scope.hrs_attempted;
				params += "&gpa_points=" + $scope.gpa_points;
				params += "&major=" + $scope.major;
				params += "&advisor_id=" + $scope.advisor_id;
				params += "&email=" + $scope.email;

				url = "edit.php?" + params;

				$http.get(url).then(function(response) {
					$scope.status = 'updated';
				});
			}
			
			$scope.deleteRecord = function() {
				params = "sql=delete&student_id=" + $scope.student_id;

				url = "delete.php?" + params;
				$http.get(url).then(function(response) {
					$scope.status = 'complete';
				});
			};
	});
</script>
<?php include "includes/footer.php"; ?> 