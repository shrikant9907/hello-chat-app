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
<body class="mobile_design">
	 
    <!--Login Form Page Start--> 
    <div class="mobile_max"> 
                    <?php  
 
                    /*  
                     * User Signup   
                     */  
//                    if(isset($_POST['register_submit'])) {   
//                        
//                        $loginstatus = $user->signup();  
//                         
//                        if($loginstatus>0) { 
//                            
//                            $pageurl = site_url('/');   
//                            echo "<div class='alert alert-success text-center'>Your account has been created. <a href='".$pageurl."'>Login here</a></div>" ;   
//                        
//                        } else {  
//                            echo "<div class='alert alert-danger text-center'>User already exists with given email address.</div>" ;   
//                        }
//                    } else { 
//                        $login = $user->check_login(); 
//                        if($login) {
//                            $dashboardurl = site_url('/chatboard.php'); 
//                            redirect_script($dashboardurl);  
//                    
//                    }   
//                    }   
                    ?>   
        
                    <!--Signup Form Start-->
                    <form action="" class="form-design text-dark" method="post" autocomplete="off"> 
                        <input type="hidden" value="user" name="user_role" />   
                        <h2 class="form-heading text-center">Create an account</h2>
                        <!--<div class="form_logo text-center"><img src="http://devwp.tutorsincity.com/wp-content/themes/tutorsincity/images/logo.png" alt="" class="img-fluid" /></div>-->
                        <p class="text-center">Enter your details to create an account.</p>
                            
                        <div class="cmd_form">
                            <label><b>First Name</b> <span class="text-danger">*</span></label>
                            <input type="text" id="first_name" class="form-control form-control-sm" name="first_name" required="required" />
                        </div> 
                      
                        <div class="cmd_form">
                            <label><b>Last Name</b> <span class="text-danger">*</span></label>
                            <input type="text" id="last_name" class="form-control form-control-sm" name="last_name" required="required" />
                        </div> 
               
                        <div class="cmd_form"> 
                            <label><b>Email</b> <span class="text-danger">*</span></label>
                            <input type="email" id="user_email" class="form-control form-control-sm" name="user_email" required="required" />
                        </div> 
                
                        <div class="cmd_form">
                            <label><b>Password</b> <span class="text-danger">*</span></label>  
                            <input type="password" maxlength="10" id="user_password" class="form-control form-control-sm" name="user_password" required="required" />
                        </div>
                        
                        <p class="text-center"><button name="register_submit" class="btn btn-primary d-block btn-md w-100" type="submit">Register</button></p>
                        
                        <p class="text-center d-block">Already have an account? <a class="text-primary font-weight-bold d-inline-block" href="<?php echo site_url(); ?>">Login</a></p> 
                        
                    </form> 
                    <!--Signup Form End--> 
                    
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
