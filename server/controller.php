<?php
    session_start();//start seesion
             
    if(isset($_SESSION['loggedIn'])) {
        if(isset($_POST['makeArticleAction'])){//create article

           $errMsg = "";


            if(isset($_POST['title']) && $_POST['title'] != ""){
                $title = $_POST['title'];
            } else {
                $errMsg .= '<li class="collection-item">Please Article Title shouldnt be empty.</li>';
            }
              
           // Upload Image
            // Validation
            if(isset($_FILES['articleImg']['name'])){//file is uploaded
                // Target Folder
                $mediaType = '';
                // $title = '';
                $uploadOk = 0;   
                $imageDir = "../img/articleImages/";
                $audioDir = "../img/audio/";
                $videoDir = "../img/video/";
                 $targetDir = "";


                $fileName = $_FILES['articleImg']['name'];
                $fileExt = strrchr($fileName, ".");

                if($fileExt == '.jpg' || $fileExt == '.png' || $fileExt == '.gif'){
                    $mediaType = 'I';
                    $targetDir = $imageDir;
                }else if ($fileExt == '.mp3' || $fileExt == '.m4a'){
                    $mediaType = 'A';
                    $targetDir = $audioDir;
                }else if ($fileExt == '.mp4' || $fileExt == '.3gp' || $fileExt == '.avi' || $fileExt == '.mkv') {
                    $mediaType = 'V';
                    $targetDir = $videoDir;
                } else {
                    $uploadOk = 1;
                    //   $errMsg .= '<li class="collection-item">Opps</li>';
                    $errMsg .= '<li class="collection-item">Please ensure the file is one of the follwoing file types: [mp3, mp4, gif, 3gp, m4a, avi, mkv, jpg, png].</li>';
                }

                // //check files dimension
                // list($width, $height, $type, $attr) = getimagesize($_FILES["articleImg"]['tmp_name']);
                // if($width > 1000 || $height > 500){
                //     $errMsg .= '<li class="collection-item">Image should be of dimension 1000x500pixel max.</li>';
                //     $uploadOk = 1;
                // }
                
                // // Check file size
                // if ($_FILES["articleImg"]["size"] > 500000) {
                //     $errMsg .= '<li class="collection-item">Sorry, your file larger than 500kb.</li>';
                //     $uploadOk = 1;
                // }

                //TODO: check if file exists in folder
                  $filePath = $targetDir.'/'.basename($fileName);
                if(file_exists($filePath)){
                    $errMsg .= '<li class="collect-item">Sorry, file already exists.</li>';
                    $uploadOk = 1;
                }
                   


                if($uploadOk == 0){                   

                    if (move_uploaded_file($_FILES["articleImg"]["tmp_name"], $filePath)) {
                         $filePath = $targetDir.'/'.basename($fileName);
                        //    echo "The file ". $fileName. " has been uploaded.";
                        //    header('location: dash.php');
                        // .substr($row['fileName'], 0, 10).

                        if($errMsg == ""){
                            require '../../uploadsDBconfig.php';

                            $userId = $_SESSION['id'];
                            $res = $db->query('INSERT INTO fileuploads(userId, mediaType, datePosted, fileName, title) VALUES ('.$userId.',"'.$mediaType.'", NOW(), "'.$fileName.'", "'.$title.'")');
                            $inserted = $db->affected_rows;
                         
                            if($inserted){   
                                echo 200;
                            //   reload();
                            } else {
                                echo 501;
                            }    
                        } else {
                            echo 501;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo '<ul>'.$errMsg.'</ul>';
                }
            }else{
                echo 401;
            }
        } else if(isset($_POST['delArtAction'])){//delete article
            $errMsg = "";
            // Validation
            
            if(isset($_POST['id']) && $_POST['id'] != ""){
                $articleId = $_POST['id'];
            } else {
                $errMsg .= '<li class="collection-item">Please Article Title shouldnt be empty.</li>';
            }

            if($errMsg == ""){
                require '../../uploadsDBconfig.php';

                $res = $db->query('DELETE FROM fileuploads WHERE id = '.$articleId);
                $updated = $db->affected_rows;

                if($updated > 0){
                    echo 201;
                } else {
                    echo 501;
                }                
            } else {
                echo 501;
            }
        }
         else if(isset($_POST['editArtAction'])){//edit article
            $errMsg = "";
               
            // Upload Image
            // Validation
            if(isset($_FILES['articleImgg']['name'])){//file is uploaded
                // Target Folder
                $mediaType = '';
                $title = '';
                $uploadOk = 0;   
                $imageDir = "../img/articleImages/";
                $targetDir = "";


                $fileName = $_FILES['articleImgg']['name'];
                $fileExt = strrchr($fileName, ".");

                if($fileExt == '.jpg' || $fileExt == '.png' || $fileExt == '.gif'){
                    $mediaType = 'I';
                    $targetDir = $imageDir;
                }else {
                    $uploadOk = 1;
                    $errMsg .= '<li class="collection-item">Please ensure the file is one of the follwoing file types: [jpg, gif, png].</li>';
                    // $errMsg .= '<li class="collection-item">Opps</li>';
                }

                //TODO: check if file exists in folder
                $filePath = $targetDir.'/'.basename($fileName);
                if(file_exists($filePath)){
                    $errMsg .= '<li class="collect-item">Sorry, file already exists.</li>';
                    $uploadOk = 1;
                }
                


                if($uploadOk == 0){                   
                        
                    if (move_uploaded_file($_FILES["articleImgg"]["tmp_name"], $filePath)) {
                        $filePath = $targetDir.'/'.basename($fileName);
                        //    echo "The file ". $fileName. " has been uploaded.";
                        //    header('location: dash.php');

                        if($errMsg == ""){

                            if(isset($_POST['title']) && $_POST['title'] != ""){
                                $title = $_POST['title'];
                            } else {
                                $errMsg .= '<li class="collection-item">Please Article Title shouldnt be empty.</li>';
                            }

                            
                            if(isset($_POST['fileName']) && $_POST['fileName'] != ""){
                                $updatedfileName = $fileName;
                            } else {
                                $errMsg .= '<li class="collection-item">Please type the article body.</li>';
                            }
                            
                            $articleId = $_POST['id'];
                            
                            require '../../uploadsDBconfig.php';
                            $res = $db->query('UPDATE fileuploads SET fileName = "'.$updatedfileName.'", title="'.$title.'" WHERE id = '.$articleId);         
                            $updated = $db->affected_rows;
                            

                            if($updated > 0){
                                // echo 'here';
                                echo 200;
                            } else {
                                // echo 'not 1here';
                                echo 501;
                            }

                        } else {
                            echo 501;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo '<ul>'.$errMsg.'</ul>';
                }
            }elseif(isset($_FILES['articleImggg']['name'])){//file is uploaded
                // Target Folder
                $mediaType = '';
                $title = '';
                $uploadOk = 0;   
                $audioDir = "../img/audio/";
                $targetDir = "";


                $fileName = $_FILES['articleImggg']['name'];
                $fileExt = strrchr($fileName, ".");

                
                if ($fileExt == '.mp3'|| $fileExt == '.m4a'){
                    $mediaType = 'A';
                    $targetDir = $audioDir;
                } else {
                    $uploadOk = 1;
                    $errMsg .= '<li class="collection-item">Please ensure the file is one of the follwoing file types: [mp3, m4a].</li>';
                    // $errMsg .= '<li class="collection-item">Opps</li>';
                }

                //TODO: check if file exists in folder
                $filePath = $targetDir.'/'.basename($fileName);
                if(file_exists($filePath)){
                    $errMsg .= '<li class="collect-item">Sorry, file already exists.</li>';
                    $uploadOk = 1;
                }
                


                if($uploadOk == 0){                   
                        
                    if (move_uploaded_file($_FILES["articleImggg"]["tmp_name"], $filePath)) {
                        $filePath = $targetDir.'/'.basename($fileName);
                        //    echo "The file ". $fileName. " has been uploaded.";
                        //    header('location: dash.php');

                        if($errMsg == ""){

                            if(isset($_POST['title']) && $_POST['title'] != ""){
                                $title = $_POST['title'];
                            } else {
                                $errMsg .= '<li class="collection-item">Please Article Title shouldnt be empty.</li>';
                            }

                            if(isset($_POST['mediaType']) && $_POST['mediaType'] != ""){
                                $mediaType = $_POST['mediaType'];
                            } else {
                                $errMsg .= '<li class="collection-item">Please Select an article category.</li>';
                            }

                            if(isset($_POST['fileName']) && $_POST['fileName'] != ""){
                                $updatedfileName = $fileName;
                            } else {
                                $errMsg .= '<li class="collection-item">Please type the article body.</li>';
                            }
                            
                            $articleId = $_POST['id'];
                            
                            require '../../uploadsDBconfig.php';
                            $res = $db->query('UPDATE fileuploads SET fileName = "'.$updatedfileName.'", title="'.$title.'" , mediaType = '.$mediaType.' WHERE id = '.$articleId);         
                            $updated = $db->affected_rows;
                            

                            if($updated > 0){
                                // echo 'here';
                                echo 200;
                            } else {
                                // echo 'not 1here';
                                echo 501;
                            }

                        } else {
                            echo 501;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo '<ul>'.$errMsg.'</ul>';
                }
            }elseif(isset($_FILES['articleVid']['name'])){//file is uploaded
                // Target Folder
                $mediaType = '';
                $title = '';
                $uploadOk = 0;   
                
                $videoDir = "../img/video/";
                $targetDir = "";


                $fileName = $_FILES['articleVid']['name'];
                $fileExt = strrchr($fileName, ".");

                
                if($fileExt == '.mp4' || $fileExt == '.3gp' || $fileExt == '.avi' || $fileExt == '.mkv') {
                    $mediaType = 'V';
                    $targetDir = $videoDir;
                }else {
                    $uploadOk = 1;
                    $errMsg .= '<li class="collection-item">Please ensure the file is one of the follwoing file types: [mp4, 3gp, avi, mkv].</li>';
                    // $errMsg .= '<li class="collection-item">Opps</li>';
                }

                //TODO: check if file exists in folder
                $filePath = $targetDir.'/'.basename($fileName);
                if(file_exists($filePath)){
                    $errMsg .= '<li class="collect-item">Sorry, file already exists.</li>';
                    $uploadOk = 1;
                }
                


                if($uploadOk == 0){                   
                        
                    if (move_uploaded_file($_FILES["articleVid"]["tmp_name"], $filePath)) {
                        $filePath = $targetDir.'/'.basename($fileName);
                        //    echo "The file ". $fileName. " has been uploaded.";
                        //    header('location: dash.php');

                        if($errMsg == ""){

                            if(isset($_POST['title']) && $_POST['title'] != ""){
                                $title = $_POST['title'];
                            } else {
                                $errMsg .= '<li class="collection-item">Please Article Title shouldnt be empty.</li>';
                            }

                            if(isset($_POST['mediaType']) && $_POST['mediaType'] != ""){
                                $mediaType = $_POST['mediaType'];
                            } else {
                                $errMsg .= '<li class="collection-item">Please Select an article category.</li>';
                            }

                            if(isset($_POST['fileName']) && $_POST['fileName'] != ""){
                                $updatedfileName = $fileName;
                            } else {
                                $errMsg .= '<li class="collection-item">Please type the article body.</li>';
                            }
                            
                            $articleId = $_POST['id'];
                            
                            require '../../uploadsDBconfig.php';
                            $res = $db->query('UPDATE fileuploads SET fileName = "'.$updatedfileName.'", title="'.$title.'" , mediaType = '.$mediaType.' WHERE id = '.$articleId);         
                            $updated = $db->affected_rows;
                            

                            if($updated > 0){
                                // echo 'here';
                                echo 200;
                            } else {
                                // echo 'not 1here';
                                echo 501;
                            }

                        } else {
                            echo 501;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo '<ul>'.$errMsg.'</ul>';
                }
            }else{
                // echo 401;
                echo 'onyhe mgbu';
            }
            
           

        }  
    } else{
        echo 'here';
    }
?>