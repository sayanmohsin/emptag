// $('.ui.form')
// .form({
//   fields: {
//     username : 'empty',
//     password : ['minLength[6]', 'empty']
//   }
// });

$("#empInBtn").click(function(){
  var url = path+"/empLoginProcess";
  var username = $("#login-name").val();
  var password = $("#login-pass").val();
$.post(url,
  {username: username, password: password},
  function (data) {
      if (data.indexOf(',') > -1) {
      var res = data.split(",");
      status = res[0];
      message = res[1];
      $('#message').text(message);
      } else {
      // $('html').html(data);
          window.location.href = path; 
      }
  });
});
