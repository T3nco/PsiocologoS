
<?php

    session_start();
    include_once '../inc/connect.php';

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $pwd = mysqli_real_escape_string($con, $_POST['password']);

    // Error handlers

    // Check for empty fields

    if (!empty($username) && !empty($pwd) && !empty($_FILES['image'])) {
        $sql = "SELECT username FROM users WHERE username = '{$username}'";
        $result = mysqli_query($con, $sql);
        // check if email is already exists in the database or not
            if(mysqli_num_rows($result) > 0)
            {
                echo "$username - This username already exists!";
            }else{
                    $img_name = $_FILES['image']['name']; // getting user uploaded img name
                    $img_type = $_FILES['image']['type']; // getting user uploaded img type
                    $tmp_name = $_FILES['image']['tmp_name']; // this temporary name is used to save/move file in our folder

                    // lets explode image and get the last extension like jpg png
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); // here we get the extension of an user uploaded img file

                    $extensions = ['jpg']; // these are some valid img ext and we've store them in array
                    if(in_array($img_ext, $extensions) === true){
                        // lets move the user uploaded img to our particular folder
                        $new_img_name = $username . "." .  $img_ext;
                        if(move_uploaded_file($tmp_name, "../inc/images/".$new_img_name)) {


                        //encrypt password, para fazer login basta comparar again usando password_verify($password, $hashedPassword)
                        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

                            // lets insert all user data inside table
                            $sql2 = mysqli_query($con, "INSERT INTO users (username,password)
                                                        VALUES ('{$username}','{$hashedPassword}')");
                            if($sql2){
                                echo "Sucessful";
                                header("Location: login.html");
                            }
                            else{
                                echo "ERROR INSERTING DATA";
                            }
                        }

                    } else{
                        include 'signup.html';
                        echo "<br><span style='color: red; font-family: verdana; font-size: 30px; background-color: rgba(170,0,0,0.1); height: 40px; justify-content: center; text-align: center; vertical-align: center; '>This image extension is not allowed, Please choose a JPG file!</span>";
                    }
            }
       

    } else{
        echo "all fields are required";
        header("Location: signup.html");
    }