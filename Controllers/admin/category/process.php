<?php
use App\General\All;

require_once __DIR__.'/../../../config/config.php';

$action = Input('submit');
$pdo = new App\General\Database();
$Star = new App\General\Admin\Category();
$Star->isSet();
$pdo = $pdo->getPdo();
$table = 'category';


if($action == 'list') {
    $draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];

$orderColumnIndex = $_POST['order'][0]['column'];
$orderDirection = $_POST['order'][0]['dir'];


    if(Input('filterdata') == 'Trashed') {
        $sql = "SELECT * FROM $table WHERE status = :stat";
    } else if(Input('filterdata') == 'Actived') {
        $sql = "SELECT * FROM $table WHERE status = :act";

    } else {
        $sql = "SELECT * FROM $table WHERE 1=1";
    }
    

    
    if (!empty($searchValue)) {
        $sql .= " AND (name LIKE :searchValue)";
    }



    
    $columns = array('id', 'image', 'name', 'status'); 
    $orderColumn = $columns[$orderColumnIndex] ?? $columns[0]; 
    $orderDirection = isset($orderDirection) ? $orderDirection : 'desc';

    $sql .= " ORDER BY $orderColumn $orderDirection";

    
    $sql .= " LIMIT :length OFFSET :start";

    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':length', (int)$length, PDO::PARAM_INT);

    if(Input('filterdata') == 'Trashed') {
        $stmt->bindValue(':stat', 2, PDO::PARAM_INT);
    } else if(Input('filterdata') == 'Actived') {
        $stmt->bindValue("act", 1, PDO::PARAM_INT);
    }

    if (!empty($searchValue)) {
        $stmt->bindValue(':searchValue', "%$searchValue%", PDO::PARAM_STR);
    }


    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalRecords = $pdo->query("SELECT COUNT(*) FROM $table")->fetchColumn();

    $totalFiltered = (!empty($searchValue)) ? count($results) : $totalRecords;

    $columnTitles = 0;

    $data = array();
    foreach ($results as $row) {
        $id = $row['id'];
        if (empty($row['image'])) {
            $thumb = '<img class="border border-dark" src="'.APP_URL.'/Public/assets/admin/img/elements/1.jpg" alt="Icon" width="60" height="60">';
        } else {
            $thumb = '<img class="border border-dark" src="'.APP_URL.'/Public/thumb'.$row['img_folder'].'/'.$row['image'].'" alt="Icon" width="60" height="60">';
        }
        $status = $row['status'] === 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Trashed</span>';
        $dropDown = ' <a href="javascript:void(0);" class="btn btn-success m-1 ebm" data-slug="' . $row['slug'] . '" data-id="' . $row['id'] . '"> <span class="mdi mdi-note-plus"></span></span></a>';

        $dropDown .= ' <a href="javascript:void(0);" class="btn btn-primary m-1 modalse" data-slug="' . $row['slug'] . '" data-id="' . $row['id'] . '"> <span class="mdi mdi-book-plus"></span></span></a>';

    if ($row['status'] != 1) {
        $dropDown .= '
        <a  class="btn btn-success activate m-1" data-id="' . $row['id'] . '" href="#"><span class="mdi mdi-check-circle"></span> </a>
        ';

    } else {
        $dropDown .= '
        <a class="btn btn-warning trash m-1" href="#" data-id="'.$id.'"><span class="mdi mdi-trash-can"></span></a>';
    }

    $dropDown .= '<a data-id="' . $row['id'] . '" class="btn btn-primary edit m-1" href="#" data-bs-toggle="modal" data-bs-target="#editmodal"><span class="mdi mdi-circle-edit-outline"></span></a>';

    $dropDown .= '<a data-id="' . $row['id'] . '" class="btn btn-danger delete m-1" href="#"><span class="mdi mdi-delete-forever"></span></a>';


         
        $rowData = array(
            '0' => $row['id'],
            '1' => $thumb,
            '2' => '<a href="?cid='.$row['id'].'"> <b>'. $row['name'] .'</b></a>',
            '3' => $dropDown,
            '4' => $status,
            '5' => date('D m, Y', strtotime($row['created_at']))
        );

        $data[] = $rowData;
    }

    $response = array(
        "draw" => (int)$draw,
        "recordsTotal" => (int)$totalRecords,
        "recordsFiltered" => (int)$totalFiltered,
        "columns" => $columnTitles,
        "data" => $data
    );

    echo json_encode($response);

} else if($action == 'settingStatus') {
    $type = Input('type');
    $ids = InputArray('ids');

    if(!$ids) {
        $s = 0;
        $m = "No Item selected";
    } else if(!in_array($type, ['activateAll', 'trashAll', 'trash', 'activate', 'delete', 'deleteAll'])) {
        $s = 0;
        $m = "Invalid action";
    } else {

        $Gen = new App\General\All();

        $total = 0;

        switch($type) {
            case "activateAll":
                foreach($ids as $id) {
                    if(!$id) {
                        continue;
                    }
                    try {
                        $arg = "id = $id";
                       if($Gen->EditRow($table,['status' => 1],$arg)) {
                        $total++;
                       }
                    } catch(PDOException $e) {
                        $errorMessages[] = "Error activating row with ID $id: " . $e->getMessage(); 
                    }
                }

                if($total > 0) {
                    $s = 1;
                    $m = "$total $table where successfully Activated";
                } else {
                    $s = 0;
                    $m = "Error : ". implode(',',$errorMessages);
                }
                break;
                case "trashAll":
                    foreach($ids as $id) {
                        if(!$id) {
                            continue;
                        }
                        try {
                            $arg = "id = $id";
                           if($Gen->EditRow($table,['status' => 2],$arg)) {
                            $total++;
                           }
                        } catch(PDOException $e) {
                            $errorMessages[] = "Error trashing row with ID $id: " . $e->getMessage(); 
                        }
                    }
    
                    if($total > 0) {
                        $s = 1;
                        $m = "$total $table where successfully Trashed";
                    } else {
                        $s = 0;
                        $m = "Error : ". implode(',',$errorMessages);
                    }
                    break;
                    case "deleteAll":
                        foreach($ids as $id) {
                            if(!$id) {
                                continue;
                            }
                            try {
                                $arg = "id = $id";
                                $deleteRow = $Gen->getRow($table, 'id', $id);
                                 $file = PUBLICPATH.'/thumb'.$deleteRow['img_folder'].'/'.$deleteRow['image'];
                               if(!empty($deleteRow['image'])) {


                               foreach($ims as $s) {
                                $file = PUBLICPATH.'/thumb/'.$deleteRow['img_folder'].'/'.$deleteRow['image'];
                                unlink($file);
                               }

                               }
                               if($Gen->delete($table, $id)) {
                                $total++;
                               }
                            } catch(PDOException $e) {
                                $errorMessages[] = "Error Deleting row with ID $id: " . $e->getMessage(); 
                            }
                        }
        
                        if($total > 0) {
                            $s = 1;
                            $m = "$total $table where successfully Deleted";
                        } else {
                            $s = 0;
                            $m = "Error : ". implode(',',$errorMessages);
                        }
                        break;
                    case "trash":

                            try {
                                $arg = "id = $ids";
                               if($Gen->EditRow($table,['status' => 2],$arg)) {
                                $s = 1;
                                 $m = "item where successfully trashed";
                               }
                            } catch(PDOException $e) {
                                $s = 0;
                                 $m = "Error : ". $e->getMessage(); ;
                            }
                        break;
                        case "activate":

                            try {
                                $arg = "id = $ids";
                               if($Gen->EditRow($table,['status' => 1],$arg)) {
                                $s = 1;
                                 $m = "item where successfully Activated";
                               }
                            } catch(PDOException $e) {
                                $s = 0;
                                 $m = "Error : ". $e->getMessage(); ;
                            }
                        break;
                    case "delete":
                        try {
                            $id = $ids;
                            $deleteRow = $Gen->getRow($table, 'id', $id);
                            if(!empty($deleteRow['image'])) {

                                foreach($ims as $s) {
                                 $file = PUBLICPATH.'/thumb/'.$deleteRow['img_folder'].'/'.$deleteRow['image'];
                                 unlink($file);
                                }
 
                                }
                           if($Gen->delete($table, $id)) {
                            $s = 1;
                             $m = "item where successfully deleted";
                             
                           }
                        } catch(PDOException $e) {
                            $s = 0;
                             $m = "Error : ". $e->getMessage(); ;
                        }

        }
    }

    echo json_encode(['m' => $m, 's' => $s]);
} else if($action == 'checkSlug') {

    $Gen = new App\General\All();
    $oldslug = slug(Input('slug'));

    if(!empty(Input('edit'))) {
        $rowSlug = $Gen->getRowData($table, 'slug', 'id', Input('id'));

        if($oldslug == $rowSlug) {
            $slug = $oldslug;
        } else {
            $slug = $Gen->genSlug($oldslug, $table);
        }
    } else if(!empty(Input('book'))) {

            $slug = $Gen->genSlug($oldslug, Input('book'));

    } else {
        $slug = $Gen->genSlug($oldslug, $table);
    }
    
    echo json_encode($slug);

} else if($action == 'getEdit') {
    $id = Input('id');
    $Gen = new App\General\All();
    $row = $Gen->getRow($table, 'id', $id);

    echo json_encode($row);
} else if($action == 'search') {
    
    $query = Input('query');
    $gen = new App\General\All();
    $results = $gen->searchBy('author', 'name', $query); 

$data = [];
foreach ($results as $tag) {
    $data[] = ['id' => $tag['name'], 'text' => $tag['name']];
}


echo json_encode($data);
} else if($action == 'groups') {

    $q = Input('query');
    $gen = new App\General\All();
    $results =$gen->searchBy('`groups`', 'name', $q);
    $data = [];
    foreach($results as $row) {
        $data[] = ['id' => $row['name'], 'text' => $row['name']];
    }

    echo json_encode($data);
} else if($action == 'compiler') {

    $q = Input('query');
    $gen = new App\General\All();
    $results =$gen->searchBy('compiler', 'name', $q);
    $data = [];
    foreach($results as $row) {
        $data[] = ['id' => $row['name'], 'text' => $row['name']];
    }

    echo json_encode($data);
} else if($action == 'book') {

    $gen = new App\General\All();
$results = $gen->listrow('book', 'id');

$data = [];

if ($results !== false) {
    $data[] = '<option value="">None</option>';
    foreach ($results as $row) {
        $data[] = '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
} else {
    echo "Error in database query.";
}

echo implode('', $data);
}



?>
