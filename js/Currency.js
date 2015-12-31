/**
 * Created by Haziq on 12/7/2015.
 */


function getCurrenyList()
{
    $.ajax({

        url: 'Action/getAllCurrency.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                for(var i=1; i<data.length; i++)
                {
                    var text = data[i]['name'] + ' (' + data[i]['code'] + ')';
                    $("#currency").append($("<option />").val(data[i]['id']).text( text) );
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