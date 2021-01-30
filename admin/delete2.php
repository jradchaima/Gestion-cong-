<?php
    include '../classes/admin.class.php';
    $id=intval($_GET['id']);
    $user = new User;
   
    $user->deletedirc($id);
    header('Location:managers.php');