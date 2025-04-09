<?php

namespace App\General\Admin;
use App\General\Database;
use App\General\All;
use App\General\DB;
use PDOException;

class Blogs

 {
    // TODO: Add class properties and method

    private $table = 'blogs';



    public function Set() {
        $db = new All();
        if(!$db->detectTable($this->table)) {
           $columns = [
               'id' => 'INT AUTO_INCREMENT',
               'name' => 'VARCHAR(255) NOT NULL',
               'slug' => 'VARCHAR(255) NOT NULL',
               'description' => 'TEXT',
               'cid' => 'INT(11) NOT NULL',
               'admin_id' => 'INT(11) NOT NULL',
               'img_folder' => 'VARCHAR(255) ',
               'image' => 'VARCHAR(255) ',
               'status' => 'INT(1) DEFAULT 1',
               'isHome' => 'INT(1) DEFAULT 1',
               'views' => 'INT(11)',
               'title' => 'VARCHAR(255)',
               'meta_key' => 'VARCHAR(255)',
               'meta_desc' => 'VARCHAR(255)',
               'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
           ];
           $PKey = "id"; 
           $db->createTable($this->table, $columns, $PKey);
           $db->addForeignKey($this->table, 'id', 'admin_tb',  'admin_id');
           $db->addForeignKey($this->table, 'id', 'cats',  'cid');
       }
    }

    public function Adds($data) {
        $s = 0;

        $m = '';
        

        if(empty($data['name'])) {
            $m = "Name field cannot be empty";
        } else if(empty($data['cid'])) {
            $m = "Select a category Pls";
        } else {

            $imageName = '';
            $img_folder = '';

            if(!empty($data['img_name']) || !empty($data['img_url'])) {

                $upImage = uploadImage($data, $this->table);
                if ( $upImage === false) {
                    $m = "Image upload failed";
                } else {
                    $imageName = $upImage;
                    $img_folder = '/' . $this->table . '/' . date('Y/m');
                     $m = "Post 2";
                }
            }




                    $All = new All();

                    if(empty($data['slug'])) {
                        $slug =  $All->genSlug(slug($data['name']), $this->table);
                    } else {
                        $slug =  $All->genSlug(slug($data['slug']), $this->table);
                    }
                    
                    $datas = [
                        'name' => $data['name'],
                        'slug' => $slug,
                        'admin_id' => $_SESSION['adminID'],
                        'cid' => $data['cid'],
                        'description' => $data['description'],
                        'image' => $imageName,
                        'img_folder' => $img_folder,
                        'isHome' => $data['isHome'],
                        'status' => $data['status'],
                        'title' => $data['meta_title'],
                        'meta_key' => $data['meta_key'],
                        'meta_desc' => $data['meta_desc'],

                    ];

                    try {
                        if($All->Insert($this->table, $datas)) {
                            $s = 1;
                            $m = "Post successfully Uploaded";
                        }
                    } catch (PDOException $e) {
                        $m = "Error 2 : ".$e->getMessage();
                    }
                

        }

        return ['m' => $m, 's' => $s];
    }

    public function Edit($data, $id) {
        $s = 0;

        $m = '';
        

        if(empty($data['name'])) {
            $m = "Name field cannot be empty";
        } else if(empty($data['slug'])) {
            $m = "Slug Cannot be empty";
        } else {

            $imageName = $data['hiddenimg'];
            $img_folder = $data['hiddenimg_foler'];

            

            if(!empty($data['img_url']) || !empty($data['img_name'])) {
                $upImage = uploadImage($data, $this->table);
                if ( $upImage === false) {
                    $m = "Image upload failed";
                } else {
                    $imageName = $upImage;
                    $img_folder = '/' . $this->table . '/' . date('Y/m');
                }
            }



            $All = new All();

                $datas = [
                    'name' => $data['name'],
                    'slug' => $data['slug'],
                    'cid' => $data['cid'],
                    'description' => $data['description'],
                    'image' => $imageName,
                    'img_folder' => $img_folder,
                    'isHome' => $data['isHome'],
                    'status' => $data['status'],
                    'title' => $data['meta_title'],
                    'meta_key' => $data['meta_key'],
                    'meta_desc' => $data['meta_desc'],
                ];

                $arg = "id = $id";

                try {

                    if($All->EditRow($this->table, $datas, $arg)) {
                        $s = 1;
                        $m = "Post successfully Edited";
                    }
                } catch (PDOException $e) {
                    $m = "Error : ".$e->getMessage();
                }
        }

        return ['m' => $m, 's' => $s];
    }
 }