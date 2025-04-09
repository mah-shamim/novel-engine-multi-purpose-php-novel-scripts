<?php
    

    namespace App\General;
    use App\General\Database;
    use App\General\All;
    use PDOException;


    class Book extends Database {

        private $table = 'ebook';

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
                    'author' => 'VARCHAR(255) NOT NULL',
                    'groupes' => 'VARCHAR(255) NOT NULL', 
                    'compiler' => 'VARCHAR(255)',
                    'phone' => 'VARCHAR(255)',
                    'description' => 'TEXT',
                    'file_name' => 'VARCHAR(255) NOT NULL',
                    'file_dir' => 'VARCHAR(255) NOT NULL',
                    'cid' => 'INT(11) NOT NULL',
                    'baid' => 'INT(11)',
                    'slug' => 'VARCHAR(255) NOT NULL',
                    'img_folder' => 'VARCHAR(255)',
                    'image' => 'VARCHAR(255)',
                    'ext'   => 'VARCHAR(255)',
                    'size'  => 'VARCHAR(255)',
                    'download' => 'INT(11)',
                    'status' => 'INT(1) DEFAULT 1',
                    'isHome' => 'INT(1) DEFAULT 0',
                    'isDownload' => 'INT(1) DEFAULT 0',
                    'isTrend' => 'INT(1) DEFAULT 0',
                    'isRead' => 'INT(1) DEFAULT 1',
                    'isFree' => 'INT(1) DEFAULT 0',
                    'views' => 'INT(11)',
                    'dl_last' => 'DATETIME',
                    'title' => 'VARCHAR(255)',
                    'meta_key' => 'VARCHAR(255)',
                    'meta_desc' => 'VARCHAR(255)',
                    'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                ];


                $PKey = "id";
                $Fkey1 = "cid";

                

                $All->createTable($this->table, $columns, $PKey, $Fkey1, 'category');
                $All->addForeignKey($this->table, 'id', 'book',  'baid');


                
            }
        }
        


        public function Adds($data) {
            $s = 0;

            $m = '';
            

            if(empty($data['name'])) {
                $m = "Name field cannot be empty";
            } else if(empty($data['file_name']) && empty($data['file_url'])) {
                $m = "Select a file Pls";
            } else if(checkType($data)) {
                $m = "Unsopported format only PDF, TXT, DOC and DOCX are supported";
            } else if(checkSize($data)) {
                $m = "your file size Exceed 20MB";
            } else {

                $imageName = '';
                $img_folder = '';

                $upImage = uploadThumb($data, $this->table);
                if ( $upImage === false) {
                    $m = "Image upload failed";
                } else {
                    $imageName = $upImage;
                    $img_folder = '/' . $this->table . '/' . date('Y/m');
                     $m = "Post 2";
                }

                    $file = upload($data);

                    if($file == false) {
                        $m = "Error Uploading File";
                    } else {
                        
                        $All = new All();

                        if(empty($data['slug'])) {
                            $slug =  $All->genSlug(slug($data['name']), $this->table);
                        } else {
                            $slug =  $All->genSlug(slug($data['slug']), $this->table);
                        }
                        $authors = implode(',', $data['author']);
                        $groups = implode(',', $data['groups']);
                        $compiler = implode(',', $data['compiler']);
                        $ext = getExt($data);
                        $size = getSize($data);
                        
                        $datas = [
                            'name' => $data['name'],
                            'slug' => $slug,
                            'author' => $authors,
                            'groupes' => $groups,
                            'compiler' => $compiler,
                            'phone' => $data['phone'],
                            'cid' => $data['cid'],
                            'baid' => $data['baid'],
                            'description' => $data['description'],
                            'image' => $imageName,
                            'img_folder' => $img_folder,
                            'file_name' => $file,
                            'file_dir' => date('Y/m/'),
                            'ext' => $ext,
                            'size' => $size,
                            'isHome' => $data['isHome'],
                            'status' => $data['status'],
                            'isTrend' => $data['isTrend'],
                            'isDownload' => $data['isDownload'],
                            'isRead' => $data['isRead'],
                            'isFree' => $data['Free'],
                            'title' => $data['meta_title'],
                            'meta_key' => $data['meta_key'],
                            'meta_desc' => $data['meta_desc'],

                        ];

                        try {
                            if($All->Insert($this->table, $datas)) {
                                $All->createMultiple('author', $data['author']);
                                $All->createMultiple('`groups`', $data['groups']);
                                $All->createMultiple('compiler', $data['compiler']);
                                $s = 1;
                                $m = "Ebook successfully Uploaded";
                            }
                        } catch (PDOException $e) {
                            $m = "Error 2 : ".$e->getMessage();
                        }
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
            } else if( (!empty($data['file_name']) && !empty($data['file_url'])) && checkType($data)) {
                $m = "Unsopported format only PDF, TXT, DOC and DOCX are supported";
            } else if(!empty($data['file_name']) && checkSize($data)) {
                $m = "your file size Exceed 20MB";
            } else {

                $imageName = $data['hiddenimg'];
                $img_folder = $data['hiddenimg_foler'];

                $file = $data['hiddenfile'];
                $ff = $data['hiddenff'];
                $ext = $data['ext'];
                $size = $data['hidesize'];

                

                if(!empty($data['img_url']) || !empty($data['img_name'])) {
                    $upImage = uploadThumb($data, $this->table);
                    if ( $upImage === false) {
                        $m = "Image upload failed";
                    } else {
                        $imageName = $upImage;
                        $img_folder = '/' . $this->table . '/' . date('Y/m');
                         $m = "Post 2";
                    }
                }

                

                if(!empty($data['file_url']) || !empty($data['file_name'])) {
                    $upfile = upload($data);

                    if($upfile === false) {
                        $m = "Error Uploading File";
                    } else {
                        $file = $upfile;
                        $ff = date('Y/m/');
                        $ext = getExt($data);
                        $size = $data['file_size'];
                    }
                }



                $All = new All();

                
                    $authors = implode(',', $data['author']);
                    $groups = implode(',', $data['groups']);
                    $compiler = implode(',', $data['compiler']);
                    $datas = [
                        'name' => $data['name'],
                        'slug' => $data['slug'],
                        'author' => $authors,
                        'groupes' => $groups,
                        'compiler' => $compiler,
                        'phone' => $data['phone'],
                        'cid' => $data['cid'],
                        'baid' => $data['baid'],
                        'description' => $data['description'],
                        'image' => $imageName,
                        'img_folder' => $img_folder,
                        'file_name' => $file,
                        'file_dir' => $ff,
                        'ext' => $ext,
                        'size' => $size,
                        'isHome' => $data['isHome'],
                        'status' => $data['status'],
                        'isTrend' => $data['isTrend'],
                        'isDownload' => $data['isDownload'],
                        'isRead' => $data['isRead'],
                        'isFree' => $data['Free'],
                        'title' => $data['meta_title'],
                        'meta_key' => $data['meta_key'],
                        'meta_desc' => $data['meta_desc'],

                    ];

                    $arg = "id = $id";

                    try {

                        if($All->EditRow($this->table, $datas, $arg)) {
                            $All->createMultiple('author', $data['author']);
                            $All->createMultiple('`groups`', $data['groups']);
                            $All->createMultiple('compiler', $data['compiler']);
                            $s = 1;
                            $m = "Ebook successfully Edited";
                        }
                    } catch (PDOException $e) {
                        $m = "Error : ".$e->getMessage();
                    }
            }

            return ['m' => $m, 's' => $s];
        }

     


        
        

 
    }
    
?> 