$(document).ready(function() {

    console.log(" i am working hahaa")


    // validating fields of add user master

    $("input").on('keyup' , function() {


        // validation for name field
        let value = $("input[type=text]").val().trim();

        let regText = /^[a-zA-Z\ ]{3,30}$/;
        
        if(regText.test(value)){
            $(".text-error").text("");
        }else if(value == ''){
            $(".text-error").text("field is rewuired");
        }
        else if(value.length < 3){
            $(".text-error").text("name should be greater than or equals to 3 words");
        }
        else if(value.length > 30){
            $(".text-error").text("name should be smaller than or equals to 30 words");
        }
        else{
            $(".text-error").text("Only Characters are allowed");
        };

        // validation for tel
        let phoneVal = $("input[type=tel]").val().trim();

        let regPhone = /^[0-9]{10}$/;

        if(regPhone.test(phoneVal)){
            $(".phone-error").text("");
        }else if(phoneVal == ''){
            $(".phone-error").text("");
        }
        else if(phoneVal.length < 10){
            $(".phone-error").text("Phone number must be of 10 digits");
        }
        else if(phoneVal.length > 10){
            $(".phone-error").text("Phone number must not be greater than 10 digits");
        }
        else{
            $(".phone-error").text("Only Digits are allowed");
        };

        // validation for email
        let emailVal = $("input[type=email]").val().trim();

        let regEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if(regEmail.test(emailVal)){
            $(".email-error").text("");
        }else if(emailVal == ''){
            $(".email-error").text("");
        }
        else if(emailVal.length > 30){
            $(".email-error").text("Email must be not greater than 30");
        }
        else{
            $(".email-error").text("Envaild email");
        };

        // validation for password
        let passwordVal = $("input[type=password]").val().trim();

        let regPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!%*?&]{8,15}$/;

        if(regPassword.test(passwordVal)){
            $(".password-error").text("");
        }else if(passwordVal == ''){
            $(".password-error").text("");
        }
        else if(passwordVal.length > 15){
            $(".password-error").text("Password must not be greater than 15");
        }
        else if(passwordVal.length < 8){
            $(".password-error").text("Password must be atleast longer than 8");
        }
        else{
            $(".password-error").text("Envaild Password");
        };
        
    })






})