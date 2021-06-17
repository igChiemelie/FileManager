<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Tutorial - Form Handling</title>
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../fonts/material-icons.css">
    <link rel="stylesheet" href="../css/styles.css">
     <style>
            .desc{
        text-align: center;
        color: white;
        }
        .image-div{
        border: 2px solid white;
        width: 200px;
        box-shadow: 0 0 10px white;
        border-radius: 15px;
        /* padding: 2px; */
        float: left;
        }

        .zoom{
        width:195px;
        height:200px;
        overflow: hidden;
        border-radius: 15px;
        }
        .zoom img{
        max-width:100%;
        max-height:100%;
        transition: all 0.9s;

        }
        .zoom:hover img{
        transform: scale(1.3,1.3);
        /* transform: scale(2.3,5); */
        cursor: pointer;
        }
        .container{
        width:80%;
        }
    </style>
</head>
<body>

 <nav class="nav-extended">
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s4">  
                     <div class=" brand-logo1">
                       <a href="../index.php" class="brand-logo bb left">Logo</a>
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
                        <!-- <li><a class="modal-trigger" href="#regModal">Login/Register</a></li>  -->
                        <?php
                            if(isset($_SESSION['loggedIn'])) {
                                echo '<li> <a href=""><i class="material-icons ">account_circle</i></a> </li>';
                                echo '<li><a class="dropdown-trigger" href="#!" data-target="userProfile" >'.$names.'<i class="material-icons right">arrow_drop_down</i></a></li>';
                            } else {
                                echo '<li><a href="../index.php">Back To Homepage</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
         
         
        
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a  href="#test1">IMAGE</a></li>
                <li class="tab"><a class="active" href="#test2">AUDIO</a></li>
                <li class="tab disabled"><a href="#test3">Disabled Tab</a></li>
                <li class="tab"><a href="#test4">VIDEOS</a></li>
            </ul>
        </div>
  </nav>
  
 

    <ul class="sidenav" id="mobile-demo">
        <!-- <li><a class="modal-trigger" href="#regModal">Login/Register</a></li> -->
        <?php
            if(isset($_SESSION['loggedIn'])) {
                echo '<li><a class="dropdown-trigger" href="#!" data-target="userProfile1"><i class="material-icons ">account_circle </i>'.$names.'<i class="material-icons right">arrow_drop_down</i></a></li>';
            } else {
                echo '<li><a href="../index.php">Back To Homepage</a></li>';
            }
        ?>
        
    </ul>

    <!-- Dropdown Structure -->
    <div>
        <ul id="userProfile" class="dropdown-content">
           <li><a href="./logout.php">Logout</a></li>    
        </ul>

        <ul id="userProfile1" class="dropdown-content">
            <li><a href="./logout.php">Logout</a></li>    
        </ul>
    </div>



    
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/jbs.js"></script>