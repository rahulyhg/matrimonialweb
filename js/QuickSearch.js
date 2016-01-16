/**
 * Created by Haziq on 1/6/2016.
 */

var error = "";

/**
 * Perform the quick search operation
 * @param gender
 * @param ageHigh
 * @param ageLow
 * @param religion
 * @param sect
 * @param country
 * @param city
 */
function quickSearch(gender, ageHigh, ageLow, religion, sect, country, city)
{
    var form = {
        gender: gender, ageHigh: ageHigh, ageLow: ageLow ,
        religion:religion, sect:sect, country:country, city:city
    };
    if(!isNaN(gender) && !isNaN(ageHigh) && !isNaN(ageLow) && !isNaN(religion) && !isNaN(sect)
        && !isNaN(country) && !isNaN(city))
    {
        var form = {
            gender: gender, ageHigh: ageHigh, ageLow: ageLow ,
            religion:religion, sect:sect, country:country, city:city
        };

        //create an ajax requests
        $.ajax({
            url: 'Action/quickSearch.php',
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
                    error +=  data[0]['Message'] +"\n";
                }
            },
            error: function (data)
            {
                error +=  data +"\n";
            }

        });
    }
    else
    {
      error += "All fields are necessary  \n";
      alert(form.toString());
      console.log(form);
    }


}