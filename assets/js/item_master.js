$(document).ready(function () {


    // Make button selected on UI
    $(".sidebar-btn:nth-child(4)").addClass("click");

    // reset search fileds 

    $(".reset-btn").click(function(){

        $("input").val("");
        getFormData();

    })


    // Getting form data 
    function getFormData() {

        let formData = new FormData(liveFormData);

        $.ajax({
            url: "assets/backend/item_master_backend.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                $(".my-item-table-body").html(data.table);
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
    $(document).on("click", ".my-pagination .li", function () {
        let page = $(this).attr("id");

        $("#pageId").val(page);

        console.log(page);
        getFormData();
    });

    // next button pagination
    $(document).on('click', '.next', function () {

        let page = $(this).parents('.my-pagination').find('.active').attr('id');
        let totalPage = $(".my-pagination").attr("id");
        console.log(totalPage)
        page = Number(page) + 1;
        if (page <= totalPage) {
            $("#pageId").val(page);
            getFormData();
        }

    })

    // previous button pagination
    $(document).on('click', '.prev', function () {

        let page = $(this).parents('.my-pagination').find('.active').attr('id');
        page = Number(page) - 1;
        console.log(page)
        if(page>0){
            $("#pageId").val(page);
            getFormData();
        }

    })

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

        let sortOn = $(this).data('set');

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

    // Getting image on input 

    $("#item_image").on('input', function () {


        if ($("#item_image").val() == "") {
            document.getElementById("imagePreview").src = "";
        }
        else {
            document.getElementById("imagePreview").src = window.URL.createObjectURL(this.files[0]);
        }

    })


    // Item master form submittion

    $("#item-master-submit-btn").on('click', function () {

        let formData = new FormData(addItemFormData);

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
                url: "assets/backend/item_master_form.php",
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
                        $("#addItemFormData").trigger("reset");
                        $(".Form-submition-success-message .alert-success").text(
                            "Item Added Successfully"
                        );
                        $(".Form-submition-success-message").slideDown("slow");
                        setTimeout(function () {
                            $(".Form-submition-success-message").slideUp("slow");
                        }, 4000);
                        document.getElementById("imagePreview").src = "";
                        getFormData();
                    }

                    // duplicate item
                    if (data.duplicateItem.length > 0) {
                        $(".item-error").text("Item already exist");
                    }

                    // validation of fileds from regularexpression
                    if (data.valid.length > 0) {
                        data.valid.forEach((ele) => {
                            if (ele == "item") {
                                $("." + ele + "-error").text("Invalid item name");
                            }
                            if (ele == "price") {
                                $("." + ele + "-error").text("Only numbers allowed");
                            }
                            if (ele == "description") {
                                $("." + ele + "-error").text("Max length must be 255 only");
                            }
                            if (ele == "image") {
                                $("." + ele + "-error").text("Invalid type of image");
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


    // Deleting User
    $(document).on("click", ".user-delete-btn", function () {
        let myId = $(this).attr("id");
        console.log(myId);

        if (confirm("Do you really want to Delelte ?")) {

            $.ajax({
                url: "assets/backend/item_master_delete.php",
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
            url: "assets/backend/item_master_edit.php",
            type: "POST",
            data: { id: myId },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                $("#sendId").val(myId);
                $("#item_name").val(data.item_name);
                $("#item_description").val(data.item_description);
                $("#item_price").val(data.item_price);
                document.getElementById("imagePreview").src = "assets"+data.item_image.substring(2);

                $("#item-master-submit-btn").hide();
                $("#item-master-update-btn").show();
            },
        });


    });

    // update client btn
    $("#item-master-update-btn").on("click", function () {

        let formData = new FormData(addItemFormData);

        let checkForm = 1;

        fieldsData.map((ele) => {

            if (ele.id === "#item_image") {
                return null;  // Skip this iteration
            }
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
                url: "assets/backend/item_master_update.php",
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
                        $("#addItemFormData").trigger("reset");
                        document.getElementById("imagePreview").src = "";
                        let change = $("#nav-home-tab");

                        let tab = new bootstrap.Tab(change);
                        tab.show();
                        getFormData();
                    }

                    // duplicate item
                    if (data.duplicateItem.length > 0) {
                        $(".item-error").text("Item already exist");
                    }

                    // validation of fileds from regularexpression
                    if (data.valid.length > 0) {
                        data.valid.forEach((ele) => {
                            if (ele == "item") {
                                $("." + ele + "-error").text("Invalid item name");
                            }
                            if (ele == "price") {
                                $("." + ele + "-error").text("Only numbers allowed");
                            }
                            if (ele == "description") {
                                $("." + ele + "-error").text("Max length must be 255 only");
                            }
                            if (ele == "image") {
                                $("." + ele + "-error").text("Invalid type of image");
                            }
                        });
                    }

                    // query of insert 
                    console.log(data.query);

                    data.empty.forEach((ele) => {
                        $("." + ele + "-error").text("field is required");
                    });

                },
            });
        }


    });


    // clearing form fields when clicking on home page
    $("#nav-home-tab").on("click", function () {

        $("#addItemFormData").trigger("reset");
        document.getElementById("imagePreview").src = "";

    })


})