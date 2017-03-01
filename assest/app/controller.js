myApp.controller('listCtrl', function ($scope, Student,CORE_CONFIG,WEB_API) {

    $scope.customer = Student.get();
    $scope.customer.$promise.then(function(result) {
//					$scope.setLog(100,"Images are optimized and converted to TIFF",""); // = function(proval, currentstatus, css, newlog)
//					$timeout(function(){
//						$scope.proval = 0;
//					}, 1000);
                                        $scope.customers = result.result;
                                        console.log($scope.customers);
				
			});
//    Student.getCustomers().then(function(data){
//        $scope.customers = data.data;
//    });
});

myApp.controller('editCtrl', function ($scope, $rootScope, $location, $routeParams, services, customer) {
    var customerID = ($routeParams.customerID) ? parseInt($routeParams.customerID) : 0;
    $rootScope.title = (customerID > 0) ? 'Edit Customer' : 'Add Customer';
    $scope.buttonText = (customerID > 0) ? 'Update Customer' : 'Add New Customer';
      var original = customer.data;
      original._id = customerID;
      $scope.customer = angular.copy(original);
      $scope.customer._id = customerID;

      $scope.isClean = function() {
        return angular.equals(original, $scope.customer);
      }

      $scope.deleteCustomer = function(customer) {
        $location.path('/');
        if(confirm("Are you sure to delete customer number: "+$scope.customer._id)==true)
        services.deleteCustomer(customer.customerNumber);
      };

      $scope.saveCustomer = function(customer) {
        $location.path('/');
        if (customerID <= 0) {
            services.insertCustomer(customer);
        }
        else {
            services.updateCustomer(customerID, customer);
        }
    };
});


