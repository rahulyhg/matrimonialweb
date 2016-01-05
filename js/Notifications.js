/**
 * Created by Haziq on 1/2/2016.
 */

/**
 * gets the user notifications
 */
function  getNotifications()
{
    $.ajax({

           url: 'Action/getUserNotifications.php',
           type: 'post',
           dataType: 'json',
           success: function(data)
           {
              if(data[0]['Status'] == 'ok')
              {
                   data = sortNotifications(data);
              }
              else
              {
                  console.log(data[0]['Message']);
              }

           },
           error:   function(data)
           {
              console.log("Error fetching Notifications \n"+ data);
           }
    });

}

/**
 * User has seen the notification now update the notification status
 * @param notificationId
 */
function seenNotification(notificationId)
{
    if(notificationId.length > 0)
    {

        var form = {notificationId: notificationId};
        $.ajax({

            url: 'Action/seenNotification.php',
            type: 'post',
            data: form,
            dataType: 'json',
            success: function (data) {
                if (data[0]['Status'] == 'ok')
                {
                    data = sortNotifications(data);
                }
                else
                {
                    console.log(data[0]['Message']);
                }
            },
            error: function (data)
            {
                console.log("Error updating seen Notifications \n"+data);
            }
        });
    }
    else
    {
        console.log("Invalid notification identification property ");
    }
}


/**
 * Sort the notifications based on the Dates and seen elements
 * @param data
 */
function sortNotifications(data)
{
    data.sort(function(a , b){
        return new Date(a.Time).getTime() - new Date(b.Time).getTime();
    });

    data.sort(function(a,b) {
        return new Date(b.Seen) - new Date(a.Seen);
    });

    data.reverse();
    return data;
}