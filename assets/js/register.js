$(document).ready(function(){
 
  
    $("#provinces").hide();

    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
    $( '.uls-trigger' ).uls( {
        onSelect : function( language ) {
            var languageName = $.uls.data.getAutonym( language );
            $( '.uls-trigger' ).text( languageName );
        },
        quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr'] //FIXME
    } );


    var base_url=window.location.origin + "/mzansiserve1/";
    $('#referrals').on('change', function() {
        var value = $(this).val();
       
        $("#NumberContacts").empty();
    if(value!="none"){
        $("#NumberContacts").append("<label>Emails</label>"); 
        for( var i=0; i<value; i++){
            $("#NumberContacts").append("<input class='form-control' type='text' name='referral_contacts[]'><br>");   
        }
        
    }
        
    
});


  //email validation
  $( "#email" ).mouseleave(function() {
  var email = $(this).val();
  if(email!=""){
  var user_url=base_url  + "index.php?login/Email_exists/" + email;
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  $("#email_info").empty();
  if (!regex.test(email)) {
   
    $("#email_info").append("<h4>Your email should follow this format any@any.com</h4"); 
  }
  $.get( user_url, function( data ) {
  if(data==0){
   
 }
 if(data==1){
   
    $("#email_info").append("<h4>You are already registered</h4"); 
 }
  });  
}
});


 //site_code validation
  $( "#unitCode" ).on('keyup', function() {
  var unitCode = $(this).val();
  var user_url=base_url  + "index.php?login/unitCode_exists/" + unitCode;
  $("#unitCode_info").empty();
  if (unitCode.length<6) {
  
    $("#unitCode_info").append("<h4>Your unitCode must be exactly 6 characters</h4"); 
  }
  $.get( user_url, function( data ) {
  if(data==0){
    $("#unitCode_info").append("<h4>Your unitCode, does not exist check properly</h4"); 
 }
 if(data==1){
   
   
 }
  });  
  
});


 //confirm password
 $( "#cpassword" ).mouseleave(function() {
  var cpassword = $(this).val();
  var password=$("#password").val();
  $("#cpassword_info").empty();
  if(password!=cpassword){
    $("#cpassword_info").append("<h4>Your passwords don't match</h4"); 
  }
});

//password strength validation
$( "#password" ).mouseleave(function() {
  var number = /([0-9])/;
  var alphabets = /([a-zA-Z])/;
  var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
  if($('#password').val().length<6) {
  $('#password-strength-status').removeClass();
  $('#password-strength-status').addClass('weak-password');
  $('#password-strength-status').html("<h4>Weak (should be atleast 6 characters.)</h4>");
  } else {  	
  if($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {            
  $('#password-strength-status').removeClass();
  $('#password-strength-status').addClass('strong-password');
  $('#password-strength-status').html("<h4>Strong</h4>");
  } else {
  $('#password-strength-status').removeClass();
  $('#password-strength-status').addClass('medium-password');
  $('#password-strength-status').html("<h4>Medium (should include alphabets, numbers and special characters.)</h4>");
  }}
});
$('#country').click(function(event){
    event.preventDefault();
var selected=$('option:selected',this).val();

if(selected=="ZA"){
    $("#provinces").show();
}
   
    });
});
