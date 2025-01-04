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


})