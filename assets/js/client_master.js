$(document).ready(function () {

    // Make button selected on UI
    $(".sidebar-btn:nth-child(3)").addClass("click");


    // Getting form data 
    function getFormData() {

        let formData = new FormData(liveFormData);

        $.ajax({
            url: "assets/backend/client_master_backend.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                $(".my-client-table-body").html(data.table);
                $(".my-pagination-container").html(data.pagination)
            }
        })

    }

    getFormData();

    // Limit the number of record
    $("#limitId").on("input", function () {
        let value = $(this).val();
        $("#limitData").val(value);
        $("#pageId").val("1");
        getFormData();
    });

    // giving the value of current page to show record according to it
    $(document).on("click", ".my-pagination li", function () {
        let page = $(this).attr("id");

        $("#pageId").val(page);

        console.log(page);
        getFormData();
    });

    // Reset the search fields
    $("#reset-btn").click(function () {
        $(".live-search-inputs").trigger("reset");
    });

    // Live search 
    $('#liveFormData input').on('input', function () {
        $("#pageId").val("1");
        getFormData();
    })

    // Sorting in selected column
    let idSort = "ASC";
    $(document).on("click", ".changeMyImageOnSort", function () {

        if (idSort == "ASC") {
            idSort = "DESC";
        } else {
            idSort = "ASC";
        }

        let sortOn = $(this).text();

        $("#sortOnId").val(sortOn);
        $("#sortTypeId").val(idSort);

        getFormData();

    });

    // Changing sort icon on click

    $(".changeMyImageOnSort").on('click', function () {

        let icon = $(this).find("i");

        if ($(".changeMyImageOnSort").find("i").hasClass('bi-arrow-up')) {

            $(".changeMyImageOnSort").find("i").removeClass('bi-arrow-up');
            icon.addClass('bi-arrow-up')

        }
        else if ($(".changeMyImageOnSort").find("i").hasClass('bi-arrow-down')) {

            $(".changeMyImageOnSort").find("i").removeClass('bi-arrow-down');
            icon.addClass('bi-arrow-down')

        }

        if (icon.hasClass('')) {
            icon.addClass('bi-arrow-up');
        }
        else if (icon.hasClass('bi-arrow-up')) {
            icon.removeClass('bi-arrow-up').addClass('bi-arrow-down');
        }
        else {
            icon.removeClass('bi-arrow-down').addClass('bi-arrow-up');
        }

    })

    // Client master form submittion

    $("#client-master-submit-btn").on('click', function () {

        let formData = new FormData(addClientFormData);

        let checkForm = 1;

        fieldsData.map((ele) => {
            let value = $(ele.id).val();


            if (value == undefined) {

            }
            else {
                if ($(ele.id).val().trim() == "") {
                    $(ele.errId).text("field is required");
                    checkForm = 0;
                }
            }

        });


        console.log(checkForm);

        if (checkForm == 1) {

            $.ajax({
                url: "assets/backend/client_master_form.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);

                    // removing previous validation text
                    fieldsData.map((ele) => {
                        $(ele.errId).text("");
                    })

                    // when every this is ok in form
                    if (data.success == 1) {
                        console.log("Form submited successfully");
                        $("#addClientFormData").trigger("reset");
                        $(".Form-submition-success-message .alert-success").text(
                            "Client Added Successfully"
                        );
                        $(".Form-submition-success-message").slideDown("slow");
                        setTimeout(function () {
                            $(".Form-submition-success-message").slideUp("slow");
                        }, 4000);
                    }

                    // duplicate email
                    if (data.duplicateEmail.length > 0) {
                        $(".email-error").text("Email already exist");
                    }
                    // duplicate phone
                    if (data.duplicatePhone.length > 0) {
                        $(".phone-error").text("Phone already exist");
                    }

                    // validation of fileds from regularexpression
                    if (data.valid.length > 0) {
                        data.valid.forEach((ele) => {
                            if (ele == "name") {
                                $("." + ele + "-error").text(
                                    "Only characters are allowed and name must be longer that 2 characters"
                                );
                            }
                            if (ele == "email") {
                                $("." + ele + "-error").text("Invaid email");
                            }
                            if (ele == "phone") {
                                $("." + ele + "-error").text("Invaid phone number");
                            }
                            if (ele == "district") {
                                $("." + ele + "-error").text("Invaid City");
                            }
                            if (ele == "state") {
                                $("." + ele + "-error").text("Invaid State");
                            }
                            if (ele == "address") {
                                $("." + ele + "-error").text("Invaid address");
                            }

                        });
                    }

                    data.empty.forEach((ele) => {
                        $("." + ele + "-error").text("field is required");
                    });

                },
            });
        }

    })


    // Fetching city according to state

    $(document).on('change', '#user_state', function () {

        let value = $(this).children(":selected").attr("id");

        $(".dynamic-city").remove();
        $("#first-option-city").text("--Select city--");


        $.ajax({
            url: "assets/backend/district_master.php",
            type: "POST",
            data: { stateId: value },
            success: function (data) {
                console.log(data);
                $("#user_district").append(data);
            }
        })

    })


    // Deleting User
    $(document).on("click", ".user-delete-btn", function () {
        let myId = $(this).attr("id");
        console.log(myId);

        if (confirm("Do you really want to Delelte ?")) {

            $.ajax({
                url: "assets/backend/client_master_delete.php",
                type: "POST",
                data: { id: myId },
                success: function (data) {
                    console.log(data);
                    getFormData();
                },
            });
        } else {
            null;
        }
    });


    // Edit User data
    $(document).on("click", ".user-edit-btn", function () {
        let myId = $(this).attr("id");

        let change = $("#nav-profile-tab");

        let tab = new bootstrap.Tab(change);
        tab.show();

        $.ajax({
            url: "assets/backend/client_master_edit.php",
            type: "POST",
            data: { id: myId },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                $("#sendId").val(myId);
                $("#user_name").val(data.NAME);
                $("#user_phone").val(data.phone);
                $("#user_email").val(data.email);
                $("#user_address").val(data.address);
                $("#user_district").val(data.district);
                $("#user_pincode").val(data.pincode);
                $("#user_district").val(data.district);
                $("#user_state").val(data.state);

                let idOfState = $("#user_state").children(":selected").attr("id");
                console.log(idOfState);


                $("#user_state").trigger("change");

                $("#first-option-city").text(data.district);
                $("#first-option-city").value(data.district);

                $("#client-master-submit-btn").hide();
                $("#client-master-update-btn").show();
            },
        });


    });


    // update client btn
    $("#client-master-update-btn").on("click", function () {

        let formData = new FormData(addClientFormData);

        let checkForm = 1;

        fieldsData.map((ele) => {
            let value = $(ele.id).val();


            if (value == undefined) {

            }
            else {
                if ($(ele.id).val().trim() == "") {
                    $(ele.errId).text("field is required");
                    checkForm = 0;
                }
            }

        });


        console.log(checkForm);

        if (checkForm == 1) {

            $.ajax({
                url: "assets/backend/client_master_update.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);

                    // removing previous validation text
                    fieldsData.map((ele) => {
                        $(ele.errId).text("");
                    })

                    // when every this is ok in form
                    if (data.success == 1) {
                        console.log("Form submited successfully");
                        $("#addClientFormData").trigger("reset");
                        $(".Form-submition-success-message .alert-success").text(
                            "Client Added Successfully"
                        );
                        $(".Form-submition-success-message").slideDown("slow");
                        setTimeout(function () {
                            $(".Form-submition-success-message").slideUp("slow");
                        }, 4000);
                        $("#addUserFormData").trigger("reset");
                        let change = $("#nav-home-tab");

                        let tab = new bootstrap.Tab(change);
                        tab.show();
                        getFormData();
                    }

                    // duplicate email
                    if (data.duplicateEmail.length > 0) {
                        $(".email-error").text("Email already exist");
                    }
                    // duplicate phone
                    if (data.duplicatePhone.length > 0) {
                        $(".phone-error").text("Phone already exist");
                    }

                    // validation of fileds from regularexpression
                    if (data.valid.length > 0) {
                        data.valid.forEach((ele) => {
                            if (ele == "name") {
                                $("." + ele + "-error").text(
                                    "Only characters are allowed and name must be longer that 2 characters"
                                );
                            }
                            if (ele == "email") {
                                $("." + ele + "-error").text("Invaid email");
                            }
                            if (ele == "phone") {
                                $("." + ele + "-error").text("Invaid phone number");
                            }
                            if (ele == "district") {
                                $("." + ele + "-error").text("Invaid City");
                            }
                            if (ele == "state") {
                                $("." + ele + "-error").text("Invaid State");
                            }
                            if (ele == "address") {
                                $("." + ele + "-error").text("Invaid address");
                            }

                        });
                    }

                    data.empty.forEach((ele) => {
                        $("." + ele + "-error").text("field is required");
                    });

                },
            });
        }


    });




})