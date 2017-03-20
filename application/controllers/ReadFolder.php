<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ReadFolder extends CI_Controller{
    
    
      function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('CropImage_model');
	}
	public function FolderScan()
	{
          
            $arrayFiles =  preg_grep('/^([^.])/', scandir(URL_STORAGE_ROOT));;
            print_r($arrayFiles);
            $date = date('Y-m-d h:i:s');   // MySQL datetime format
           
            $time = date("h:i:s",strtotime($date));  
                $dt = date("Y-m-d",strtotime($date));
               str_replace(':', '', $time);
            $sql1 = "select * from FolderDetails";
            $querypar = $this->db->query($sql1);
//            print_r($querypar->result());
             $fa = array();
             $cnt = array();
            foreach ($querypar->result() as $row)
                {
                array_push($fa, $row->FolderName);
                array_push($cnt, $row->count_files_in_folder);
                   
                }
//                print_r($fa);

            for($i = 2 ;$i< count($arrayFiles) ;$i++){
                if(!in_array($arrayFiles[$i], $fa, true)){
                  
                     $tiffFiles=  preg_grep('/^([^.])/', scandir(URL_STORAGE_ROOT."/".$arrayFiles[$i]));
                    $sql = "insert into FolderDetails(FolderName,Created_date,count_files_in_folder) values ('".$arrayFiles[$i]."','".$date."',". count($tiffFiles).")";
                    $query = $this->db->query($sql);
                    echo "kjdhfkhfd" .$query;
                    $types = $this->CropImage_model->folderscan($arrayFiles[$i]);
                    print_r($types);
//                    }
                }else{
                    
                    $tiffFiles=  preg_grep('/^([^.])/', scandir(URL_STORAGE_ROOT."".$arrayFiles[$i]));
                     for($f1=2;$f1<count($tiffFiles) ,$f1<count($cnt); $f1++) {
                         if($cnt[$f1] < count($tiffFiles)){
                         $lastModified =  date("Y-m-d h:i:s.",filectime(URL_STORAGE_ROOT.""."17022017HA08"."/".$tiffFiles[$f1]));
                            echo $lastModified;
                            if($lastModified == date('Y-m-d h:i:s')){
                            $sql = "insert into FolderDetails(FolderName,Created_date,count_files_in_folder) values ('".$tiffFiles[$i]."','".date('Y-m-d h:i:s')."',". count($tiffFiles).")";
                           $query = $this->db->query($sql);
//                    echo "kjdhfkhfd" .$query;
                             $types = $this->CropImage_model->folderscan($arrayFiles[$i]);
//                           print_r($types);
                            }
                         }
                        
                     }
                     echo "array finished \n\r  ";      
                     $sql = "insert into FolderDetails(FolderName,Created_date,count_files_in_folder) values ('".$arrayFiles[$i]."','".$date."',". count($tiffFiles).")";
                        $query = $this->db->query($sql);
//                    echo "kjdhfkhfd" .$query;
                    $types = $this->CropImage_model->folderscan($arrayFiles[$i]);
//                    print_r($types);
                }
            }
	}
        
}

