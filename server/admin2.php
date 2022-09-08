<?php
    session_start();
    require '../../uploadsDBconfig.php';

    if(isset($_SESSION['loggedIn'])) {
        //Collect data from global session variable
        $fName = $_SESSION['fName'];
        $lName = $_SESSION['lName'];
        $oName = $_SESSION['oName'];
   
        $names = $fName.' '.$lName; 
        // $userId = $_SESSION['id'];
        // include '../includes/header.php';   
        // include 'serverHeader.php';
        include 'serverHeader.php';

?>

    <div class="container grey">
        <div class="row">
            <?php
                $imgArr = [];
                $audArr = [];
                $vidArr = [];

                // $res = $db->query("SELECT userId, datePosted,mediaType, fileName FROM fileuploads WHERE fileuploads.access = 'Pub' ORDER BY fileuploads.datePosted DESC");
                // $res = $db->query("SELECT users.*, fileuploads.* FROM fileuploads, users WHERE fileuploads.access = 'Pub' AND fileuploads.userId = users.id ORDER BY fileuploads.datePosted DESC");
                $res = $db->query("SELECT CONCAT(users.firstname, ' ', users.lastname) as names, fileuploads.datePosted, fileuploads.mediaType, fileuploads.fileName, fileuploads.title,fileuploads.id FROM fileuploads, users WHERE fileuploads.access = 'Pub' AND fileuploads.userId = users.id ORDER BY fileuploads.datePosted  DESC");
                $rowNum = $res->num_rows;

                if($rowNum > 0){
                    while($row = $res->fetch_assoc()){
                        if($row['mediaType'] == 'I' ){
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

            <div class="col s12 m10 l10">
                <div id="images" class="row">
                    
                    <?php
                        echo'<div class="col s12">
                        <table class="striped responsive-table">
                            <tr>
                                <th>S/N</th>
                                <th>title</th>
                                <th>fileName</th>            
                                <th>category</th>
                                <th>fileuploadsId</th>
                                <th>By</th>
                                <th>When</th>
                                <th>Action</th>
                            </tr>
                            <br>';
                            $imgArrLen = count($imgArr);
                            if($imgArrLen > 0){
                                
                                $a = 1;
                                $b = 0;

                                while($b < $imgArrLen ){
                                    //   var_dump($imgArr);
                                    //   print_r($imgArr);

                                    
                                    // if($b == 8){
                                    //     break;
                                    // }  <td>'.$imgArr[$b]['fileName'].'</td>  
                                    //  .substr($imgArr[$b]['fileName'], 0, 10).
                                echo  '<tr>
                                            <td>'.$a.'</td>                          
                                            <td>'.$imgArr[$b]['title'].'</td>
                                            <td>'.substr($imgArr[$b]['fileName'], 0, 30).'</td>          
                                            <td>'.$imgArr[$b]['mediaType'].'</td>
                                            <td>'.$imgArr[$b]['id'].'</td>
                                            <td>'.$imgArr[$b]['names'].'</td>
                                            <td>'.$imgArr[$b]['datePosted'].'</td>
                                            <td data-id="'.$imgArr[$b]['id'].'" data-categories="'.$imgArr[$b]['mediaType'].'">
                                                <a href="#"><i class="material-icons">visibility</i></a>
                                                <a href="#" class="showEditImgModal" data-value="'.$imgArr[$b]['fileName'].'"  data-title="'.$imgArr[$b]['title'].'"><i class="material-icons">edit</i></a>
                                                <a href="#" class="showDeleteBlogModal"><i class="material-icons">delete</i></a>
                                            </td>
                                        </tr>';
                                    $a++;
                                    $b++; 
                                }
                            } else {
                                echo '<tr><td colspan="5">No related post.</td></tr>';
                            }

                        echo '</table>
                            </div>';
                        // }else {
                        //     echo '<div class="col l12 center-align"><i>No related post.</i></div>';
                        // }
                        echo '  <!-- Delete Modal Structure -->
                            <div id="delArtModal" class="modal">
                                <div class="modal-content center-align">
                                    <h4>Delete Picture Uploads</h4>
                                    <p>Are you sure you want to to delete this file: <b><span id="delArticleTitle"></span></b>
                                    <input type="hidden" id="delArticleId"/>
                                    <p>
                                        <a class="waves-effect waves-light btn red" id="deleteArticle"><i class="material-icons left">thumb_up</i>Yes</a>
                                        <a class="waves-effect waves-light btn-flat yellow" id="cancelDel" ><i class="material-icons left">thumb_down</i>No</a>
                                    </p>
                                </div>        
                        </div>';

                            echo '  <!-- Edit Modal Structure -->
                            <div id="editModal1" class="modal">
                                <div class="modal-content">
                                    <h4>Edit Blog Article</h4>
                                    

                                    <form action="controller.php" method="POST" id="editForm"  enctype="multipart/form-data">
                                    
                                        <div class="input-field col s12 m8 l8">
                                            <textarea id="title" placeholder="Say Something About Your Pics.." class="materialize-textarea" data-length="40"
                                                required></textarea>
                                    
                                        </div>
                                       
                                     
                                        <div class="file-field input-field col s9 m6 l6">
                                    
                                            <div class="btn">
                                                <span>PICK FILE</span>
                                                <input type="file" id="editFile" name="articleImgg">
                                            </div>
                                            <input type="hidden" id="editFileId" />
                                            <div class="file-path-wrapper white-text">
                                                <input class="file-path  validate" type="text" required>
                                                <label class="red-text">Size:Less than 500kb, Dim:1000x500pixels</label>
                                            </div>
                                        </div>
                                    
                                        <div class="input-field col s3 m6 l6">
                                            <button class="btn waves-effect waves-light" type="submit">Submit
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </form>

                                </div>        
                            </div>';
                    ?>
                </div>
                
                <div id="audios" class="row">
                  
                    <?php
                       echo'<div class="col s12">
                         <table class="striped responsive-table">
                            <tr>
                                <th>S/N</th>      
                                <th>title</th>
                                <th>fileName</th>              
                                <th>category</th>
                                <th>fileuploadsId</th>
                                <th>By</th>
                                <th>When</th>
                                <th>Action</th>
                            </tr>
                            <br>';
                            $audArrLen = count($audArr);
                            if($audArrLen > 0){
                                
                                $a = 1;
                                $b = 0;

                                while($b < $audArrLen ){
                                    //   var_dump($imgArr);
                                    //   print_r($imgArr);

                                    
                                    // if($b == 8){
                                    //     break;
                                    // }
                                echo  '<tr>
                                            <td>'.$a.'</td>
                                            <td>'.$audArr[$b]['title'].'</td>
                                            <td>'.$audArr[$b]['fileName'].'</td>
                                            <td>'.$audArr[$b]['mediaType'].'</td>
                                            <td>'.$audArr[$b]['id'].'</td>
                                            <td>'.$audArr[$b]['names'].'</td>
                                            <td>'.$audArr[$b]['datePosted'].'</td>
                                            <td data-id="'.$audArr[$b]['id'].'" data-title="'.$audArr[$b]['title'].'" data-article="'.$audArr[$b]['fileName'].'" data-catId="'.$audArr[$b]['mediaType'].'">
                                                <a href="#"><i class="material-icons">visibility</i></a>
                                                <a href="#" class="showEditAudioModal"><i class="material-icons">edit</i></a>
                                                <a href="#" class="showDeleteBlogModal"><i class="material-icons">delete</i></a>
                                            </td>
                                        </tr>';
                                    $a++;
                                    $b++; 
                                }
                            } else {
                                echo '<tr><td colspan="5">No related post.</td></tr>';
                            }

                        echo '</table>
                        </div>';

                        echo '  <!-- Delete Modal Structure -->
                            <div id="delArtModal2" class="modal">
                                <div class="modal-content center-align">
                                    <h4>Delete Audio Uploads</h4>
                                    <p>Are you sure you want to to delete this file: <b><span id="delArticleTitle2"></span></b>
                                    <input type="hidden" id="delArticleId2"/>
                                    <p>
                                        <a class="waves-effect waves-light btn red" id="deleteArticle2"><i class="material-icons left">thumb_up</i>Yes</a>
                                        <a class="waves-effect waves-light btn-flat yellow" id="cancelDel2" ><i class="material-icons left">thumb_down</i>No</a>
                                    </p>
                                </div>        
                            </div>';

                            echo '  <!-- Edit Modal Structure -->
                            <div id="editModal2" class="modal">
                                <div class="modal-content">
                                    <h4>Edit Audios</h4>
                                    

                                    <form action="controller.php" method="POST" id="editForm2"  enctype="multipart/form-data">
                                    
                                        <div class="input-field col s12 m8 l8">
                                            <textarea id="title2" placeholder="Say Something About Your Audio.." class="materialize-textarea" data-length="40"
                                                required></textarea>
                                    
                                        </div>
                                        <div class="input-field col s12">
                                            <select id="editArticleCat2" required>
                                                <option value="-">Choose Category</option>';
                                                $res2 = $db->query('SELECT * FROM categories');
                                                while($rw2 = $res2->fetch_assoc()){
                                                echo '<option value="'.$rw2['id'].'">'.$rw2['mediaType'].'</option>';
                                                }
                                    
                                    
                                                echo '
                                            </select>
                                            <label>Categories</label>
                                        </div>
                                    
                                        <div class="file-field input-field col s9 m6 l6">
                                    
                                            <div class="btn">
                                                <span>PICK FILE</span>
                                                <input type="file" id="editFile2" name="articleImggg">
                                            </div>
                                            <input type="hidden" id="editFileId2" />
                                            <div class="file-path-wrapper white-text">
                                                <input class="file-path  validate" type="text" required>
                                                <label class="red-text">Size:Less than 500kb, Dim:1000x500pixels</label>
                                            </div>
                                        </div>
                                    
                                        <div class="input-field col s3 m6 l6">
                                            <button class="btn waves-effect waves-light" type="submit">Submit
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </form>

                                </div>        
                            </div>';
                    ?>
                    <?php
                        echo '<p><a href=""><i class="material-icons medium">account_circle</i></a></p>';
                        echo  "Hi $names welcome to our page";
                    ?>
                    
                </div>


            

                
                <div id="videos" class="row">
                    
                    <?php
                     echo'<div class="col s12">
                        <table class="striped responsive-table"">
                            <tr>
                                <th>S/N</th>   
                                <th>title</th>
                                <th>fileName</th>
                                <th>category</th>
                                <th>fileuploadsId</th>
                                <th>By</th>
                                <th>When</th>
                                <th>Action</th>
                            </tr>
                            <br>';
                            $vidArrLen = count($vidArr);
                            if($vidArrLen > 0){
                                
                                $a = 1;
                                $b = 0;

                                while($b < $vidArrLen ){
                                    //   var_dump($imgArr);
                                    //   print_r($imgArr);

                                    
                                    // if($b == 8){
                                    //     break;
                                    // }
                                echo  '<tr>
                                            <td>'.$a.'</td>   
                                            <td>'.$vidArr[$b]['title'].'</td>
                                            <td>'.$vidArr[$b]['fileName'].'</td>
                                            <td>'.$vidArr[$b]['mediaType'].'</td>
                                            <td>'.$vidArr[$b]['id'].'</td>
                                            <td>'.$vidArr[$b]['names'].'</td>
                                            <td>'.$vidArr[$b]['datePosted'].'</td>
                                            <td data-id="'.$vidArr[$b]['id'].'" data-title="'.$vidArr[$b]['title'].'" data-article="'.$vidArr[$b]['fileName'].'" data-catId="'.$vidArr[$b]['mediaType'].'">
                                                <a href="#"><i class="material-icons">visibility</i></a>
                                                <a href="#" class="showEditVideoModal"><i class="material-icons">edit</i></a>
                                                <a href="#" class="showDeleteBlogModal"><i class="material-icons">delete</i></a>
                                            </td>
                                        </tr>';
                                    $a++;
                                    $b++; 
                                }
                            } else {
                                echo '<tr><td colspan="5">No related post.</td></tr>';
                            }

                        echo '</table>
                            </div>';

                            echo '  <!-- Delete Modal Structure -->
                            <div id="delArtModal3" class="modal">
                                <div class="modal-content center-align">
                                    <h4>Delete Video Uploads</h4>
                                    <p>Are you sure you want to to delete this file: <b><span id="delArticleTitle3"></span></b>
                                    <input type="hidden" id="delArticleId3"/>
                                    <p>
                                        <a class="waves-effect waves-light btn red" id="deleteArticle3"><i class="material-icons left">thumb_up</i>Yes</a>
                                        <a class="waves-effect waves-light btn-flat yellow" id="cancelDel3" ><i class="material-icons left">thumb_down</i>No</a>
                                    </p>
                                </div>        
                            </div>';

                            echo '  <!-- Edit Modal Structure -->
                            <div id="editModal3" class="modal">
                                <div class="modal-content">
                                    <h4>Edit  Video Upload</h4>
                                    

                                    <form action="controller.php" method="POST" id="editForm3"  enctype="multipart/form-data">
                                    
                                        <div class="input-field col s12 m8 l8">
                                            <textarea id="title3" placeholder="Say Something About Your Video .." class="materialize-textarea" data-length="40"
                                                required></textarea>
                                    
                                        </div>
                                        <div class="input-field col s12">
                                            <select id="editArticleCat3" required>
                                                <option value="-">Choose Category</option>';
                                                $res2 = $db->query('SELECT * FROM categories');
                                                while($rw2 = $res2->fetch_assoc()){
                                                echo '<option value="'.$rw2['id'].'">'.$rw2['mediaType'].'</option>';
                                                }
                                    
                                    
                                                echo '
                                            </select>
                                            <label>Categories</label>
                                        </div>
                                    
                                        <div class="file-field input-field col s9 m6 l6">
                                    
                                            <div class="btn">
                                                <span>PICK FILE</span>
                                                <input type="file" id="editFile3" name="articleVid">
                                            </div>
                                            <input type="hidden" id="editFileId3" />
                                            <div class="file-path-wrapper white-text">
                                                <input class="file-path  validate" type="text" required>
                                                <label class="red-text">Size:Less than 500kb, Dim:1000x500pixels</label>
                                            </div>
                                        </div>
                                    
                                        <div class="input-field col s3 m6 l6">
                                            <button class="btn waves-effect waves-light" type="submit">Submit
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </form>

                                </div>        
                            </div>';

                            
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
        }else{
        echo 'NOT HERE 101 <b> thief <b>';
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