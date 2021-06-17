<?php

    if(isset($_POST['banye'])){//LOGIN
       
        $errMsg = "";
         require "../../uploadsDBconfig.php";
        // Validation
        
        if(isset($_POST['loginPassword']) && $_POST['loginPassword'] != ""){
            $pass = $_POST['loginPassword'];
        } else {
            $errMsg .= '<li class="collection-item">Please all password fields re required.</li>';
        }

        if(isset($_POST['loginEmail']) && $_POST['loginEmail'] != ""){
            $email = $_POST['loginEmail'];
        } else {
            $errMsg .= '<li class="collection-item">Please Email field is required</li>';
        }


        if($errMsg == ""){
          
              //TODO: Get all records from DB where email = $email and password = $pass
                 $res = $db->query('SELECT * FROM users WHERE email = "'.$email.'" AND password = "'.$pass.'"');
                $nmRws = $res->num_rows;

            //LOGIN SECTION
            if($nmRws == 1){
                //LOGIN SECTION
                session_start();//start seesion

                $row = $res->fetch_assoc();
                
                $_SESSION["loggedIn"] = true;
                $_SESSION["id"] = $row['id'];
                $_SESSION["fName"] = $row['firstname'];
                $_SESSION["lName"] = $row['lastname'];
                $_SESSION["oName"] = $row['username'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["gender"] = $row['gender'];

                // header('location: dash.php');//redirect user to dashboard
                echo 200;
                // Login ends Here
            } else {
                echo 501;
            }
            
        } else {
            echo 501;
        }
    } elseif(isset($_POST['debanye'])){//REGISTRATION
        $errMsg = "";
         require "../../uploadsDBconfig.php";
        // Validation
        if(isset($_POST['firstName']) && $_POST['firstName'] != ""){
            $fName = $_POST['firstName'];
        } else {
            $errMsg .= '<li class="collection-item">Please Enter Firstname</li>';
        }

        if(isset($_POST['lastName']) && $_POST['lastName'] != ""){
            $lName = $_POST['lastName'];
        } else {
            $errMsg .= '<li class="collection-item">Please Enter Lastname</li>';
        }

        if(isset($_POST['password']) && $_POST['password'] != "" && $_POST['password'] == $_POST['cPassword']){
            $pass = $_POST['password'];
        } else {
            $errMsg .= '<li class="collection-item">Please all password fields re required.</li>';
        }

        if(isset($_POST['email']) && $_POST['email'] != ""){
            $email = $_POST['email'];
        } else {
            $errMsg .= '<li class="collection-item">Please Email field is required</li>';
        }

        if(isset($_POST['gender']) && $_POST['gender'] != ""){
            $gender = $_POST['gender'];
        } else {
            $errMsg .= '<li class="collection-item">Please Enter Gender</li>';
        }

        // if(isset($_POST['state']) && $_POST['state'] != ""){
        //     $state = $_POST['state'];
        // } else {
        //     $errMsg .= '<li class="collection-item">Please Enter State</li>';
        // }
        $oName = $_POST['oName'];

        if($errMsg == ""){
              require "../../uploadsDBconfig.php";
              $names = $fName.' '.$lName; 
              
             $res = $db->query('INSERT INTO users(firstname, lastname, email,othername, username, password, gender, dateCreated) VALUES ("'.$fName.'","'.$lName.'","'.$email.'","'.$oName.'","'.$names.'","'.$pass.'","'.$gender.'",NOW())');
             $inserted = $db->affected_rows;
       
            if($inserted){
             $userId = $db->insert_id;
                // //LOGIN SECTION
                session_start();//start seesion

                $_SESSION["loggedIn"] = true;
                $_SESSION["id"] = $userId;
                $_SESSION["fName"] = $fName;
                $_SESSION["lName"] = $lName;
                $_SESSION["oName"] = $_POST['oName'];
                $_SESSION["email"] = $email;
                $_SESSION["gender"] = $gender;

                echo 200;
            
            } else {
                echo 501;
            }
        }else {
          echo 501;
        }
    } else {
        echo 401;//unauthorized access
    }

    // include 'partials/serverFooter.php';
?>