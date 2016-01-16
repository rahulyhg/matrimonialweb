<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/12/2016
 * Time: 12:46 PM
 */
?>


<!DOCTYPE html>
    <html>

   <head>
          <title>ShadiPlan</title>
          <script type="text/javascript" src="jslib/jquery-1.11.3.min.js"></script>
          <script type="text/javascript" src="js/bootstrap.min.js"></script>
         <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
         <script type="text/javascript" src="js/Language.js"></script>
         <script type="text/javascript" src="js/Country.js"></script>
         <script type="text/javascript" src="js/Religion.js"></script>
         <script type="text/javascript" src="js/Education.js"></script>
         <script type="text/javascript" src="js/Field.js"></script>
         <script type="text/javascript" src="js/Currency.js"></script>
         <script type="text/javascript" src="js/height.js"></script>
         <script type="text/javascript" src="js/Family.js"></script>
         <script type="text/javascript" src="js/MartialStatus.js"></script>
         <script type="text/javascript" src="js/Verifier.js"></script>
       <!-- <link rel="stylesheet" type="text/css" href="css/customstyle.css"> -->

   </head>

<body>

  <!--   Language sections and social media icons section -->
  <div class="headerSection">

      <h3 class="headerText">Select Language</h3>
      <select class="headerSelect">
          <option value="en">English</option>
          <option value="ar">Arabian</option>
          <option value="fr">French</option>
      </select>

      <table class="headerTable">
          <tr>
              <td>
                  <a href="#" style="hover"> <img src="image/icons/fb.PNG"/>  </a>
              </td>

              <td>
                  <a href="#"> <img src="image/icons/gmail.PNG"/>  </a>
              </td>

              <td>
                  <a href="#"> <img src="image/icons/twitter.PNG"/>  </a>
              </td>

              <td>
                  <a href="#"> <img src="image/icons/rss.PNG"/>  </a>
              </td>
          </tr>
      </table>

  </div>


  <!--   Quick Search section -->

  <div class="quickSearch">
   <h3 class="quickSearchText">Search the match who deserves you</h3>

      <table class="quickSearchTable">
          <tr>

              <td>
                  <label class="quickSearchLabel">Bride</label>
              </td>

              <td class="quickSearchTableData">
                  &nbsp; &nbsp;
                  <input style="margin-bottom: 30px;" type="radio" name="Gender" value="1" >
              </td>

              <td>
                  <label class="quickSearchLabel">Groom</label>
              </td>
              <td class="quickSearchTableData">
                  &nbsp; &nbsp;
                  <input style="margin-bottom: 30px;" type="radio" name="Gender" value="2" >
              </td>

              <td>
                  <label class="quickSearchLabel">From</label>
              </td>
              <td class="quickSearchTableData">
                  <select  id="ageLow" class="quickSearchSelect"></select>
              </td>

              <td>
                  <label class="quickSearchLabel">To</label>
              </td>
              <td class="quickSearchTableData">
                  <select  id="ageHigh" class="quickSearchSelect"></select>
              </td>


              <td class="quickSearchTableData">
                  <select  id="countre" class="quickSearchSelect">
                      <option value="Country">country</option>
                  </select>

              </td>


              <td class="quickSearchTableData">
                  <select  id="states" class="quickSearchSelect">
                      <option value="City">City</option>
                  </select>
              </td>

              <td class="quickSearchTableData">
                  <select  id="religions" class="quickSearchSelect">
                      <option value="religion">religion</option>
                  </select>
              </td>

              <td class="quickSearchTableData">
                  <select  id="sects" class="quickSearchSelect">
                      <option value="sect"> <p class="quickSearchOption"> Sect </p></option>
                  </select>
              </td>

              <td class="quickSearchTableData">
              <input class="quickSearchButton" style="width: 185px; height: 40px; " type="button" id="search">
              </td>
          </tr>
      </table>


</div>

  <!--   Member Login area section -->

  <div class="memberLoginSection">


   <table class="memberLoginTable">
       <tr>

          <td class="quickSearchTableData">
              <h3 style="color:#0081c2; font-size: x-large">Member Login</h3>
          </td>

           <td class="quickSearchTableData">
            <input  placeholder="Email/Username" type="email" class="input-medium" id="userNameLogin"/>
          </td>

           <td class="quickSearchTableData">
               <br/>
               <input placeholder="*******" type="password" class="input-medium" id="passwordLogin"/>
               <a href="#"><label style="color: red ">Forget Password?</label></a>
           </td>

           <td class="quickSearchTableData">
               <button class="memberLoginButton"  id="login"></button>
           </td>

           <td class="quickSearchTableData">
               <img src="image/ring.PNG"/>
           </td>

           <td class="quickSearchTableData">
               <a href="#"><img src="image/fbButton.PNG"/> </a>
           </td>
       </tr>



   </table>


  </div>

 <!-- Help Section -->
 <div class="helpSection">
     <div style="border-left:medium #ffffff solid; position:absolute; left:150px; height:50px;" ></div>
     <h3 style="color: #ffffff; font-size: large;  margin-bottom: 10px; margin-left:11%" >HELP</h3>
     <div style="border-left:medium #ffffff solid; position:absolute; left:280px; height:50px;     margin-top: -3%;" ></div>
     <div style="border-left: medium #ffffff solid;position: absolute; left: 68%; height: 50px; margin-top: -3%;" ></div>
     <h3 style="    color: #ffffff;font-size: large;margin-left: 70%; margin-top: -3%;">Join Now for Free</h3>
     <div style="border-left:medium #ffffff solid; position:absolute; left:80%; height:50px;     margin-top: -3.6%;" ></div>
 </div>

<!-- Main section -->

<div class="mainSection">

    <!-- Hadith Section -->
    <div class="hadithSection">

        <h2 class="hadithHeadingText">Hadees-e-Nabwi (S.A.W)</h2>
        <p id="hadith" class="hadithText">
            " Jb tmhy kisi aisy ki taraf se <br/> nikah ka paigham aye jis k ikhlaq or <br/> deen se tm mutmain ho
            to us <br/> nikah k paigham ko qabool krlo "<br/> <br/>
        </p>
    </div>

    <!-- Registration Section -->
    <div class="registrationSection">
    <button id="premiumMembersBenifits" class="premiumMembersBenifits"></button>

        <!-- For the form time Line info -->
        <div>
            <button id="backButton" class="registrationBackButton"></button>
            <h3 id="FormName" class="registrationTimeline"> Basic Information </h3>
            <br/> <br/>
        </div>
        <!-- Section for form submission will go here -->
        <div id="form1" class="">
        <table>

            <tr >
                <td style="padding:0px;40px;0px;40px">
                    <label class="registrationLabel" for="error"></label>
                </td>
                <td >
                    <p id="error" class="errorText" name="error"></p>
                </td>
            </tr>

            <tr >
                <td style="padding:0px;40px;0px;40px">
                <label class="registrationLabel" for="userName">UserName </label>
                </td>
                <td >
                    <input class="registrationFields" type="text" id="userName" name="userName" onchange="verifyUsername( $('#userName').val() )" >
                </td>
            </tr>

            <tr >
                <td style="padding:0px;40px;0px;40px">
                    <label class ="registrationLabel" for="email">Email </label>
                </td>
                <td >
                    <input class="registrationFields" type="email" id="email" name="email" onchange="verifyEmail( $('#email').val() )">
                </td>
            </tr>

            <tr >
                <td style="padding:0px;40px;0px;40px">
                    <label class ="registrationLabel" for="password">Password </label>
                </td>
                <td >
                    <input class="registrationFields" type="password" id="password" name="password">
                </td>
            </tr>

            <tr >
                <td >
                    <label class ="registrationLabel" for="conform">Conform Password </label>
                </td>
                <td >
                    <input class="registrationFields" type="password" id="conform" name="conform">
                </td>
            </tr>

            <tr >
                <td >
                    <label class ="registrationLabel" for="gender">Gender </label>
                </td>
                <td >
                    <select class="registrationFields" id="gender" name="gender">
                    <option value="Select Gender">Select Gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td >
                    <label class ="registrationLabel" for="dob">Birth </label>
                </td>
                <td >
                    <input type="date" class="registrationFields" id="dob" name="dob"/>
                </td>
            </tr>

            <tr>
                <td >
                    <label class ="registrationLabel" for="next"></label>
                </td>
                <td >
                    <br/>
                    <button id="next" name="next" class="btn-danger" style="width: 120px; margin-left:40%;">Next</button>

                </td>
            </tr>

        </table>
        </div>

        <div id="form2" class="" style="display: none">
            <table>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class="registrationLabel" for="country" onload="loadCountriesName()">Country </label>
                    </td>
                    <td >
                        <select id="country" name="country" class="registrationFields"></select>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="city">city </label>
                    </td>
                    <td >
                        <select id="state" name="city" class="registrationFields" onchange="getStates( $('#country').val() )"></select>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="code">Code </label>
                    </td>
                    <td >
                        <select class="registrationFields" id="codes" name="code"></select>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="cell">Cell </label>
                    </td>
                    <td >
                        <input type="tel" maxlength="10" class="registrationFields" id="cell" name="cell"/>
                    </td>
                </tr>

                <tr >
                    <td >
                        <label class ="registrationLabel" for="religion">Religion </label>
                    </td>
                    <td >
                        <select id="religion" name="religion" class="registrationFields"></select>
                    </td>
                </tr>

                <tr >
                    <td >
                        <label class ="registrationLabel" for="sect">Sect </label>
                    </td>
                    <td >
                        <select class="registrationFields" id="sect" name="sect"></select>
                    </td>
                </tr>

                <tr>
                    <td >
                        <label class ="registrationLabel" for="language">Language </label>
                    </td>
                    <td >
                        <select class="registrationFields" id="language" name="language"></select>
                    </td>
                </tr>

                <tr>
                    <td >
                        <label class ="registrationLabel" for="me">Myself </label>
                    </td>
                    <td>
                        <textarea class="registrationFields" id="me" name="me"></textarea>
                    </td>
                </tr>

                <tr>
                    <td >
                        <label class ="registrationLabel" for="next"></label>
                    </td>
                    <td >
                        <br/>
                        <button id="next2" name="next" class="btn-danger" style="width: 120px; margin-left:40%;">Next</button>

                    </td>
                </tr>

            </table>

        </div>

        <div id="form3" class="" style="display: none">
            <table>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class="registrationLabel" for="Education">Education </label>
                    </td>
                    <td >
                        <select id="education" name="Education" class="registrationFields"></select>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="Field">Field </label>
                    </td>
                    <td >
                        <select id="field" name="Field" class="registrationFields"></select>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="Working">Working </label>
                    </td>
                    <td >
                        <select class="registrationFields" id="working" name="Working"></select>
                    </td>
                </tr>

                <tr>
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="Income">Income </label>
                    </td>
                    <td >
                        <input type="number" class="registrationFields" id="income" name="Income"/>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="Currency">Currency </label>
                    </td>
                    <td >
                        <select class="registrationFields" id="currency" name="Currency"></select>
                    </td>
                </tr>

                <tr>
                    <td >
                        <label class ="registrationLabel" for="next"></label>
                    </td>
                    <td >
                        <br/>
                        <button id="next3" name="next" class="btn-danger" style="width: 120px; margin-left:40%;">Next</button>
                    </td>
                </tr>

            </table>
        </div>

        <div id="form4" class="" style="display: none">

            <table>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class="registrationLabel" for="Height">Height </label>
                    </td>
                    <td >
                        <select id="height" name="Height" class="registrationFields"></select>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="Weight">Weight </label>
                    </td>
                    <td >
                        <select id="weight" name="Weight" class="registrationFields"></select>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="Disability">Disability </label>
                    </td>
                    <td >
                        <input type="radio" class="registrationFields" id="yes" value="1" name="Disability"/>
                    </td>
                </tr>

                <tr style="display:none">
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="Type">Type </label>
                    </td>
                    <td >
                        <select id="disability" name="Type" class="registrationFields"></select>
                    </td>
                </tr>

                <tr>
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="Marital">Marital </label>
                    </td>
                    <td >
                        <select class="registrationFields" id="martial" name="Marital"></select>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="FamilyType">FamilyType </label>
                    </td>
                    <td >
                        <select class="registrationFields" id="type" name="FamilyType"></select>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="FamilyStatus">FamilyStatus </label>
                    </td>
                    <td >
                        <select class="registrationFields" id="class" name="FamilyStatus"></select>
                    </td>
                </tr>


                <tr>
                    <td >
                        <label class ="registrationLabel" for="next"></label>
                    </td>
                    <td >
                        <br/>
                        <button id="next4" name="next" class="btn-danger" style="width: 120px; margin-left:40%;">Next</button>
                    </td>
                </tr>

            </table>

        </div>

        <div id="form5" class="" style="display: none">
            <table>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class="registrationLabel" for="Partner">Partner </label>
                    </td>
                    <td >
                        <textarea name="Partner" id="partner" placeholder="Partner preference should not be more then 100 length"></textarea>
                    </td>
                </tr>

                <tr >
                    <td style="padding:0px;40px;0px;40px">
                        <label class ="registrationLabel" for="Agree">Terms and Conditions </label>
                    </td>
                    <td >
                        <input type="checkbox" name="Agree" id="agree"/>
                    </td>
                </tr>

                <tr>
                    <td >
                        <label class ="registrationLabel" for="next"></label>
                    </td>
                    <td >
                        <br/>
                        <button id="next5" name="next" class="btn-danger" style="width: 120px; margin-left:40%;">Next</button>
                    </td>
                </tr>

            </table>
        </div>

    </div>
</div>


<!--New members Section -->
<div class="newMembersSection" id="newMembers">
    <h3 class="newMembersText"> New Members Section</h3>
</div>

  <!-- Featured Members -->
  <div class="featuredMembersSection" id="featuredMembers">
      <h3 class="featuredMembersText"> Featured Members Section</h3>
  </div>

<!-- Header Section -->
<div class="footerSection">
    <img style="margin-left: 1%;" src="image/logo_blue.PNG">

    <p style="margin-top: -0.1%;" class="newMembersText">AqdZawaj.com is the only portal in the history of online <br/> matrimony to provide
    matrimony services solely based on community. <br/> It has dedicated approximately 30+ portals for various communities
    around the globe <br/> it's the right destination for singles looking for a life partner within <br/> their community
    <br/> When you register on CommunityMatrimony.com, based on your community, your <br/> profile will be assigned
    to the relevant community matrimony <br/> site where you can search and collect profiles from your... <strong>Read more</strong> </p>

    <div class="footerLinks">
        <table class="footerTable">

            <tr >

                <td  style="    padding: 0px 70px 0px 70px;">
                    <h3 class="footerText">Need Help?</h3>
                </td>

                <td  style="    padding: 0px 70px 0px 70px;">
                    <h3 class="footerText">Privacy and You</h3>
                </td>

                <td  style="    padding: 0px 70px 0px 70px;">
                    <h3 class="footerText">Network Sites</h3>
                </td>

                <td  style="    padding: 0px 70px 0px 70px;">
                    <h3 class="footerText">Company</h3>
                </td>
            </tr>

            <tr>
                <td style="">
                    <a href="#"><p class="footerLinksText">MemberLogin</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">Terms of use</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">shadiPlan.com</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">About Shadi.com</p> </a>
                </td>

            </tr>



            <tr>
                <td style="">
                    <a href="#"><p class="footerLinksText">RegisterFree</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">Privacy Policy</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">AqdZawaj.com</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">Blog</p> </a>
                </td>
            </tr>

            <tr>
                <td style="">
                    <a href="#"><p class="footerLinksText">PartnerSearch</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">Security Tips</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">Affiliate Program</p> </a>
                </td>
            </tr>

            <tr>
                <td style="">
                    <a href="#"><p class="footerLinksText">How to use Shadi.com</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">Report misuse</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">Join Us</p> </a>
                </td>
            </tr>

            <tr>
                <td style="">
                    <a href="#"><p class="footerLinksText">Premium Membership</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">List your site</p> </a>
                </td>
            </tr>

            <tr>
                <td style="">
                    <a href="#"><p class="footerLinksText">Customer Support</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">Awards & Recognizition</p> </a>
                </td>
            </tr>

            <tr>
                <td style="">
                    <a href="#"><p class="footerLinksText">Contact Us</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText">Site Map</p> </a>
                </td>
            </tr>

            <tr>
                <td style="">
                    <a href="#"><p class="footerLinksText">Success Stories</p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>

                <td style="">
                    <a href="#"><p class="footerLinksText"></p> </a>
                </td>
            </tr>

        </table>
        <img src="image/logo_white.PNG" style="margin-left: 80%;margin-top: -20%;"/>
    </div>


    <img src="image/seperator.PNG" style="margin-left: 300px;margin-top: -20%;" />

    <img src="image/seperator.PNG" style="margin-left: 250px;margin-top: -20%;" />

    <img src="image/seperator.PNG" style="margin-left:250px;margin-top: -20%;" />

    <div class="footerCompany">
    <h3 class="footerCompanyText">
        Design and developed by <a href="#"> <h3 class="footerCompanyTextLink">MabsApps</h3> </a>
    </h3>
    </div>

</div>


    <script type="text/javascript">

          $(document).ready(function()
          {
              getLanguages();
              loadCountriesName();
              loadCountryCodes();
              getReligions();
              getEducationList();
              getAllField();
              getWorkingList();
              getCurrenyList();
              loadAll();
              getsAllFamilyTypes();
              getAllFamilyClasses();

              $('#religion').change(function(){
                  //'#country option:selected'
                  console.log( 'value: ' + $(this).val());
                  getSects(this.value);
              });

              $('#country').change(function(){
                  //'#country option:selected'
                  console.log( 'value: ' + $(this).val());
                  getStates(this.value);
              });

              var currentIndex = 1;
              $('#next').click(function()
              {
                  //alert('click');

              });

              $('#next2').click(function()
              {
                  $("#form2").slideUp(100,function()
                  {
                      $("#form1").hide();
                      $("#form2").hide();
                      $("#FormName").text('Physical/Personel Information');
                      $("#form3").slideDown(800,function()
                      {
                          currentIndex = 2;
                          $("#form3").show();
                      });
                  });
              });

              $('#next3').click(function()
              {
                  //alert('click');
                  $("#form1").hide();
                  $("#form2").hide();
                  $("#form3").hide();
                  $("#form4").show();
                  $("#FormName").text('Family Background');
                  currentIndex = 3;
              });

              $('#next4').click(function()
              {
                  //alert('click');
                  $("#form1").hide();
                  $("#form2").hide();
                  $("#form3").hide();
                  $("#form4").hide();
                  $("#form5").show();
                  $("#FormName").text('Partner');
                  currentIndex = 5;
              });

              $('#backButton').click(function()
              {
                  console.log(currentIndex);
                  if(currentIndex > 0 && (currentIndex -1) > 0)
                  {
                      var id = '#form'+(currentIndex -1) ;
                      $('#form'+currentIndex).hide();
                      $(id).show();
                      currentIndex -= 1;

                      switch (currentIndex)
                      {
                          case 1:
                              $("#FormName").text('Basic Information');
                              break;

                          case 2:
                              $("#FormName").text('Socio/Religious Information');
                              break;

                          case 3:
                              $("#FormName").text('Physical/Personel Information');
                              break;

                          case 4:
                              $("#FormName").text('Family Background');
                              break;

                          case 5:
                              $("#FormName").text('Partner Information');
                             break;
                      }

                  }
              })

              var feets = getFeets();
              var height = getHeights();
              var weight = getWeight();
              for(var i=0; i< feets.length; i++)
              {
                  $("#height").append($("<option />").val(height[i]).text(feets[i]));
              }

              for(var i=0; i<weight.length; i++)
              {
                  $("#weight").append($("<option />").val(weight[i]).text(weight[i]));
              }

          });


    </script>

</body>
</html>
