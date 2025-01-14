$(document).ready(function () {


    console.log("i am working fine...")

    $("#btn-login").on('click', function (e) {

        e.preventDefault();

        var emailVal = $("#emailId").val().trim();
        var passwordVal = $("#passwordId").val().trim();

        if (emailVal == "" || passwordVal == "") {
            if (emailVal == "") {
                $("#emailId").css({ "border-bottom-color": "red" });
                $("#emailErr").slideDown().show();
                $("#emailErr").text("This field is required");
            }
            else {
                $("#emailId").css({ "border-bottom-color": "black" });
                $("#emailErr").slideUp().hide();
                $("#emailErr").text("");
            }
            if (passwordVal == "") {
                $("#passwordId").css({ "border-bottom-color": "red" });
                $("#passwordErr").slideDown().show();
                $("#passwordErr").text("This field is required");
            }
            else {
                $("#passwordId").css({ "border-bottom-color": "black" });
                $("#passwordErr").slideUp().hide();
                $("#passwordErr").text("");
            }
        }
        else {

            // to hide required error
            $("#emailId").css({ "border-bottom-color": "black" });
            $("#emailErr").slideUp().hide();
            $("#emailErr").text("");
            $("#passwordId").css({ "border-bottom-color": "black" });
            $("#passwordErr").slideUp().hide();
            $("#passwordErr").text("");
            $("#alert-message").html("");

            // make call to backend to check user details 
            $.ajax({
                url: "assets/backend/login_backend.php",
                type: "POST",
                data: {
                    user_email : emailVal,
                    user_password : passwordVal,
                },
                success: function(data){
                    if(data == "0"){
                        $("#alert-message").html(`<div class='alert alert-danger' role='alert'>
                            Please fill all the fields
                        </div>`);
                    }
                    else if(data == "11"){
                        $("#alert-message").html(`<div class='alert alert-success' role='alert'>
                            Login Successfully !
                        </div>`);
                        $("#login_form").trigger("reset");
                        window.location.href="dashboard.php";
                    }
                    else{
                        $("#alert-message").html(`<div class='alert alert-danger' role='alert'>
                            email or password is wrong
                        </div>`);
                    }
                    console.log(data);
                }
            })





        }

    })


})