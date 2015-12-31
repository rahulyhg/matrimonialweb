/**
 * Created by Haziq on 12/6/2015.
 */

/**
 * loads all martial statuses
 */
function loadAll()
{

    $.ajax({

        url: 'Action/getAllMartialStatus.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                for(var i=1; i<data.length; i++)
                {
                    $("#martial").append($("<option />").val(data[i]['id']).text(data[i]['name']));
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
 * get user martial status
 * @param userId
 */
function getMartialStatus(userId)
{
    var form = {
        "id":userId
    };

    $.ajax(
        {
            url: '',
            type: 'post',
            dataType: 'json',
            data: form,
            success: function(data)
            {
                if(data[0]['Status'] == 'ok')
                {

                }
            },
            error:function(data)
            {
                console.log(data[0]['Message']);
            }
        });
}
