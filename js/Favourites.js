/**
 * Created by Haziq on 12/31/2015.
 */


function addToFavourites(partnerId)
{
    if(partnerId.length > 0)
    {
        var form = {
            partnerId: partnerId
        };
        $.ajax(
            {
                url: 'Action/addToFavourite.php',
                type: 'post',
                data: form,
                dataType: 'json',
                success: function(data)
                {
                    if(data[0]['Status']=='ok')
                    {

                    }
                    else
                    {
                        console.log(data[0]['Message']);
                    }
                },
                error: function(data){}
            });
    }
    else
    {
        //error show
    }
}


function removeFromFavourites(partnerId)
{
    if(partnerId.length > 0)
    {
        var form = {
            partnerId: partnerId
        };
        $.ajax(
            {
                url: 'Action/removeFromFavourite.php',
                type: 'post',
                data: form,
                dataType: 'json',
                success: function(data)
                {
                    if(data[0]['Status']=='ok')
                    {

                    }
                    else
                    {
                        console.log(data[0]['Message']);
                    }
                },
                error: function(data){}
            });
    }
    else
    {
        //error show
    }
}