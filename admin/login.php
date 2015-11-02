<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/site/core/init.php';
include 'includes/head.php';

$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors = array();
?>

<style>
    body{
     background-image: url("/site/images/headerlogo/background.png");
     background-size: 100vw 100vh;
     background-attachment: fixed;
    }
</style>
<div id="login-form">
    <div>
    
    <?php
        if($_POST){
            //form validation
            if(empty($_POST['email']) || empty($_POST['password'])){
            $errors[] = 'You must provide email and password.';
            }
            
            //validate email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = 'You must enter a valid email';
            }
            
            //password is less than 6 characters
            if(strlen($password)<6){
                $errors[] = 'Password must be at least 6 characters';
            }
            
            //check if email is in database
            $query = $db->query("SELECT * FROM users WHERE email = '$email'");
            $user = mysqli_fetch_assoc($query);
            $userCount = mysqli_num_rows($query);
            if($userCount==0){
                $errors[]='That email doesn\'t exist in the database';
            }
            
            if(!password_verify($password, $user['password'])){
                $errors[] = 'Password incorrect. Try again';
            }
            
            
            
            //check for errors
            if(!empty($errors)){
             echo display_errors($errors);   
            }else{
             //log user   
            }
        }
    
    ?>
    
    </div>
    <h2 class="text-center">Login</h2><hr>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" class="form-control" value="<?=$email; ?>">
        </div>
         <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" class="form-control" value="<?=$password; ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Login" class="btn btn-primary">
        </div>
    </form>
    <p class="text-right"><a href="/site/index.php" alt="home">Visit site</a></p>
</div>


<?php include 'includes/footer.php'; ?>