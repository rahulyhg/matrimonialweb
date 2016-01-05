/**
 * Created by Haziq on 12/6/2015.
 */

/**
 * gets all disabilities
 */
function getAllDisability()
{
    $.ajax({

        url: 'Action/allDisability.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                for(var i=1; i<data.length; i++)
                {
                    $("#disability").append($("<option />").val(data[i]['id']).text(data[i]['name']));
                }
            }
            else
            {

            }
        },
        error: function(data)
        {
            console.log(data[0]['Message']);
        }
    });
}

/**
 * update the disability function of the user
 * @param disability
 */
function updateDisability(disability)
{
    if(!isNaN(disability))
    {
        var form = { disability : disability  };
        $.ajax({

            url: 'Action/updateUserDisability.php',
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
                console.log("ERROR \n"+data);
            }
        });
    }
}

