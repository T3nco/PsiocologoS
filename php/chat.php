<?php
require 'verify.php';
require '../inc/connect.php';
?>

<!DOCTYPE html>
<html>

     
    <!-- head things -->
    <head>
        <meta charset="utf-8" />
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Psicologo da Mosca - Login</title>
        <link rel = "stylesheet" href = "../inc/css.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    </head>
    
    
    <?php 
    $userInfo = $_GET['username'];
    $userInfoArray = explode(",", $userInfo);
    $username = $userInfoArray[0];
    $status = $userInfoArray[1];

    ?>
    <!-- body things -->
    <body id="hero">
        
        <div class = "wrapperChat">
            <section class = "chat-area">
                <header>
                    <img src="<?php echo "../inc/images/".$username.".jpg"; ?>" alt="">
                    <div class = "details">
                        <span id="username"><?php echo $username ?></span>
                        <p id="status"><?php echo $status ?></p>
                    </div>
                </header>
                <div class = "chat-box">
                    
                    </div>
                    <form action="#" class="typing-area" id="message-form" method="post">
                        <input type="text" name="message" placeholder="Type a message here...">
                        <input type="hidden" name="mainUserName" value="<?php echo $_SESSION['mainUserName']; ?>">
                        <input type="hidden" name="username" value="<?php echo $username; ?>">
                        <button type="submit"><i class="fab fa-telegram-plane"></i></button>
                    </form>
                    
                    
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="../inc/users.js"></script>
                    <script>
                    $(document).ready(function() {
                    // Handle form submission
                    let mainUserName = "<?php echo $_SESSION['mainUserName']; ?>";
                    let userName = "<?php echo $username; ?>";
                    $('#message-form').submit(function(e) {
                        e.preventDefault(); // Prevent default form submission
                        
                        let message = $('input[name="message"]').val(); // Get the message from the input field
                        mainUserName = $('input[name="mainUserName"]').val(); // Get the mainUserName value
                        userName = $('input[name="username"]').val(); // Get the username value
                        console.log(message + " " + mainUserName + " " + userName)
                        
                        // Make an AJAX request to insert the message into the database
                        $.ajax({
                            url: 'insert_message.php',
                        method: 'POST',
                        data: {
                            message: message,
                            mainUsername: mainUserName,
                            username: userName,
                        },
                        success: function(response) {
                            // Call getMessagesFromDatabase function to update the chat
                            getMessagesFromDatabase();
                            console.log("sucess");
                        },
                        error: function(xhr, status, error) {
                            console.log(error); // Log any errors
                        }
                    });

                    $('input[type="text"]').val(''); // Clear the input field
                });

                // Function to get messages from the database and update the chat
                function getMessagesFromDatabase() {
                    // Make an AJAX request to retrieve messages from the database
                    $.ajax({
                            url: 'get_messages.php',
                            method: 'GET',
                            data: {
                                sender: mainUserName,
                                receiver: userName,
                            },
                        success: function(response) {
                            // Update the chat with the retrieved messages
                            $('.chat-box').html(response);
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(error); // Log any errors
                        }
                    });
                }
                getMessagesFromDatabase();
                setInterval(getMessagesFromDatabase, 1500);
                });


                </script>


                    

            </section>
        </div>
    </body>
</html>