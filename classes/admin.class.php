<?php

include 'dbconnect.class.php';

class User
{
    private $pdo;

    public function __construct()
    {
        $dbconn = new DBConnection;
        $this->pdo = $dbconn->connectDB();
    }

    public function register($username, $email, $password,$firstname,$lastname,$ville,$sexe,$telephone,$date)
    {
        try {
            $sql = "INSERT INTO admine (username,email,password,sexe,city,first_name,last_name,telephone,date_naissance)
                    VALUES (:username,:email,:password,:sexe,:ville,:firstname,:lastname,:telephone,:date)";
            $query = $this->pdo->prepare($sql);
            $query->bindparam(":username", $username);
            $query->bindparam(":email", $email);
            $query->bindparam(":password", $password);
            $query->bindparam(":sexe", $sexe);
            
            $query->bindparam(":ville", $ville);
            $query->bindparam(":telephone",$telephone);
            $query->bindparam(":date",$date);
            $query->bindparam(":firstname",$firstname);
            $query->bindparam(":lastname",$lastname);
            $query->execute();
            return $query;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
}
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM admine WHERE email= :email";
            $query = $this->pdo->prepare($sql);
            $query->bindparam(":email", $email);
            $query->execute();
            $user = $query->fetch();
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function update($fname,$lname,$address,$sexe,$mobileno,$eid,$date,$username){

        $sql="update admine set first_name=:fname,last_name=:lname,sexe=:sexe,city=:address,telephone=:mobileno,date_naissance=:date,username=:username where email=:eid";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':lname',$lname,PDO::PARAM_STR);
        $query->bindParam(':sexe',$sexe,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
        $query->bindParam(':eid',$eid,PDO::PARAM_STR);
        $query->bindParam(':date',$date,PDO::PARAM_STR);
        $query->bindParam(':username',$username,PDO::PARAM_STR);
        $query->execute();
            }
            public function select($eid){
                $sql = "SELECT * from  admine where email=:eid";
        $query = $this->pdo->prepare($sql);
        $query -> bindParam(':eid',$eid, PDO::PARAM_STR);
        $query->execute();
        return $query;
        
        
        }


        public function employee(){
            $sql = "SELECT empid,first_name,last_name,date_naissance,city,email,telephone,username,departementname,empcode from employees";
$query = $this->pdo->prepare($sql);

$query->execute();
return $query;
        }
        public function manager(){
            $sql = "SELECT mngid,first_name,last_name,date_naissance,city,email,telephone,departementname,username from manager";
$query = $this->pdo->prepare($sql);

$query->execute();
return $query;
        }
        public function deleteUser($id)
        {
            try {
                $sql = 'DELETE FROM employees WHERE empid = :id';
                $result = $this->pdo->prepare($sql);
                $result->bindparam(":id", $id);
                $result->execute();
                return $result;
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        }
        public function deletedirc($id){
            try {
                $sql = 'DELETE FROM manager WHERE mngid = :id';
                $result = $this->pdo->prepare($sql);
                $result->bindparam(":id", $id);
                $result->execute();
                return $result;
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }

        }
        public function deletedemande($id)
        {
            try {
                $sql = 'DELETE FROM demandeconge WHERE empid = :id';
                $result = $this->pdo->prepare($sql);
                $result->bindparam(":id", $id);
                $result->execute();
                return $result;
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        }
}