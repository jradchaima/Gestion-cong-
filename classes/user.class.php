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

    public function register($username,$email,$password,$firstname,$lastname,$ville,$sexe,$telephone,$date,$departement,$solde,$empcode)
    {
        try {
            $sql = "INSERT INTO employees(username,email,password,sexe,departementname,city,first_name,last_name,telephone,date_naissance,solde,empcode)
                    VALUES (:username,:email,:password,:sexe,:departement,:ville,:firstname,:lastname,:telephone,:date,:solde,:empcode)";
            $query = $this->pdo->prepare($sql);
            $query->bindparam(":username", $username);
            $query->bindparam(":email", $email);
            $query->bindparam(":password", $password);
            $query->bindparam(":sexe", $sexe);
            $query->bindparam(":departement", $departement);
            $query->bindparam(":ville", $ville);
            $query->bindparam(":telephone",$telephone);
            $query->bindparam(":date",$date);
            $query->bindparam(":firstname",$firstname);
            $query->bindparam(":lastname",$lastname);
            $query->bindparam(":solde",$solde);
            $query->bindparam(":empcode",$empcode);
            $query->execute();
            return $query;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM employees WHERE email= :email";
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
    public function update($fname,$lname,$department,$address,$sexe,$mobileno,$eid,$date,$username){

        $sql="update employees set first_name=:fname,last_name=:lname,sexe=:sexe,departementname=:department,city=:address,telephone=:mobileno,date_naissance=:date,username=:username where email=:eid";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':lname',$lname,PDO::PARAM_STR);
        $query->bindParam(':sexe',$sexe,PDO::PARAM_STR);
        $query->bindParam(':department',$department,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
        $query->bindParam(':eid',$eid,PDO::PARAM_STR);
        $query->bindParam(':date',$date,PDO::PARAM_STR);
        $query->bindParam(':username',$username,PDO::PARAM_STR);
        $query->execute();
            }
            public function select($eid){
                $sql = "SELECT * from  employees where email=:eid";
        $query = $this->pdo->prepare($sql);
        $query -> bindParam(':eid',$eid, PDO::PARAM_STR);
        $query->execute();
        return $query;
        
        
        }

        public function departement(){
            $sql = "SELECT depname from  tbldepartments ";
                  $query = $this->pdo->prepare($sql);
                  $query->execute();
        return $query;



        }


        public function typeconge(){
             $sql = "SELECT  nomtypeconge from typeconge";
$query = $this->pdo->prepare($sql);
  $query->execute();
  return $query;
        }

        public function demande($leavetype,$fromdate,$todate,$description,$status,$eid,$datedemande,$vu){

            $sql="INSERT INTO demandeconge(nomtypeconge,datedebut,datefin,description,status,empid,datedemande,vu) VALUES(:leavetype,:fromdate,:todate,:description,:status,:empid,:datedemande,:vu)";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
            $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
            $query->bindParam(':todate',$todate,PDO::PARAM_STR);
            $query->bindParam(':description',$description,PDO::PARAM_STR);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->bindParam(':vu',$vu,PDO::PARAM_STR);
          
            $query->bindParam(':empid',$eid,PDO::PARAM_STR);
            $query->bindParam(':datedemande',$datedemande,PDO::PARAM_STR);
  
            $query->execute();
      
        }
        public function insersolde($solde,$eid){
            $sql="update employees set solde=:solde where empid=:eid";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':solde',$solde,PDO::PARAM_STR);
            $query->bindParam(':eid',$eid,PDO::PARAM_STR);
            $query->execute();

        }


        public function lid(){
            $lastInsetId = $this->pdo->lastInsertId();
            return $lastInsetId;
            
        }

        public function history($eid){
            $sql = "SELECT nomtypeconge,datedebut,datefin,description,datedemande,adminremarque,status,solde,id as lid from demandeconge join employees on demandeconge.empid=employees.empid  where demandeconge.empid=:eid ORDER BY lid desc";
$query = $this->pdo->prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
return $query;
        }


        public function change_password($email){

    $sql ="SELECT password FROM employees WHERE email=:email";
$query= $this->pdo->prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
return $query;

        }

        public function change_password1($email,$newpassword){
$sql="update employees set password=:newpassword where email=:email";
$chngpwd1 = $this->pdo->prepare($sql);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
return $chngpwd1;


        }
        public function vucount($vu,$empid){
            $sql = "SELECT empid,id from demandeconge where vu=:vu AND empid=:empid";
            $query = $this->pdo->prepare($sql);
             $query->bindParam(':vu',$vu,PDO::PARAM_STR);
             $query->bindParam(':empid',$empid,PDO::PARAM_STR);
         $query->execute();
         return $query;

        }
        public function vu($vu,$empid){
            $sql = "SELECT employees.first_name,employees.last_name,employees.empid,employees.departementname,demandeconge.nomtypeconge,demandeconge.datedemande,demandeconge.status,demandeconge.id as lid from employees join demandeconge on employees.empid=demandeconge.empid where vu=:vu AND employees.empid=:empid order by lid desc";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':vu',$vu,PDO::PARAM_STR);
            $query->bindParam(':empid',$empid,PDO::PARAM_STR);
            $query->execute();
            return $query;
          
        }
        public function vu2($vu,$did){
            $sql="update demandeconge set vu=:vu where id=:did";
            $query= $this->pdo->prepare($sql);
$query->bindParam(':vu',$vu,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
        }
}
