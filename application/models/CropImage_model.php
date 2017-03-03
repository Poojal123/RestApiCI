<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CropImage_model extends CI_Model{
    public function __construct()
        {
                parent::__construct();
				
        }
        public function folderscan($job)
        {
		
		$arrFiles = scandir($job, SCANDIR_SORT_ASCENDING); //SCANDIR_SORT_DESCENDING
		$arrSortedFiles = array();
		for($i=0;$i<count($arrFiles);$i++)
		{
			if(!is_dir($job."//".$arrFiles[$i])) $arrSortedFiles[] = $arrFiles[$i];
		}
		return ($arrSortedFiles);
	}
        public function GetFolderData($id){
            
            
            $query = URL_IMPORT_IMAGES_ROOT;
           
        return $query;

        }
        public function convertImage($filename){
            
            try
{
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//  echo $actual_link;
  $images = new Imagick("G:/xampp/htdocs/CropImage/".$filename);
//  echo $images;
  foreach($images as $i=>$image) {
    // Providing 0 forces thumbnail Image to maintain aspect ratio
    $image->thumbnailImage(768,0);
    if($i==2){
    $image->resizeImage(1710,2583,Imagick::FILTER_LANCZOS,1);
 
    $image->writeImage("G:/xampp/htdocs/CropImage/page".$i.".jpg");

          $img = array("status"=>"success","result"=>"http://localhost/CropImage/page$i.jpg");
//     echo json_encode($img); 
     return json_encode($img);
    }
   
  }
  $images->clear();
}
catch(Exception $e)
{
  echo $e->getMessage();
}

        }
        
}