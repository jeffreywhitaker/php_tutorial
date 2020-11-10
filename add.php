<?php

  // if(isset($_GET['submit'])) {
  //   echo $_GET['email'];
  //   echo $_GET['title'];
  //   echo $_GET['ingredients'];
  // }

    if (isset($_POST['submit'])) {
        // check email
        if (empty($_POST['email'])) {
            echo 'An email is required <br />';
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'email must be a valid address <br />';
            }
        }
        // check title
        if (empty($_POST['title'])) {
            echo 'A title is required <br />';
        } else {
            $title = $_POST['title'];
            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $title)) {
                echo 'title must be letters, spaces, or numbers only';
            }
        }

        // check ingredients
        if (empty($_POST['ingredients'])) {
            echo 'Ingredients are required <br />';
        } else {
            $ingredients = $_POST['ingredients'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                echo 'ingredients must be a comma delineated list';
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
    <label for="email">Your Email:</label>
    <input type="text" name="email">
    <label for="title">Pizza Title:</label>
    <input type="text" name="title">
    <label for="ingredients">Ingredients (comma separated):</label>
    <input type="text" name="ingredients">
    <div class="center">
    <input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></div>
  </form>
</section>

<?php include 'templates/footer.php'; ?>

</body>
</html>