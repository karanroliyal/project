<?php

$title = "Invoice";

include_once "header.php";

?>



<div class="layout-wrapper">

    <div class="navigation-wrapper">

        <?php
        include_once "navigation.php";
        ?>

    </div>

    <div class="sidebar-and-content-wrapper">

        <div class="sidebar-wrapper">

            <?php
            include_once "sidebar.php";
            ?>

        </div>
        <div class="content-wrapper">
            <!-- <h3>User master</h3> -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" onclick="{removeCloneOnHome() , emptyForm()}" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All Invoice</button>
                    <button class="nav-link" id="nav-profile-tab" onclick="{generateInvoiceNumber() , dateGet()}" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add Invoice</button>

                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

                <!-- All users tab -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="user-master-all-users">


                        <!-- search fileds -->
                        <form class="live-search-inputs" id="liveFormData">

                            <div>
                                <label for="invoiceNoId">Invoice no.</label>
                                <input id="invoiceNoId" name="invoice_no" class="form-control">
                            </div>
                            <div>
                                <label for="clientNameId">Client name</label>
                                <input id="clientNameId" class="form-control" name="cl_name">
                            </div>
                            <div>
                                <label for="phoneId">Phone</label>
                                <input id="phoneId" class="form-control" name="cl_phone">
                            </div>
                            <div>
                                <label for="emailId">Email</label>
                                <input id="emailId" class="form-control" name="cl_email">
                            </div>
                            <div>
                                <label for="invoiceDateId">Invoice date</label>
                                <input type="date" id="invoiceDateId" class="form-control" name="bill_date">
                            </div>
                            <input type="hidden" name="limit" id="limitData" value="5">
                            <input type="hidden" name="pageignation_number" id="pageId" value="1">
                            <input type="hidden" name="sortOn" id="sortOnId" value="">
                            <input type="hidden" name="sortType" id="sortTypeId" value="">

                            <button type="button" class="btn bg-danger text-light reset-btn">Reset</button>

                        </form>



                        <div class="all-users-data-table">

                            <div class="row-and-pagination mb-3">

                                <!-- limit of records -->
                                <div>
                                    <label for="limitId">Number of rows : </label>
                                    <select id="limitId">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>

                                <div class="my-pagination-container">



                                </div>


                            </div>


                            <div class="table-container">

                                <table class='myTable'>
                                    <thead class='my-invoice-table-head bg-primary text-white'>
                                        <tr>
                                            <th>S no.</th>
                                            <th class='idSort changeMyImageOnSort' data-sorting="invoice_id">Invoice id <i class='bi-arrow-down-up'></th>
                                            <th class='nameSort changeMyImageOnSort' data-sorting="invoice_number">Invoice no. <i class='bi-arrow-down-up'></i></th>
                                            <th class='phoneSort changeMyImageOnSort' data-sorting="invoice_date">Invoice Date <i class='bi-arrow-down-up'></i> </th>
                                            <th class='phoneSort changeMyImageOnSort' data-sorting="NAME">Client name <i class='bi-arrow-down-up'></i> </th>
                                            <th class='emailSort changeMyImageOnSort' data-sorting="address">Address <i class='bi-arrow-down-up'> </th>
                                            <th class='emailSort changeMyImageOnSort' data-sorting="email">Client email <i class='bi-arrow-down-up'> </th>
                                            <th class='emailSort changeMyImageOnSort' data-sorting="phone">Client phone <i class='bi-arrow-down-up'> </th>
                                            <th class='emailSort changeMyImageOnSort' data-sorting="total_amount">Total <i class='bi-arrow-down-up'> </th>
                                            <th class='emailSort '>PDF </th>
                                            <th class='emailSort '>Mail </th>
                                            <th class='text-center'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="my-invoice-table-body">
                                        <!-- table data is comeing from database -->

                                        <tr>
                                            <td>1</td>
                                            <td>In198187</td>
                                            <td>20212108</td>
                                            <td>20/05/2024</td>
                                            <td>Karan rawat</td>
                                            <td>322-B</td>
                                            <td>karan@gmail.com</td>
                                            <td>8368145192</td>
                                            <td>₹20000</td>
                                            <td><i class="bi bi-file-earmark-pdf-fill text-danger"></i></td>
                                            <td><i class="bi bi-envelope-fill text-primary"></i></td>
                                            <td>action</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>In198187</td>
                                            <td>20212108</td>
                                            <td>20/05/2024</td>
                                            <td>Karan rawat</td>
                                            <td>322-B</td>
                                            <td>karan@gmail.com</td>
                                            <td>8368145192</td>
                                            <td>₹20000</td>
                                            <td><i class="bi bi-file-earmark-pdf-fill text-danger"></i></td>
                                            <td><i class="bi bi-envelope-fill text-primary"></i></td>
                                            <td>action</td>
                                        </tr>

                                    </tbody>
                                </table>


                                <!-- My mail Modal  -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <!-- Mail Alert  -->
                                        <div class="alert alert-success mail-send" role="alert" style="display: none;">
                                            <!-- success message  -->
                                        </div>
                                        <div class="alert alert-danger mail-fail" role="alert" style="display: none;">
                                            <!-- fail message  -->
                                        </div>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="mailForm"   enctype="multipart/form-data">
                                                    <input type="hidden" name="invoice_id_hide" id="invoice_id_hidden" >
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Recipient name:</label>
                                                        <input type="text" class="form-control" id="recipient-name" name="recipient_name" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-email" class="col-form-label">To:</label>
                                                        <input type="text" class="form-control" id="recipient-email" name="recipient_email" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="subject" class="col-form-label">Subject:</label>
                                                        <input type="text" class="form-control" id="subject" name="subject">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" id="message-text" name="message" rows="10"></textarea>
                                                    </div>
                                                    <!-- <div class="mb-3">
                                                    <label for="formFile" class="form-label">Attachment</label>
                                                    <input class="form-control" type="file" id="formFile" name="file[]" multiple>
                                                    </div> -->
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <div class="mail-btn-container">
                                                    <button type="button" class="btn btn-primary mail-send-btn" onclick="mailSend()">Send message</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>



                </div>

                <!-- Add user  -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    <div class="add-user-master">

                        <form id="addInvoiceFormData">

                            <div class="client-detail-container mb-4">

                                <div class="row mb-3">
                                    <input type="hidden" class="invoice_id_for_upadte" name="invoice_update_id">
                                    <div class="col-md-3 col-xl-3 col-sm-6 col-xs-6">
                                        <label for="InvoiceAddId">Invoice no.</label>
                                        <input type="text" id="InvoiceAddId" class="form-control  " name="invoice_number" readonly>
                                    </div>
                                    <div class="col-md-3 col-xl-3 col-sm-6 col-xs-6">
                                        <label for="InvoiceDateAddId">Invoice date</label>
                                        <input type="text" id="InvoiceDateAddId" class="form-control  " name="bill_date" readonly>
                                    </div>

                                </div>

                                <div class="row">

                                    <input type="hidden" name="client_id" id="client_Id">
                                    <div class="col-md-3  col-sm-6 ">
                                        <label for="clientAddId">Client name</label>
                                        <input type="text" id="clientAddId" oninput="emptyClient()" class="form-control">
                                    </div>
                                    <div class="col-md-3  col-sm-6 ">
                                        <label for="phoneAddId">Phone</label>
                                        <input type="text" id="phoneAddId" class="form-control  " readonly>
                                    </div>
                                    <div class="col-md-3  col-sm-6 ">
                                        <label for="emailAddId">Email</label>
                                        <input type="text" id="emailAddId" class="form-control  " readonly>
                                    </div>
                                    <div class="col-md-3  col-sm-6 ">
                                        <label for="addressAddId">Address</label>
                                        <input type="text" id="addressAddId" class="form-control  " readonly>
                                    </div>

                                </div>

                            </div>


                            <div class="client-detail-container-item">


                                <div class="code-container">

                                    <div class="row mb-4 duplicate-row">

                                        <input type="hidden" class="item_id" name="item_id[]">
                                        <div class="col-md-3  col-sm-6 ">
                                            <label for="">Item name</label>
                                            <input name="item_name[]" type="text" class="form-control itemAddId" onkeyup="getitems(this)">
                                            <small class="no-item-found"></small>
                                        </div>
                                        <div class="col-md-3  col-sm-6 ">
                                            <label for="">Item price</label>
                                            <input name="item_price[]" type="text" class="form-control itemPriceAddId" readonly>
                                        </div>
                                        <div class="col-md-2 col-sm-6 ">
                                            <label for="">Quantity</label>
                                            <input name="item_quantity[]" type="number" class="form-control quantityAddId text-end" min=1>
                                        </div>
                                        <div class="col-md-3  col-sm-6 ">
                                            <label for="">Amount</label>
                                            <input name="total[]" type="text" class="form-control amountAddId  " readonly>
                                        </div>

                                        <div class="col-1 mt-4">
                                            <button type="button" class="btn bg-danger delete-row"><i class="bi bi-trash text-light"></i></button>
                                        </div>

                                    </div>


                                </div>



                                <div class="row">


                                    <div class="col-6 mt-4">
                                        <button type="button" onclick="cloneItems()" class="btn bg-success text-light cloned-item-btn">Add item</button>
                                    </div>
                                    <div class="col-6 ">
                                        <label for="totalAmount">Total Amount:</label>
                                        <input type="text" class="form-control  " placeholder="Total Amount" id="totalAmount" readonly>
                                    </div>

                                </div>



                            </div>

                            <button type="button" class="btn bg-primary text-light mt-4" id="invoice-master-submit-btn">Add Invoice</button>
                            <button type="button" class="btn bg-primary text-light mt-4" id="invoice-master-update-btn" name="update-btn" style="display: none;" onclick="updateInvoice()">Update Invoice</button>


                        </form>

                        <div class="Form-submition-success-message">
                            <div class="alert alert-danger" role="alert">

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>


</div>




<script src="assets/js/invoice.js"></script>
<?php
include_once "footer.php";

?>