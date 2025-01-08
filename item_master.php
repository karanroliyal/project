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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="assets/js/jquery.js"></script>
    <title>Item Master</title>
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
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All Item</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add Item</button>

                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <!-- All users tab -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                        <div class="user-master-all-users">


                            <!-- search fileds -->
                            <form class="live-search-inputs item-master-search" id="liveFormData">

                                <div>
                                    <label for="nameId">Item name</label>
                                    <input id="nameId" name="NAME" class="form-control">
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
                                        <thead class='my-item-table-head bg-primary text-white'>
                                            <tr>
                                                <th>S no.</th>
                                                <th class='idSort changeMyImageOnSort' data-set="id" >Id <i class='bi-arrow-down-up'></th>
                                                <th class='idSort changeMyImageOnSort' data-set="item_name">Item Name <i class='bi-arrow-down-up'></th>
                                                <th class='nameSort changeMyImageOnSort' data-set="item_price">Item Price <i class='bi-arrow-down-up'></i></th>
                                                <th class='phoneSort changeMyImageOnSort' data-set="item_description">Item Description <i class='bi-arrow-down-up'></i> </th>
                                                <th class='phoneSort ' >Item Image  </th>
                                                <th class='text-center'>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-item-table-body">
                                            <!-- table data is comeing from database -->
                                        </tbody>
                                    </table>




                                </div>

                            </div>


                        </div>



                    </div>

                    <!-- Add user  -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                        <div class="add-user-master">

                            <form id="addItemFormData" enctype="multipart/form-data">

                                <div class="row">

                                    <input type="hidden" id="sendId" name="id">

                                    <div>
                                        <label for="item_name" class="mb-2 mt-2">Item name</label>
                                        <input type="text" name="item_name" id="item_name" placeholder="Enter item name" class="form-control" maxlength="30">
                                        <small class="text-danger item-error"></small>
                                    </div>

                                    <div>
                                        <label for="item_price" class="mb-2 mt-2">Item price (₹)</label>
                                        <input type="number" name="item_price" id="item_price" placeholder="Enter item price" class="form-control" maxlength="50">
                                        <small class="text-danger price-error"></small>
                                    </div>

                                    <div>
                                        <label for="item_description" class="mb-2 mt-2">Item description</label>
                                        <input type="text" name="item_description" id="item_description" placeholder="Enter item description" class="form-control" maxlength="255">
                                        <small class="text-danger description-error"></small>
                                    </div>

                                    <div>
                                        <label for="item_image" class="mb-2 mt-2">Item Image</label>
                                        <input type="file" name="item_image" id="item_image" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                                        <small class="text-danger image-error"></small>
                                        <span><img src="" id="imagePreview" ></span>
                                    </div>

                                

                                </div>

                                <div>
                                    <button type="button" class="btn bg-primary text-light mt-4" id="item-master-submit-btn">Add Item</button>
                                    <button type="button" class="btn bg-primary text-light mt-4" id="item-master-update-btn" name="update-btn" style="display: none;">Update Item</button>
                                </div>

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




    <script src="assets/js/item_master.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/layout.js"></script>
</body>

</html>