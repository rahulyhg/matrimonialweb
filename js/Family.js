/**
 * Created by Haziq on 12/6/2015.
 */


function getsAllFamilyTypes()
{
    $.ajax({

        url: 'Action/allFamilyTypes.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                for(var i=1; i<data.length; i++)
                {
                    $("#type").append($("<option />").val(data[i]['id']).text(data[i]['name']));
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


function getAllFamilyClasses()
{
    $.ajax({

        url: 'Action/allFamilyClass.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                for(var i=1; i<data.length; i++)
                {
                    $("#class").append($("<option />").val(data[i]['id']).text(data[i]['name']));
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
 * Update the user family status
 * @param familyType
 * @param familyStatus
 */
function updateFamilyInformation(familyType, familyStatus)
{
    if(!isNaN(familyType) && !isNaN(familyStatus))
    {
        var form  = { FamilyType: familyType , FamilyStatus: familyStatus};
        $.ajax({
            url: 'Action/updateUserFamilyInformation.php',
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