<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Student_model extends CI_Model{
    public function __construct()
        {
                parent::__construct();
				
        }

        public function getStudentData($id){
            
            
            $query = $this->db->query('SELECT * FROM angularcode_customers')->result();
            
//            $users = [
//            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
//            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
//            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
//        ];
        //print_r($query);
        return $query;

        }
        
}