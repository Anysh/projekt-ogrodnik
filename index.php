<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
  
</head>
<body>
<?php
session_start();


if (isset($_REQUEST['action']) && $_REQUEST['action'] == "login") {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    
    $db = new mysqli("localhost", "root", "", "auth");

    
    
    $q = $db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
    
    $q->bind_param("s", $email);
    
    $q->execute();
    $result = $q->get_result();

    $userRow = $result->fetch_assoc();
    if ($userRow == null) {
        
        echo "zły login lub hasło <br>";

    } else {
        
        if (password_verify($password, $userRow['passwordHash'])) {
            
            echo "Zalogowano <br>";
            header("Location:produkty.php");
        } else {
            
            echo "Błędny login lub hasło <br>";
        }
    }
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "register") {

    $db = new mysqli("localhost", "root", "", "auth");
    $email = $_REQUEST['email'];
    
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $name = $_REQUEST['name'];
    $secondname = $_REQUEST['secondname'];
    $password = $_REQUEST['password'];
    $passwordRepeat = $_REQUEST['passwordRepeat'];

    if($password == $passwordRepeat) {
        
        $q = $db->prepare("INSERT INTO user VALUES (NULL, ?, ?, ?, ?)");
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);
        //$q->bind_param("ss", $email, $passwordHash); 
        $q->bind_param("ssss", $email, $passwordHash, $name, $secondname);
        $result = $q->execute();
        if($result) {
            echo "Konto utworzono"; 
        } else {
            echo "błąd!";
        }
    } else {

        echo "Hasła się nie zgadzają";
    }
}
if(isset($_POST['email'])) {


$_SESSION['email'] = $_POST['email'];
}
//if(isset($_GET['id'])) {
//$_SESSION['id'] = $_GET['id'];
//}
?>



<form action="index.php" method="post" class="registerform">
<h1>Zarejestruj się</h1>
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput"><br>
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <label for="passwordRepeatInput">Hasło ponownie:</label>
    <input type="password" name="passwordRepeat" id="passwordRepeatInput">
    
    
    <label for="nameInput">Imię:</label>
    <input type="text" name="name" id="nameInput"> 
    <label for="FornameInput">Nazwisko:</label>
    <input type="text" name="secondname" id="secondnameInput">
    
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Zarejestruj">
    
    
</form>
<form action="index.php" method="post" class="loginform">
<h1>Zaloguj się</h1>    
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <input type="hidden" name="action" value="login">
    <input type="submit" value="Zaloguj">
</form>
</body>
</html>