<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../fonts/material-icons.css">
    <link rel="stylesheet" href="../css/styles.css">
   
</head>
<body>
<?php
    session_start();//start seesion
    require '../../uploadsDBconfig.php';

    if(isset($_SESSION['loggedIn'])) {
        //Collect data from global session variable
        $fName = $_SESSION['fName'];
        $lName = $_SESSION['lName'];
        $oName = $_SESSION['oName'];
   
        $names = $fName.' '.$lName; 
        // include '../includes/header.php';   
        include 'serverHeader.php';

        if(isset($_GET['fileuploadsId'])){    
          $fileuploadsId = $_GET['fileuploadsId'];

        
            $res = $db->query('SELECT users.*, fileuploads.* FROM users, fileuploads WHERE fileuploads.id =  '.$fileuploadsId.' AND users.id = userId');
            $nmRws = $res->num_rows;
            // print_r($fileuploadsId);
            // if($nmRws > 0){
            //     echo "messi";
            // }else {
            //     echo "waa";
            // }

   
 
     
?>
            <div class="container">
                <div class="row">
                    <div class="col s12">
                
                        <?php
                            if($nmRws > 0){
                                
                                $rw = $res->fetch_assoc();
                                $datePosted = $rw['datePosted'];  
                                $userId = $rw['firstname'];                             
                                $userId1 = $rw['lastname'];
                                $names = $userId.' '.$userId1;
                            
                                echo '<div class="container " >
                                        <div class="row">
                                            <div class="col l12 s12">
                                            <img class="responsive-img materialboxed" data-caption="A NICE PIC -MAGIC"  src="../img/articleImages/'.$rw['fileName'].'" alt=""  width="100%"  style="height: 430px;"/>
                                            </div>
                                        </div>

                                        <div class="desc col s12">                         
                                            <a href="singlePic.php?fileuploadsId='.$rw['id'].'"><b>'.substr($rw['fileName'], 0, 10).'...</b></a>  <br>
                                            <i class="black-text"><small>'.$datePosted.'</small></i> <br>
                                            <i class="black-text"><small>posted by '.$names.'</small></i> 

                                        </div> 
                                    </div> ';
                            } else {
                                echo '<h3>Article does not exist.</h3>';
                                
                            }
                        ?>    

                        <?php
                            // if($nmRws > 0){
                            //     $rw = $res->fetch_assoc();
                            //     // $catId = $rw['catId'];
                            //     //if this article has image
                            //         //display the image

                            //     echo '
                            //         <img class="responsive-img materialboxed" data-caption="A NICE PIC -MAGIC" src="../img/articleImages/'.$rw['fileName'].'" alt="" width="100%"/>
                            //     ';
                

                            // } else {
                            //     echo '<h3>Article does not exist oo.</h3>';
                            // }
                        ?>                                      
                    </div>
                </div>
            </div>

<?php

        }else{
            echo 'Not here';
        }
    }else{
        echo 'NOT HERE 101';
    }
?>
    <footer class="page-footer">  
        <div class="footer-copyright">
            <div  style="width: 90%; margin: 0 auto; max-width: 1280px;">
                © 2014 Copyright Text
                <a class="grey-text text-lighten-4 right" href="#!">More  Links</a>
            </div>
        </div>
    </footer>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/jbs.js"></script>
</body>
</html>