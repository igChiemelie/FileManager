<?php
  require "../uploadsDBconfig.php";

  
    include "includes/header.php";
    //  session_start();//start seesion
     

//    if(isset($_SESSION['loggedIn'])) {
//         include 'server/controller.php';
//     }
?>

 
    <div class="container myCard">
        <div class="row">
            
            <div class="col s12 m10 l10 gutter">
                <?php
                    $imgArr = [];
                    $audArr = [];
                    $vidArr = [];

                    // $res = $db->query("SELECT userId, datePosted,mediaType, fileName FROM fileuploads WHERE fileuploads.access = 'Pub' ORDER BY fileuploads.datePosted DESC");
                    $res = $db->query("SELECT CONCAT(users.firstname, ' ', users.lastname) as names, fileuploads.datePosted, fileuploads.mediaType, fileuploads.fileName FROM fileuploads, users WHERE fileuploads.access = 'Pub' AND fileuploads.userId = users.id ORDER BY fileuploads.datePosted DESC ");
                    $rowNum = $res->num_rows;

                    if($rowNum > 0){
                        while($row = $res->fetch_assoc()){
                            if($row['mediaType'] == 'I'){
                                array_push($imgArr, $row);
                            } else if($row['mediaType'] == 'A'){
                                array_push($audArr, $row);
                            } else if($row['mediaType'] == 'V'){
                                array_push($vidArr, $row);
                            }
                        }
                    } else {
                        echo 'No Data';
                    }
                ?>
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
                                echo    '<div>
                                            <div  class="col s10 m6 l3 offset-s1">              
                                                <div class="image-div" >
                                                    <div class="zoom">
                                                        <img class="responsive-img" src="./img/articleImages/'.$imgArr[$a]['fileName'].'" alt="" width="100%"/>
                                                    </div>
                                                </div>  
                                                <div class="desc">
                                                
                                                    <a class="black-text" href="google.com">'.substr($imgArr[$a]['fileName'], 0, 10).'...</a>  <br>
                                                    <i><small>'.$imgArr[$a]['datePosted'].'</small></i> <br>
                                                   <i> <small class="black-text">'.$imgArr[$a]['names'].'</small> </i>
                                                </div>       
                                                        
                                            </div>
                                        </div>';
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
                                echo    '<div class="col s12 m6 l4" >
                                            <div class="gutter2">
                                                <audio controls>
                                                    <source media="(min-width:200px)" src="./img/audio/'.$audArr[$a]['fileName'].'" srcset="" sizes="">
                                                </audio> 
                                                <div class="">
                                                    <h4>'.substr($audArr[$a]['fileName'], 0, 20).'...</h4> 
                                                    <i><small>'.$audArr[$a]['datePosted'].'</small></i> 
                                                </div>
                                            </div>
                                        </div>';
                                $a++;
                            }
                        
                        } else {
                            echo 'No Image yet.';
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
                                echo    '<div class="col s12 m6 l4">
                                            <div class="gutter3">
                                                <video controls poster="./img/bbb.jpg"  height="300px" width="80%" class="video">
                                                    <source src="./img/video/'.$vidArr[$a]['fileName'].'" >                            
                                                </video>
                                                <div class="vid">
                                                    <p>'.substr($vidArr[$a]['fileName'], 0, 20).'...</p> 
                                                    <i><small>'.$imgArr[$a]['datePosted'].'</small></i> 
                                                </div>
                                            </div>
                                        </div>';
                                $a++;
                            }
                        
                        } else {
                            echo 'No Image yet.';
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
                                echo '<a href="server/singleFile.php?userId='.$row['id'].'" class="collection-item">'.$firstname.' '.$lastname.'</a>';
                            }
                            echo '</div>';
                        }                        
                    ?>
                </section>              
            </div>
        </div>
    </div>
    
 
<?php
    // if(isset($_SESSION['loggedIn'])) {
    //     include 'controller.php';
    // }
?>

<?php
         include "includes/footer.php";
?>
  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/jbs.js"></script>
</body>
</html>