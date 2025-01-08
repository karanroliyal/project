$(document).ready(function () {
  // Make button selected on UI
  $(".sidebar-btn:nth-child(2)").addClass("click");

  // reset search fileds 

  $(".reset-btn").click(function(){

    $(".live-search-inputs input").val("");
   
      loadTable();

})

  // getting table data
  function loadTable(limit, page, sId, sname_, sphone, semail, Sort, sortOn) {
    $.ajax({
      url: "assets/backend/user_master_backend.php",
      type: "POST",
      data: {
        page_limit: limit,
        curr_page: page,
        id: sId,
        name: sname_,
        phone: sphone,
        email: semail,
        sort: Sort,
        sortIN: sortOn,
      },
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        $(".my-table-body").html(data.table);
        $(".my-pagination-container").html(data.pagination);
      },
    });
  }

  let sortOnId = $("#sortOnId").val();
  let sortTypeId = $("#sortTypeId").val();
  let id = $("#idId").val();
  let name_ = $("#nameId").val();
  let phone = $("#phoneId").val();
  let email = $("#emailId").val();
  let limit = $("#limitData").val();
  let page = $("#pageId").val();
  loadTable(limit, page, id, name_, phone, email, sortTypeId, sortOnId);

  // Limit the number of record
  $("#limitId").on("input", function () {
    let value = $(this).val();
    $("#limitData").val(value);
    loadTable(value);
  });

  // giving the value of current page to show record according to it
  $(document).on("click", ".my-pagination li", function () {
    let page = $(this).attr("id");
    let id = $("#idId").val();
    let name_ = $("#nameId").val();
    let phone = $("#phoneId").val();
    let email = $("#emailId").val();
    let limit = $("#limitData").val();

    $("#pageId").val(page);

    console.log(page);
    loadTable(limit, page, id, name_, phone, email);
  });

  // Reset the search fields
  $("#reset-btn").click(function () {
    $(".live-search-inputs").trigger("reset");
  });

  // array of ids
  ids = [
    {
      id: "#idId",
    },
    {
      id: "#nameId",
    },
    {
      id: "#phoneId",
    },
    {
      id: "#emailId",
    },
    {
      id: "#limitID",
    },
    {
      id: "#pageId",
    },
  ];

  // live search
  ids.map((ele) => {
    $(ele.id).on("input", function () {
      let id = $("#idId").val();
      let name_ = $("#nameId").val();
      let phone = $("#phoneId").val();
      let email = $("#emailId").val();
      let limit = $("#limitData").val();
      let page = $("#pageId").val();
      // let page = $(document).on('.my-pagination li').attr("id");

      loadTable(limit, undefined, id, name_, phone, email);
    });
  });

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

    let id = $("#idId").val();
    let name_ = $("#nameId").val();
    let phone = $("#phoneId").val();
    let email = $("#emailId").val();
    let limit = $("#limitData").val();
    let current_page = $("#pageId").val();

    loadTable(limit, current_page, id, name_, phone, email, idSort, sortOn);
  });

  // Deleting User
  $(document).on("click", ".user-delete-btn", function () {
    let myId = $(this).attr("id");
    console.log(myId);

    if (confirm("Do you really want to Delelte ?")) {
      let sortOnId = $("#sortOnId").val();
      let sortTypeId = $("#sortTypeId").val();
      let id = $("#idId").val();
      let name_ = $("#nameId").val();
      let phone = $("#phoneId").val();
      let email = $("#emailId").val();
      let limit = $("#limitData").val();
      let page = $("#pageId").val();

      $.ajax({
        url: "assets/backend/user_master_delete.php",
        type: "POST",
        data: { id: myId },
        success: function (data) {
          console.log(data);
          loadTable(limit, page, id, name_, phone, email, sortTypeId, sortOnId);
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
      url: "assets/backend/user_master_edit.php",
      type: "POST",
      data: { id: myId },
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        $("#user_name").val(data.Name);
        $("#user_phone").val(data.phone);
        $("#user_email").val(data.email);
        $("#sendId").val(myId);
        $("#user-master-submit-btn").hide();
        $("#user-master-update-btn").show();
      },
    });
  });

  let fields = [
    {
      id: "#user_name",
      errId: ".name-error",
    },
    {
      id: "#user_email",
      errId: ".email-error",
    },
    {
      id: "#user_phone",
      errId: ".phone-error",
    },
  ];

  // update user btn
  $("#user-master-update-btn").on("click", function () {

    let checkForm = 1;

    let formData = new FormData(addUserFormData);

    fields.map((ele) => {

      if ($(ele.id).val().trim() == "") {

        $(ele.errId).text("field is required");
        checkForm = 0;

      };

      if (checkForm == 1) {

        $.ajax({

          url: "assets/backend/user_master_update.php",
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
              // console.log("i am error : " + data.error);
              $(".Form-submition-success-message .alert-success").text(
                "User Updated Successfully"
              );
              $(".Form-submition-success-message").slideDown("slow");
              setTimeout(function () {
                $(".Form-submition-success-message").slideUp("slow");
              }, 4000);
              $("#addUserFormData").trigger("reset");
              let change = $("#nav-home-tab");

              let tab = new bootstrap.Tab(change);
              tab.show();
              let sortOnId = $("#sortOnId").val();
              let sortTypeId = $("#sortTypeId").val();
              let id = $("#idId").val();
              let name_ = $("#nameId").val();
              let phone = $("#phoneId").val();
              let email = $("#emailId").val();
              let limit = $("#limitData").val();
              let page = $("#pageId").val();
              loadTable(limit, page, id, name_, phone, email, sortTypeId, sortOnId);
            }
            // email duplicate
            else if (data.duplicateEmail.length > 0) {
              $(".email-error").text("Email already exist");
            }
            // duplicate phone
            if (data.duplicatePhone.length > 0) {
              $(".phone-error").text("Phone already exist");
            }
            // when any field is empty
            else if (data.required > 0) {
              data.required.forEach((ele) => {
                $("." + ele + "-error").text("Field is required");
              });
            }
            // when field is not valid
            else if (data.valid.length > 0) {
              data.valid.forEach((ele) => {
                if (ele == "name") {
                  $("." + ele + "-error").text(
                    "Only characters are allowed and name must be longer that 2 characters"
                  );
                }
                if (ele == "password") {
                  $("." + ele + "-error").text(
                    "1 Uppercase , 1 special character , min length 8 is required and max length is 15"
                  );
                }
                if (ele == "email") {
                  $("." + ele + "-error").text("Invaid email");
                }
                if (ele == "phone") {
                  $("." + ele + "-error").text("Invaid phone number");
                }
              });
            }
          }

        })

      }


    });

  });

  // loading table and clearing form fields when clicking on home page
  $("#nav-home-tab").on("click", function () {

    let sortOnId = $("#sortOnId").val();
    let sortTypeId = $("#sortTypeId").val();
    let id = $("#idId").val();
    let name_ = $("#nameId").val();
    let phone = $("#phoneId").val();
    let email = $("#emailId").val();
    let limit = $("#limitData").val();
    let page = $("#pageId").val();
    loadTable(limit, page, id, name_, phone, email, sortTypeId, sortOnId);
    $("#addUserFormData").trigger("reset");

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




  // User master form submission

  $("#user-master-submit-btn").on("click", function () {
    let formData = new FormData(addUserFormData);

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
            $("#addUserFormData").trigger("reset");
            $(".Form-submition-success-message .alert-success").text(
              "User Added Successfully"
            );
            $(".Form-submition-success-message").slideDown("slow");
            setTimeout(function () {
              $(".Form-submition-success-message").slideUp("slow");
            }, 4000);
          }
          // email duplicate
          else if (data.duplicateEmail.length > 0) {
            $(".email-error").text("Email already exist");
          }
          // duplicate phone
          if (data.duplicatePhone.length > 0) {
            $(".phone-error").text("Phone already exist");
          }
          // when field is not valid
          else if (data.valid.length > 0) {
            data.valid.forEach((ele) => {
              if (ele == "name") {
                $("." + ele + "-error").text(
                  "Only characters are allowed and name must be longer that 2 characters"
                );
              }
              if (ele == "password") {
                $("." + ele + "-error").text(
                  "1 Uppercase , 1 special character , min length 8 is required and max length is 15"
                );
              }
              if (ele == "email") {
                $("." + ele + "-error").text("Invaid email");
              }
              if (ele == "phone") {
                $("." + ele + "-error").text("Invaid phone number");
              }
            });
          }
          // when any field is empty
          else {
            data.required.forEach((ele) => {
              $("." + ele + "-error").text("Field is required");
            });
          }
        },
      });
    }
  });





});
