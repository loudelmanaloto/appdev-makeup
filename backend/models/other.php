<?php
    class Post {
        private $pdo;
        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function postStudent($data){
            $sql = "INSERT INTO students(studentid, fullname) VALUES (?,?)";
            $stmt = $this->pdo->prepare($sql);
            try{
                $stmt->execute([$data->studentid, $data->fullname]);
                return array("data"=>[], "message"=>"Successfully inserted record.");
            }
            catch(\PDOException $e){
                http_response_code(401);
                return array("message"=>$e->getMessage());
            }
            return "Failed to insert.";
        }
       
    }


?>