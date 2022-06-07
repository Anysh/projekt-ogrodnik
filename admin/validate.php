<?php
include_once('connection.php');
  
function test_input($data) {
    return $data;
}
//sprawdzenie czy login i hasło jest poprawne 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM loginadmin");
    $stmt->execute();
    $users = $stmt->fetchAll();
     
    foreach($users as $user) {
         
        if(($user['username'] == $username) &&
            ($user['password'] == $password)) {
                header("location: adminpage.php");
        }
        else {
            echo "błędne hasło lub login";
            die();
        }
    }
}
 
?>