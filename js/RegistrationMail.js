/**
 * Created by Haziq on 12/30/2015.
 */

var id = "#resend";

/**
 * call the request to resend the mail once again
 */
function resendMail()
{
    $.ajax({

        url:'Action/registrationMail.php',
        dataType:'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                console.log("success");

            }
            else
            {
                console.log(data[0]['Message']);
            }
        },
        error: function(data)
        {
            console.log(data[0]['Message']);
        }

    });
}