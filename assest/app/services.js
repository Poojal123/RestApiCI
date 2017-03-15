myApp.factory('GetData', ['$resource','CORE_CONFIG','WEB_API', function($resource,CORE_CONFIG,WEB_API)
	 {
//             alert(CORE_CONFIG.WEB_SERVICE+WEB_API.GETDATA);
	  return $resource(CORE_CONFIG.WEB_SERVICE+WEB_API.GetData+'/:id', {},{ 'update': { method:'PUT' } 
	 }  
	); 
}]);
myApp.factory('FolderScan', ['$resource','CORE_CONFIG','WEB_API', function($resource,CORE_CONFIG,WEB_API)
	 {
             alert("hiiii" +CORE_CONFIG.WEB_SERVICE+WEB_API.FOLDERSCAN);
	  return $resource(CORE_CONFIG.WEB_SERVICE+WEB_API.FOLDERSCAN+'/:folderName', {},{ 'update': { method:'PUT' } 
	 }  
	); 
}]);
myApp.factory('CropImage', ['$resource','CORE_CONFIG','WEB_API', function($resource,CORE_CONFIG,WEB_API)
	 {
//             alert(CORE_CONFIG.WEB_SERVICE+WEB_API.convertImage);
	  return $resource(CORE_CONFIG.WEB_SERVICE+WEB_API.convertImage+'/:name/:ext/:page', {},{ 'update': { method:'PUT' } 
	 }  
	); 
}]);
myApp.factory('SaveCoordinates', ['$resource','CORE_CONFIG','WEB_API', function($resource,CORE_CONFIG,WEB_API)
	 {
//             alert(CORE_CONFIG.WEB_SERVICE+WEB_API.SaveCoordinates);
	  return $resource(CORE_CONFIG.WEB_SERVICE+WEB_API.SaveCoordinates+'/:x/:y/:w/:h/:pageNo/:fieldType', {},{ 'update': { method:'PUT' } 
	 }  
	); 
}]);
