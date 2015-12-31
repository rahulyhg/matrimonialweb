/**
 * Created by Haziq on 12/7/2015.
 */

/**
 * verify salary inputted
 * @return {boolean}
 */
function verifySalary()
{
    var id = "#salary";
    if($(id).val() != "")
    {
        if($(id).val() >= 100)
        {
            $("#salary").removeClass('error');
            return true;
        }
        else
        {
            $("#salary").addClass('error');
        }
    }
    else
    {
        $("#salary").addClass('error');
    }
   return false;
}

/**
 * final verification before going to next step
 */
function verifyAll()
{
    if(verifySalary())
    {

        var education = $("#education").val();
        var field     = $("#field").val();
        var working   = $("#working").val();
        var currency  = $("#currency").val();
        var salary    = $("#salary").val();

       if(education > 0 && field > 0 && working > 0 && currency > 0 && salary > 0)
       {
           var form = {

               education: education,
               field:     field,
               working:   working,
               currency:  currency,
               salary:    salary
           };
           console.log(form);
           $.ajax({

                  url: 'Action/EducationalInfo.php',
                  dataType: 'json',
                  data: form,
                  type: 'post',

                  success:   function(data)
                  {
                      if(data[0]['Status'] == "ok")
                      {  window.location.href = "signupformfive.php"; }
                      else{ var id = "#error";  $(id).show().append(data[0]['Message']);  }
                  },
                  error:     function(data)
                  {
                      var id = "#error";
                      console.log(data);
                      $(id).show().append("some error occurred");

                  }

           });
       }
        else
       {
           var id = "#error";
           $(id).show().append("Error occurred must provide all fields");
       }
    }
    else
    {
        var idd = "#error";
        $(idd).show().append("Invalid salary detected");
    }
}
