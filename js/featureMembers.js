/**
 * Created by Haziq on 12/13/2015.
 */

var divId = "#feature";
var divClass = "col-sm-4";
var imgClass = "image";
var nameClass = "name";
/**
 * get the premium members list
 */
function fetchFeatureMembers()
{
    $.ajax({

        url: 'Action/getPremiumMembers.php',
        type: 'post',
        dataType: 'json',
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                appendElements(data);
            }
        },
        error: function(data)
        {
            console.log(data[0]['Message']);
        }
    });
}

/**
 * populates the friends section with the help from response
 * @param data
 */
function appendElements(data)
{

    var index = 0;
    for(var i=0; i< data[1].length; i++ )
    {
        var name  = data[1][index]['userName'];
        var image = 'data:image/png;base64,' + data[1][index]['image'];
        var elements = '<div class="'+divClass+'">' + '<img class="'+imgClass+'" src="'+image + '"/> <p class="'+nameClass+'">' + name +
                        "</p></div>";
        $(divId).append(elements);
        index+=1;
    }

}