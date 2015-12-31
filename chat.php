<?php

   session_start();
   if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
   }
   else{
       header("Location: index.php");
   }

?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Chat</title>

        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/customstyle.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="css/chat.css">
        <script type="text/javascript" src="jslib/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="jslib/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/Partner.js"></script>
        <script type="text/javascript" src="js/Chat.js"></script>

    </head>
    <body>

           <!-- header section -->
            <?php include 'header.php'; ?>

           <!-- partnerList section section -->
           <div id="partners" class="friends">




           </div>

           <!-- chatArea section section -->
           <div id="chatBox" class="chatArea">


           </div>

           <!-- TextArea section section -->
           <div class="chatText">
               <label for="message" style="display: none"> </label>
             <textarea id="message" class="message" placeholder="Type your message"></textarea>
           </div>
             <br> <br>

           <!-- footer section -->
            <br><br><br>
            <?php include './footer.php'; ?>

              <script>

                  var textArea = "#message";
                  $(document).ready(function()
                  {
                      getAllPartnersList();
                      $('#message').on('keydown', function(event)
                      {
                          if (event.keyCode === 13 && event.shiftKey === false)
                          {
                              console.log(partner);
                              //send the chat to the server
                              sendChat(partner, $(textArea).val());
                              $(textArea).val(null);
                          }
                      });
                      // regularly fetch for new updates
                      //setTimeout(getPartnerChat(partner),500);
                  });

              </script>
        </body>
