<?php

$title = "User Master";

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
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All Users</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add User</button>

                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <!-- All users tab -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                        <div class="user-master-all-users">


                            <!-- search fileds -->
                            <form class="live-search-inputs">

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
                                        <thead class='my-table-head bg-primary text-white'>
                                            <tr>
                                                <th>S no.</th>
                                                <th class='idSort changeMyImageOnSort'>Id <i class='bi-arrow-down-up'></th>
                                                <th class='nameSort changeMyImageOnSort'>Name <i class='bi-arrow-down-up'></i></th>
                                                <th class='phoneSort changeMyImageOnSort'>Phone <i class='bi-arrow-down-up'></i> </th>
                                                <th class='emailSort changeMyImageOnSort'>Email <i class='bi-arrow-down-up'> </th>
                                                <th class='text-center'>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-table-body">

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
                                        <label for="user_password" class="mb-2 mt-2">Password</label>
                                        <input type="password" name="password" id="user_password" placeholder="Enter password" class="form-control" maxlength="15" >
                                        <small class="text-danger password-error"></small>
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




    <script src="assets/js/user_master.js"></script>

    
    <?php
    
    include_once "footer.php";
    
    ?>