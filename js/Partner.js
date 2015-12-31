/**
 * Created by Haziq on 12/12/2015.
 */

var partnerDiv  = "#partners";
var idGenerate  = 1001;
/**
 * get all the list of users which the user have ever send expressMessage
 * or ever initiated chat with
 */
function getAllPartnersList()
{
    $.ajax({

       url: 'Action/getAllPartners.php',
       type: 'post',
       dataType: 'json',
       success: function(data)
       {
           if(data[0][0]['Status'] == 'ok')
           {
              populatePartnersList(data);
           }
           else
           {
               console.log(data[0][0]['Message']);
           }
       },
       error: function(data)
       {
           alert(data);
       }
    });
}

/**
 * populates the partners section
 * provide partner name and image
 * @param data
 */
function populatePartnersList(data)
{
    for(var i=0; i<data[0][1].length; i++)
    {
        var name = data[0][1][i]['UserName'];
        var id   = data[0][1][i]['PartnerId'];
        var img  = 'data:image/png;base64,' + data[0][1][i]['Image'];
        var divElement = '<div id="'+idGenerate + '"class="user">';
        var inpElement = '<input  type="hidden" id="i'+idGenerate + '" value="'+id+ '" />';
        var imgElement = '<img class="images" src="'+img + '"/>';
        var tagElement = '<p class="name" >' + name + '</p> </div>';
        var dataElements = divElement + imgElement +  inpElement +tagElement ;
        $(partnerDiv).append(dataElements);
        //add the on click function
        $("#"+idGenerate).on('click',function()
        {
            //Get the partner identification
            //loads the partner Messages on click
            var to =  $("#i"+this.id).val();
            //Set the Partner identification
            setPartner(to);
            setInterval(getPartnerChat(to), 500);
        });
        idGenerate += 1;
    }
}