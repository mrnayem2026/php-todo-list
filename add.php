<?php

include "db.php";

if(isset($_POST["submit"])){
  $task = $_POST["task"];

  $sql = "INSERT INTO task (name) VALUES ('$task')";
  mysqli_query($conn, $sql);

  header("location: index.php");
}


?>