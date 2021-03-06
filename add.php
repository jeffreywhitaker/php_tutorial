<?php

include 'config/db_connect.php';

$errors = ['email' => '', 'title' => '', 'ingredients' => ''];
$title = '';
$email = '';
$ingredients = '';

  // if(isset($_GET['submit'])) {
  //   echo $_GET['email'];
  //   echo $_GET['title'];
  //   echo $_GET['ingredients'];
  // }

    if (isset($_POST['submit'])) {
        // check email
        if (empty($_POST['email'])) {
            $errors['email'] = 'An email is required <br />';
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'email must be a valid address <br />';
            }
        }
        // check title
        if (empty($_POST['title'])) {
            $errors['title'] = 'A title is required <br />';
        } else {
            $title = $_POST['title'];
            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $title)) {
                $errors['title'] = 'title must be letters, spaces, or numbers only';
            }
        }

        // check ingredients
        if (empty($_POST['ingredients'])) {
            $errors['ingredients'] = 'Ingredients are required <br />';
        } else {
            $ingredients = $_POST['ingredients'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                $errors['ingredients'] = 'ingredients must be a comma delineated list';
            }
        }

        if (!array_filter($errors)) {
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $title = mysqli_real_escape_string($conn, $_POST['title']);

            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            // create sql
            $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('{$title}', '{$email}', '{$ingredients}')";

            // save to db and check
            if (mysqli_query($conn, $sql)) {
                // success
                header('Location: index.php');
            } else {
                // false
                echo 'query error: '.mysqli_error($conn);
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<?php include 'templates/header.php'; ?>

<section class="container grey-text">
  <h4 class="center">Add a Pizza</h4>
  <form action="add.php" method="POST" class="white">
    <!-- email -->
    <label for="email">Your Email:</label>
    <input type="text" name="email" value=<?php echo htmlspecialchars($email); ?>>
    <div class="red-text"><?php echo $errors['email']; ?></div>

    <!-- title -->
    <label for="title">Pizza Title:</label>
    <input type="text" name="title" value=<?php echo htmlspecialchars($title); ?>>
    <div class="red-text"><?php echo $errors['title']; ?></div>

    <!-- ingredients -->
    <label for="ingredients">Ingredients (comma separated):</label>
    <input type="text" name="ingredients" value=<?php echo htmlspecialchars($ingredients); ?>>
    <div class="red-text"><?php echo $errors['ingredients']; ?></div>

    <!-- submit -->
    <div class="center">
    <input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></div>
  </form>
</section>

<?php include 'templates/footer.php'; ?>

</body>
</html>