<?php
include 'config/db_connect.php';
$email = $title = $ingredients = '';
$errors = array('email'=>'', 'title'=>'', 'ingredients'=>'' );
if(isset($_POST['submit']))
{
//email validation
    if(empty($_POST['email'])){
    $errors['email'] = 'Email Required <br>';
    } else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'email is not valid <br>';
        }
    }
    //title validation
    if(empty($_POST['title'])){
        $errors['title'] = 'title Required <br>';
    } else{
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['title'] = 'title must have letters and spaces only <br>';
        }
    }
    //ingredients validation
    if(empty($_POST['ingredients'])){
        $errors['ingredients'] = 'ingredient Required <br>';
    } else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^[a-zA-Z\s]+(,\s?[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients'] = 'Ingredients should be separated by comma <br>';
        }
    }

    if(!array_filter($errors)){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
        
        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES ('$title', '$email', '$ingredients')";
         
        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        } else{
            echo 'Query Error ' . mysqli_error($conn);
        }
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('Templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Add a Pizza<h4>
        <form class="white" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <label>Your Email</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Pizza Title</label>
            <input type="text" name="title" value="<?php echo  ($title); ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label>Ingredients (comma separated)<label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <div class="center">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
</section>
<?php include('Templates/footer.php'); ?>

</html>