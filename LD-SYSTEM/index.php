<?php

session_start();

require_once 'Config/Functions.php';
$Fun_call = new Functions();

if(isset($_SESSION['user_name']) && isset($_SESSION['user_uni_no'])){
    header('Location:post.php');
}

$u_error = $p_error = $error_msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['submit'])){

        $username = $Fun_call->validate($_POST['username']);
        $password = $Fun_call->validate($_POST['password']);

        $save_cookie = (isset($_POST['savepass']))?($Fun_call->validate($_POST['savepass'])):'';

        if((!preg_match('/^[ ]*$/', $username)) && (!preg_match('/^[ ]*$/', $password))){

            $verify_fields['u_name'] = $username;
            $verify_fields['u_pass'] = $password;
            $verify_user = $Fun_call->user_verify("user",$verify_fields);

            if($verify_user){
                
                $fetch_user_info = $Fun_call->select_assoc('user', $verify_fields);

                if(!empty(trim($save_cookie))){

                    setcookie('username', $username, time()+(365 * 24 * 60), "/");
                    setcookie('userpass', $password, time()+(365 * 24 * 60), "/");

                }

                $_SESSION['user_name'] = $fetch_user_info['u_name'];
                $_SESSION['user_uni_no'] = $fetch_user_info['u_uni_no'];

                header('Location:post.php');

            }
            else{
                $error_msg = "Username and Passwword are Invalid";
            }

        }
        else{

            if(preg_match('/^[ ]*$/', $username)){
                $u_error = "Please Enter Username";
            }
            if(preg_match('/^[ ]*$/', $password)){
                $p_error = "Please Enter Password";
            }

        }
    }
    else{
        $error_msg = "Invalid Request Not Allow";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f124118c9b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<div class="container-fluid login-bg">
    <div class="container ">
        <div class="row">
          <div class="box-container">
            <div class="card w-400">
              <div class="card-body">
                <h5 class="card-title text-center pt-3 pb-3 ">Sign In</h5>
                <hr>
                    <form class="login-box" method="post">

                    <div class="form-label-group">
                        <label for="username"><b>Username</b></label>
                        <input type="text" id="username" name="username" class="form-control mb-2" placeholder="Username" value="<?php echo @$_COOKIE['username']; ?>" autofocus>
                        <span class="error-msg"><?php echo @$u_error; ?></span>
                    </div>
    
                    <div class="form-label-group">
                        <label for="password"><b>Password</b></label>
                        <input type="password" id="password" name="password" class="form-control mb-2" placeholder="Password" value="<?php echo @$_COOKIE['userpass']; ?>">
                        <span class="error-msg"><?php echo @$p_error; ?></span>
                    </div>
    
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="savepass" name="savepass" value="savepass">
                        <label class="custom-control-label" for="savepass">Remember password</label>
                    </div>
                    <span class="error-msg"><?php echo @$error_msg; ?></span>
                    <input class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" value="SUBMIT" type="submit">
                  
                    </form>
              </div>
            </div>
          </div>
        </div>
    </div>   
</div>         
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        

</body>
</html>