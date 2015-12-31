/**
 * Created by Haziq on 12/7/2015.
 */

/**
 * validate partner preference input
 * @return {boolean}
 */
function verifyPartner()
{
    var id = "#partner";
    var error = "#error";
    if($(id).val() != "")
    {
        if($(id).val().length <= 100)
        {
            $(id).removeClass('error');
            $(error).hide();
            return true;
        }
        else
        {
            $(id).addClass('error');
            $(error).empty();
            $(error).show().append("Partner preference should not exceed 100. you have write "+ $(id).val().length + " words");
            return false;
        }
    }
    $(id).addClass('error');
    $(error).empty();
    $(error).show().append("Partner preference should not be empty");
    return false;
}

/**
 * verify if user has agreed to terms and conditions
 * @return {boolean}
 */
function validateTerms()
{
    var id = "#agree";
    var error = "#error";
    if($(id).is(':checked'))
    {
        $(error).hide();
        return true;
    }
    $(error).empty();
    $(error).show().append("Agree to terms in order to continue");
    return false;
}

/**
 * final checkup
 */
function verifyAll()
{
    var a = false;
    if(verifyPartner())
    {
         if(validateTerms())
         {
             var form = {

                 'partner': $('#partner').val()
             };
             //ajax response
             $.ajax({

                 url: 'Action/PartnerInfo.php',
                 dataType: 'json',
                 data: form,
                 type: 'post',

                 success:   function(data)
                 {
                     var response = data.responseText;
                     console.log(response);
                     if(data[0]['Status'] == "ok")
                     {
                         a = true;
                         //createNewProfile();
                         var userId = data[0]['UserId'];
                         //window.location.href = "success.php/?id="+userId;
                         console.log("profile success");
                         window.location.href = 'registrationMail.php?id='+userId;
                     }
                     else{ var id = "#error"; $(id).empty(); $(id).show().append(data[0]['Message']);  }
                 },
                 error:     function(data)
                 {
                     var response = data.responseText;
                     console.log(response);
                     response =  response.substring(2);
                     var json = JSON.parse(response);
                     console.log(json);
                     if(json[0]['Status'] == 'ok')
                     {
                         var userId = json[0]['UserId'];
                         //window.location.href = "success.php/?id="+userId;
                         console.log("profile success");
                         window.location.href = 'registrationMail.php?id='+userId;

                     }
                     var id = "#error";
                     console.log(data);
                     $(id).empty();
                     $(id).show().append("some error occurred");
                 }

             });
         }

        if(a)
        {

        //    createNewProfile();
        }
    }

}


function createNewProfile()
{
    $.ajax({

        url: 'Action/newProfile.php',
        type:'post',
        dataType:'json',
        success: function(data)
        {
             if(data[0]['Status'] == 'ok')
             {
                 //alert("Profile created");
                 var userId = data[0]['UserId'];
                 //window.location.href = "success.php/?id="+userId;
                   console.log("profile success");
                   window.location.href = 'registrationMail.php/?id='+userId;
             }
            else
             {
                 alert(data[0]['Message']);
             }
        },
        error: function(data)
        {
            console.log(data);
        }

    });


}