/**
 * Created by Mahmoud on 8/22/2017.
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}*/


$(document).ready(function(){
    $('#inputEmail').on('change paste keyup', function(){

        $('#email-msg').html("");

    });
    $('#inputPassword').on('change paste keyup', function(){

        $('#password-msg').html("");

    });
    $('#login').click(function(){
        var email = $('#inputEmail').val();
        var password = $('#inputPassword').val();


        if(!$.trim(email).length > 0){
            $('#login').val("Login");
            $('#email-msg').html("<span class='text-danger' style='color: #D9534F'><i class='glyphicon glyphicon-exclamation-sign'></i> This field is required .</span>");
            $('#msg').html("");
        }



        if($.trim(email).length > 0){
            $('#login').val("Login");
            $('#email-msg').html("");

        }



         if(!$.trim(password).length > 0){
            $('#login').val("Login");
            $('#password-msg').html("<span class='text-danger' style='color: #D9534F'><i class='glyphicon glyphicon-exclamation-sign'></i> This field is required .</span>");
             $('#msg').html("");
        }

        if($.trim(password).length > 0){
            $('#login').val("Login");
            $('#password-msg').html("");

        }



    if($.trim(email).length > 0 && $.trim(password).length > 0){

            $('#email-msg').html("");
            $('#password-msg').html("");

            $.ajax({
                url:"http://localhost/Winners10/Controllers/userController.php",
                method:"POST",
                data:{username:email, password:password},
                cache:false,
                dataType: 'json',
                beforeSend:function(){
                    $('#login').val("connecting...");
                },
                success:function(data)
                {


                    if(data.msg==2)
                    {


                        $('#login').val("Login");
                        $('#msg').html("<div class='alert alert-dismissible alert-danger' ><span class='text-danger' style='color: #fff'><i class='glyphicon glyphicon-exclamation-sign'></i> Invalid username or password</span></div>");
                    }

                    if(data.msg==1)
                    {
                        window.location.href = "http://localhost/Winners10/dashboard.php";
                    }

                }
                ,
                error: function () {
                    $('#msg').html("<div class='alert alert-dismissible alert-danger'  ><span class='text-danger' style='color: #fff'><i class='glyphicon glyphicon-exclamation-sign'></i> Error in recieving response. </span></div>");
                }

            });
        }






    });
});