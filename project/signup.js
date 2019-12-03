$(document).ready(function () {
  $("#signupSubmit").click(function () {
    var email = $(this).parent().parent().find(".signup-input[name='email']").val(),
    password = $(this).parent().parent().find(".signup-input[name='password']").val(),
    confirmPassword = $(this).parent().parent().find(".signup-input[name='confirmPassword']").val();

    if (password == confirmPassword && email != '' && password != '' && confirmPassword != '') {
      $(".signup-form").submit();
      alert("Signup succesful!");
    } else {
      alert("Please make sure your passwords match and all fields are completed.");
    }
  });
});
