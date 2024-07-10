<?php
require_once('lib.php');
if (is_login() == false) {
    header('Location:index.php');
    exit;
}
include('header.php');
if (is_siteadmin()) {
    $query = "select u.id,u.username,o.id,t.title,o.travelid,o.amount,o.seats,o.order_id,o.reciept,o.status as payment_status,o.payment_id,o.timecreated,o.timemodified from user u 
join orders o on u.id=o.userid
 join travel t on o.travelid=t.id order by o.id desc";
} else {
    $userid = get_user()->userid;
    $query = "select u.id,u.username,o.id,t.title,o.travelid,o.amount,o.seats,o.order_id,o.reciept,o.status as payment_status,o.payment_id,o.timecreated,o.timemodified from user u 
join orders o on u.id=o.userid
 join travel t on o.travelid=t.id where u.id=$userid order by o.id desc";
}
$res = mysqli_query($conn, $query);
$total_record = mysqli_num_rows($res);
$sr = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Form</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="css/page_style.css">
    <style>
        .container {
            width: 100%;
            margin: 20px auto;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .form-container {
            width: 500px;
            margin: 50px auto;
            border: 1px solid black;
            padding: 20px 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            margin-top: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .submit-btn {
            display: flex;
            justify-content: flex-end;
        }

        .submit-btn button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .submit-btn button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="main-div">
        <?php
        sidenavbar()
        ?>
        <div class="right-div">
            <button id="hamburger_btn">&#x2716;</button>
            <div class="container">
                <h2 id="page_heading">Bookings </h2>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr</th>
                            <?php
                            if (is_siteadmin()) {
                                echo '<th>Name</th>';
                            }
                            echo '<th>Trip</th>';
                            ?>

                            <th>Amount</th>
                            <th>Seats</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th> Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($total_record != 0) {
                            $record = mysqli_fetch_assoc($res);
                            $username = $record['username'];
                            $trip = $record['title'];
                            $amount = $record['amount'];
                            $payment_status = $record['payment_status'];
                            $seats = $record['seats'];
                            $status = 'Active';
                            $timecreated = strtolower(date('d-M-y', $record['timecreated']));
                            if ($record['timemodified'] == 0) {
                                $timemodified = 'NA';
                            } else {
                                $timemodified = date('Y-m-d', $record['timemodified']);
                            }
                            echo "<tr>
                            <td>$sr</td>
                            ";

                            if (is_siteadmin()) {
                                echo "<td>$username</td>";
                            }
                            echo "<td>$trip</td>";
                            echo "<td>$amount</td>";
                            echo "<td>$seats</td>";
                            echo "<td>$payment_status</td>";
                            echo "<td>$status</td>";
                            echo " <td>$timecreated</td>";
                            echo "<td>$timemodified</td>";
                            echo "<td>";
                            echo "
                            <a href='#' title='Edit'><i class='fa fa-pencil-square'></i></a>
                            ";
                            if(time()<=$record['timecreated']+600){
                                echo "
                                <a id='delete_btn' data-id='' data-action='delete_travel' title='Delete'><i class='fa fa-trash'></i></a>
                                ";
                            }
                            echo "</tr>";
                            $total_record--;
                            $sr++;
                        }
                        ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Create new category</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="categoryForm">
                        <div class="form-group">
                            <label for="categoryName">Category Name:</label>
                            <input type="text" id="categoryName" name="categoryName" maxlength="100" required>
                            <span class="error" id="errorMessage"></span>
                        </div>
                        <div class="submit-btn">
                            <button type="button" id="submit_btn">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
</body>
<?php
include('footer.php');
?>