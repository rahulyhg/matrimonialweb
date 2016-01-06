/**
 * Created by Haziq on 1/6/2016.
 */

var Error;
/**
 * update the professional information of the user
 * @param educationId
 * @param fieldId
 * @param occupationId
 * @param salary
 * @param currencyId
 */
//noinspection JSUnusedGlobalSymbols
function updateUserProfessionalInformation(educationId, fieldId, occupationId, salary, currencyId)
{
    //check for valid arguments
    if(!isNaN(educationId) && !isNaN(fieldId)&& !isNaN(occupationId)&& !isNaN(salary)&& !isNaN(currencyId))
    {
        var  form = {
            educationId: educationId, fieldId:fieldId, occupationId: occupationId,
            salary: salary, currencyId: currencyId
        };

        //create an ajax requests
        $.ajax({
              url: 'Action/updateUserProfessionalInformation.php',
              data: form,
              type: 'post',
              dataType: 'json',
              success: function(data)
              {
                  if(data[0]['Status'] == 'ok')
                  {
                      //success
                  }
                  else
                  {
                      Error +=  data[0]['Message'] +"\n"
                  }
              },
              error: function (data)
              {
                  Error +=  data +"\n"
              }

        });
    }
    else
    {
        //invalid arguments found....
        Error += "Invalid arguments detected \n";
    }
}