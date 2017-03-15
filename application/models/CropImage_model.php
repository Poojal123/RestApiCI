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
        public function folderscan($fileName)
        {
		$sql = "select * from vu_imgsettings";
		$qparent = $this->db->query($sql);
		$result = $qparent->result();
                 $x=$result[1]->xCo;
		$y = $result[1]->yCo;
		$w = $result[1]->Width;
		$h = $result[1]->Height;
		$pageNo = $result[1]->PageNo;
		$type = $result[1]->FieldType;
                 $x0=$result[0]->xCo;
		$y0 = $result[0]->yCo;
		$w0 = $result[0]->Width;
		$h0 = $result[0]->Height;
		$pageNo0 = $result[0]->PageNo;
		$type0 = $result[0]->FieldType;
//                echo $x." d ".$y.$type.$pageNo.$h.$w ;
		$arrFiles = scandir(URL_STORAGE_ROOT."".$fileName, SCANDIR_SORT_ASCENDING);
                //SCANDIR_SORT_DESCENDING
//                print_r($arrFiles);
		$arrSortedFiles = array();
                $count =0;
		for($i=0;$i<count($arrFiles);$i++)
		{
                        if(!is_dir($fileName."//".$arrFiles[$i])){ 
                            $ext = substr(strrchr($arrFiles[$i], '.'), 1);
                            if($ext == "tiff" || $ext == "tif" || $ext == "TIFF" || $ext == "TIF" ) {
//                                echo URL_STORAGE_ROOT.$fileName."/".$arrFiles[$i];
                                try
                                    {
                                    $structure = URL_STORAGE_ROOT."CONVERTED";
                                    // Saving every page of a TIFF separately as a JPG thumbnail
                                    $images = new Imagick(URL_STORAGE_ROOT.$fileName."/".$arrFiles[$i]); 
                                    foreach($images as $i1=>$image) {
                                        // Providing 0 forces thumbnail Image to maintain aspect ratio
                                        if($i1 == $pageNo0-1){
                                            echo "in if";
                                             $fname = pathinfo($arrFiles[$i], PATHINFO_FILENAME);
                                             $imagepic = $image;
                                               
                                       if($type0 == 'Photo'){
                                        $image->thumbnailImage(768,0);
//                                         $image->cropImage(316, 404, 15, 30);
                                        $image->resizeImage(800,800,Imagick::FILTER_LANCZOS,1);
                                        $image->cropImage($w0, $h0, $x0, $y0);
                                        $image->writeImage($structure."/cropped"."/".$fname."_Photo".".jpg");
                                        }
                                      if($type == 'Signature'){
//                                        $image->thumbnailImage(768,0);
                                        $image->resizeImage(800,800,Imagick::FILTER_LANCZOS,1);
                                        $image->cropImage($w, $h, $x, $y);
                                        $image->writeImage($structure."/cropped"."/".$fname."_Signature".".jpg");
                                        }
                                         
                                        }
//                                        echo "<img src='page$i.jpg' alt='images' ></img>";
                                    }
                                    $images->clear();
                                    $images1 = new Imagick(URL_STORAGE_ROOT.$fileName."/".$arrFiles[$i]); 
                                    foreach($images1 as $i1=>$image) {
                                        // Providing 0 forces thumbnail Image to maintain aspect ratio
                                        if($i1 == $pageNo0-1){
                                            echo "in if";
                                             $fname = pathinfo($arrFiles[$i], PATHINFO_FILENAME);
                                           
                                      if($type == 'Signature'){
//                                        $image->thumbnailImage(768,0);
                                        $image->resizeImage(800,800,Imagick::FILTER_LANCZOS,1);
                                        $image->cropImage($w, $h, $x, $y);
                                        $image->writeImage($structure."/cropped"."/".$fname."_Signature".".jpg");
                                        }
                                         
                                        }
//                                        echo "<img src='page$i.jpg' alt='images' ></img>";
                                    }
                                    $images1->clear();
                                    }
                                    catch(Exception $e)
                                    {
                                            echo $e->getMessage();
                                    }
                                
                                
                                
                                
                                
//                                $images = new Imagick(URL_STORAGE_ROOT.$fileName."/".$arrFiles[$i]);
////                                echo "befor loop";
//                                foreach($images as $i1=>$image) {
////                                    echo "hiii";
//                                  if($i1==$pageNo-1){
//                                    $image->resizeImage(800,800,Imagick::FILTER_LANCZOS,1);
//                                    $structure = URL_STORAGE_ROOT."CONVERTED";
//                                    echo $structure;
//                                     if (!file_exists($structure)) {
//                                      mkdir($structure, 0777, true);
////                                        die('Failed to create folders...');
//                                     }
//////                                    $fname = pathinfo($arrFiles[$i], PATHINFO_FILENAME);
//////                                     $image->writeImage($structure."/".$fname."_".$i.".jpg");
//////                                     $imagick1 = new \Imagick(realpath($structure."/".$fname."_".$i.".jpg"));
//////                                        $imagick1->cropImage($w, $h, $x, $y);
//////                                        $imagick1->writeImage($structure."/cropped/".$fname."_".$i.".jpg");
//                                        $image->cropImage(316, 404, 15, 30);
////                                        $image->cropImage($w, $h, $x, $y);
//                                        $image->writeImage($structure."/cropped/".$arrFiles[$i]."_".$count.".jpg");
//                                        return;
//                                  }
//
//                                }
//                            $images->clear();
//                            echo "hiii ";
                            $arrSortedFiles[] = $arrFiles[$i];
                            }

                        }
                        $count++;
		}
                
                
                
		return $arrSortedFiles;
	}
        public function GetData($fileName){
            
            $sql = "select * from vu_imgsettings";
		$qparent = $this->db->query($sql);
		        return $qparent->result();
                        
                        

        }
        public function SaveCoordinates($x,$y,$w,$h,$pageNo,$fieldType){
            
            
            $sql = "insert into vu_imgsettings (xCo, yCo,Width,Height,PageNo,FieldType) values (".$x.",".$y.",".$w.",".$h.",".$pageNo.",'".$fieldType."')";	
			$qparent = $this->db->query($sql);
			 $insert_id = $this->db->insert_id();
		echo $sql;
			return $insert_id;
                  }
        public function convertImage($filename,$ext,$page){
            
            try
        {
          $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //  echo $actual_link;
          
          $images = new Imagick(URL_STORAGE_ROOT."/sample/".$filename.".".$ext);
        //  echo $images;
          foreach($images as $i=>$image) {
            // Providing 0 forces thumbnail Image to maintain aspect ratio
            $image->thumbnailImage(768,0);
            if($i==$page-1){
            $image->resizeImage(800,800,Imagick::FILTER_LANCZOS,1);
             $d = $image->getImageGeometry(); 
            $w2 = $d['width']; 
            $h2 = $d['height']; 
            $image->writeImage(URL_STORAGE_ROOT."/sample/page".$i.".jpg");
                 $img = array("statusresult"=>URL_STORAGE_ROOT_URL."sample/page$i.jpg","width"=>$w2,"height"=>$h2);
            }

          }
          return $img;
          $images->clear();
        }
catch(Exception $e)
{
  echo $e->getMessage();
}

        }
        
}