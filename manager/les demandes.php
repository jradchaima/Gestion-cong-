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
<title>Employees</title>
        
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
button:hover{
    text-decoration:underline;
}
        </style>
</head> 

<body class="bg-gra-01">


<div class="card-heading">
                    <h2 class="title">Employee de departement <?php echo $dep ?></h2>
                </div>

                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table class="table table-light">
 
							<thead class="thead-dark">
								<tr>
                                <th>#</th>
									<th>Nom Employee</th>
									<th>Type conge</th>
									<th>Date de demande</th>
                                    <th>Status</th>
                                   
                                    <th align="center">Voir details</th>
                               
                               
                               
								</tr>
							</thead>
				
							<tbody>
<?php

$user = new User;
 $query=$user->demande($dep);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                            
                            <tr>
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                              <td><a href="editemployee.php?empid=<?php echo htmlentities($result->empid);?>" target="_blank"><?php echo htmlentities($result->first_name." ".$result->last_name);?></a></td>
                                            <td><?php echo htmlentities($result->nomtypeconge);?></td>
                                            <td><?php echo htmlentities($result->datedemande);?></td>
                                                                       <td><?php $stats=$result->status;
if($stats==1){
                                             ?>
                                                 <span style="color: green">Acceptée</span>
                                                 <?php } if($stats==2)  { ?>
                                                <span style="color: red">Refusée</span>
                                                 <?php } if($stats==0)  { ?>
 <span style="color: blue">En attente de l'acceptation</span>
 <?php } ?>
 <td> <button ><a  style ="color:white;font-size:30px;text-align:center;background-color:green;width:500px;height:300px;border-radius:5px;border-color:green;border-style:solid;" href="leave-detailsc.php?leaveid=<?php echo htmlentities($result->lid);?>">voir</a></button></td>

                                            
                    
           
                                    </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
            <?php

                                                 }

                                                 ?>