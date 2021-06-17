<?php
    // session_start();
    include 'includes/header.php';
    require '../uploadsDBconfig.php';

?>

 <div class="container grey">
        <div class="row">
            
            <div class="col s12 m10 l10">
                <div id="test1" class="row">
                    <h5 class="center"><i>Images</i></h5>  

                    <?php
                        // $userId = $_SESSION['loggedIn'];
                        $res =  $db->query('SELECT * FROM fileuploads , users');
                        $nmRws = $res->num_rows;
        echo'<table class="striped">
        <tr>
                        <th>S/N</th>
                        <th>fileName</th>
                        <th>category</th>
                        <th>By</th>
                        <th>When</th>
                        <th>Action</th>
                    </tr>
                    <br>';
                        if($nmRws > 0){
                $a = 1;

                             while($row = $res->fetch_assoc()){
                              echo   '<tr>
                                        <td>'.$a.'</td>
                                        <td>'.$row['fileName'].'</td>
                                        <td>'.$row['mediaType'].'</td>
                                        <td>'.$row['firstname'].' '.$row['lastname'].'</td>
                                        <td>'.$row['datePosted'].'</td>
                                        <td data-id="'.$row['id'].'" data-title="'.$row['fileName'].'"  data-category="'.$row['mediaType'].'">
                                            <a href="#"><i class="material-icons">visibility</i></a>
                                            <a href="#" class="showEditBlogModal"><i class="material-icons">edit</i></a>
                                            <a href="#"><i class="material-icons">delete</i></a>
                                        </td>
                                    </tr>';
$a++;
                            }
                        } else {
                echo '<tr><td colspan="5">No blog article created yet.</td></tr>';
            }

            echo '</table>';
                        // else {
                        //     echo '<div class="col l12 center-align"><i>No related post.</i></div>';
                        // }
                    ?>
                    
                </div>
                
                <div id="test2" class="row">
                    <h5 class="center"><i>Audio</i></h5>  
                    <?php
                            $userId = $_SESSION['loggedIn'];
                        $res1 =  $db->query('SELECT * FROM fileuploads WHERE mediaType = "A" AND userId = '.$userId);
                        $nmRws1 = $res1->num_rows;
                                
                        if($nmRws1 > 0){    
                            while($row = $res1->fetch_assoc()){
                                echo  ' <div class="col s12 m12 l6" >
                                            <div> 
                                                <p style="margin-left:12px;"><b>'.substr($row['fileName'], 0, 20).'...</b></p> 
                                            
                                                <audio controls>
                                                    <source media="(min-width:200px)" src="../img/audio/'.$row['fileName'].'" srcset="" sizes="">
                                                </audio> <br>
                                            </div>
                                        </div>';
                            }
                        }
                        //  else {
                        //     echo '<div class="col l12 center-align"><i>No related post.</i></div>';
                        // }
                    ?>
                    <?php
                        echo '<p><a href=""><i class="material-icons medium">account_circle</i></a></p>';
                        echo  "Hi $names welcome to our page";
                    ?>
                    
                </div>

                <!-- <div id="test3" class="col s12">Test 3</div> -->
            

                
                <div id="test4" class="row">
                    <h5 class="center"><i>Videos</i></h5>
                    <?php
                    $userId = $_SESSION['loggedIn'];
                       $res2 =  $db->query('SELECT * FROM fileuploads WHERE mediaType = "V" AND userId = '.$userId);
                       $nmRws2 = $res2->num_rows;

                       if($nmRws2 > 0){    
                         while($row = $res2->fetch_assoc()){ 
                            
                         echo    '<div class="col s12 m6 l4">
                                 <p style="margin-left:12px;"><b>'.substr($row['fileName'], 0, 20).'...</b></p> 
                                    <video  controls poster="../img/bbb.jpg"  height="300px" width="80%">
                                        <source src="../img/video/'.$row['fileName'].'" >                            
                                    </video>
                                </div>';
                            }
                        } 
                        // else {
                        //     echo '<div class="col l12 center-align"><i>No related post.</i></div>';
                        // }

                    ?>
                </div>
            </div>

            <div class="col s12 m2 l2 light-green" style="margin-top:3.5rem;">
                <section>
                    <h6><b>USERS</b></h6>
                    <hr>
                  <?php
                      $res3 = $db->query('SELECT * FROM users');
                      $nmRws3 = $res3->num_rows;
                        if($nmRws3 > 0){
                            while($row = $res3->fetch_assoc()){

                                $userNameId = $row['id'];
                                $firstname = $row['firstname'];
                                $lastname = $row['lastname'];
                            echo    ' <ul class="users">
                                        <li><i><a href="singleFile.php?userId='.$row['id'].'" class="black-text">'.$firstname.' '.$lastname.'</a></i></li>
                                        <li class="divider"></li>
                                        
                                    </ul>';
                            }
                        } 
                        // <a href="singleArticle.php?articleId='.$row['id'].'">Read More</a>
                    ?>
                </section>              
            </div>
        </div>
    </div>










<?php
         include "includes/footer.php";
?>


<!-- ?> -->
 <script src="js/jquery-3.3.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/jbs.js"></script>