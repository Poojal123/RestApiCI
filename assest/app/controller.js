myApp.controller('CropController', function ($scope, $http,CropImage,FolderScan,Student,CORE_CONFIG,WEB_API) {

//    $scope.customer = Student.get();
//    $scope.customer.$promise.then(function(result) {
//
//        $scope.customers = result.result;
//        console.log($scope.customers);
//
//    });
$scope.scanFolder = function(){
   $scope.imageUrl =  FolderScan.get();
    $scope.customer.$promise.then(function(result) {
//
        $scope.url = result.result;
        alert($scope.url);

    });
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
    $http.get("http://localhost/bpoapps/storage\\apps\\casaindex\\20161024/002505004132.TIF", {responseType: 'blob'}).then(function (resp) {
        file = new File([resp], "002505004132.TIF", {type: "image/tiff"});
        $scope.formdata.fileInput = resp.data;
        $scope.formdata.filename = file.name;
        console.log($scope.formdata.fileInput);
    });

    $scope.convertimg = function () {
        
var name1 = $scope.formdata.filename.split(".");
//alert(name1[0]);
        $scope.cropImage = CropImage.get({"name": name1[0]});

        $scope.cropImage.$promise.then(function(result){
            alert("hiii");
            $scope.message = result;
            $scope.myImage = result.result;
            alert($scope.myImage);
            alert($scope.message);
          
                $scope.src = $scope.myImage;
                var c = document.getElementById("myCanvas");
                var ctx = c.getContext("2d");
                ctx.clearRect(0, 0, c.width, c.height);
                var img1 = document.getElementById("scream");
                ctx.drawImage(img1, 10, 10);
        });
        var res = $http.post('index.php', {"name": file.name});
//        res.success(function (data, status, headers, config) {
//            $scope.message = data;
//            $scope.myImage = data.result;
//            alert($scope.myImage);
//            alert($scope.message);
//            $http.get($scope.myImage, {responseType: 'blob'}).then(function (resp) {
//                $scope.fileInputOut = resp.data;
//                $scope.src = $scope.myImage;
////                        window.onload = function() {
////                            alert("hii");
//
//                var c = document.getElementById("myCanvas");
//                var ctx = c.getContext("2d");
//                ctx.clearRect(0, 0, c.width, c.height);
//                var img1 = document.getElementById("scream");
//                ctx.drawImage(img1, 10, 10);
//
//
//            });
//        });
        res.error(function (data, status, headers, config) {
            alert("failure message: " + JSON.stringify({data: data}));
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
//       alert(position);
        var p = $("#overlay").position();
        var w1 = $("#overlay").height();
        var y1 = $("#overlay").width();
        alert("hiii " + p.left + p.top + w1 + y1);
        var c = document.getElementById("myCanvas1");
        var ctx = c.getContext("2d");
        ctx.clearRect(0, 0, c.width, c.height);
        var img = document.getElementById("scream");
        ctx.drawImage(img, p.left, p.top, w1, y1, 10, 10, 200, 200);
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


