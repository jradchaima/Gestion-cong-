<?php





if(isset($_SESSION['email']) =="") {
    header("Location: loginmanager.php");
}
else{
$eid=$_SESSION['email'];
if(isset($_POST['update']))
{

$fname=$_POST['firstName'];
$lname=$_POST['lastName']; 
$username=$_POST['username'];
$department=$_POST['department']; 
$address=$_POST['address']; 
$mobileno=$_POST['mobileno'];
$sexe= $_POST['gender'];
$date=$_POST['dob'];
$userr = new User;
$userr->update($fname,$lname,$department,$address,$sexe,$mobileno,$eid,$date,$username);

}

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vend/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vend/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vend/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vend/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="cs/main.css" rel="stylesheet" media="all">
</head>
<style>
    table{
    
    margin-left:30px;
}
body{
    width:1200px;
}
.card-heading h2{
    color:white;
    font-size:20px;
    font-family:"Lucida Console", Monaco, monospace;
    text-align:center;
    text-transform: uppercase;
    

}
.card {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background: #fff;
}

.card-5 {
  background: #fff;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
}

.card-5 .card-heading {
  padding: 20px 0;
  background: #1a1a1a;
  -webkit-border-top-left-radius: 10px;
  -moz-border-radius-topleft: 10px;
  border-top-left-radius: 10px;
  -webkit-border-top-right-radius: 10px;
  -moz-border-radius-topright: 10px;
  border-top-right-radius: 10px;
}

.card-5 .card-body {
  padding: 52px 85px;
  padding-bottom: 73px;
}

@media (max-width: 767px) {
  .card-5 .card-body {
    padding: 40px 30px;
    padding-bottom: 50px;
  }
}
.btn--red {
  background: #0f89da;
}

.btn--red:hover {
  background: #b8e8fc;
}

</style>

<body class="bg-gra-01">
    

        <div class="wrapper wrapper--w790">
            <div class="card card-5">
           
            <div class="card-heading">
                    <h2>Directeur profile</h2>
                </div>
            
                <?php 
$eid=$_SESSION['email'];
$user = new User;
$query=$user->select($eid);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)

{       
    $_SESSION['eid']=$result->mngid; 
    $_SESSION['dep']=$result->departementname;
           ?> 
                    <div class="card-body">
                    <form method="POST">
                        <div class="form-row m-b-55">
                            <div class="name">Nom

                            </div>
                            <div class="value">
                                <div class="row row-space">
                                
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="firstName" value="<?php echo htmlentities($result->first_name);?>" autocomplete="off" required readonly>
                                            <label class="label--desc">Nom</label>
                                       
                                    </div>
                                
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="lastName" value="<?php echo htmlentities($result->last_name);?>" autocomplete="off" required readonly >
                                            <label class="label--desc">Prénom</label>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name"> Directeur ID</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="empcode" value="<?php echo htmlentities($result->mngid);?>"readonly autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" value="<?php echo htmlentities($result->email);?>"autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Nom d'utilisateur</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="username" value="<?php echo htmlentities($result->username);?>" autocomplete="off" required >
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Addresse</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="address" value="<?php echo htmlentities($result->city);?>" autocomplete="off" required >
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Telephone</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="mobileno" value="<?php echo htmlentities($result->telephone);?>" autocomplete="off" required >
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Date de naissance</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="date" class="datepicker" name="dob" value="<?php echo htmlentities($result->date_naissance);?>" autocomplete="off" required readonly>
                                </div>
                            </div>
                        </div>


                      
                        <div class="form-row">
                            <div class="name">Sexe</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search" >
                                        <select name="gender">
                                        <option value="<?php echo htmlentities($result->sexe);?>"><?php echo htmlentities($result->sexe);?> </option>                                          
                                  
                                        
                                        </select>
                                     
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                             
                        <div class="form-row">
                            <div class="name">Departement</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
<select  name="department" autocomplete="off">
<option value="<?php echo htmlentities($result->departementname);?>"><?php echo htmlentities($result->departementname);?></option>

</select>
<div class="select-dropdown"></div>
</div>
                                </div>
                            </div>
                        </div>
                       
                        


                            <button class="btn btn--radius-2 btn--red" type="submit" name="update">Modifier</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php }} ?>  




  <!-- Jquery JS-->
  <script src="vend/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vend/select2/select2.min.js"></script>
    <script src="vend/datepicker/moment.min.js"></script>
    <script src="vend/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="j/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
<?php } ?>