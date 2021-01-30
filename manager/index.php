 
 

 <?php
session_start();
include '../classes/manager.class.php';



if(isset($_SESSION['email']) =="") {
    header("Location:../managerlogin.php");
}
else{
$eid=$_SESSION['email'];
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Profil du directeur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<link rel="stylesheet" href="css/style.css">
        
  </head>

  <style>
#sidebar{
  background:linear-gradient(to right, #0f89da , #b8e8fc);

}
body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        background: #60a3bc !important;
    }

}



  </style>
  <body>
 
        
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" style="background:linear-gradient(to right, #0f89da , #b8e8fc);color:white;width:50px;height:50px ;border-radius:50% 50% 50%;">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
        <img src="../cnte.jpg"style="height:100px;width:150px;margin-left:10px;margin-top:10px;opacity:0.7;border-radius:20px">
    <br>
				<div class="p-4 pt-5" style="  margin-left:0px;">
 
          <h2 style="color:white">Bienvenue</h2>
      
		  		                          <?php
                      
$user = new User;
$query=$user->select($eid);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
   echo '<h3 style="color:white;">'.htmlentities($result->username).'</h3>';
   $depname = $result->departementname;
   

}}
?>

	      
<ul class="list-unstyled components mb-5">
	          <li class="active">
			  <a href="index.php">Page de profil</a>
	          </li>
	          <li>
              <a href="lesdemandesc.php">Les demandes</a>
	          </li>
	          <li>
              <a href="employeec.php">Les employées</a>
	          </li>
            <li>
              <a href="change-passwordc.php">Changer mot de passe</a>
	          </li>
	          <li>
              <a href="../logoutmanager.php">Logout</a>
	          </li>
	        </ul>

	        <div class="mb-5">
			
						<form action="#" class="colorlib-subscribe-form">
	            <div class="form-group d-flex">
	            	<div class="icon"><span class="icon-paper-plane"></span></div>
	    
	            </div>
	          </form>
					</div>


	      </div>
    	</nav>

 
        <!-- Page Content  -->
      <div id="content">
          <?php

          include 'dashboard.php';
          

          ?>
      </div>
      <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top" style="width:150px;height:60px;border-radius:30px;position:absolute; left:1160px;">
     
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault"style="background-color:linear-gradient(to right, #0f89da , #b8e8fc);">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications 
               <?php 
                     $vu = 0;
                     $user = new User;
                     $query=$user->vucount($vu,$depname);
                     $results=$query->fetchAll(PDO::FETCH_OBJ);
                     $unreadcount=$query->rowCount();
                     ?>
                         <span class="badge badge-dark" style="font-size:15px;"><?php echo htmlentities($unreadcount);?> </span>
              </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
               
            <?php
            $usera = new User;
            $vu=0;
                $query=$usera->vu($vu,$depname);
                $results=$query->fetchAll(PDO::FETCH_OBJ);
               
                if($query->rowCount() > 0)
                {
                foreach($results as $result)
                { 
                ?>
              <a  href="leave-detailsc.php?leaveid=<?php echo htmlentities($result->lid);?>"class="dropdown-item " >  <?php echo htmlentities($result->datedemande)?> <br><?php echo htmlentities($result->first_name)?><br><?php echo htmlentities($result->last_name)?> </a>
                          
              <div class="dropdown-divider"></div>
                <?php
                     
                    }
                  }else{
                      echo "Rien de voir.";
                  }
                     ?>
            
               
            </div>
          </li>
        </ul>
          
          
          
      </div>
    </nav>
  
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>