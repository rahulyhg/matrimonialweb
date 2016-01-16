/**
 * Created by Haziq on 12/5/2015.
 */
/**
 * Global states recorder
 */

var Username = false;
var Email    = false;
var Password = false;
var Error="";

/**
 * verify user inputted UserName
 * @param username
 * @return boolean
 */
function verifyUsername(username)
{
    var result = false;
    var form = {
        name: username
    };
    $.ajax({

        url:"Action/verifyUserName.php",
        type:"POST",
        dataType:"json",
        data: form,
        success: function(data)
        {
            if(data[0]['Status'] == 'ok')
            {
                 if(data[0]['verify'] == "1")
                 {
                     $("#name").removeClass('error');
                     //alert("Unique");
                     result = true;
                     Username  = true;
                 }
                 else
                 {
                     //alert("not Unique");
                     $("#userName").addClass('error');
                     $("#error").append('Username already exists').show();
                     Error += "Username already exists \n";
                 }
            }
            else
            {
                console.log("Error loading codes");

            }
        },
        error:   function(data)
        {
            console.log(data[0]['Message']);
        }
    });
   return result;
}

/**
 * verify user inputted Email
 * @param email
 * @return boolean
 */
function verifyEmail(email)
{
    var result = false;
    var form = {
        email: email
    };
    if(validateEamil()) {
        $.ajax({

            url: "Action/verifyEmail.php",
            type: "POST",
            dataType: "json",
            data: form,
            success: function (data) {
                if (data[0]['Status'] == 'ok') {
                    if (data[0]['verify'] == "1") {
                        $("#email").removeClass('error');
                        //alert("Unique");
                        result = true;
                        Email = true;
                    }
                    else {
                        $("#email").addClass('error');
                        Error += "Email already exists \n";
                        $("#error").append(Error).show();
                    }
                }
                else {
                    console.log("Error loading codes");
                }
            },
            error: function (data) {
                console.log(data[0]['Message']);
            }
        });
    }
    return result;
}

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
                if (data[0]['Status'] == 'ok') {
                    if (data[0]['verify'] == "1") {
                        $("#cell").removeClass('error');
                        //alert("Unique");
                        result = true;
                        Celll = true;
                    }
                    else {
                        $("#cell").addClass('error');
                        Error += "Cell number already exists";
                    }
                }
                else {
                    console.log("Error loading codes");
                }
            },
            error: function (data) {
                console.log(data[0]['Message']);
            }
        });
    }
    return result;
}

/**
 * validate passwords and conform passwords
 * @returns {boolean}
 */
function validatePasswords()
{
    var passwordId = '#password';
    var conformId  = '#conform';
    var password = $(passwordId).val();
    var conform  = $(conformId).val();
    console.log("Password: " + password + "\t" + "Conform: "+ conform);
    console.log("result: "+password.localeCompare(conform));
    if( (password.localeCompare(conform)) == 0)
    {
        //alert("Match");
        $(passwordId).removeClass('error');
        $(conformId).removeClass('error');
        Password = true;
        return true;
    }
    else
    {
        //alert("dontMatch");
        var span = $('<span />').html('Passwords should match');
        Error += "Password should match";
        $(passwordId).addClass('error');
        $(passwordId).addClass('error');
        $(conformId).html(span);
    }
    return false;
}


/**
 * validate email format
 * @return {boolean}
 */
function validateEamil()
{
    var emailId = "#email";
    var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if($(emailId).val() != '' && re.test($(emailId).val()))
    {
        $(emailId).removeClass('error');
        return true;
    }
    else
    {
        $(emailId).addClass('error');
        Error += "Invalid email address provided \n Email should be in something@somedomain.com";
        return false;
    }
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


function verifyAll()
{
    var id = "#dob";
    var radioMale = "#male";
    if(Username && Password && Email  && $(id).val() != '' && ( $(radioMale).is(':checked') || $("#female").is(':checked'))  )
    {

        var gender;
        if($(radioMale).is(':checked'))
        {
            gender = '1';
        }
        else
        {
            gender = '2';
        }
        var form =  {

            name: $("#name").val(),
            email:$('#email').val(),
            password:$('#password').val(),
            dob     : $('#dob').val(),
            gender  : gender
         };

         console.log(form);
        $.ajax(
            {
                  url: 'Action/BasicInfo.php',
                  dataType: 'json',
                  data: form,
                  type: 'post',
                  success: function(data)
                  {
                      //success
                      if(data[0]['Status'] == 'ok')
                      {
                          $("#form1").slideUp(100,function()
                          {
                              $("#form1").hide();
                              $("#FormName").text('Socio Religious Background');
                              $("#form2").slideDown(800,function()
                              {
                                  $("#form2").show();
                              });
                          });
                      }
                      else
                      {
                          var error = "#error";
                          $(error).empty();
                          $(error).show().append(data[0]['Message']);
                      }
                  },
                  error: function(data)
                  {
                      var error = "#error";
                      $(error).show().append(data[0]['Message']);
                  }

        });
    }
    else
    {
          Error += "Please provide all mendatory fields \n";
          console.log("Error occurred");
          $("#error").show().append(Error);
    }

}