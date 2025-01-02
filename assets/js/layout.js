$(document).ready(function () {

    console.log(" i am working hahaa")


    // validating fields of add user master

    class formValidation {

        constructor(value, regexp, errId, errText) {

            this.value = value;
            this.regexp = regexp;
            this.errId = errId;
            this.errText = errText;

        }

        validation() {

            if (this.regexp.test(this.value)) {
                $(this.errId).text("");
            }
            else if (this.value == "") {
                $(this.errId).text("");
            }
            else {
                $(this.errId).text(this.errText);
            }

        }

    }

    // fields data for validation

    fieldsData = [
        {
            id: "#user_name",
            regexp: /^[a-zA-Z\ ]{3,30}$/,
            errId: ".name-error",
            errText: "Only characters are allowed and name must be longer that 2 characters"
        },
        {
            id: "#user_password",
            regexp: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!%*?&]{8,15}$/,
            errId: ".password-error",
            errText: "1 Uppercase , 1 special character , min length 8 is required and max length is 15"
        },
        {
            id: "#user_email",
            regexp: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,30}$/,
            errId: ".email-error",
            errText: "Invaid email"
        },
        {
            id: "#user_phone",
            regexp: /^[0-9]{10}$/,
            errId: ".phone-error",
            errText: "Invaid phone number"
        },
    ];

    // Input taking for validation 

    fieldsData.map(ele => {

        $(ele.id).on('input', function () {

            let value = $(ele.id).val().trim();

            let valObj = new formValidation(value, ele.regexp, ele.errId, ele.errText);

            valObj.validation();

        })

    })


    $("#user-master-submit-btn").on('click', function () {

        let formData = new FormData(addUserFormData);

        let checkForm = 1;


        fieldsData.map(ele => {

            if ($(ele.id).val().trim() == "") {
                $(ele.errId).text("field is required");
                checkForm = 0;
            }

        })
        fieldsData.map(ele => {

            if($(ele.errId).text() == ""){
                checkForm = 0;
            }

        })

        if (checkForm == 1) {

            $.ajax({
                url: "assets/backend/user_master_form.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {

                    data = JSON.parse(data); // parsing json into object

                    console.log("this i am getting in ajax : ", data);

                    // when every this is ok in form
                    if (data.success == 1) {
                        console.log("Form submited successfully");
                        // $("#addUserFormData").trigger("reset");
                        $(".Form-submition-success-message .alert-success").text("User Added Successfully");
                        $(".Form-submition-success-message").slideDown("slow");
                        setTimeout(
                            function () {
                                $(".Form-submition-success-message").slideUp("slow");
                            }, 4000);
                    }
                    // email duplicate
                    else if (data.duplicate.length > 0) {
                        $(".email-error").text("Email already exist");
                    }
                    // when field is not valid
                    else if (data.valid.length > 0) {
                        data.valid.forEach(ele => {
                            if (ele == "name") {
                                $("." + ele + "-error").text("Only characters are allowed and name must be longer that 2 characters");
                            }
                            if (ele == "password") {
                                $("." + ele + "-error").text("1 Uppercase , 1 special character , min length 8 is required and max length is 15");
                            }
                            if (ele == "email") {
                                $("." + ele + "-error").text("Invaid email");
                            }
                            if (ele == "phone") {
                                $("." + ele + "-error").text("Invaid phone number");
                            }
                        })
                    }
                    // when any field is empty
                    else {
                        data.required.forEach(ele => {
                            $("." + ele + "-error").text("Field is required");
                        });
                    }
                }
            });

        }


    })






})