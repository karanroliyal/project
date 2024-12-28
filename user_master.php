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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.js"></script>
    <title>User Master</title>
</head>

<body>

    <!-- <h1>I am layout</h1>

    <a id="logout-btn" href="logout.php" >Logout</a> -->


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
                <h3>User master</h3>
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



                            <form class="live-search-inputs">

                                <input type="text" id="idId" class="form-control">
                                <input type="text" id="nameId" class="form-control">
                                <input type="text" id="phoneId" class="form-control">
                                <input type="text" id="emailId" class="form-control">

                                <button class="btn bg-primary text-light">Search</button>
                                <button class="btn bg-danger text-light">Reset</button>

                            </form>


                            <div class="all-users-data-table">

                                <div class="row-and-pagination">

                                    <select id="limitId">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>

                                    <ul class="my-pagination">
                                        <li class="active">1</li>
                                        <li>2</li>
                                        <li>3</li>
                                    </ul>

                                </div>


                                <div class="table-container">

                                    <table class="table table-striped">
                                        <thead class="my-table-head">
                                            <tr>
                                                <th scope="col">Sno.</th>
                                                <th scope="col">Id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-table-body">
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>butt</td>
                                                <td><button class="btn bg-primary text-white"><img src="assets/images/edit.svg" alt=""></button><button class="btn text-white bg-danger"><img src="assets/images/delete.svg" alt=""></button></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                                <td>@fat</td>
                                                <td><button class="btn bg-primary text-white"><img src="assets/images/edit.svg" alt=""></button><button class="btn text-white bg-danger"><img src="assets/images/delete.svg" alt=""></button></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>Bird</td>
                                                <td>@twitter</td>
                                                <td>@twitter</td>
                                                <td><button class="btn bg-primary text-white"><img src="assets/images/edit.svg" alt=""></button><button class="btn text-white bg-danger"><img src="assets/images/delete.svg" alt=""></button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>


                        </div>



                    </div>

                    <!-- Add user  -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                        <h1>Add user</h1>

                    </div>

                </div>
            </div>

        </div>


    </div>




    <script src="assets/js/user_master.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/layout.js"></script>
</body>

</html>