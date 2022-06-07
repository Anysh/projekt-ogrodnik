<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
session_start();
$db= new mysqli("localhost", "root", "", "auth");
$q = $db->prepare("SELECT * FROM orders WHERE email = ?");
//$q2 = $db->prepare("SELECT ilość_produktu FROM orders WHERE email = ?");

$q -> bind_param("s", $_SESSION['email']);
//$q2 -> bind_param("i", $_SESSION['email']);
$q -> execute();
//$q2 -> execute();
$result = $q->get_result();
//$result2 = $q->get_result();
$total = 0;
echo "Twoje zamówienie:"."<br>";
while ($row = $result->fetch_assoc()) {
    
    echo $row['nazwa_produktu'];
    echo ":";
    echo $row['ilość_produktu'];
    echo " cena: " .$row['cena']."<br>";
    $total = $total + ($row['cena'] * $row['ilość_produktu']);
}
//$q2 = $db ->prepare("SELECT ilość_produktu FROM orders WHERE email=?");
//$q2 -> bind_param("i", $_SESSION['email']);
//$q3 = $db ->prepare("SELECT cena FROM orders WHERE email=?");
//$q3 -> bind_param("i", $_SESSION['email']);
//$q2 -> execute();
//$result2 = $q2->get_result();
//$q3 ->execute();
//$result3 = $q3->get_result();

//$total = ($result2 * $result3);

echo "cena całkowita : ".$total."PLN" ;
?>
<br><a href="produkty.php">Powrót do strony zamówień</a>
</body>
</html>