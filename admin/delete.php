
<?php
    include '../classes/admin.class.php';
    $id=intval($_GET['id']);
    $user = new User;
    $user->deletedemande($id);
    $user->deleteUser($id);
    header('Location:employeesc.php');
   