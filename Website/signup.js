$(document).ready(function () {
  $("#signupSubmit").click(function () {
    var email = $(this).parent().find(".signup-input[name='email']").val(),
    password = $(this).parent().find(".signup-input[name='password']").val(),
    confirmPassword = $(this).parent().find(".signup-input[name='confirmPassword']");

    console.log(confirmPassword);
  });
});
