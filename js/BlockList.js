/**
 * Created by Haziq on 12/31/2015.
 */

/**
 * if the person seems annoying or any other problem occurres lets block it....
 * @param partnerId
 * @param reason
 */
function blockUser(partnerId, reason)
{
    if(partnerId.length > 5 && reason.length > 10)
    {
        var form = {
            partnerId: partnerId,
            reason   : reason
        };

        $.ajax({

               url: 'Action/blockUser.php',
               data: form,
               type: 'post',
               dataType: 'json',
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
               error: function(data)
               {
                   console.log(data);
               }
        });
    }
    else
    {
        //error occurred
    }
}

/**
 * remove the block constraint from the user
 * @param partnerId
 */
function removeBlock(partnerId)
{
    if(partnerId.length > 5 && reason.length > 10)
    {
        var form = {
            partnerId: partnerId
        };

        $.ajax({

            url: 'Action/removeBlock.php',
            data: form,
            type: 'post',
            dataType: 'json',
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
            error: function(data)
            {
                console.log(data);
            }
        });
    }
    else
    {
        //error occurred
    }
}

/**
 * get the user Ban's list
 */
function getBanList()
{
    $.ajax({
        url: 'Action/getBanList.php',
        type: 'post',
        dataType: 'json',
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
        error: function(data)
        {
            console.log(data);
        }
    });
}