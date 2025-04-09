<?php

namespace App\General\Admin;
use App\General\Database;
use App\General\All;
use App\General\DB;
use PDOException;

class Cats

 {
    // TODO: Add class properties and method

    private $table = 'cats';

    public function __contstruct() {
    }


    public function Set() {
        $db = new All();
        if(!$db->detectTable($this->table)) {
           $columns = [
               'id' => 'INT AUTO_INCREMENT',
               'name' => 'VARCHAR(255) NOT NULL',
               'slug' => 'VARCHAR(255) NOT NULL',
               'description' => 'VARCHAR(255) ',
               'img_folder' => 'VARCHAR(255) ',
               'image' => 'VARCHAR(255) ',
               'status' => 'INT(1) DEFAULT 1',
               'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
           ];
           $PKey = "id"; 
           $db->createTable($this->table, $columns, $PKey);
           // $db->addForeignKey($this->table, 'id', 'users',  'user_id');
       }
    }

    public function Add($data) {
        $s = 0;
        $errorMessage = '';
        $imageName = '';
    
        if (empty($data['name'])) {
            $errorMessage = "Please insert name";
        }
    
        if (empty($errorMessage) && (!empty($data['img_name']) || !empty($data['img_url']))) {
            
            if (checkImageSize($data)) {
                $errorMessage = "Image size is not valid";
            } elseif (checkImageType($data)) {
                $errorMessage = "Image type is not valid";
            } else {
                $imageName = uploadImage($data, $this->table);
                if ( $imageName === false) {
                    $errorMessage = "Image upload failed";
                } else {
                    $newImage = $imageName;
                }
            }
        }
    
        if (empty($errorMessage)) {
            $All = new All();
            $folder = '/' . $this->table . '/' . date('Y/m');

            $name = $data['name'];
            $slug =  $All->genSlug(slug($data['slug']), $this->table);
            
            $datas = [
                'name' => $name,
                'slug' => $slug,
                'description' => $data['description'],
                'image' => isset($newImage) ? $newImage : "",
                'img_folder' => isset($newImage) ? $folder : '',
                'status' => $data['status'],
            ];
    
            try {
                $All->Insert($this->table, $datas);
                $message = "Blog Category Inserted Successfully";
                $s = 1;
            } catch (PDOException $e) {
                $errorMessage = "Error inserting " . $e->getMessage();
            }
        }
        return ['m' => $errorMessage ?: $message, 's' => $s];
    }

    public function Edit($data, $id) {
        $s = 0;
        if(empty($data['name'])) {
        $m = "name field cannot be empty";
        } else {
            if(empty($data['img_name']) && empty($data['img_url'])) {
                $imageName = $data['hiddenimg'];
                $folder = $data['hiddenimg_foler'];
            } else {
                if(checkImageSize($data)) {
                    $m = "Image size exceed 6MB";
                } else if(checkImageType($data)) {
                    $m = "Unsupported Image Type";
                } else {
                    $upload = uploadImage($data, $this->table);
                    if($upload === false) {
                        $m = "Image upload fail";
                    } else {
                        $imageName = $upload;
                        $folder = '/' . $this->table . '/' . date('Y/m');

                    }
                } 
            }

            if(empty($m)) {
                try {
                    $All = new All();
                    $arg = "id = $id";
                    $slug = $data['slug'];
                    $datas = [
                        'name' => $data['name'],
                        'slug' => $slug,
                        'description' => $data['description'],
                        'image' => $imageName,
                        'img_folder' => $folder,
                        'status' => $data['status'],
                    ];

                    if($All->EditRow($this->table, $datas, $arg)) {
                        $s = 1;
                        $m = "Item Successfully edited";
                    }
                } catch(PDOException $e) {
                    $m = "Error: ".$e->getMessage();
                }
            } else {
                $m = $m;
            }
        } 

        return ['m' => $m, 's' => $s];
    }


 }