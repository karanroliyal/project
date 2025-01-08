$(document).ready(function () {



    // Make button selected on UI
    $(".sidebar-btn:nth-child(5)").addClass("click");

    // reset search fileds 

    $(".reset-btn").click(function(){

        $("input").val("");


    })

    // client name get from auto-complete

    let dataForComplete = [];

    $("#clientAddId").on('input' , function(){
        $.ajax({
            url: "assets/backend/client_master_autocomplete.php",
            // dataType: "json",
            type: "POST",
            success: function(data){
                data = JSON.parse(data);
                let myArr = data.object;
                myArr.map(ele=>{
                    dataForComplete.push({id:ele.id , NAME:ele.NAME , phone:ele.phone , email:ele.email , address:ele.address });
                })
    
                $("#clientAddId").autocomplete({
                    source: dataForComplete,
                    select:function() {
                        $("#phoneAddId").val(data.output[0].phone);
                        // $("#emailAddId").val(suggestion.email);
                        // $("#addressAddId").val(suggestion.address);
                    }
                })
                
            }
        })
    })


    


})