$(document).ready(function () {



    // Make button selected on UI
    $(".sidebar-btn:nth-child(5)").addClass("click");

    //get invoice table data from database

    function getInvoiceData() {

        let formData = new FormData(liveFormData);

        $.ajax({
            url: "assets/backend/invoice_backend.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                data = JSON.parse(data);
                // console.log(data);
                $(".my-invoice-table-body").html(data.table);
                $(".my-pagination-container").html(data.pagination);
            }
        })

    }

    getInvoiceData();

    // reset search fileds 

    $(".reset-btn").click(function () {

        $("input").val("");


    })

    // client name get from auto-complete

    let clientAutoComplete = [];

    // Initialize autocomplete for client master
    $("#clientAddId").autocomplete({
        source: function (request, response) {
            let value = request.term; // `term` is the query the user is typing

            $.ajax({
                url: "assets/backend/client_master_autocomplete.php",
                type: "POST",
                data: { str: value },
                success: function (data) {
                    data = JSON.parse(data);

                    clientAutoComplete = [];

                    let myArr = data.object;

                    // Populate clientAutoComplete with the fetched results
                    myArr.map(ele => {
                        clientAutoComplete.push({
                            id: ele.id,
                            label: ele.NAME,  // show up in the dropdown
                            value: ele.NAME,  // populate in the input field when selected
                            phone: ele.phone,
                            email: ele.email,
                            address: ele.address
                        });
                    });

                    response(clientAutoComplete);
                }
            });
        },
        select: function (event, ui) {
            $("#phoneAddId").val(ui.item.phone);
            $("#emailAddId").val(ui.item.email);
            $("#addressAddId").val(ui.item.address);
            $("#client_Id").val(ui.item.id);
        }
    });


    // Total amount of each item
    $(document).on('input', ".quantityAddId", function () {

        let price = $(this).parents(".duplicate-row").find('.itemPriceAddId').val();

        let amount = parseFloat($(this).parents(".duplicate-row").find(".amountAddId").val($(this).val() * price));

        // Update total amount dynamically whenever the quantity is updated
        calculateTotalAmount();

    });

    // Calculate total amount from all fields
    function calculateTotalAmount() {

        let totalAmount = 0;

        $(".amountAddId").each(function () {
            let amount = parseFloat($(this).val()) || 0; // Parse and default to 0 if empty
            totalAmount += amount;
        });

        // Update totalAmount field
        $("#totalAmount").val(totalAmount.toFixed(2));

    }

    // delete item rows

    $(document).on('click', '.code-container .duplicate-row .delete-row', function () {


        if ($(".code-container .duplicate-row").length > 1) {

            $(this).parents(".duplicate-row").remove();
            calculateTotalAmount();
        }

    })


    // Limit the number of record
    $("#limitId").on("input", function () {
        let value = $(this).val();
        $("#limitData").val(value);
        $("#pageId").val("1");
        getInvoiceData();
    });

    // giving the value of current page to show record according to it
    $(document).on("click", ".my-pagination li", function () {
        let page = $(this).attr("id");

        $("#pageId").val(page);

        console.log(page);
        getInvoiceData();
    });

    // Reset the search fields
    $("#reset-btn").click(function () {
        $(".live-search-inputs").trigger("reset");
    });

    // Live search 
    $('#liveFormData input').on('input', function () {
        $("#pageId").val("1");
        getInvoiceData();
    })

    // Sorting in selected column
    let idSort = "ASC";
    $(document).on("click", ".changeMyImageOnSort", function () {

        if (idSort == "ASC") {
            idSort = "DESC";
        } else {
            idSort = "ASC";
        }

        let sortOn = $(this).data("sorting");

        $("#sortOnId").val(sortOn);
        $("#sortTypeId").val(idSort);

        getInvoiceData();

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

    // form data of invoice

    $("#invoice-master-submit-btn").on('click', function () {

        let formData = new FormData(addInvoiceFormData);

        $.ajax({

            url: "assets/backend/invoice_form.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                if (data == "success") {

                    $("#addInvoiceFormData").trigger("reset");
                    let change = $("#nav-home-tab");

                    let tab = new bootstrap.Tab(change);
                    tab.show();
                    getInvoiceData();

                }
                else if (data == "required") {

                    $(".Form-submition-success-message .alert-danger").text(
                        "Please fill all fields"
                    );
                    $(".Form-submition-success-message").slideDown("slow");
                    setTimeout(function () {
                        $(".Form-submition-success-message").slideUp("slow");
                    }, 4000);

                }
            }

        })

    })


    // Deleting Invoice
    $(document).on("click", ".invoice-delete-btn", function () {
        let myId = $(this).attr("id");
        console.log(myId);

        if (confirm("Do you really want to Delelte ?")) {

            $.ajax({
                url: "assets/backend/invoice_delete.php",
                type: "POST",
                data: { id: myId },
                success: function (data) {
                    console.log(data);
                    getInvoiceData();
                },
            });
        } else {
            null;
        }
    });


    // Edit invoice data
    $(document).on("click", ".invoice-edit-btn", function () {

        let myId = $(this).attr("id");

        let change = $("#nav-profile-tab");

        let tab = new bootstrap.Tab(change);
        tab.show();

        $.ajax({
            url: "assets/backend/invoice_edit.php",
            type: "POST",
            data: { id: myId },
            success: function (data) {
                data = JSON.parse(data);

                console.log(data);
                let cl = data.clientData;
                let it = data.itemdata;
                let count = data.count - 1;
                console.log(data);
                $("#InvoiceAddId").val(cl.invoice_number);
                $("#client_Id").val(cl.client_id);
                $("#clientAddId").val(cl.NAME);
                $("#phoneAddId").val(cl.phone);
                $("#emailAddId").val(cl.email);
                $("#addressAddId").val(cl.address);
                $(".invoice_id_for_upadte").val(myId);


                for (let i = 0; i < count; i++) {
                    cloneItems();
                }
                dateGet();
                for (let i = 0; i < count + 1; i++) {
                    $('.itemAddId').eq(i).val(it[i].item_name);
                    $('.item_id').eq(i).val(it[i].item_id);
                    $('.itemPriceAddId').eq(i).val(it[i].item_price);
                    $('.quantityAddId').eq(i).val(it[i].quantity);
                    $('.amountAddId').eq(i).val(it[i].amount);
                }

                $("#totalAmount").val(cl.total_amount);

                $("#invoice-master-submit-btn").hide();
                $("#invoice-master-update-btn").show();

            },
        });


    });

    // empty all things if item name is not there 

    $(document).on('input', '.itemAddId', function () {

        let value = $(this).val().trim();

        if (value == "") {
            // console.log("empty")
            $(this).parents('.duplicate-row').find(".itemPriceAddId").val("");
            $(this).parents('.duplicate-row').find(".item_id").val("");
            $(this).parents('.duplicate-row').find(".quantityAddId").val("");
            $(this).parents('.duplicate-row').find(".amountAddId").val("");
            calculateTotalAmount();
        }

    })


})




// form empty when click on nav-home-tab

function emptyForm() {
    $("#addInvoiceFormData").trigger("reset");
}


// item name get from auto-complete

let itemAutoComplete = [];

function getitems(e) {
    $('.itemAddId').autocomplete({
        source: function (request, response) {
            let value = request.term;

            let idArr = [];

            $(".item_id").each(function () {

                if (!$(this).val() == "") {

                    idArr.push($(this).val());

                }


            })

            let newSet = new Set(idArr);

            idArr = [...newSet];

            console.log(idArr);

            $.ajax({
                url: "assets/backend/item_master_autocomplete.php",
                type: "POST",
                data: { str: value, arrId: idArr },
                success: function (data) {
                    // console.log(data);
                    if (data == 0) {
                        itemAutoComplete = [];
                        return false
                    }
                    else {
                        data = JSON.parse(data);
                        itemAutoComplete = [];

                        console.log(data.query);

                        let myArr = data.object;

                        // Populate itemAutoComplete with the fetched results
                        myArr.map(ele => {
                            itemAutoComplete.push({
                                id: ele.id,
                                label: ele.item_name,  // show up in the dropdown
                                value: ele.item_name,  // populate in the input field when selected
                                price: ele.item_price,
                            });
                        });

                        response(itemAutoComplete);
                    }
                }
            });
        },
        select: function (event, ui) {

            $(this).parents('.duplicate-row').find(".itemPriceAddId").val(ui.item.price);
            $(this).parents('.duplicate-row').find(".item_id").val(ui.item.id);
            
        }
    });


}

// generating invoice number

function generateInvoiceNumber() {

    $.ajax({

        url: "assets/backend/generate_invoice_number.php",
        type: "POST",
        success: function (data) {
            // console.log("i am id = "+ "INV0"+(Number(data)+1)  );
            $("#InvoiceAddId").val("INV0" + (Number(data) + 1));
        }

    })

}


// cloning the item form

function cloneItems() {

    let value = "";

    let prnt = $(".client-detail-container-item");
    let trFrstChild = prnt.find("div.duplicate-row:first-child");
    let cloneChild = trFrstChild.clone();
    cloneChild.find("input[type='text'] , input[type='number']").val('');
    let appendedTo = prnt.find("div.code-container").append(cloneChild);
}

// get date on click 
function dateGet() {
    let d = new Date();
    $("#InvoiceDateAddId").val(`${(d.getDate()) > 9 ? d.getDate() : "0" + d.getDate()}/${d.getMonth() + 1 > 9 ? d.getMonth() + 1 : "0" + (d.getMonth() + 1)}/${d.getFullYear()}`);
}



// remove clone items on click of all invoice 

function removeCloneOnHome() {
    console.log("delete")

    $(".delete-row").trigger('click');

}

// update invoice 

function updateInvoice() {

    console.log("upadte");

    let formData = new FormData(addInvoiceFormData);

    

    $.ajax({

        url: "assets/backend/invoice_update.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
            if (data == "success") {

                $("#addInvoiceFormData").trigger("reset");
                let change = $("#nav-home-tab");

                let tab = new bootstrap.Tab(change);
                tab.show();
                getInvoiceData();

            }
            else if (data == "required") {

                $(".Form-submition-success-message .alert-danger").text(
                    "Please fill all fields"
                );
                $(".Form-submition-success-message").slideDown("slow");
                setTimeout(function () {
                    $(".Form-submition-success-message").slideUp("slow");
                }, 4000);

            }
        }

    })

}





