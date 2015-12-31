/**
 * Created by Haziq on 12/9/2015.
 */

var username = "#username";
var password = "#password";
var id       = "#error";

function verify()
{
    if($(username).val().length() > 0 && $(password).val().length() > 0 )
    {
        $(id).hide();
        return true;
    }
    $(id).empty();
    $(id).show().append("All fields must be provided in order to Login");
    return false;
}



function Login()
{
    if(verify)
    {
        var form = {
            user:     $(username).val(),
            password: $(password).val()
        };

        $.ajax({

           url: 'Action/Login.php',
           data:form,
           type:'post',
           dataType:'json',
           success: function(data)
           {
               if(data[0]['Status'] == "ok")
               {
                  //alert("Congratulations you are login");
                  var userId = data[0]['userId'];
                  window.location.href = 'success.php?id='+userId;
               }
               else
               {
                   $(id).empty();
                   $(id).show().append(data[0]['Message']);
               }
           },
           error:   function(data)
           {

           }
        });
    }
}