/**
 * Created by Haziq on 1/5/2016.
 */

var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
var message;

$("#images").change(function(){

    var fileSize = this.files[0].size;
    console.log( 'Bytes: '+fileSize);
    var KB  = Math.round(  parseFloat( ( parseFloat(fileSize)/1024 )) * 100)/ 100;
    var MB  = Math.round(  parseFloat( ( parseFloat(KB)/1024 )) * 100) / 100;

    if( $.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) != -1)
    {
       if(MB <= 10)
       {
           uploadImage();
       }
       else
       {
           message = "Image too large \n Size should be less then or equal to 10 MB";
       }
    }
    else
    {
       message = "Allowed image format are in " + fileExtension.join(', ');
    }
});

/**
 * Upload the image by using AJAX and get the response from the server
 */
function uploadImage()
{
    var formData = new FormData($('#form')[0]);
    $.ajax({

        url:'Action/uploadImage.php',
        type:'POST',
        data:formData,
        cache: false,
        contentType: false,
        processData: false,
        success:    function(data)
        {
            //var result = JSON.parse(data);
            console.log(result);
            if(data[0]['Status'] == 'ok')
            {

            }
            else
            {
               message = data[0]['Message'];
            }
        },
        error:function(data)
        {
            message = "Some error occurred during upload \n"+ data;
        }
    });

}