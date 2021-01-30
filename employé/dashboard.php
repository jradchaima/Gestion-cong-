<?php




if(isset($_SESSION['email']) =="") {
    header("Location: login.php");
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
    <title> </title>

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
                    <h2>Profil de l'employée</h2>
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
    $_SESSION['eid']=$result->empid; 
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
                            <div class="name"> Employée ID</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="empcode" value="<?php echo htmlentities($result->empid);?>"readonly autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name"> Employée code</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="empc" value="<?php echo htmlentities($result->empcode);?>"readonly autocomplete="off">
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
                        <div class="form-row">
                            <div class="name">Solde de congé</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="name" value="<?php echo htmlentities($result->solde);echo "jours";?>" autocomplete="off" required readonly >
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