<?php include('functions.php'); ?>

<!DOCTYPE html>  

<html>
<head>  

    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sample Page</title> 

    <!--Fonts-->   
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
 
    <!-- CSS Files -->
    <link type="text/css" href="css/fontawesome-all.min.css" rel="stylesheet" />
    <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="css/mdb.min.css" rel="stylesheet" />
    <link type="text/css" href="css/style.css" rel="stylesheet" />
    <link type="text/css" href="css/responsive.css" rel="stylesheet" />

</head>  
 
<!-- Body Start -->
<body class="primary-color-dark text-white mobile_design">
	 
    <!--Login Form Page Start--> 
    <div class="mobile_max">  
                    <?php 
                    /*
                    * User Login  
                    */  
                    if(isset($_POST['login_submit'])) {  

                        $loginstatus = $user->signin();  

                        if($loginstatus>0) {  

                            echo "<div class='alert alert-success text-center'>You are successfully loggedin.</div>" ;  
                            $pageurl = site_url('/chatboard.php');  

                            //Redirect  
                            redirect_script($pageurl);   

                        } else {
                            echo "<div class='alert alert-danger text-center'>Invalid Email/Password.</div>" ;   
                        }
                    } else { 
                        $login = $user->check_login();
                        if($login) {
                            $dashboardurl = site_url('/chatboard.php'); 
                            redirect_script($dashboardurl);    
                        }   
                    }        
                    ?>    
        
                    <!--Login Form Start--> 
                    <form action="" class=" form-design text-dark" method="post" autocomplete="off"> 
                        <h2 class="form-heading text-center">Log in</h2>
                        <!--<div class="form_logo text-center"><img src="http://devwp.tutorsincity.com/wp-content/themes/tutorsincity/images/logo.png" alt="" class="img-fluid" /></div>-->
                        <p class="text-center">You will get access of our Services, Tutorials and Advance Search.</p>
                             
                        <div class="cmd_form">
                            <label><b>Email</b> <span class="text-danger">*</span></label>
                            <input type="text" id="user_email" class="form-control form-control-sm" name="user_email" required="required" />
                        </div> 
                
                        <div class="cmd_form">
                            <label><b>Password</b> <span class="text-danger">*</span></label>  
                            <input type="password" maxlength="10" id="user_password" class="form-control form-control-sm" name="user_password" required="required" />
                        </div>
                         
                        <p class="text-right forget_password"><a class="text-primary font-weight-bold d-inline-block" href="forgot-password.php">Forgot your password?</a></p>
                        
                        <p class="text-center"><button name="login_submit" class="btn btn-primary d-block btn-md w-100" type="submit">Login</button></p>
                        
                        <p class="text-center d-block">Don't have an account? <a class="text-primary font-weight-bold d-inline-block" href="signup.php">Signup</a></p> 
                        
                    </form> 
                    <!--Login Form End--> 
                     
    </div>   
    <!--Login Form Page End-->
 
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>  
    
</body>
<!-- Body End -->

</html>  
        <?php 

     

         
 
