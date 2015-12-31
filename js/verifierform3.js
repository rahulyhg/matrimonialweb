/**
 * Created by Haziq on 12/6/2015.
 */

var error = "#error";

function verfiyAll()
{
   var height  = $("#height").val();
   var weight  =  $("#weight").val();
   var martial = $('#martial').val();
   var type    = $('#type').val();
   var fclass  = $('#class').val();
   var disability;
   var form;


   if($("#yes").is(':checked'))
   {
     disability = $("#disability").val();
     form = {
         height: height,
         weight: weight,
         martial: martial,
         familyType: type,
         familyClass: fclass,
         disability: true,
         type: disability
     };
   }
   else
   {
       form = {
           height: height,
           weight: weight,
           martial: martial,
           familyType: type,
           familyClass: fclass,
           disability: false
       };
   }


    if(height != '' && weight != '' && martial > 0 && type > 0 && fclass > 0)
    {
        $.ajax({

           url:  'Action/PhysicalInfo.php',
           data: form,
           type: 'post',
           dataType: 'json',
           success: function(data)
           {
               if(data[0]['Status'] == 'ok')
               {
                   window.location.href = 'signupformfour.php';
               }
               else{

                   $(error).show().append(data[0]['Message']);
               }
           },
           error:   function(data)
           {
               $(error).show().append(data[0]['Message']);
           }

        });
    }
    else
    {
        $(error).show().append('All fields must be provided');
    }

}