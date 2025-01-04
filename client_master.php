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
    <title>Client Master</title>
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
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All Users</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add User</button>

                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <!-- All users tab -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                        <div class="user-master-all-users">


                            <!-- search fileds -->
                            <form class="live-search-inputs" id="liveFormData">

                                <div>
                                    <label for="idId">Id</label>
                                    <input id="idId" name='id' class="form-control">
                                </div>
                                <div>
                                    <label for="nameId">Name</label>
                                    <input id="nameId" name="NAME" class="form-control">
                                </div>
                                <div>
                                    <label for="phoneId">Phone</label>
                                    <input id="phoneId" name="phone" class="form-control">
                                </div>
                                <div>
                                    <label for="emailId">Email</label>
                                    <input id="emailId" name="email" class="form-control">
                                </div>
                                <div>
                                    <label for="addressId">Address</label>
                                    <input id="addressId" name="address" class="form-control">
                                </div>
                                <div>
                                    <label for="stateId">State</label>
                                    <input id="stateId" name="state" class="form-control">
                                </div>
                                <div>
                                    <label for="districtId">District</label>
                                    <input id="districtId" name="district" class="form-control">
                                </div>
                                <div>
                                    <label for="pinCodeId">Pincode</label>
                                    <input id="pinCodeId" name="pincode" class="form-control">
                                </div>
                                <input type="hidden" name="limit" id="limitData" value="5">
                                <input type="hidden" name="pageignation_number" id="pageId" value="1">
                                <input type="hidden" name="sortOn" id="sortOnId" value="">
                                <input type="hidden" name="sortType" id="sortTypeId" value="">

                                <button class="btn bg-danger text-light reset-btn">Reset</button>

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
                                        <thead class='my-client-table-head bg-primary text-white'>
                                            <tr>
                                                <th>S no.</th>
                                                <th class='idSort changeMyImageOnSort'>Id <i class=''></th>
                                                <th class='nameSort changeMyImageOnSort'>Name <i class=''></i></th>
                                                <th class='phoneSort changeMyImageOnSort'>Phone <i class=''></i> </th>
                                                <th class='phoneSort changeMyImageOnSort'>Email <i class=''></i> </th>
                                                <th class='emailSort changeMyImageOnSort'>Address <i class=''> </th>
                                                <th class='emailSort changeMyImageOnSort'>State <i class=''> </th>
                                                <th class='emailSort changeMyImageOnSort'>District <i class=''> </th>
                                                <th class='emailSort changeMyImageOnSort'>Pincode <i class=''> </th>
                                                <th class='text-center'>Action</th>
                                            </tr>
                                        </thead>
                                    </table>



                                    <table class="myTable">
                                        <tbody class="my-client-table-body">
                                            <!-- table data is comeing from database -->
                                        </tbody>
                                    </table>



                                    <!-- record of users -->
                                    <!-- Table comeing from database  -->

                                </div>

                            </div>


                        </div>



                    </div>

                    <!-- Add user  -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                        <div class="add-user-master">

                            <form id="addUserFormData">

                                <div class="row">

                                    <input type="hidden" id="sendId" name="id">

                                    <div>
                                        <label for="user_name" class="mb-2 mt-2">Name</label>
                                        <input type="text" name="name" id="user_name" placeholder="Enter name" class="form-control" maxlength="30">
                                        <small class="text-danger name-error"></small>
                                    </div>

                                    <div>
                                        <label for="user_phone" class="mb-2 mt-2">Phone</label>
                                        <input type="tel" name="phone" id="user_phone" placeholder="Enter phone" class="form-control" maxlength="10">
                                        <small class="text-danger phone-error"></small>
                                    </div>
                                    
                                    <div>
                                        <label for="user_email" class="mb-2 mt-2">Email</label>
                                        <input type="email" name="email" id="user_email" placeholder="Enter email" class="form-control" maxlength="30">
                                        <small class="text-danger email-error"></small>
                                    </div>

                                    <div>
                                        <label for="user_address" class="mb-2 mt-2">Address</label>
                                        <input type="text" name="address" id="user_address" placeholder="Enter address" class="form-control" maxlength="30">
                                        <small class="text-danger address-error"></small>
                                    </div>

                                    <div>
                                        <label for="user_state" class="mb-2 mt-2">State</label>
                                        <!-- <input type="text" name="state" id="user_state" placeholder="Enter address" class="form-control" maxlength="30"> -->
                                        <select name="state" id="user_state">
                                            <option value="">--Select state--</option>
                                        </select>
                                        <small class="text-danger address-error"></small>
                                    </div>

                                </div>

                                <div>
                                    <button type="button" class="btn bg-primary text-light mt-4" id="user-master-submit-btn">Add User</button>
                                    <button type="button" class="btn bg-primary text-light mt-4" id="user-master-update-btn" name="update-btn">Update User</button>
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




    <script src="assets/js/client_master.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/layout.js"></script>
</body>

</html>