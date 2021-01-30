<?php


error_reporting(0);





if(isset($_SESSION['email']) =="") {
    header("Location:../managerlogin.php");
}
else{
    $dep=$_SESSION['dep'];
    ?>

    <!DOCTYPE html>
<html lang="en">
<head>
<title>Les directeurs</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="cs/main.css" rel="stylesheet" media="all">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
 
    
        <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

table{
    
    margin-left:30px;
}
body{
    width:1200px;
}
.title{
    color:white;
    font-size:20px;
    font-family:"Lucida Console", Monaco, monospace
    

}
        </style>
</head> 

<body class="bg-gra-01">


<div class="card-heading">
                    <h2 class="title">Liste des directeurs</h2>
                </div>

                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table class="table table-light">
 
							<thead class="thead-dark">
								<tr>
                                <th>#</th>
                                <th>id</th>
                                <th>Nom</th>
									<th>Prénom</th>
									<th>Date de naissance</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    
                        
                                    <th>Departement</th>
                                    <th>Nom d'utilisateur</th>
                               
                                    <th>Telephone</th>
                                    <th>Supprimer</th>
                        
                                    
        
								</tr>
							</thead>
				
							<tbody>
<?php

$user = new User;
 $query=$user->manager();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                      <tr>
 
                                  
                                            <td> <?php echo htmlentities($cnt);?> </td>
                                            <td> <?php echo htmlentities($result->mngid);?> </td>
                                           
                                            <td><?php echo htmlentities($result->first_name);?></td>
                                            <td><?php echo htmlentities($result->last_name);?></td>
                                            <td><?php echo htmlentities($result->date_naissance);?></td>
                                           <td><?php echo htmlentities($result->city);?></td>
                                            <td><?php echo htmlentities($result->email);?></td>
                                            <td><?php echo htmlentities($result->departementname);?></td>
                                            <td><?php echo htmlentities($result->username);?></td>
                                            <td><?php echo htmlentities($result->telephone);?></td>
                                            <td><a href="delete2.php?id=<?php echo htmlentities($result->mngid);?>"class="btn btn-danger">Supprimer</a></td>
                                       
                                        
                                       
          
                                        </tr>
                                         <?php $cnt++;} }?>
                                         </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
      
         
        </div>
     
        
        <!-- Javascripts -->
 

        
    </body>
</html>
<?php } ?>