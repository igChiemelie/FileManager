<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../fonts/material-icons.css">
    <link rel="stylesheet" href="../css/styles.css"> -->
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

        if(isset($_GET['userId'])){    
          $userId = $_GET['userId'];
    
        
            $imgArr = [];
            $audArr = [];
            $vidArr = [];
           
            $imgLen = count($imgArr);

            // $res =  $db->query('SELECT * FROM fileuploads WHERE  userId = '.$userId.' ORDER BY datePosted DESC');
            $res =  $db->query('SELECT fileuploads.id, users.username, fileuploads.mediaType,fileuploads.fileName,fileuploads.datePosted, fileuploads.title, fileuploads.userId FROM users,fileuploads WHERE users.id =  '.$userId.' AND fileuploads.userId = '.$userId.' ORDER BY fileuploads.datePosted DESC');
            $nmRws = $res->num_rows;
      

            if($nmRws > 0){
                while($row = $res->fetch_assoc()){
                    // $mediaType = $row['mediaType'];
                            if($row['mediaType'] == 'I' ){
                                array_push($imgArr, $row);
                            } else if($row['mediaType'] == 'A'){
                                array_push($audArr, $row);
                            } else if($row['mediaType'] == 'V'){
                                array_push($vidArr, $row);
                            }
                    
                }
                // print_r($imgArr); 
                // var_dump($imgArr);
                
            }else {
               echo  'no data';
            }

           
?>  
        <div class="container myCard1">  
            <div class="row">
                <div class="col s12 m10 l10">
                    <div id="images" class="row">
                        <?php
                            $imgArrLen = count($imgArr);
                            if($imgArrLen > 0){
                                // print_r($imgArr);
                                $a = 0;
                                while($a < $imgArrLen){
                                    if($a == 8){
                                        break;
                                    }

                                    echo '
                                            <div  class="col s10 m6 l3 offset-s1">
                                                <div class="card ">
                                                    <div class="card-image  wave-effect waves-block waves-light">
                                                        <img class="responsive-img materialboxed" data-caption="A NICE PIC -MAGIC" src="../img/articleImages/'.$imgArr[$a]['fileName'].'" alt="" width="100%"/>
                                                    </div>
                                                    <div class="card-content">
                                                        <span class="card-title activator grey-text text-darken-4">'.substr($imgArr[$a]['fileName'], 0, 10).'<i class="material-icons right">more_vert</i></span>
                                                        <p><a href="./singlePic.php?fileuploadsId='.$imgArr[$a]['id'].'">View</a></p>
                                                    </div>
                                                    <div class="card-reveal">
                                                        <span class="card-title grey-text text-darken-4">'.substr($imgArr[$a]['fileName'], 0, 10).'<i class="material-icons right">close</i></span>
                                                        <p>'.$imgArr[$a]['title'].'</p>

                                                            <p>'.$imgArr[$a]['username'].'</p>
                                                        <p>'.$imgArr[$a]['datePosted'].'</p>                                                
                                                    </div>
                                                </div>
                                            </div>
                                    ';
                                    $a++;
                                }
                            
                            } else {
                                echo 'No Image yet.';
                            }
                        ?>

                        <div class="row">
                            <div class="col s12 center gutter">
                                <a href="viewMore.php">View more..</a>
                            </div>
                        </div>                                              
                            
                    </div>
            
                    <div id="audios" class="row">
                        <?php
                            $audArrLen = count($audArr);
                            if($audArrLen > 0){
                                
                                $a = 0;
                                while($a < $audArrLen){
                                    if($a == 8){
                                        break;
                                    }
                                    
                                    echo '<div class="col s12 m6 l4" >
                                            <div class="card gutter2 grey">
                                                <div class="card-image  wave-effect waves-block waves-light">
                                                    <audio controls >
                                                        <source media="(min-width:200px)" src="../img/audio/'.$audArr[$a]['fileName'].'" srcset="" sizes="">
                                                    </audio> 
                                                </div>
                                                <div class="card-content">
                                                    <span class="card-title activator grey-text text-darken-4">'.substr($audArr[$a]['fileName'], 0, 10).'<i class="material-icons right">more_vert</i></span>
                                                    <p><a href="#">View</a></p>
                                                </div>
                                                <div class="card-reveal">
                                                    <span class="card-title grey-text text-darken-4">'.substr($audArr[$a]['fileName'], 0, 10).'<i class="material-icons right">close</i></span>
                                                    <ul>
                                                        <li>'.$audArr[$a]['username'].'</li>
                                                        <li>'.$audArr[$a]['datePosted'].'</li> <br>
                                                        <li class="center"><a href="#">View</a></li>
                                                    </ul>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    ';
                                    $a++;
                                }
                            
                            } else {
                                echo 'No Audio yet.';
                            }
                        ?>

                        <div class="row">
                            <div class="col s12 center gutter">
                                <a href="MoreAudios.php">View more..</a>
                            </div>
                        </div>  
                            
                    </div>

                    <div id="videos" class="row">
                        <?php
                            $vidArrLen = count($vidArr);
                            if($vidArrLen > 0){
                                
                                $a = 0;
                                while($a < $vidArrLen){
                                    if($a == 8){
                                        break;
                                    }
                                

                                    echo '<div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="card-image wave-effect waves-block waves-light ">
                                                    <video controls poster="../img/bbb.jpg"  height="300px" width="80%" class="video materialboxed hide-on-med-and-down " data-caption="A NICE PIC -MAGIC">
                                                            <source src="../img/video/'.$vidArr[$a]['fileName'].'" >                            
                                                    </video>
                                                    <video controls poster="../img/bbb.jpg"  height="200px" width="58%" class="video materialboxed  hide-on-large-only" data-caption="A NICE PIC -MAGIC">
                                                        <source src="../img/video/'.$vidArr[$a]['fileName'].'" >                            
                                                    </video>
                                                </div>
                                                <div class="card-content">
                                                    <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
                                                    <p><a href="#">This is a link</a></p>
                                                </div>
                                                <div class="card-reveal">
                                                    <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                                                    <p>Here is some more information about this product that is...</p>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                    $a++;
                                }
                            
                            } else {
                                echo 'No Video yet.';
                            }
                        ?>

                        <div class="row">
                            <div class="col s12 center">
                                <a href="MoreVIdeos.php">View more..</a>
                            </div>
                        </div> 
                    </div>

                </div> 
                    
                <div class="col s12 m2 l2 light-green">
                    <section>
                        <h4>USERS</h4>
                        <?php
                            $res3 = $db->query('SELECT * FROM users');
                            $nmRws3 = $res3->num_rows; 
                            if($nmRws3 > 0){
                                echo    '<div class="collection">';
                                while($row = $res3->fetch_assoc()){

                                    $userNameId = $row['id'];
                                    $firstname = $row['firstname'];
                                    $lastname = $row['lastname'];
                                    echo '<a href="./singleFile.php?userId='.$row['id'].'" class="collection-item">'.$firstname.' '.$lastname.'</a>';
                                }
                                echo '</div>';
                            }                        
                        ?>
                    </section>              
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