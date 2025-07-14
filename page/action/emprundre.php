<?php
session_start();
include("../../inc/sql_function.php");

set_emprunt($_POST['id_obj'], $_SESSION['id'], $_POST['jour']);

header("location:../liste.php");
