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

    if(isset($_SESSION['loggedIn'])) {
        //Collect data from global session variable
        $fName = $_SESSION['fName'];
        $lName = $_SESSION['lName'];
        $oName = $_SESSION['oName'];
   
        $names = $fName.' '.$lName; 
        $userId = $_SESSION['id'];
        // include '../includes/header.php';   
        include 'serverHeader.php';
    ?>
    

    <div class="container myCard1">
        <div class="row redd">
            <div class="col s11 m12 l9 offset-l2  ">
                <div class="">
                    <form action="controller.php" method="POST" id="makeArticle" enctype="multipart/form-data">
                        <div class="input-field col s12 m8 l8">
                            <textarea id="title" class="materialize-textarea"  data-length="40" max-length="40" required ></textarea>
                            <label for="title">Say Something About Your Pics..</label>
                        </div>
                        <div class="file-field input-field col s9 m6 l6">
                           
                            <div class="btn">
                                <span>PICK FILE</span>
                                <input type="file" name="articleImg" >
                            </div>
                            <div class="file-path-wrapper white-text">
                                <input class="file-path  validate" type="text" required>
                                <label class="red-text">Size:Less than 500kb, Dim:1000x500pixels</label>
                            </div>
                        </div>
                        
                        <div class="input-field col s3 m6 l6">
                            <button class="btn waves-effect waves-light " type="submit">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>

                         
                    </form>
                </div>
            </div>
        </div>
        <div class="row ">
            
            <div class="col s12 m10 l10">
                <div id="images" class="row">
                      <br>

                    <?php
                    require '../../uploadsDBconfig.php';
                        $res =  $db->query('SELECT users.id,fileuploads.id, fileuploads.mediaType,fileuploads.fileName,fileuploads.datePosted,fileuploads.userId FROM users,fileuploads WHERE users.id = "'.$userId.'" AND fileuploads.userId = userId ORDER BY fileuploads.datePosted DESC');
                        $nmRws = $res->num_rows;

                        if($nmRws > 0){
                             while($row = $res->fetch_assoc()){
                                  $fileuploadsId = $row['userId'];
                                  $mediaType = $row['mediaType'];
                                  if( $mediaType == 'I' ){
                              echo      '

                                        <div  class="col s10 m6 l3 offset-s1">
                                            <div class="card ">
                                                <div class="card-image  wave-effect waves-block waves-light">
                                                    <img class="responsive-img materialboxed" data-caption="A NICE PIC -MAGIC" src="../img/articleImages/'.$row['fileName'].'" alt="" width="100%"/>
                                                </div>
                                                <div class="card-content">
                                                    <span class="card-title activator grey-text text-darken-4">'.substr($row['fileName'], 0, 10).'<i class="material-icons right">more_vert</i></span>
                                                    <p><a href="singlePic.php?fileuploadsId='.$row['id'].'">View</a></p>
                                                    
                                                </div>
                                                <div class="card-reveal">
                                                    <span class="card-title grey-text text-darken-4">'.substr($row['fileName'], 0, 10).'<i class="material-icons right">close</i></span>
                                                   
                                                    <p>'.$row['datePosted'].'</p>                                                
                                                </div>
                                            </div>
                                        </div>';
                                         // <p>'.$row['title'].'</p>
                                                    // <p>'.$row['names'].'</p>
                                        // <div>
                                        //     <div  class="col s10 m6 l3">              
                                        //         <div class="image-div" >
                                        //             <div class="zoom">
                                                    // <img class="responsive-img" src="../img/articleImages/'.$row['fileName'].'" alt="" width="100%"/>

                                        //             </div>
                                        //         </div>    
                                        //          <div class="desc"> 
                                        //             <a href="singlePic.php?fileuploadsId='.$row['id'].'"><b>'.substr($row['fileName'], 0, 10).'...</b></a> <br>
                                        //             <i><small>'.$row['datePosted'].'</small></i>
                                        //         </div>
                                                                
                                        //     </div>
                                        // </div> ';
                                  }

                            }
                        }
                    ?>
                    
                </div>
                
                <div id="audios" class="row">
                       <br>

                    <?php
                         require '../../uploadsDBconfig.php';
                      $res1 =  $db->query('SELECT users.id, fileuploads.mediaType,fileuploads.fileName,fileuploads.datePosted,fileuploads.userId FROM users,fileuploads WHERE users.id = "'.$userId.'" AND fileuploads.userId = userId ORDER BY fileuploads.datePosted DESC');
                      $nmRws1 = $res1->num_rows;
                            
                    if($nmRws1 > 0){    
                       while($row = $res1->fetch_assoc()){
                            $fileuploadsId = $row['userId'];
                           $mediaType = $row['mediaType'];
                                  if( $mediaType == 'A' ){
                            echo  ' <div class="col s12 m6 l4" >
                                        <div class="card gutter2 grey">
                                            <div class="card-image  wave-effect waves-block waves-light">
                                                <audio controls >
                                                    <source media="(min-width:200px)" src="../img/audio/'.$row['fileName'].'" srcset="" sizes="">
                                                </audio> 
                                            </div>
                                            <div class="card-content">
                                                <span class="card-title activator grey-text text-darken-4">'.substr($row['fileName'], 0, 10).'<i class="material-icons right">more_vert</i></span>
                                                <p><a href="#">View</a></p>
                                            </div>
                                            <div class="card-reveal">
                                                <span class="card-title grey-text text-darken-4">'.substr($row['fileName'], 0, 10).'<i class="material-icons right">close</i></span>
                                                <ul>
                                                    <li>'.$row['datePosted'].'</li> <br>
                                                    <li class="center"><a href="#">View</a></li>
                                                </ul>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>';

                                    

                                        // <div> 
                                        //     <p style="margin-left:12px;" ><a class="red-text text-darken-4" href="singlePic.php?fileuploadsId='.$row['id'].'"><b>'.substr($row['fileName'], 0, 20).'...</b> </a> </p> 
                                           
                                        //     <audio controls>
                                        //         <source media="(min-width:200px)" src="../img/audio/'.$row['fileName'].'" srcset="" sizes="">
                                        //     </audio> <br>
                                        // </div>
                                }
                        }
                    }
                    ?>
                    <?php
                        echo '<p><a href=""><i class="material-icons medium">account_circle</i></a></p>';
                        echo  "Hi $names welcome to our page";
                    ?>
                    
                </div>

            

                
                <div id="videos" class="row">
                   <br>
                    <?php
                       $res2 =  $db->query('SELECT users.id, fileuploads.mediaType,fileuploads.fileName,fileuploads.datePosted,fileuploads.userId FROM users,fileuploads WHERE users.id = "'.$userId.'" AND fileuploads.userId = userId ORDER BY fileuploads.datePosted DESC');
                       $nmRws2 = $res2->num_rows;

                       if($nmRws2 > 0){    
                         while($row = $res2->fetch_assoc()){ 
                              $fileuploadsId = $row['userId'];
                              $mediaType = $row['mediaType'];
                            if($mediaType == 'V'){
                            
                      
                             echo '<div class="col s12 m6 l4">
                                        <div class="card">
                                            <div class="card-image wave-effect waves-block waves-light  ">
                                                <video controls poster="../img/bbb.jpg"  height="300px" width="80%" class="video materialboxed hide-on-med-and-down" data-caption="A NICE PIC -MAGIC">
                                                        <source src="../img/video/'.$row['fileName'].'" >                            
                                                </video>
                                                <video controls poster="../img/bbb.jpg"  height="200px" width="58%" class="video materialboxed hide-on-large-only" data-caption="A NICE PIC -MAGIC">
                                                    <source src="../img/video/'.$row['fileName'].'" >                            
                                                </video>
                                            </div>
                                            <div class="card-content">
                                                <span class="card-title activator grey-text text-darken-4"><p>'.substr($row['fileName'], 0, 20).'...</p><i class="material-icons right">more_vert</i></span>
                                                <p><a href="singlePic.php?fileuploadsId='.$row['id'].'">This is a link</a></p>
                                            </div>
                                            <div class="card-reveal">
                                                <span class="card-title grey-text text-darken-4"><p>'.substr($row['fileName'], 0, 20).'...</p><i class="material-icons right">close</i></span>
                                                <p>Here is some more information about this product that is...</p>
                                            </div>
                                        </div>
                                    </div>';

                                //         <div class="col s12 m6 l4">
                                //  <p style="margin-left:12px;"> <a class="black-text" href="singlePic.php?fileuploadsId='.$row['id'].'"><b>'.substr($row['fileName'], 0, 20).'...</b></a> </p> 
                                //     <video  controls poster="../img/bbb.jpg"  height="300px" width="80%">
                                //         <source src="../img/video/'.$row['fileName'].'" >                            
                                //     </video>
                                // </div>';
                                }
                            }
                        }

                    ?>
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
        //  $a = array('red','green');
        //  array_push( $a,'blue','yellow');
        //  print_r($a);
    
    } else {
        header('location: ../index.php');
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
