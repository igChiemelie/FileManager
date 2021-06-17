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
        html{
            position: relative;
            min-height: 100%;
        }
        .redd{
        /* background: linear-gradient(rgb(69, 209, 51),rgb(82, 163, 196)); */
        /* background: linear-gradient(rgb(151, 250, 138),rgb(180, 229, 248)); */
        background: #393f42ba;

        /* background-color: green; */
        }
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
        img.responsive-img, video.responsive-video {
           /* height: 80vh; */
        }
        .video{
        border-radius:6px;
        margin-left: 30px; 
        }
            .myCard1{
            /* border: thin solid #ddd; */
        }
        .container{
            width:86.55%;
            box-shadow: 0 0 3px black;
            /* box-shadow: -10px -10px 10px black; */
            border-radius: 5px;

        }
       
        footer{
            position: absolute;
            bottom:0;
            width: 100%;
        }
    </style>
     
</head>
<body>

<nav class="nav-extended">
    <div class="nav-wrapper container">
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
                    <li class="tab"><a  class="active" href="#images">IMAGE</a></li>
                    <li class="tab"><a href="#audios">AUDIO</a></li>
                    <li class="tab"><a href="#videos">VIDEOS</a></li>
                </ul>
            </div>
        
    </div>
        
</nav>
  
 

    <ul class="sidenav" id="mobile-demo">
        <!-- <li><a class="modal-trigger" href="#regModal">Login/Register</a></li> -->
        <?php
            if(isset($_SESSION['loggedIn'])) {
                echo '<li><a class="dropdown-trigger" href="#!" data-target="userProfile1"><i class="material-icons ">account_circle </i>'.substr($names, 0, 15).'<i class="material-icons right">arrow_drop_down</i></a></li>';
            } else {
                echo '<li><a href="../index.php">Back To Homepage</a></li>';
            }
        ?>
        
    </ul>

    <!-- Dropdown Structure -->
    <div>
        <ul id="userProfile" class="dropdown-content">
           <li><a href="../gateway/logout.php">Logout</a></li>    
        </ul>

        <ul id="userProfile1" class="dropdown-content">
            <li><a href="../gateway/logout.php">Logout</a></li>    
        </ul>
    </div>

   
 

    
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/jbs.js"></script>


    
</body>
</html>