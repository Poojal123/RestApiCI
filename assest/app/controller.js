myApp.controller('CropController', function ($scope, $http,CropImage,FolderScan,SaveCoordinates,GetData,CORE_CONFIG,WEB_API) {

//    $scope.customer = Student.get();
//    $scope.customer.$promise.then(function(result) {
//
//        $scope.customers = result.result;
//        console.log($scope.customers);
//
//    });
  $scope.ImageUrls = [];
$scope.scanFolder = function(){
   $scope.imageUrl =  FolderScan.get({"folderName":$scope.folderName});
    $scope.imageUrl.$promise.then(function(result) {
//
        $scope.url = result.result;
        $scope.ImageUrls =result.result;
        alert("dfgdg " +$scope.ImageUrls.length);
        
//       $scope.cropMultipleImages();
    });
}
$scope.cropMultipleImages =function(){
    alert("cropp Image "+$scope.ImageUrls.length);
   $scope.result = GetData.get();
     $scope.result.$promise.then(function(res){
         alert(res.result);
     })
    for(var i=0;i<$scope.ImageUrls.length ;i++){
       
    }
}
 $scope.formdata = {};
     $scope.formdata.fileInput;
    var file;
    var options = {
        zoom: {
            value: 0.5,
            step: 0.01
        },
        rotate: {
            value: 90
        }
    };
    $scope.formdata.filename;
    $http.get("http://localhost/RestApiCI/ProjectStorage/sample/sample.tif", {responseType: 'blob'}).then(function (resp) {
        file = new File([resp], "sample.tif", {type: "image/tiff"});
        $scope.formdata.fileInput = resp.data;
        $scope.formdata.filename = file.name;
        console.log($scope.formdata.fileInput);
    });

    $scope.convertimg = function () {
//        alert()
        
            var name1 = $scope.formdata.filename.split(".");
//alert(name1[1]);
            $scope.cropImage = CropImage.get({"name": name1[0],"ext":name1[1],"page": $scope.pageNo});

            $scope.cropImage.$promise.then(function(result){
//            alert("hiii");
            $scope.message = result;
            $scope.myImage = result.result.statusresult;
            $scope.hei = result.result.height;
            $scope.wid = result.result.width;
//            alert("dgdgf "+result.result.statusresult);
//            alert($scope.message);
          alert(result.result.statusresult + "result.result.statusresult");
                $scope.src =  $scope.myImage;
                var c = document.getElementById("myCanvas");
                var ctx = c.getContext("2d");
                ctx.clearRect(0, 0, c.width, c.height);
                var img1 = document.getElementById("scream");
                ctx.drawImage(img1, 10, 10);
        });
    }
    var position;
    var h;
    var w;
    $scope.move = function (xseed, yseed) {
        var div = $("#overlay");
        position = div.position();
        console.log("left: " + position.left + ", top: " + position.top);
        if (xseed != 0) {
            position.left += xseed;
            $('#overlay').css({'left': position.left + 'px'});
        }
        if (yseed != 0) {
            position.top += yseed;
            $('#overlay').css({'top': position.top + 'px'});
        }
//                alert()
    }

    $scope.size = function (wseed, hseed) {
        var div = $("#overlay");
        var h = div.height();
        var w = div.width();
        console.log("left: " + h + ", top: " + w);
        if (wseed != 0) {
            w += wseed;
            $('#overlay').css({'width': w + 'px'});
        }
        if (hseed != 0) {
            h += hseed;
            $('#overlay').css({'height': h + 'px'});
        }
    }
    $scope.crop = function () {
        
        var p = $("#overlay").position();
        var h1 = $("#overlay").height();
        var w1 = $("#overlay").width();
        alert("hiii " + p.left + p.top + w1 + h1);
        var c = document.getElementById("myCanvas1");
        var ctx = c.getContext("2d");
        ctx.clearRect(0, 0, c.width, c.height);
        var img = document.getElementById("scream");
        ctx.drawImage(img, p.left, p.top, w1, h1, 10, 10, 200, 200);
        $scope.SaveImageData = SaveCoordinates.get({"x":p.left,"y": p.top,"w":w1,"h":h1,"pageNo":$scope.pageNo,"fieldType":$("#selectType option:selected").text()});
        $scope.SaveImageData.$promise.then(function(result){
            
            
        })
        
        
    }
    

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


