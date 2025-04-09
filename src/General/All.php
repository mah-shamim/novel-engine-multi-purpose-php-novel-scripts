<?php
    
    namespace App\General;
    use  App\General\Database;
    use PDOException, PDO, Exception;
    use App\General\DB;

    class All extends Database {

        public function isSubscribe($user_id) {

            $db = new DB();
            $row = $db->table('subscriptions')->where('user_id', $user_id)->where('status', 1)->where('days', 0, '>')->first();
            return $row ? true : false;
        } 

        public function createTable($tableName, $columns, $primaryKey, $foreignKey = null, $TR = null) {
            try {
                $sql = "CREATE TABLE IF NOT EXISTS $tableName (";
                
                foreach ($columns as $columnName => $columnType) {
                    $sql .= "$columnName $columnType, ";
                }
    
                $sql .= "PRIMARY KEY ($primaryKey))";
    
                $this->pdo->exec($sql);
                
    
                if ($foreignKey) {
                    return $this->addForeignKey($tableName,  $primaryKey, $TR, $foreignKey);
                }
    
                return true;
            } catch(PDOException $e) {
                throw new Exception("Error creating table: " . $e->getMessage());
                return false;
            }
        }
        
        public function getLastRow($table) {
            $stmt = $this->pdo->prepare("SELECT MAX(created_at) AS               last_modified_date
                    FROM $table");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result['last_modified_date'];
        }
    
        public function addForeignKey($tableName,  $Pkey, $TR, $foreignKey) {
            try {
                $fk =$tableName."_fk_".$foreignKey;
                $sql = "ALTER TABLE $tableName
                        ADD CONSTRAINT $fk
                        FOREIGN KEY ($foreignKey) 
                        REFERENCES $TR($Pkey)";
    
                $this->pdo->exec($sql);
     
                return true;
            } catch(PDOException $e) {
                throw new Exception("Error adding foreign key constraint: " . $e->getMessage());
                return false;
            }
        }
        
        public function detectTable($table) {
            try {
               $stmt = $this->pdo->query("SHOW TABLES LIKE '$table'"); 
               
               if($stmt->rowCount() > 0) {
                   return true;
               } else {
                   return false;
               }
            } catch(PDOException $e) {
                throw new Exception("Error ".$e->getMessage());
            }
            
        }
        
            public function formatDate($date) {
                $dateTime = new \DateTime($date);
                return $dateTime->format('Y-m-d');
            }
        
        public function getTotal($table) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM $table");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        }

        public function getTotalByID($table, $column, $id) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM $table WHERE $column = :cid ");
            $stmt->bindValue(":cid", $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        }

        public function getT2($table, $column = null, $id = null, $search = null, $searchVal = null) {
            $sql = "SELECT COUNT(*) AS total FROM $table WHERE status = :stat ";

            if(!is_null($column)) {
                $sql .= "AND  $column = :cid ";
            }

            if(!is_null($search)) {
                $sql .= " AND ($search LIKE :searchVal) ";
            }

            $stmt = $this->pdo->prepare($sql);
            if(!is_null($id)) {
                $stmt->bindValue(":cid", $id, PDO::PARAM_INT);
            }
            $stmt->bindValue(":stat", 1, PDO::PARAM_INT);
            if(!is_null($searchVal)) {
                $stmt->bindValue(':searchVal', "%$searchVal%", PDO::PARAM_STR);
            }
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        }

        public function selectBy($table, $conditions = [], $orderByColumn = 'id', $orderByDirection = 'ASC', $limit =  null)
        {
            $whereClause = '';
            $values = [];

            foreach ($conditions as $column => $value) {
                $whereClause .= "$column = :$column AND ";
                $values[":$column"] = $value;
            }

            $whereClause = rtrim($whereClause, ' AND ');

            $orderByClause = ' ';
            if ($orderByColumn) {
                $orderByClause = "ORDER BY $orderByColumn $orderByDirection ";
            }

            if(!is_null($limit)) {
                $orderByClause .= "LIMIT :limit";
            }

            $query = $this->pdo->prepare("SELECT * FROM $table WHERE $whereClause $orderByClause");

            if(!is_null($limit)) {
                $query->bindValue(":limit", $limit, PDO::PARAM_INT);
            }
            try {
                $query->execute($values);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function delete($table, $id) {
            $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        }


        public function getRow($table, $column, $id) 
        {
            $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $column = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getList($table,  $order = 'id', $limit = null, $col = null, $val= null) {
            $sql = "SELECT * FROM $table ";
            if(!is_null($col)) {
                $sql .= "WHERE $col = :col ";
            }

            $sql .= "ORDER BY $order ";

            if(!is_null($limit)) {
                $sql .= "LIMIT :limit";
            }

            $stmt = $this->pdo->prepare($sql);

            if(!is_null($col)) {
                $stmt->bindValue(":col", $val, PDO::PARAM_INT);
            }
            if(!is_null($limit)) {
                $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);   

        }

        public function getFiles($table, $order = 'id', $limit = null, $offset = null, $col = null, $val = null, $search = null, $searchVal = null) {
            $sql = "SELECT * FROM $table ";
            $stat = 1;
        
            if (!is_null($col)) {
                $sql .= "WHERE $col = :val AND status = :stat ";
            } else {
                $sql .= "WHERE status = :stat ";
            }

            if(!is_null($search)) {
                $sql .= " AND ($search LIKE :searchVal)";
            }
        
            $sql .= "ORDER BY $order DESC ";
        
            if (!is_null($limit)) {
                $sql .= "LIMIT :limit ";
            }
        
            if (!is_null($offset)) {
                $sql .= "OFFSET :start";
            }
        
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":stat", $stat, PDO::PARAM_INT);
            if (!is_null($col)) {
                $stmt->bindValue(":val", $val, PDO::PARAM_STR);
            }
        
            if (!is_null($limit)) {
                $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
            }
        
            if (!is_null($offset)) {
                $stmt->bindValue(":start", $offset, PDO::PARAM_INT);
            }

            if(!is_null($searchVal)) {
                $stmt->bindValue(':searchVal', "%$searchVal%", PDO::PARAM_STR);
            }
        
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

        public function listRow2($table, $column, $id, $order) {
            $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $column = :id ORDER BY $order ASC");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }

        public function getRowData($table, $name, $condition, $id) 
        {
            $stmt =  $this->pdo->prepare("SELECT * FROM $table WHERE $condition = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row[$name];
        }

        public function Insert($table, $data, $id = null)
        {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
    
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    
            $stmt = $this->pdo->prepare($sql);
    
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            $success = $stmt->execute();

            
            return $success ? $this->pdo->lastInsertId() : null;
        }


        public function EditRow($table, $data, $condition)
        {
            $setClause = implode(' = ?, ', array_keys($data)) . ' = ?';
        
            $sql = "UPDATE $table SET $setClause WHERE $condition";
        
            $stmt = $this->pdo->prepare($sql);
        
            $bindValues = array_values($data);
            foreach ($bindValues as $index => $value) {
                $stmt->bindValue($index + 1, $value);
            }
        
            return $stmt->execute();
        }

        public function detectColumn($table, $column, $id) 
        {
            $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $column = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } 

        public function listrow($table, $order) {
            $stmt = $this->pdo->prepare("SELECT * FROM $table ORDER BY $order DESC");
            $stmt->execute();
            return $stmt->fetchAll();

        }

        

        public function genSlug($slug, $table) {
            $originalSlug = $slug;
        
            while (true) {
                
                    if ($this->selectBy($table, ['slug' => $slug])) {
                        $slug = $originalSlug . '-' . rand(0, 10);
                    
                    } else {
                        break;
                    }
        
            
        }

        return $slug;
    }

    public function searchBy($table, $column, $query)
{
    $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $column LIKE :search");
    $query = '%' . $query . '%';
    $stmt->bindParam(":search", $query, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function createMultiple($table, $data) 
{
    $s = true;

    foreach($data as $row) {
        if(!$this->selectBy($table, ['name' => $row])) {
            $slug = slug($this->genSlug($row, $table));

            $stmt = $this->pdo->prepare("INSERT INTO $table (name, slug) VALUES(:name, :slug)");
            $stmt->bindParam(":name", $row, PDO::PARAM_STR);
            $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
            if(!$stmt->execute()) {
                $s = false;
            }

        }
    }

    return $s;
}






         


    }
?>