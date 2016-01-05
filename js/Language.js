/**
 * Created by Haziq on 12/6/2015.
 */

/**
 * gets the list of all the language stores
 */
function getLanguages()
{
    $.ajax({

        url: 'Action/getLanguages.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                for(var i=1; i<data.length; i++)
                {
                    $("#language").append($("<option />").val(data[i]['id']).text(data[i]['name']));
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
 * handle the request of updating user language
 * @param language
 */
function updateUserLanguage(language)
{
    if(!isNaN(language))
    {
        var form = { language : language };
        $.ajax({

            url: 'Action/updateUserLanguage.php',
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

                }
            },
            error: function(data)
            {
                console.log(data[0]['Message']);
            }
        });
    }
    else
    {

    }
}
