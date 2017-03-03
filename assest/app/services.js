myApp.factory('Student', ['$resource','CORE_CONFIG','WEB_API', function($resource,CORE_CONFIG,WEB_API)
	 {
//             alert(CORE_CONFIG.WEB_SERVICE+WEB_API.GETDATA);
	  return $resource(CORE_CONFIG.WEB_SERVICE+WEB_API.GETDATA+'/:id', {},{ 'update': { method:'PUT' } 
	 }  
	); 
}]);
myApp.factory('FolderScan', ['$resource','CORE_CONFIG','WEB_API', function($resource,CORE_CONFIG,WEB_API)
	 {
//             alert(CORE_CONFIG.WEB_SERVICE+WEB_API.GETDATA);
	  return $resource(CORE_CONFIG.WEB_SERVICE+WEB_API.GETDATA+'/:id', {},{ 'update': { method:'PUT' } 
	 }  
	); 
}]);
myApp.factory('CropImage', ['$resource','CORE_CONFIG','WEB_API', function($resource,CORE_CONFIG,WEB_API)
	 {
             alert(CORE_CONFIG.WEB_SERVICE+WEB_API.convertImage);
	  return $resource(CORE_CONFIG.WEB_SERVICE+WEB_API.convertImage+'/:name', {},{ 'update': { method:'PUT' } 
	 }  
	); 
}]);
myApp.factory("services", ['$http','CORE_CONFIG', function($http,CORE_CONFIG) {
  var serviceBase = 'services/'
    var obj = {};
    obj.getCustomers = function(){
        return $http.get(serviceBase + 'customers');
    }
    obj.getCustomer = function(customerID){
        return $http.get(serviceBase + 'customer?id=' + customerID);
    }

    obj.insertCustomer = function (customer) {
    return $http.post(serviceBase + 'insertCustomer', customer).then(function (results) {
        return results;
    });
	};

	obj.updateCustomer = function (id,customer) {
	    return $http.post(serviceBase + 'updateCustomer', {id:id, customer:customer}).then(function (status) {
	        return status.data;
	    });
	};

	obj.deleteCustomer = function (id) {
	    return $http.delete(serviceBase + 'deleteCustomer?id=' + id).then(function (status) {
	        return status.data;
	    });
	};

    return obj;   
}]);