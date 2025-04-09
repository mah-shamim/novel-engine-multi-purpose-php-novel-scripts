<?php
    

    namespace App\General\Admin;
    use App\General\Database;
    use App\General\All;
    use PDOException;


    class Author extends Database {

        private $table = 'author';

        public function __construct() {

            parent::__construct();
        }

        public function Set()
        {
            $All =  new All();

            if(!$All->detectTable($this->table)) {

                $columns = [
                    'id' => 'INT AUTO_INCREMENT',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'slug' => 'VARCHAR(255) NOT NULL',
                    'img_folder' => 'VARCHAR(255)',
                    'image' => 'VARCHAR(255)',
                    'status' => 'INT(1) DEFAULT 1',
                    'isHome' => 'INT(1) DEFAULT 0',
                    'title' => 'VARCHAR(255)',
                    'meta_key' => 'VARCHAR(255)',
                    'meta_desc' => 'VARCHAR(255)',
                    'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                ];

                $PKey = "id";

                $All->createTable($this->table, $columns, $PKey);
            }
        }


        public function addGenre($data) {
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
                $slug = $All->genSlug(slug($data['slug']), $this->table);
                $datas = [
                    'name' => $name,
                    'slug' => $slug,
                    'image' => isset($newImage) ? $newImage : "",
                    'img_folder' => isset($newImage) ? $folder : '',
                    'status' => $data['status'],
                    'isHome' => $data['isHome'],
                    'title' => $data['meta_title'],
                    'meta_key' => $data['meta_key'],
                    'meta_desc' => $data['meta_desc'],
                ];
        
                try {
                    $All->Insert($this->table, $datas);
                    $message = "Author Inserted Successfully";
                    $s = 1;
                } catch (PDOException $e) {
                    $errorMessage = "Error inserting " . $e->getMessage();
                }
            }
        
            return ['m' => $errorMessage ?: $message, 's' => $s];
        }

        public function editGenre($data, $id) {
            $s = 0;
            if(empty($data['name'])) {
            $m = "name field cannot be empty";
            } else {
                if(empty($data['img_name']) && empty($data['img_url'])) {
                    $imageName = $data['hiddenimg'];
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
                        }
                    } 
                }

                if(empty($m)) {
                    try {
                        $All = new All();

                        $folder = !empty('img_name') || !empty('img_url;') ? '/' . $this->table . '/' . date('Y/m') : $data['hiddenimg_foler'];
                        $arg = "id = $id";
                        $slug = $All->genSlug(slug($data['slug']), $this->table);
                        $datas = [
                            'name' => $data['name'],
                            'slug' => $slug,
                            'image' => $imageName,
                            'img_folder' => $folder,
                            'status' => $data['status'],
                            'isHome' => $data['isHome'],
                            'title' => $data['meta_title'],
                            'meta_desc' => $data['meta_desc'],
                            'meta_key' => $data['meta_key'],
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
?> 