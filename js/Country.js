/**
 * Created by Haziq on 12/5/2015.
 */


/**
 * function is to make a ajax request to the load the countries codes in to the DOM element
 */
function loadCountryCodes()
{
    $.ajax({

            url:"Action/getCountriesCode.php",
            type:"POST",
            dataType:"json",
            success: function(data)
            {
                if(data[0]['Status'] == 'ok')
                {
                    for( var i=1; i<data.length; i++)
                    {
                        $("#codes").append($("<option />").val(data[i]['id']).text(data[i]['name']));
                    }
                }
                else
                {
                    console.log(data[0]['Message']);
                }
            },
            error:   function(data)
            {
                console.log(data[0]['Message']);
            }
    });

}

/**
 * set the phone code accroding to the user selected state
 */
function setCode_with_Country()
{
    var selectedValue = $('#country  option:selected').val();
    $("#codes").val(selectedValue);
}

/**
 * loads the country names and append it into the select box
 */
function loadCountriesName()
{
    $.ajax({

        url:"Action/getCountriesName.php",
        type:"POST",
        dataType:"json",
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
               for( var i=1; i<data.length; i++)
               {
                   $("#country").append($("<option />").val(data[i]['id']).text(data[i]['name']));
               }

            }
            else
            {
                console.log(data[0]['Message']);
            }
        },
        error:   function(data)
        {
            console.log(data[0]['Message']);
        }
    });
}

/**
 * loads the states of the country in the select
 * @param country
 */
function getStates(country)
{
    setCode_with_Country();
    var stateId = "#state";
    if(!isNaN(country))
    {
        var form = {

            country:country
        };
        console.log(form);
        $.ajax({

            url: 'Action/getStates.php',
            type: 'post',
            data: form,
            dataType: 'json',
            success: function (data) {
                if (data[0]['Status'] == 'ok')
                {
                    $(stateId).empty();
                    for(var i=1; i<data.length; i++)
                    {
                        $(stateId).append($("<option />").val(data[i]['id']).text(data[i]['name']));
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

 function getUserState(userId)
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

/**
 * update the state of the user
 * @param countryId
 * @param cityId
 */
function updateUserState(countryId, cityId)
{
    if(!isNaN(countryId) && !isNaN(cityId))
    {
        var form = { countryId: countryId , cityId: cityId  };
        $.ajax({
            url: 'Action/updateUserState.php',
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
       console.log("Invalid fields occurred");
    }
}


/**
 * Update the user cell number attribute
 * @param cell
 */
function updateUserCell(cell)
{
    if(cell.length > 7 && cell.length < 20 )
    {
        var form = { cell: cell  };
        $.ajax({
            url: 'Action/updateUserCell.php',
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
        console.log("Invalid fields occurred");
    }
}