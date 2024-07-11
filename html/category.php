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
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            /* display: flex; */
        }

        .delete_modal {
            width: 22%;
            height: 30%;
            position: fixed;
            z-index: 10000000000;

            background-color: white;

            overflow: auto;

            align-items: center;
            justify-content: center;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 20px;

            margin: 15% 40%;
            padding: 20px;

        }

        #close_btn {
            margin-left: 95%;
            cursor: pointer;
        }

        #coutinue_btn {
            margin-left: 10%;
        }

        #modal_heading {
            text-align: center;
        }

        .modal_btn_div {
            margin-top: 35px;
            margin-left: 5%;
        }

        #deleted_success_msg {
            text-align: center;
            font-weight: bold;
            margin-top: 22%;
        }

        td#description {
            margin-bottom: 0;
            text-align: left;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
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
                            $id = $record['id'];
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
                            <td id='cat_$id'>$category_name</td>";
                            if($status==1){
                                echo "<td>Active</td>";
                            }else{
                                echo "<td>Suspended</td>";
                            }
                            echo "
                            <td>$timecreated</td>
                            <td>$timemodified</td>
                            <td>
                            <a  title='Edit' id='update_category_btn' data-id='$id' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa fa-pencil-square'></i></a>
                            <a id='delete_btn' data-id='$id' data-action='delete_category'  title='Delete'><i class='fa fa-trash'></i></a>";
                            if($status==1){
                                echo"
                                <a id='suspend_btn' data-id='$id' data-action='suspend_category'  title='Active'><i class='fa fa-eye'></i></a>
                                ";
                                
                            }else{
                                echo"
                                <a id='suspend_btn' data-id='$id' data-action='suspend_category'  title='Active'><i class='fa fa-eye-slash'></i></a>
                                ";

                            }
                            echo "</td>
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

    <div id="deleteModal" class="modal">
        <div class="delete_modal">
            <h3 id="close_btn">X</h3>
            <h2 id="modal_heading">Are You Sure?</h2>
            <div class="modal_btn_div">
                <button id="coutinue_btn" class="btn btn-primary">Continue</button>
                <button id="cancel_btn" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        const update_category_btn=document.querySelectorAll('#update_category_btn');
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
                fetch('http://localhost/travel_booking_system/travel_booking_system/html/ajax.php', {
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
                                "http://localhost/travel_booking_system/travel_booking_system/html/category.php";
                        }, 3000)
                    } else {
                        errorMessage.innerHTML = res.msg;
                    }
                })
            }
        });
        update_category_btn.forEach((e)=>{
            const category_name=document.get
            e.addEventListener('click',()=>{
                let categoryid=e.getAttribute('data-id');
                let category_name=document.getElementById('cat_'+categoryid);
                console.log(category_name.innerText);
                categoryName.value=category_name.innerText;
                var category_update_data={
                    action:'update_category',
                    id:categoryid
                }

            })
        })
        
    </script>
        <script>
        window.addEventListener('load', () => {
            const delete_btn_group = document.querySelectorAll('#delete_btn');
            const suspend_btn_arr = document.querySelectorAll('#suspend_btn');
            const deleteModal = document.querySelector('#deleteModal');
            const delete_modal_content = document.querySelector('.delete_modal');
            const delete_btn = document.querySelector('#delete_btn');
            const close_btn = document.getElementById('close_btn');
            const cancel_btn = document.getElementById('cancel_btn');
            const continue_btn = document.getElementById('coutinue_btn');

            delete_btn_group.forEach((e) => {
                e.addEventListener('click', (s) => {
                    openModal(deleteModal);
                    continue_btn.setAttribute('data-id', e.getAttribute('data-id'));
                    continue_btn.setAttribute('data-action', e.getAttribute('data-action'));
                    process_request(e);

                })
            })

            suspend_btn_arr.forEach((e) => {
                e.addEventListener('click', () => {
                    openModal(deleteModal);
                    continue_btn.setAttribute('data-id', e.getAttribute('data-id'));
                    continue_btn.setAttribute('data-action', e.getAttribute('data-action'));
                    process_request(e);

                })
            })

            close_btn.addEventListener('click', (e) => {
                continue_btn.setAttribute('data-id', 0);
                continue_btn.setAttribute('data-action', 0);
                closeModal(deleteModal)
            })
            cancel_btn.addEventListener('click', () => {
                continue_btn.setAttribute('data-id', 0);
                continue_btn.setAttribute('data-action', 0);
                closeModal(deleteModal);
            });

            function closeModal(selector) {
                selector.style.display = 'none';
            }

            function openModal(selector) {
                selector.style.display = 'block';
            }

            function process_request(e) {
                continue_btn.addEventListener('click', (s) => {
                    const delete_id = continue_btn.getAttribute('data-id');
                    const data_action = continue_btn.getAttribute('data-action');

                    const delete_data = {
                        action: data_action,
                        id: delete_id
                    }
                    fetch("ajax.php", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(delete_data)
                    }).then((response) => {
                        return response.json();
                    }).then((res) => {
                        delete_modal_content.innerHTML = '<h4 id="deleted_success_msg">' + res.msg + '</h4>';
                        setTimeout(() => {
                            window.location.href = "http://localhost/travel_booking_system/travel_booking_system/html/category.php";
                        }, 3000)
                    })
                })
            }

        })
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