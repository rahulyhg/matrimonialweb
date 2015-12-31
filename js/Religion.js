/**
 * Created by Haziq on 12/6/2015.
 */

/**
 * gets all the religion
 */
function getReligions()
{
    $.ajax({

           url: 'Action/getReleigons.php',
           type: 'post',
           dataType: 'json',
           success: function(data)
           {
               if(data[0]['Status'] == 'ok')
               {
                   for(var i=1; i<data.length; i++)
                   {
                       $("#religion").append($("<option />").val(data[i]['id']).text(data[i]['name']));
                   }
                   var option = data[0]['name'];
                  $('#religion option[value = name   ]').prop('selected', 'selected');
                  getSects(data[0]['id']);
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
 * gets the sects of the religion
 * @param religion
 */
function getSects(religion)
{

    if(!isNaN(religion))
    {
        var form = {

            religion:religion
        };
        $.ajax({

            url: 'Action/getSects.php',
            type: 'post',
            data: form,
            dataType: 'json',
            success: function (data) {
                if (data[0]['Status'] == 'ok')
                {
                    $("#sect").empty();
                    for(var i=1; i<data.length; i++)
                    {
                        $("#sect").append($("<option />").val(data[i]['id']).text(data[i]['name']));
                    }
                }
                else
                {

                }
            },
            error: function (data) {
                console.log(data[0]['Message']);
            }
        });
    }


}