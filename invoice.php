<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit;
}

// echo "Welcome to our website {$_SESSION['email']}";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.js"></script>
    <!-- Autocomplete CDN  start -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Autocomplete CDN  end -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Invoice</title>
</head>

<body>



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
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All Invoice</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add Invoice</button>

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
                                    <input id="invoiceNoId" class="form-control">
                                </div>
                                <div>
                                    <label for="clientNameId">Client name</label>
                                    <input id="clientNameId" class="form-control">
                                </div>
                                <div>
                                    <label for="phoneId">Phone</label>
                                    <input id="phoneId" class="form-control">
                                </div>
                                <div>
                                    <label for="emailId">Email</label>
                                    <input id="emailId" class="form-control">
                                </div>
                                <div>
                                    <label for="invoiceDateId">Invoice date</label>
                                    <input type="date" id="invoiceDateId" class="form-control">
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
                                                <th class='idSort changeMyImageOnSort'>Invoice id <i class='bi-arrow-down-up'></th>
                                                <th class='nameSort changeMyImageOnSort'>Invoice no. <i class='bi-arrow-down-up'></i></th>
                                                <th class='phoneSort changeMyImageOnSort'>Invoice Date <i class='bi-arrow-down-up'></i> </th>
                                                <th class='phoneSort changeMyImageOnSort'>Client name <i class='bi-arrow-down-up'></i> </th>
                                                <th class='emailSort changeMyImageOnSort'>Address <i class='bi-arrow-down-up'> </th>
                                                <th class='emailSort changeMyImageOnSort'>Client email <i class='bi-arrow-down-up'> </th>
                                                <th class='emailSort changeMyImageOnSort'>Client phone <i class='bi-arrow-down-up'> </th>
                                                <th class='emailSort changeMyImageOnSort'>Total <i class='bi-arrow-down-up'> </th>
                                                <th class='emailSort changeMyImageOnSort'>PDF <i class='bi-arrow-down-up'> </th>
                                                <th class='emailSort changeMyImageOnSort'>Mail <i class='bi-arrow-down-up'> </th>
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

                                        <div class="col-3">
                                            <label for="InvoiceAddId">Invoice no.</label>
                                            <input type="text" id="InvoiceAddId" class="form-control" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label for="InvoiceDateAddId">Invoice date</label>
                                            <input type="text" id="InvoiceDateAddId" class="form-control" disabled>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-3">
                                            <label for="clientAddId">Client name</label>
                                            <input type="text" id="clientAddId" class="form-control">
                                        </div>
                                        <div class="col-3">
                                            <label for="phoneAddId">Phone</label>
                                            <input type="text" id="phoneAddId" class="form-control" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label for="emailAddId">Email</label>
                                            <input type="text" id="emailAddId" class="form-control" disabled>
                                        </div>
                                        <div class="col-3">
                                            <label for="addressAddId">Address</label>
                                            <input type="text" id="addressAddId" class="form-control" disabled>
                                        </div>

                                    </div>

                                </div>


                                <div class="client-detail-container-item">


                                    <div class="code-container">

                                        <div class="row mb-4 duplicate-row">

                                            <div class="col-3">
                                                <label for="">Item name</label>
                                                <input name="item_name[]" type="text" class="form-control itemAddId" id="itemAddId" onkeyup="getitems(this)">
                                                <small class="no-item-found"></small>
                                            </div>
                                            <div class="col-3">
                                                <label for="">Item price</label>
                                                <input name="item_price[]" type="text" class="form-control itemPriceAddId" disabled>
                                            </div>
                                            <div class="col-2">
                                                <label for="">Quantity</label>
                                                <input name="item_quantity[]" type="number" class="form-control quantityAddId" min=1 >
                                            </div>
                                            <div class="col-3">
                                                <label for="">Amount</label>
                                                <input name="total[]" type="text" class="form-control amountAddId" disabled>
                                            </div>

                                            <div class="col-2 mt-4">
                                                <button type="button" class="btn bg-danger delete-row"><i class="bi bi-trash text-light"></i></button>
                                            </div>

                                        </div>



                                    </div>



                                    <div class="row">


                                        <div class="col-6 mt-4">
                                            <button type="button" class="btn bg-success text-light cloned-item-btn">Add item</button>
                                        </div>
                                        <div class="col-2">
                                            <label for="totalAmount">Total Amount:</label>
                                            <input type="text" placeholder="Total Amount" class="form-control" id="totalAmount" disabled>
                                        </div>

                                    </div>


                                    
                                </div>

                                <button type="button" class="btn bg-primary text-light mt-4" id="item-master-submit-btn">Add Invoice</button>
                                <button type="button" class="btn bg-primary text-light mt-4" id="item-master-update-btn" name="update-btn" style="display: none;">Update Invoice</button>


                            </form>

                            <div class="Form-submition-success-message">
                                <div class="alert alert-success" role="alert">

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>


    </div>




    <script src="assets/js/invoice.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/layout.js"></script>
</body>

</html>