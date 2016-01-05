/**
 * Created by Haziq on 1/4/2016.
 */


/**
 * Send the greeting message to the desired partner
 * @param partner
 * @param message
 */
function sendGreetingMessage(partner, message)
{
    if(partner.length > 0 && message.length > 0)
    {
        var form = { partner: partner , message: message  };
        $.ajax({
            url: 'Action/sendGreetingMessage.php',
            data: form,
            dataType: 'json',
            type: 'post',
            success: function(data)
            {
                if(data[0]['Status'] == 'ok')
                {

                }
                else
                {
                    console.log(data[0]['Message']);
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    }
    else
    {
        console.log("error occurred");
    }
}