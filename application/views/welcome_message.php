<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html ng-app="myApp" ng-app lang="en">
<head>
    <meta charset="utf-8">
   
    <link href="<?php echo base_url();?>assest/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assest/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assest/canvasviewer/src/CanvasViewer.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://fcrohas.github.io/angular-canvas-viewer/assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="http://fcrohas.github.io/angular-canvas-viewer/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="http://fcrohas.github.io/angular-canvas-viewer/assets/css/bootstrap-theme.min.css">

    <title>Crop Image</title>
</head>
<body>
<div class="navbar navbar-default" id="navbar">
    <div class="container" id="navbar-container">
    <div class="navbar-header">
        <a href="http://angularcode.com" class="navbar-brand">
            <small>
                <i class="glyphicon glyphicon-log-out"></i>
                AngularCode / AngularJS Demos 
            </small>
        </a><!-- /.brand -->
        
    </div><!-- /.navbar-header -->
    <div class="navbar-header pull-right" role="navigation">
        <a href="http://angularcode.com/demo-of-a-simple-crud-restful-php-service-used-with-angularjs-and-mysql/" class="btn btn-sm btn-danger nav-button-margin"> <i class="glyphicon glyphicon-book"></i>&nbsp;Tutorial Link</a>
        <a href="http://angularcode.com/download-link/?url=https://app.box.com/s/58ozc62qhypmhtaij33c" class="btn btn-sm btn-warning nav-button-margin"> <i class="glyphicon glyphicon-download"></i>&nbsp;Download Project</a>
    </div>
    </div>
</div>
 <script  src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!--<script src="<?php echo base_url();?>assest/js/angular.min.js"></script>-->
<script src="<?php echo base_url();?>assest/canvasviewer/assets/lib/angular/angular.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>assest/js/angular-route.min.js"></script>
<script src="<?php echo base_url();?>assest/js/angular-resource.js"></script>
<script src="<?php echo base_url();?>assest/canvasviewer/dist/CanvasViewer.all.min.js"></script>

        
        <script src="<?php echo base_url();?>assest/canvasviewer/assets/lib/libtiff/tiff.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo base_url();?>assest/canvasviewer/assets/lib/pdfjs/pdf.compat.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo base_url();?>assest/canvasviewer/assets/lib/pdfjs/pdf.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo base_url();?>assest/canvasviewer/assets/lib/json-formatter/dist/json-formatter.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo base_url();?>assest/canvasviewer/dist/CanvasViewer.all.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo base_url();?>assest/canvasviewer/src/FormatReader.js" type="text/javascript" charset="utf-8"></script>	
        <script src="<?php echo base_url();?>assest/canvasviewer/src/CanvasViewer.js" type="text/javascript" charset="utf-8"></script>	
<script src="<?php echo base_url();?>assest/app/app.js"></script>    
<script src="<?php echo base_url();?>assest/app/config.js"></script>
<script src="<?php echo base_url();?>assest/app/CONSTANTS.js"></script>
<script src="<?php echo base_url();?>assest/app/services.js"></script>
<script src="<?php echo base_url();?>assest/app/controller.js"></script><!--
     -->
     <div>
<div class="container">
<br/>
<blockquote><h4><a href="http://angularcode.com/demo-of-a-simple-crud-restful-php-service-used-with-angularjs-and-mysql/">Cro Image</a></h4></blockquote>
<br/>
    <div ng-view="" id="ng-view"></div>

</div>
</div>
</body>
</html>