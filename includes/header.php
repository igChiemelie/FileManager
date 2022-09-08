<?php
session_start(); //start seesion
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/materialize.min.css">
    <link rel="stylesheet" href="./fonts/material-icons.css">
    <link rel="stylesheet" href="./css/styles.css">
    <style>
   
       .collection .collection-item {
            padding: 1vh 0.7vw;
        }
        #audios .col h4 {
            font-size: 0.99rem;
            padding: 0 1vw;
        } 
        #audios .col audio {
            max-width: 100%;
            position: relative;
            bottom: 0px;
        }
        .container{
            width:86.55%;
        }
        .zoom img{
            height: 200px;
        }
    </style>
   
</head>
<body>
                            
  <nav class="nav-extended">
        <div class="nav-wrapper container">
            <div class="row">
                <div class="col s4">  
                     <div class=" brand-logo1">
                       <a href="./index.php" class="brand-logo bb left ">Logo</a>
                    </div>
                </div>
                <div class="col s5 m4 l4">
                    <form action="" style="margin-top:10px;">
                        <div class="input-field grey" style='border-radius:50px;'>
                            <input type="search" id="search" required style="height:55px;border-radius:50px;">
                            <label for="search" class="label-icon"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                    </div>
                    </form>
                </div>

                <div class="col s3 m4 l4">
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i class="material-icons right">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <?php
if (isset($_SESSION['loggedIn'])) {
    $fName = $_SESSION['fName'];
    $lName = $_SESSION['lName'];
    $names = $fName . ' ' . $lName;
    echo '<li> <a href=""><i class="material-icons ">account_circle</i></a> </li>';
    echo '<li><a class="dropdown-trigger" href="#!" data-target="userProfile" >' . $names . '<i class="material-icons right">arrow_drop_down</i></a></li>';
}
else {
    echo '<li><a class="modal-trigger" href="#regModal">Login/Register</a></li> ';
}
?>
                    </ul>
                </div>
            </div>
         
         
        
            <div class="nav-content">
                <ul class="tabs tabs-transparent">
                    <li class="tab"><a  class="active" href="#images">IMAGE</a></li>
                    <li class="tab"><a href="#audios">AUDIO</a></li>
                    <li class="tab"><a href="#videos">VIDEOS</a></li>
                </ul>
            </div>
        </div>
  </nav>


  <ul class="sidenav" id="mobile-demo">
     <?php
if (isset($_SESSION['loggedIn'])) {
    echo '<li><a class="dropdown-trigger" href="#!" data-target="userProfile1"><i class="material-icons ">account_circle </i>' . substr($names, 0, 15) . '<i class="material-icons right">arrow_drop_down</i></a></li>';
}
else {
    echo '<li><a class="modal-trigger" href="#regModal">Login/Register</a></li>';
}
?>
        
  </ul>

   <!-- Dropdown Structure -->
    <div>
        <ul id="userProfile" class="dropdown-content">
           <li><a href="./gateway/logout.php">Logout</a></li>    
        </ul>

        <ul id="userProfile1" class="dropdown-content">
            <li><a href="./gateway/logout.php">Logout</a></li>    
        </ul>
    </div>



  <div id="regModal"  class="modal ">
    <div class="modal-content img1">
        <div class="card img1" id="loginCard">
            <div class="card-content ">
            <h4>Login</h4>
                <div class="row">
                    <form class="col s12" id="loginForm" action="gateway/gateway.php" method="POST">
                        <div class="input-field col s6">
                            <input id="loginEmail" name="loginEmail" required placeholder="Email" type="email" class="validate">
                            <label class="black-text"  for="loginEmail">Email</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="loginPassword" name="loginPassword" required placeholder="Password" type="password" class="validate">
                            <label class="black-text"  for="loginPassword">Password</label>
                        </div>
                        <div class="input-field col s12 center-align">
                            <button class="btn waves-effect waves-light" type="submit" name="banye">Login
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                    <p class="center-align">Do not have an Account? <a href="#" id="goToReg">Sign Up</a></p>
                </div>
            </div>
        </div>
        

        <div class="card hide img1" id="regCard">
            <div class="card-content">
                <h4>Create Account</h4>
                <div class="row">
                    <form id="regForm" class="col s12" action="gateway/gateway.php" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="Firstname" required name="firstName" id="firstName" type="text" class="validate">
                                <label  class="black-text" for="firstName">First Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input placeholder="Lastname" required id="lastName" name="lastName" type="text" class="validate">
                                <label class="black-text"  for="lastName">Last Name</label>
                            </div>
                            
                            <div class="input-field col s6">
                                <input name="otherName" id="otherName" placeholder="Othername" type="text">
                                <label class="black-text"  for="otherName">Other Name</label>
                            </div>
                            
                            <div class="input-field col s6">
                                <input id="password" name="password" required placeholder="Password" type="password" class="validate">
                                <label class="black-text"  for="password">Password</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="cPassword" name="cPassword" required placeholder="Confirm Password" type="password" class="validate">
                                <label class="black-text"  for="cPassword">Confirm Password</label>
                            </div>
                            
                            <div class="input-field col s6">
                                <input id="email" name="email" required placeholder="Email" type="email" class="validate">
                                <label class="black-text"  for="email">Email</label>
                            </div>
                            <div class="input-field col s6">
                                <p class="col s4">
                                    <b>Gender: </b>
                                </p>
                                <p class="col s4">
                                    <label class="black-text" >
                                        <input required name="gender" type="radio" value="M" />
                                        <span>Male</span>
                                    </label>
                                </p>
                                <p class="col s4">
                                    <label class="black-text" >
                                        <input required name="gender" type="radio" value="F"/>
                                        <span>Female</span>
                                    </label>
                                </p>
                            </div>
                            <!-- <div class="col s6">
                                <input type="text" name="dob" placeholder="dob" class="datepicker" id="dob">
                                
                            </div> -->
                            <!-- <div class="input-field col s6">
                                <select name="state" id="state">
                                    <option value="">Select State</option>
                                    <option value="">America</option>
                                    <option value="">SWEDEN</option>
                                    <option value="">BULGARIA</option>
                                    <option value="">WALES</option>
                                    <option value="">SCOTLAND</option>
                                    <option value="">CZECH REPUBLIC</option>
                                    <option value="">GERMANY</option>
                                    <option value="">POLAND</option>
                                    <option value="">SPAIN</option>
                                    <option value="">ENGLAND</option>                             
                                </select>
                                <label class="black-text" >State of Origin</label>
                            </div> -->
                            <div class="input-field col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="debanye">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="center-align">Have an Account? <a href="#" id="goToLogin">Login</a></p>
                </div>
            </div>
        </div>
        
    </div>        
</div>

 