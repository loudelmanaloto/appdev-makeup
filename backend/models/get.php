<?php
    class Get {
        private $pdo;
        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function getStudents(){
            $sql = "SELECT * FROM students";
            $data = array();
            try{
                if($result = $this->pdo->query($sql)->fetchAll()){
                    foreach($result as $record){
                        array_push($data, $record);
                    }
                    return $data;
                }
            }
            catch(\PDOException $e){
                return $e->getMessage();
            }
            return "No records found";
        }
        public function getGrades(){
            $sql = "SELECT * FROM grades";
            $data = array();
            try{
                if($result = $this->pdo->query($sql)->fetchAll()){
                    foreach($result as $record){
                        array_push($data, $record);
                    }
                    return $data;
                }
            }
            catch(\PDOException $e){
                return $e->getMessage();
            }
            return "No records found";
        }
        public function getCourses(){
            $sql = "SELECT * FROM courses";
            $data = array();
            try{
                if($result = $this->pdo->query($sql)->fetchAll()){
                    foreach($result as $record){
                        array_push($data, $record);
                    }
                    return $data;
                }
            }
            catch(\PDOException $e){
                return $e->getMessage();
            }
            return "No records found";
        }
    }


?>