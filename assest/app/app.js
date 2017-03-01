var myApp = angular.module('myApp', ['ngRoute','ngResource']);
//alert("jkjhkjhkj");
myApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/', {
        title: 'Customers',
        templateUrl: 'assest/partials/customers.html',
        controller: 'listCtrl'
      })
      .when('/edit-customer/:customerID', {
        title: 'Edit Customers',
        templateUrl: 'assest/partials/edit-customer.html',
        controller: 'editCtrl',
        resolve: {
          customer: function(services, $route){
            var customerID = $route.current.params.customerID;
            return services.getCustomer(customerID);
          }
        }
      })
      .otherwise({
        redirectTo: '/'
      });
      alert("$routeProvider"+ JSON.stringify($routeProvider));
}]);
myApp.run(['$location', '$rootScope', function($location, $rootScope) {
    $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
        $rootScope.title = current.$$route.title;
    });
}]);