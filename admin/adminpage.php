<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Zamówienia</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="bs-example">
   <h2 class="pull-left">Zamówienia użytkowania</h2>
  </div>
<?php
  // łączenie do bazy danych
  $conn = new mysqli("localhost", "root", "", "auth");
  $result = mysqli_query($conn,"SELECT * FROM orders");
?>
<?php
  //sprawdza czy liczba linijek w wykonanej komendzie jest większa niż 0 
  if (mysqli_num_rows($result) > 0) {
?>
  <table class='table'>
  <tr>
    <td>Mail</td>
    <td>Produkty</td>
    <td>Ilość</td>
  </tr>
<?php
  $i=0;
  //zbiera dane z komendy i przechowuje w $row
  while($row = mysqli_fetch_array($result)) {
?>
<tr>
  <td><?php echo $row["email"]; ?></td>
  <td><?php echo $row["nazwa_produktu"]; ?></td>
  <td><?php echo $row ["ilość_produktu"]; ?></td>
</tr>
<?php
  $i++;
  }
?>
</table>
<?php
  }
    else{
    echo "No result found";
  }
?>
</body>
</html>