/**
 * Created by Haziq on 12/6/2015.
 */


/**
 * get all fields list
 */
function getAllField()
{
    $.ajax({

        url: 'Action/getAllField.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                $("#field").empty();
                for(var i=1; i<data.length; i++)
                {
                    $("#field").append($("<option />").val(data[i]['id']).text(data[i]['name']));
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
 * get all the working list
 */
function getWorkingList()
{
    $.ajax({

        url: 'Action/getWorkingList.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                $("#working").empty();
                for(var i=1; i<data.length; i++)
                {
                    $("#working").append($("<option />").val(data[i]['id']).text(data[i]['name']));
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
