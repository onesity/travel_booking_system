<?php
require_once('lib.php');
if(is_siteadmin()==false){
    header('Location:index.php');
    exit;
}
include('header.php');

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
                <h2 id="page_heading">Categories </h2>
                <button type="button" class="btn btn-primary" id='create_btn' data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Create new category</button>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th> Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "select * from category order by id desc";
                        $res = mysqli_query($conn, $query);
                        $total_record = mysqli_num_rows($res);
                        $sr = 1;
                        while ($total_record != 0) {
                            $record = mysqli_fetch_assoc($res);
                            $category_name = $record['name'];
                            $status = $record['status'];
                            $timecreated = date('Y-m-d', $record['timecreated']);
                            if ($record['timemodified'] == 0) {
                                $timemodified = 'NA';
                            } else {
                                $timemodified = date('Y-m-d', $record['timemodified']);
                            }
                            echo "<tr>
                            <td>$sr</td>
                            <td>$category_name</td>
                            <td>$status</td>
                            <td>$timecreated</td>
                            <td>$timemodified</td>
                            <td>
                            <a href='#' title='Edit'><i class='fa fa-pencil-square'></i></a>
                            <a id='delete_btn' data-id='' data-action='delete_travel' title='Delete'><i class='fa fa-trash'></i></a>
                            <a data-id='' id='suspend_btn' data-action='suspend_travel' title='Active'><i class='fa fa-eye'></i></a>
                            </td>
                            </tr>";
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
        const form_div = document.querySelector('.modal-content');
        document.getElementById('submit_btn').addEventListener('click', function(event) {

            const categoryName = document.getElementById('categoryName').value.trim();
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.textContent = '';

            const alphanumericPattern = /^[a-zA-Z0-9]+$/;
            const startsWithAlphabetPattern = /^[a-zA-Z]/;

            if (categoryName === '') {
                errorMessage.textContent = 'Category name should not be empty.';
            } else if (categoryName.length < 3) {
                errorMessage.textContent = 'Category name should be at least 3 characters long.';
            } else if (!alphanumericPattern.test(categoryName)) {
                errorMessage.textContent = 'Category name should contain only alphanumeric values.';
            } else if (!startsWithAlphabetPattern.test(categoryName)) {
                errorMessage.textContent = 'Category name should start with an alphabet.';
            } else {
                var category_data = {
                    action: 'create_category',
                    category_name: categoryName
                };
                fetch('http://localhost/travel_booking_system/travel_booking_system/ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(category_data)
                }).then((res) => {
                    return res.json();
                }).then((res) => {
                    if (res.success == true) {
                        form_div.innerHTML = "<h2 id='success_msg'>" + res.msg + "</h2>";
                        const success_msg = document.getElementById('success_msg');
                        success_msg.style.margin = '30px';
                        setTimeout(() => {
                            window.location.href =
                                "http://localhost/travel_booking_system/travel_booking_system/category.php";
                        }, 3000)
                    } else {
                        errorMessage.innerHTML = res.msg;
                    }
                })
            }
        });
        
    </script>
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