/**
 * Created by Haziq on 1/2/2016.
 */

$(document).ready(function()
{
    var data = [];
    for( var $i=0; $i< 6; $i++)
    {
        data.push(
            {
              "Message" : generateRandomString(),
              "Time"    : randomDate(new Date(1961,10,12), new Date()),
              "Seen"    : Math.round(getRandomArbitrary(0,1))
            });
    }

    data.sort(function(a,b)
    {
        return new Date(b.Time) - new Date(a.Time);
    });

    console.log(data);

    data.sort(function(a,b)
    {
        return new Date(b.Seen) - new Date(a.Seen);
    });

    data.reverse();
    showThisStuff(data);
    console.log(data);
});


function generateRandomString()
{
        var length = 10;
        var       $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var $randomString = '';
        for (var $i = 0; $i < length; $i++) {
            var range = getRandomArbitrary(0, $characters.length -1);
             range = Math.round(range);
            $randomString += $characters[range];
        }
        return $randomString;
}

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}

function randomDate(start, end)
{
    return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
}


function showThisStuff(data)
{
   for(var i=0; i< data.length; i++)
   {
       var text = data[i]['Message'];
       var element = '<li><p class = "notification"></p>' + text + '</p></li>';
       $('#notification').append(element);
   }
}
