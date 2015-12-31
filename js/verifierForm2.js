/**
 * Created by Haziq on 12/6/2015.
 */

var Celll  =false;
/**
 * verify inputted cell number
 * @param cell
 * @return {boolean}
 */
function verifyCell(cell)
{
    var result = false;
    var form = {
        cell: cell
    };
    if(validateCell()) {
        $.ajax({

            url: "Action/verifyCell.php",
            type: "POST",
            dataType: "json",
            data: form,
            success: function (data) {
                if (data[0]['Status'] == 'ok')
                {
                    if (data[0]['verify'] == "1")
                    {
                        $("#cell").removeClass('error');
                        //alert("Unique");
                        result = true;
                        Celll = true;
                    }
                    else
                    {
                        $("#cell").addClass('error');
                        Error += "Cell number already exists";
                    }
                }
                else {
                    console.log("Error loading codes");
                }
            },
            error: function (data)
            {
                console.log(data[0]['Message']);
            }
        });
    }
    return result;
}

/**
 * validate cell number format
 * @return {boolean}
 */
function validateCell()
{
    var cellId = "#cell";
    var cell = $(cellId).val();
    var isnum = /^\d+$/.test(cell);
    if(isnum)
    {
        $(cellId).removeClass('error');
        return true;
    }
    else
    {
        $(cellId).addClass('error');
        return false;
    }

}

/**
 * button code
 */
function verifyAll()
{
  var error     =  "#error";
  var country   =  $('#country').val();
  var state     =  $('#state').val();
  var religion  =  $('#religion').val();
  var sect      =  $('#sect').val();
  var language  =  $('#language').val();
  var me        =  $('#me').val();
  var cellV     = $("#codes option:selected").text() + $('#cell').val()

  if(country != '' && Celll && state != '' && religion != '' && sect != '' && language != '' && me != '')
  {
      var form = {

          country:   country,
          state:     state,
          religion:  religion,
          sect:      sect,
          language:  language,
          me:        me,
          cell:      cellV
      };
      console.log(form);
      $.ajax({

             url: 'Action/SocialInfo.php',
             data:form,
             type: 'post',
             dataType: 'json',
             success:  function(data)
             {
                 if(data[0]['Status'] == 'ok')
                 {
                     window.location.href = 'signupformthree.php';
                 }
                 else
                 {
                     $(error).show();
                     $(error).append(data[0]['Message']);
                 }
             },
             error:    function(data)
             {
                 $(error).show().append(data[0]['Message']);
             }
      });
  }
  else
  {
      $(error).show().append('All fields must be provided');
  }


}