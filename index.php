<?php

// connect to DB
$conn = mysqli_connect('localhost', 'jeff', 'test1234', 'jeff_pizza');

if (!$conn) {
    echo 'Connection error: '.mysqli_connect_error();
}

// write query for all pizzas
$sql = 'SELECT title, ingredients, id FROM pizzas';

// make query and get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);

print_r($pizzas);

?>


<!DOCTYPE html>
<html lang="en">

<?php include 'templates/header.php'; ?>
<?php include 'templates/footer.php'; ?>

</body>
</html>