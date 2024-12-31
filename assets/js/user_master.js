$(document).ready(function () {

    // Make button selected on UI 
    $(".sidebar-btn:nth-child(2)").addClass("click")



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
                sortIN: sortOn
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data)
                $(".table-container").html(data.table);
                $(".my-pagination-container").html(data.pagination);
            }
        })

    }


    loadTable();


    // Limit the number of record
    $("#limitId").on('input', function () {

        let value = $(this).val();
        $("#limitID").val(value);
        loadTable(value);

    });

    // giving the value of current page to show record according to it
    $(document).on('click', ".my-pagination li", function () {

        let page = $(this).attr('id');
        let id = $("#idId").val();
        let name_ = $("#nameId").val();
        let phone = $("#phoneId").val();
        let email = $("#emailId").val();
        let limit = $("#limitId").val();

        $("#pageId").val(page);

        console.log(page);
        loadTable($("#limitId").val(), page, id, name_, phone, email);

    });

    // Reset the search fields
    $("#reset-btn").click(function () {

        $(".live-search-inputs").trigger("reset");

    })

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
            id: "#limitID"
        },
        {
            id: "#pageId"
        }
    ]

    // live search
    ids.map(ele => {

        $(ele.id).on('input', function () {

            let id = $("#idId").val();
            let name_ = $("#nameId").val();
            let phone = $("#phoneId").val();
            let email = $('#emailId').val();
            let limit = $("#limitId").val();
            let page = $(document).on('.my-pagination li').attr("id");


            loadTable(limit, page, id, name_, phone, email);

        })

    })




    let idSort = "ASC";


    $(document).on('click', ".changeMyImageOnSort", function () {

        if (idSort == "ASC") {
            idSort = "DESC";
        } else {
            idSort = "ASC";
        }

        let sortOn = $(this).text();

        let id = $("#idId").val();
        let name_ = $("#nameId").val();
        let phone = $("#phoneId").val();
        let email = $('#emailId').val();
        let limit = $("#limitId").val();
        let current_page = $("#pageId").val();

        loadTable(limit, current_page, id, name_, phone, email, idSort, sortOn);


    })





})


















































