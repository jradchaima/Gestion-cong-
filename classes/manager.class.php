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

    public function register($username, $email, $password,$firstname,$lastname,$ville,$sexe,$telephone,$date,$departement)
    {
        try {
            $sql = "INSERT INTO manager(username,email,password,sexe,departementname,city,first_name,last_name,telephone,date_naissance)
                    VALUES (:username,:email,:password,:sexe,:departement,:ville,:firstname,:lastname,:telephone,:date)";
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
            $query->execute();
            return $query;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM manager WHERE email= :email";
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
    public function departement(){
        $sql = "SELECT depname from  tbldepartments ";
              $query = $this->pdo->prepare($sql);
              $query->execute();
    return $query;



    }
    public function update($fname,$lname,$department,$address,$sexe,$mobileno,$eid,$date,$username){

        $sql="update manager set first_name=:fname,last_name=:lname,sexe=:sexe,departementname=:department,city=:address,telephone=:mobileno,date_naissance=:date,username=:username where email=:eid";
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
                $sql = "SELECT * from  manager where email=:eid";
        $query = $this->pdo->prepare($sql);
        $query -> bindParam(':eid',$eid, PDO::PARAM_STR);
        $query->execute();
        return $query;
        
        
        }
        
        public function employee($dep){
            $sql = "SELECT first_name,last_name,date_naissance,city,email,telephone,username,solde,empcode from employees where departementname=:dep";
$query = $this->pdo->prepare($sql);
$query->bindParam(':dep',$dep,PDO::PARAM_STR);
$query->execute();
return $query;
        }
        public function demande($dep){
            $sql = "SELECT employees.first_name,employees.last_name,employees.empid,demandeconge.nomtypeconge,demandeconge.datedemande,demandeconge.status,demandeconge.id as lid from employees join demandeconge on employees.empid=demandeconge.empid where departementname=:dep order by lid desc";
$query = $this->pdo->prepare($sql);
$query->bindParam(':dep',$dep,PDO::PARAM_STR);
$query->execute();
return $query;
        }
public function repondre($description,$status,$did){
    $sql="update demandeconge set adminremarque=:description,status=:status where id=:did";
$query = $this->pdo->prepare($sql);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$msg="Leave updated Successfully";

}

public function demandedet($lid){
    $sql = "SELECT demandeconge.id as lid,employees.first_name,employees.last_name,employees.empid,employees.sexe,employees.telephone,employees.email,employees.solde,demandeconge.nomtypeconge,demandeconge.datedebut,demandeconge.datefin,demandeconge.description,demandeconge.datedemande,demandeconge.status,demandeconge.adminremarque from demandeconge join employees on demandeconge.empid=employees.empid where demandeconge.id=:lid";
$query = $this->pdo->prepare($sql);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->execute();
return $query;
}
public function change_password($email){

    $sql ="SELECT password FROM manager WHERE email=:email";
$query= $this->pdo->prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
return $query;

        }

        public function change_password1($email,$newpassword){
$sql="update manager set password=:newpassword where email=:email";
$chngpwd1 = $this->pdo->prepare($sql);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
return $chngpwd1;


        }
        public function insersolde($solde,$eid){
            $sql="update employees set solde=:solde where empid=:eid";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':solde',$solde,PDO::PARAM_STR);
            $query->bindParam(':eid',$eid,PDO::PARAM_STR);
            $query->execute();

        }
        public function vucount($vu,$depname){
            $sql = "SELECT employees.departementname,demandeconge.id from employees join demandeconge on employees.empid=demandeconge.empid where vu=:vu AND employees.departementname=:depname";
            $query = $this->pdo->prepare($sql);
             $query->bindParam(':vu',$vu,PDO::PARAM_STR);
             $query->bindParam(':depname',$depname,PDO::PARAM_STR);
         $query->execute();
         return $query;

        }
        public function vu($vu,$depname){
            $sql = "SELECT employees.first_name,employees.last_name,employees.empid,employees.departementname,demandeconge.nomtypeconge,demandeconge.datedemande,demandeconge.status,demandeconge.id as lid from employees join demandeconge on employees.empid=demandeconge.empid where vu=:vu AND employees.departementname=:depname order by lid desc";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':vu',$vu,PDO::PARAM_STR);
            $query->bindParam(':depname',$depname,PDO::PARAM_STR);
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