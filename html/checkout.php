<?php
require_once('lib.php');
if (is_login() == false) {
    header('Location:login.php');
} else {
    include('header.php');

    $login_user = is_login()->data;
}
// var_dump($login_user->userid);

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
        $gst_amount = ($price * 18) / 100;
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
    <link rel="stylesheet" href="../css/styles.css">
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
            /* background-color: lightblue; */
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            height: auto;
        }

        .checkout-right-div {
            margin-left: 2%;
            background-color: lightblue;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            margin-top: 2%;
            margin-bottom: 2%;
            width: 40%;
            height: 100%;

        }

        .detail-top-div {
            width: 100%;
            height: 10%;
            margin-left: 0%;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            margin-top: 3%;
        }

        .detail-bottom-div {
            width: 94%;
            height: 20%;
            margin-left: 3%;
            /* background-color: white; */
            margin-top: 2%;
        }

        .top-detail-card {
            margin-top: 20px;
            /* background-color: white; */
            display: flex;
        }

        #top-detail-card-img {
            height: 100%;
            width: 25%;
            margin-top: 4%;
            margin-bottom: 4%;
        }

        img#top-detail-card-img {
            margin-left: 0px;
            margin-top: 33px;
        }

        .detail-top-card-details-div {
            /* background-color: white; */
            width: 73%;
            margin-left: 2%;

        }

        #price-tag {
            margin-top: 40px;
            margin-left: 60%;
        }

        #title-tag {
            margin-top: 4%;

        }

        p#card-desc {
            margin-bottom: 0;
            text-align: left;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #count-seat {
            width: 70px;
            border: none;
        }

        span#name_error,
        #email_error,
        #zip_error,
        #address_error,
        #city_error,
        #state_error,
        #phone_error {
            color: red;
            margin-left: 3px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="main-div">
        <div class="checkout-left-div">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card mt-3 mb-3">
                            <div class="card-header text-center">
                                <h2>Checkout</h2>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <span id="name_error" class="errors">username error</span>
                                </div>

                                <div class="form-group">
                                    <label for="address">Phone</label>
                                    <input type="number" class="form-control" id="phone" name="phone" required>
                                    <span id="phone_error">phone error</span>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                    <span id="address_error">addres error</span>
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                    <span id="city_error">city error</span>
                                </div>
                                <div class="form-group">
                                    <select name="state" id="state" class="form-control">
                                        <?php
                                        foreach (get_all_states_of_india() as $key => $value) {
                                            echo "<option value='$key'>$value</option>";
                                        }

                                        ?>
                                    </select>
                                    <span id="state_error">state error</span>
                                </div>
                                <div class="form-group">
                                    <label for="zip">Zip Code</label>
                                    <input type="number" class="form-control" id="zip" name="zip" required>
                                    <span id="zip_error">zip error</span>
                                </div>
                                <button id="payButton" class="btn btn-primary btn-block">Pay Now</button>
                                <form id="checkoutForm" method="POST" action="verify.php">
                                    <input type="hidden" id="userid" name="userid" value="<?php echo $login_user->userid; ?>">
                                    <input type="hidden" id="travelid" name="travelid" value="<?php echo $id; ?>">
                                    <input type="hidden" id="amount" name="amount" value="<?php echo $price + $gst_amount; ?>">
                                    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                                    <input type="hidden" id="razorpay_payment_id" name="razorpay_payment_id">
                                    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout-right-div">
            <div class="detail-top-div">
                <div class="top-detail-card">

                    <img src="../images/104_download (9).jpg" id="top-detail-card-img" alt="">
                    <div class="detail-top-card-details-div">
                        <h2 id="title-tag"><?php echo $title; ?></h2>
                        <p id="card-desc"><?php echo $description; ?></p>
                        <h5 id="price-tag">Price: <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $price; ?></h5>
                    </div>
                </div>
            </div>
            <div class="detail-bottom-div">
                <h4 id="total-ammount">Price: <?php echo $price; ?></h4>
                <h4 id="total-ammount">Seats:
                    <select name="" id="count-seat">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </h4>

                <h4 id="total-ammount">Days: <?php echo $days; ?></h4>
                <h4 id="sub-total">Subtotal: 1 x <?php echo $price * 1; ?> = <?php echo $price * 1; ?></h4>
                <h4 id="total-ammount">GST: 18% </h4>
                <h4 id="gst-ammount">GST amount: <?php echo $gst_amount; ?> </h4>
                <hr style="width: 90%; height: 2px; background-color: black;">
                <h4 id="grand-total">Grand Total:<?php echo floor($price + $gst_amount); ?> </h4>
                <hr style="width: 90%; height: 2px; background-color: black;">
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="module">
        import {
            success_modal,
            validateEmail,
            validatePassword,
            validateUsername,
            validateIndianPhoneNumber,
            validateAddress,
            validateCity,
            validateState,
            validateZipcode
        } from '../js/functions.js';
        const name = document.getElementById('name');
        const name_error = document.getElementById('name_error');


        const phone = document.getElementById('phone');
        const phone_error = document.getElementById('phone_error');

        const address = document.getElementById('address');
        const address_error = document.getElementById('address_error');

        const city = document.getElementById('city');
        const city_error = document.getElementById('city_error');

        const state = document.getElementById('state');
        const state_error = document.getElementById('state_error');

        const zip = document.getElementById('zip');
        const zip_error = document.getElementById('zip_error');

        const userid = document.getElementById('userid');
        const travelid = document.getElementById('travelid');
        const count_seat = document.getElementById('count-seat');
        const sub_total = document.getElementById('sub-total');
        const gst_ammount = document.getElementById('gst-ammount');
        const grand_total_amount = document.getElementById('grand-total');
        const amount = document.getElementById('amount');
        const price = "<?php echo $price; ?>";
        let total_ammount = ((price * count_seat.value) + ((price * count_seat.value) * 18) / 100);



        document.getElementById('payButton').onclick = function(e) {
            e.preventDefault();
            let errors = [];

            var usernameRes = validateUsername(name.value);
            if (usernameRes.status == true) {
                name_error.style.display = 'none';
                name.style.border = '1px solid green';
            } else {
                name_error.innerHTML = usernameRes.message;
                name.style.border = '1px solid red';
                name_error.style.display = 'block';
                errors['name'] = 'name_error';
            }

            var phoneRes = validateIndianPhoneNumber(phone.value)
            if (phoneRes.status == true) {
                phone_error.style.display = 'none';
                phone.style.border = '1px solid green';

            } else {
                phone_error.innerHTML = phoneRes.message;
                phone.style.border = '1px solid red';
                phone_error.style.display = 'block';
                errors['phone'] = 'phone_error';
            }

            var addressRes = validateAddress(address.value)
            if (addressRes.status == true) {
                address_error.style.display = 'none';
                address.style.border = '1px solid green';

            } else {
                address_error.innerHTML = addressRes.message;
                address.style.border = '1px solid red';
                address_error.style.display = 'block';
                errors['address'] = 'address_error';

            }

            var cityRes = validateCity(city.value)
            if (cityRes.status == true) {
                city_error.style.display = 'none';
                city.style.border = '1px solid green';

            } else {
                city_error.innerHTML = cityRes.message;
                city.style.border = '1px solid red';
                city_error.style.display = 'block';
                errors['city'] = 'city_error';

            }

            var stateRes = validateState(state.value)
            if (stateRes.status == true) {
                state_error.style.display = 'none';
                state.style.border = '1px solid green';

            } else {
                state_error.innerHTML = stateRes.message;
                state.style.border = '1px solid red';
                state_error.style.display = 'block';
                errors['state'] = 'state_error';

            }

            var zipRes = validateZipcode(zip.value)
            if (zipRes.status == true) {
                zip_error.style.display = 'none';
                zip.style.border = '1px solid green';

            } else {
                zip_error.innerHTML = zipRes.message;
                zip.style.border = '1px solid red';
                zip_error.style.display = 'block';
                errors['zip'] = 'zip_error';

            }

            let booking_data = {
                action: 'create_booking',
                userid: userid.value,
                name: name.value,
                phone: phone.value,
                address: address.value,
                city: city.value,
                state: state.value,
                zip: zip.value,
                travelid: travelid.value,
                seats: count_seat.value,
                amount: ((price * count_seat.value) + ((price * count_seat.value) * 18) / 100)
            }
            if (Object.keys(errors).length == 0) {
                fetch('http://localhost/travel_booking_system/travel_booking_system/html/ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(booking_data)
                }).then((res) => {
                    return res.json();
                }).then((res) => {
                    if (res.success == true) {
                        const create_order_data = {
                            action: 'create_order',
                            amount: parseInt(((price * count_seat.value) + ((price * count_seat.value) * 18) / 100)),
                            userid: userid.value,
                            travelid: travelid.value

                        }
                        fetch('http://localhost/travel_booking_system/travel_booking_system/html/ajax.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(create_order_data)
                        }).then((res) => {
                            return res.json();
                        }).then((res) => {

                            if (res.success == true) {
                                const data = res.data;
                                var options = {
                                    "key": data['api_key'],
                                    "amount": data['amount'],
                                    "currency": "INR",
                                    "name": name,
                                    "description": "This is test payment description.",
                                    "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3420502Ztc7RjaetY17CYvJv3m21wM14scg&s",
                                    order_id: res.data['order_id'],
                                    "handler": function(response) {

                                        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                                        document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                                        document.getElementById('razorpay_signature').value = response.razorpay_signature;
                                        document.getElementById('checkoutForm').submit();
                                    },
                                    "prefill": {
                                        "name": name,
                                        "email": 'bad@bb.dfg',
                                        "contact": phone
                                    },
                                    "notes": {
                                        "address": "Razorpay Corporate Office"
                                    },
                                    "theme": {
                                        "color": "white"
                                    }
                                };

                                var rzp1 = new Razorpay(options);
                                rzp1.open();
                            }
                        })

                    }
                })
            }
        }
        count_seat.addEventListener('change', () => {

            sub_total.innerText = "Subtotal : " + count_seat.value + " x " + price + " = " + price * count_seat.value;
            gst_ammount.innerHTML = "GST amount : " + ((price * count_seat.value) * 18) / 100;
            grand_total_amount.innerHTML = "Grand Total : " + ((price * count_seat.value) + ((price * count_seat.value) * 18) / 100);
            amount.setAttribute('value', parseInt(((price * count_seat.value) + ((price * count_seat.value) * 18) / 100)));

        })
    </script>
</body>

</html>


<?php
include('footer.php');
?>