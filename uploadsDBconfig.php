<?php
    $dbHost = "localhost";
    $username = "root";
    $password = "";
    $dbSeleceted = "uploadsProject";

    // Create connection nd save d connection to $db
    $db = new mysqli($dbHost, $username, $password, $dbSeleceted);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } else {
        
        

        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL,    
            otherName VARCHAR(30) NOT NULL,
            username VARCHAR(30) NOT NULL,
            password VARCHAR(32) NOT NULL,
            gender ENUM('M', 'F') NOT NULL,
            dateCreated Date NOT NULL       
        )";

        $createUserTable = $db->query($sql);

        if($createUserTable) {
            $sql2 = "CREATE TABLE IF NOT EXISTS categories (
                id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                mediaType ENUM('A','V','I') NOT NULL
            )";

            $createCatTable = $db->query($sql2);

            if($createCatTable){
                $sql3 = "CREATE TABLE IF NOT EXISTS fileUploads (
                    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    userId INT(11) NOT NULL,
                    -- title VARCHAR(20) NOT NULL,
                    mediaType ENUM('A','V','I') NOT NULL,
                    datePosted Date NOT NULL,
                    fileName VARCHAR(75) NOT NULL   
                )";

                $createArtTable = $db->query($sql3);

                if($createArtTable){
                    $sql4 = "CREATE TABLE IF NOT EXISTS comments (
                        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        comment VARCHAR(150) NOT NULL,
                        userId INT(11) NOT NULL,
                        fileUploadsId INT(11) NOT NULL,
                        datePosted Date NOT NULL
                    )";

                    $db->query($sql4);
                }
            }
            
        }
               
    }
?>