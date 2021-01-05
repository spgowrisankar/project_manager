$(document).ready(function() {
    $("#reg_form").validate({
        onfocusout: false,
        rules:{
            fullname:{
                required:true,
                minlength:3
            },
            email:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength:6
            },
            con_password:{
                required : true,
                minlength : 6,
                equalTo : "#password"
            }
        },
        messages:{
            fullname:{
                required:"*Please enter the name.",
                minlength:"*Should be at least 3 characters"
            },
            email:{
                required:"*Please enter the email.",
                email:"*Please enter valid email"
            },
            password:{
                required:"*Please enter the password.",
                minlength:"*Should be at least 6 characters"
            },
            con_password:{
                required:"*Re-enter the password again.",
                minlength:"*Should be at least 6 characters",
                equalTo : "Mismatch password"
            }
        }
    });
});
