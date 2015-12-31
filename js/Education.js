/**
 * Created by Haziq on 12/6/2015.
 */

/**
 * get all the education types list
 *
 */
function getEducationList()
{
    $.ajax({

        url: 'Action/getEducationList.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                for(var i=1; i<data.length; i++)
                {
                    $("#education").append($("<option />").val(data[i]['id']).text(data[i]['name']));
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