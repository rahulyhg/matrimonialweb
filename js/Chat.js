/**
 * Created by Haziq on 12/10/2015.
 */
var partner;
//var chatError = "#chatError";
var message   = "#message";
var chatBox   = "#chatBox";

/**
 * set the global partner Identification
 * @param partnerId
 */
function setPartner(partnerId){
    partner = partnerId;
}

/**
 * send the chat message typed by the user
 * to the server
 * @param partnerId
 * @param message
 */
function sendChat(partnerId, message)
{
     if( partnerId.length != 0 && message.length != 0)
     {
         var form = {  to: partnerId, message: message  };
         //send ajax and response
         $.ajax({

             url: 'Action/sendChat.php',
             type: 'post',
             data: form,
             dataType: 'json',
             success: function(data)
             {
                 if(data[0]['Status'] == 'ok')
                 {
                     var response = '<p class="userChat">' + message + '</p> <br>';
                     $(chatBox).append(response);
                 }
                 else
                 {

                 }
             },
             error: function(data)
             {console.log('Error \n'+data);}
         });
     }
     else
     {
        console.log("Error occurred during sending chat");
     }
}

/**
 * get the desired partner chat
 * @param to
 */
function getPartnerChat(to)
{
    var result = false;
    var form =
    {
        partner: to
    };
    $.ajax({

         url: 'Action/getChat.php',
         data:form,
         type:'post',
         dataType:'json',
         success: function(data)
         {
            if(data[0]['Status'] == 'ok')
            {
                result  =true;
                populateChatBox(data);
            }
         },
         error: function(data)
         {

         }
    });

}

/**
 * populate the chatBox from response
 * @param data
 */
function populateChatBox(data)
{
    var message = "";
    var element;
    $(chatBox).html("");
    for(var i= 0; i< data[1].length; i++)
    {
        if(data[1][i]['type'] == 'partner')
        {//message from partner
            message = data[1][i]['message'];
            element = '<p class="partnerChat">' + message + '</p> <br>';
        }
        else
        {//message from user
            message = data[1][i]['message'];
            element = '<p class="userChat">' + message + '</p><br>';
        }
        $(chatBox).append(element);
    }
    window.setInterval(function()
    {
        $.when( getPartnerChat(partner)).done(function(){
            getPartnerChat(partner);
        });
        console.log("working");
    },(50 * 1000));
    //$.when(getPartnerChat(partner)).then(getPartnerChat(partner));

}

