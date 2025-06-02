<?php
    class Post {
        private $pdo;
        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function addStudent($data){
            $sql = "INSERT INTO students(studentid, fullname) VALUES (?, ?);";
          
            try{
               $stmt = $this->pdo->prepare($sql);
                $body = [
                    $data->studentid,
                    $data->fullname
                ];
               $stmt->execute($body);
               return array("data"=>[], "message"=>"successfully inserted.");
            }
            catch(\PDOException $e){
                return $e->getMessage();
            }
            return "Failed to insert.";
        }

       public function editStudent($data){
            $sql = "UPDATE students SET studentid =?, fullname = ? WHERE recno = ?";
          
            try{
               $stmt = $this->pdo->prepare($sql);
                $body = [
                    $data->studentid,
                    $data->fullname,
                    $data->recno
                ];
               $stmt->execute($body);
               return array("data"=>[], "message"=>"successfully updated.");
            }
            catch(\PDOException $e){
                return $e->getMessage();
            }
            return "Failed to update.";
        } 

        public function deleteStudent($data){
            $sql = "DELETE FROM students WHERE recno = ?";
          
            try{
               $stmt = $this->pdo->prepare($sql);
                $body = [
                    $data->recno
                ];
               $stmt->execute($body);
               return array("data"=>[], "message"=>"successfully deleted.");
            }
            catch(\PDOException $e){
                return $e->getMessage();
            }
            return "Failed to delete.";
        }

    }


?>