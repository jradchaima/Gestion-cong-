 
 

 <?php
session_start();
include '../classes/user.class.php';



if(isset($_SESSION['email']) =="") {
    header("Location:../login.php");
}
else{
$eid=$_SESSION['email'];
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Historique des demandes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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

}}
?>

	      
<ul class="list-unstyled components mb-5">
	          <li class="active">
	           
	              <a href="index.php">Page de profil</a>
	          </li>
	          <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Congé</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="demander_conge.php">Demander un congé</a>
                </li>
                <li>
                    <a href="historiquedemandec.php">Historique des demandes</a>
                </li>
              </ul>
	          </li>
	          <li>
              <a href="changer-motdepassec.php">Changer mot de passe</a>
	          </li>
	          <li>
              <a href="../logout.php">Logout</a>
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
      <div id="content">
          <?php
          include 'historiquedemande.php';
          ?>
                </div>
		</div>
  
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>