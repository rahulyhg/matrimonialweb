<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/30/2015
 * Time: 12:03 AM
 */

  $str = $_SERVER['QUERY_STRING'];
  parse_str($str, $out);
  $id = $out['id'];

?>


<html>
  <title>
      User Activation
  </title>

<script type="text/javascript" src="jslib/jquery-1.11.3.min.js"></script>

   <body>


   <script>

       $(document).ready(function()
       {
           var form = {

               id: "<?php echo $id; ?>"
           };

           $.ajax({
               url:'Action/activateUser.php',
               data: form,
               type: 'post',
               dataType:'json',
               success: function(data)
               {
                  if(data[0]['Status'] == "ok")
                  {
                      window.location.href='success.php?id='+<?php echo $id;  ?>;
                  }
               },
               error: function(data)
               {

               }


           });

       });

   </script>

   </body>




</html>
