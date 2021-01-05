$(document).ready(function() {
    $("#login_form").validate({
        onfocusout: false,
        rules:{ 
            email:{
                required:true,
                email:true
            },
            password:{
                required:true
            }
        },
        messages:{
            email:{
                required:"*Please enter the email.",
                email:"*Please enter valid email"
            },
            password:{
                required:"*Please enter the password."
            }
        }
    });
});
