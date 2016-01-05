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

/**
 * update the user religion and sect with according to the given fields
 * @param religionId
 * @param sectId
 */
function updateUserReligion(religionId, sectId)
{
    if(!isNaN(religionId) && !isNaN(sectId))
    {
        var form  = { religionId: religionId , sectId: sectId};
        $.ajax({
              url: 'Action/updateUserReligion.php',
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
              error: function (data)
              {
                  console.log(data.toString());
              }
        });
    }
    else
    {
        console.log("Wrong fields");
    }
}