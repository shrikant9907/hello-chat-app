<!DOCTYPE html>  

<html>
<head> 

    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <title>Edit Profile</title> 

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
<!--
    <div class="spinner-border text-primary loader_wr" role="status">
        <span class="sr-only">Loading...</span>
    </div> -->
        
    <!--Login Form Page Start--> 
    <div class="mobile_max">  
                    <div class="page-design blue-grey lighten-5 text-dark">
                        
                        <!-- Navbar -->
                        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

                          <!-- Collapse button -->
                          <button class="navbar-toggler nav_left_trigger" type="button">
                            <span class="navbar-toggler-icon"></span>
                          </button>

                          <!-- Collapsible content --> 
                          <div class="collapse nav_left primary-color" id="MobileNavBar"> 
 
                            <!-- Links -->
                            <ul class="navbar-nav m-auto"> 
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.html"><i class="fas fa-home"></i>Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="edit-profile.html"><i class="fas fa-user-edit"></i>Edit Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="offers.html"><i class="fas fa-ticket-alt"></i>Offers</a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link" href="blog.html"><i class="fab fa-blogger-b"></i>Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="store.html"><i class="fas fa-store"></i>Store</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="change-password.html"><i class="fas fa-key"></i>Change Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="change-city.html"><i class="fas fa-map-marker-alt"></i>Change City</a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link" href="feedback.html"><i class="fas fa-comments"></i>Feedback</a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link" href="promote-us.html"><i class="fas fa-share-alt"></i>Promote Us</a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link" href="settings.html"><i class="fas fa-cog"></i>Settings</a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html"><i class="fas fa-phone"></i>Contact Us</a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.html"><i class="fas fa-sign-out-alt"></i>Logout</a>
                                </li>
                                <li class="nav-item"> 
                                    <a class="nav-link" href="login.html"><i class="fas fa-sign-in-alt"></i>Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="signup.html"><i class="fas fa-user-plus"></i>Create account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="forgot-password.html"><i class="fas fa-unlock-alt"></i>Forgot Password</a>
                                </li>
                            </ul>
                            <!-- Links -->  
                            
                          </div>
                          <!-- Collapsible content -->

                        </nav>
                        <!-- Navbar -->
                        
                        <h2 class="form-heading text-center"><a href="javascript:history.go(-1);" class="last_open_page"><i class="fas fa-arrow-left"></i></a>Edit Profile</h2>
                        
                          <!--Edit Profile-->
                                <form action="" class=" full-width-form mb-0" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" value="<?php echo $uid; ?>"  />
                                    <div class="row">
                                        <div class="col-12 text-center mb-3"> 
                                            <img src="http://devwp.tutorsincity.com/wp-content/themes/tutorsincity/images/logo.png" alt="" width="100" class="img-thumbnail img-circle img-fluid" />
                                        </div>    
                                        <div class="col-12">
                                            <label>Edit Profile Picture (.jpg, .jpeg and .png)  <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="profile_pic" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="md-form"> 
                                        <input type="text" class="form-control" value="" name="firstname" required="required" autofocus />
                                        <label>First Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="md-form">
                                        <input type="text" class="form-control" value="" name="lastname" required="required" />
                                        <label>Last Name <span class="text-danger">*</span></label>
                                    </div>
                     
                                    <div class="md-form"> 
                                        <input type="email" class="form-control" value="" name="email" required="required"  />
                                        <label>Email Address<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="row">    
                                        <div class="col-12">
                                                <label>User Role<span class="text-danger">*</span></label>
                                        </div>      
                                        <div class="col-12">  
                                            <div class="form-group">
                                                <select class="custom-select" id="user_role" name="role">  
                                                    <option value="author">Author</option>   
                                                 </select>  
                                            </div>    
                                        </div>  
                                    </div> 

                                    <div class="row">
                                        <div class="col-12"> 
                                            <button name="update_user" class="btn btn-primary btn-sm mt-0 w-100" type="submit">Update</button>
                                            <!--<button name="delete_user" class="btn btn-danger btn-inline-block btn-sm float-right mr-2" type="submit">Delete</button>-->
                                        </div> 
                                    </div>

                                </form>

                    </div>

    </div>   
  
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>  
    <script type="text/javascript" src="js/script.js"></script>  
    
</body>
<!-- Body End -->

</html>   
                        

               