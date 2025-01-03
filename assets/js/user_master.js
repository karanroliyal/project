$(document).ready(function () {
  // Make button selected on UI
  $(".sidebar-btn:nth-child(2)").addClass("click");

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
        $(".table-container").html(data.table);
        $(".my-pagination-container").html(data.pagination);
      },
    });
  }

  loadTable();

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

      loadTable(limit, page, id, name_, phone, email);
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
        $(".user-update-btn").text("Update User")
      },
    });
  });

  $("#nav-home-tab").on('click' , function() {

    loadTable();

  })

});
