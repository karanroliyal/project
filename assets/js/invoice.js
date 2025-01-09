$(document).ready(function () {



    // Make button selected on UI
    $(".sidebar-btn:nth-child(5)").addClass("click");

    // reset search fileds 

    $(".reset-btn").click(function () {

        $("input").val("");


    })

    // client name get from auto-complete

    let clientAutoComplete = [];

    // Initialize autocomplete only once
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
        }
    });



    // show the date in Invoice date

    let d = new Date();
    $("#InvoiceDateAddId").val(`${(d.getDate() + 10).length > 1 ? d.getDate() : "0" + d.getDate()} -${d.getMonth() + 1}-${d.getFullYear()}`);









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

    // cloning the item form

    $('.cloned-item-btn').click(function () {

        var value = "";

        var prnt = $(".client-detail-container-item");
        var trFrstChild = prnt.find("div.duplicate-row:first-child");
        var cloneChild = trFrstChild.clone();
        cloneChild.find("input[type='text'] , input[type='number']").val('');
        var appendedTo = prnt.find("div.code-container").append(cloneChild);

    });

    // delete item rows

    $(document).on('click', '.code-container .duplicate-row .delete-row', function () {


        if ($(".code-container .duplicate-row").length > 1) {

            $(this).parents(".duplicate-row").remove();
            calculateTotalAmount();
        }

    })






})

// item name get from auto-complete

let itemAutoComplete = [];

function getitems(e) {
    //     // $(this).val("hello");
    // console.log(this, 'this');
    $('.itemAddId').autocomplete({
        source: function (request, response) {
            let value = request.term; // `term` is the query the user is typing

            $.ajax({
                url: "assets/backend/item_master_autocomplete.php",
                type: "POST",
                data: { str: value },
                success: function (data) {
                    // console.log(data);
                    if (data == 0) {
                        itemAutoComplete = [];
                        return false
                    }
                    else {
                        data = JSON.parse(data);
                        itemAutoComplete = [];

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
        }
    });


}