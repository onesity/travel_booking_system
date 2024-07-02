<?php
include('header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "select t.* ,c.id,c.name from travel as t join category as c on t.categoryid = c.id where t.id=$id";
    $query_res = mysqli_query($conn, $query);
    if ($query_res) {
        $data = mysqli_fetch_assoc($query_res);
        $title = $data['title'];
        $category_name = $data['name'];
        $description = $data['description'];
        $image = $data['image'];
        $price = $data['price'];
        $days = $data['days'];
        $category = $data['name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .main-div {
            width: 98%;
            margin-left: 1%;
            height: auto;
            
        }
        
        .checkout-left-div {
            width: 55%;
            margin-left: 2%;
            margin-top: 2%;
            margin-bottom: 2%;
            background-color: lightblue;
            height: 100%;
        }
        
        .checkout-right-div {
            margin-left: 2%;
            background-color: lightblue;
            margin-top: 2%;
            margin-bottom: 2%;
            width: 40%;
        }
        .detail-top-div{
            width: 94%;
            height: auto;
            margin-left: 3%;
            background-color: white;
            margin-top: 3%;
        }
        .detail-bottom-div{
            width: 94%;
            height: 15%;
            margin-left: 3%;
            background-color: white;
            margin-top: 3%;
        }
        .top-detail-card{
            margin-top: 20px;
            background-color: green;
            display: flex;
        }
        #top-detail-card-img{
            height: 100%;
            width: 25%;
        }
        .detail-top-card-details-div{
            background-color: orange;
            width: 75%;
           
        }
    </style>
</head>

<body>
    <div class="main-div">
        <div class="checkout-left-div"> <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card mt-3 mb-3">
                            <div class="card-header text-center">
                                <h2>Checkout</h2>
                            </div>
                            <div class="card-body">
                                <form id="checkoutForm" method="POST" action="verify.php">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Phone</label>
                                        <input type="number" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state" name="state" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="zip">Zip Code</label>
                                        <input type="text" class="form-control" id="zip" name="zip" required>
                                    </div>
                                
                                    <button id="payButton" class="btn btn-primary btn-block">Pay Now</button>
                                    <input type="hidden" id="razorpay_payment_id" name="razorpay_payment_id">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div></div>
        <div class="checkout-right-div">
            <div class="detail-top-div">
                <div class="top-detail-card">
                    <img src="../images/104_download (9).jpg" id="top-detail-card-img" alt="">
                    <div class="detail-top-card-details-div">
                        <h1>Title</h1>
                    </div>
                </div>

           
            </div>
            <div class="detail-bottom-div">

            </div>
           
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('payButton').onclick = function(e) {
            e.preventDefault();

            var options = {
                "key": "YOUR_RAZORPAY_KEY_ID", // Enter the Key ID generated from the Razorpay Dashboard
                "amount": "50000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or ₹500.
                "currency": "INR",
                "name": "Acme Corp",
                "description": "Test Transaction",
                "image": "https://example.com/your_logo",
                "handler": function(response) {
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('checkoutForm').submit();
                },
                "prefill": {
                    "name": "John Doe",
                    "email": "john.doe@example.com",
                    "contact": "9999999999"
                },
                "notes": {
                    "address": "Razorpay Corporate Office"
                },
                "theme": {
                    "color": "#F37254"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>
</body>

</html>


<?php
include('footer.php');
?>