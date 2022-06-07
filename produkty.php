<?php

use function PHPSTORM_META\sql_injection_subst;

session_start();
$connect = mysqli_connect("localhost", "root", "", "auth");
if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
           if(!in_array($_GET["id"], $item_array_id))
           {
               $count = count($_SESSION["shopping_cart"]);
               $item_array = array(
                'item_id'         => $_GET["id"],
                'item_name'       => $_POST["hidden_name"],
                'item_price'      => $_POST["hidden_price"],
                'item_quantity'   => $_POST["quantity"]

               );
               $_SESSION["shopping_cart"][$count] = $item_array;
           }   
           else     
           {
echo '<script>alert("Item Already Added")</script>';
echo '<script>window.location="produkty.php"</script>';
           }
        }     
    else
    {
        $item_array = array(
            'item_id'         => $_GET["id"],
            'item_name'       => $_POST["hidden_name"],
            'item_price'      => $_POST["hidden_price"],
            'item_quantity'   => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("przedmiot usunięty")</script>';
                echo '<script>window.location="produkty.php"</script>';
            }
        }
    }
   
}

if(isset($_GET["action"]))
{
    if($_GET["action"] == "order")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            $db= new mysqli("localhost", "root", "", "auth");
            $query2 = $db->prepare("INSERT INTO orders VALUES (NULL, ?, ?, ?, ?)");
            $query2->bind_param("sssi", $values["item_name"], $values["item_quantity"], $_SESSION['email'], $values["item_price"]);
            $query2->execute();
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("zamówienie złożone")</script>';
                echo '<script>window.location="produkty.php"</script>';
            
        }
    }
   
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <style>
        img{
            height: 100px;
            width: 100px;
        }
        .orderbutton{
            clear: both;
        }
    </style>
</head>
<body>
    <a href="view_order.php">Sprawdź zamówienie</a>
    
    <?php
    
echo "your email is " . $_SESSION['email'] . "<br>";



$query = "SELECT * FROM tbl_product ORDER BY id ASC";
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
?>
<div class="col-md-4">
<form method="post" action="produkty.php?action=add&id=<?php echo $row["id"]; ?>">
<div style="border: 1px solid #333; background-color: #f1f1f1;">
<img src="<?php echo $row["image"];?>" alt="">
<h4 class="text-info"><?php echo $row["name"];?></h4>
<h4 class="text-danger">PLN <?php echo $row["price"];?></h4>
<input type="text" name="quantity" class="form-control" value="1">
<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Dodaj do koszyka" />
</div>
</form>
</div>
<?php
    }
}
?>
<div style="clear: both"></div>
<br>
<h3>Szczegóły zamówienia</h3>
<div class="table-responsive"></div>
<table class="table table-bordered">
    <tr>
        <th width="40%">Nazwa produktu</th>
        <th width="10%">Ilość</th>
        <th width="20%">Cena</th>
        <th width="15">Total</th>
        <th width="5%">Usuń</th>
    </tr>
    <?php
if(!empty($_SESSION["shopping_cart"]))
{
    $total = 0;
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
        ?>
        <tr>
            <td><?php echo $values["item_name"]; ?></td>
            <td><?php echo $values["item_quantity"]; ?></td>
            <td>PLN <?php echo $values["item_price"]; ?></td>
            <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
            <td><a href="produkty.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Usuń</span></a></td>
            <td><form class="orderbutton" action="produkty.php">
            <!--<input type="submit" name="order" value="Złóż zamówienie">-->
        </form></td>
        </tr>
        
        <?php
        $total = $total + ($values["item_quantity"] * $values["item_price"]);
    }
    ?>
    <tr>
        <td colspan="3">Total</td>
        <td>PLN <?php echo number_format($total, 2); ?></td>
    </tr>
    <?php
}
    ?>
</table>
<a href="produkty.php?action=order">Zamów</a>
</body>
</html>