$(document).ready(function () {
  //Makes sure that all fields are filled before submitting the form
  $("#signinSubmit").click(function () {
    var email = $(this).parent().parent().find(".signin-input[name='email']").val(),
    password = $(this).parent().parent().find(".signin-input[name='password']").val();

    if (email != '' && password != '') {
      $(".signin-form").submit();
    } else {
      alert("Please make sure all fields are filled in.");
    }
  });
});
