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
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Trip Details</title>

            <!-- <link rel="stylesheet" href="page_style.css"> -->

            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }

                .container,
                #container {
                    width: 100%;
                    margin: 20px auto;
                    background: #fff;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                .page_heading {
                    background: url("../<?php echo $image; ?>") no-repeat center center/cover;
                    height: 400px;
                    position: relative;
                    color: white;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-size: 100% 100%;
                    background-position: abstract;
                }

                .page_heading h1 {
                    margin: 0;
                    font-size: 3em;
                    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
                }

                .content {
                    padding: 20px;
                }

                .content h2 {
                    margin-top: 0;
                }

                .details,
                .itinerary {
                    margin-bottom: 20px;
                }

                .details ul {
                    list-style-type: none;
                    padding: 0;
                }

                .details ul li {
                    background: #eee;
                    margin: 5px 0;
                    padding: 10px;
                    border-radius: 5px;
                }

                .itinerary ul {
                    list-style-type: decimal;
                    padding-left: 20px;
                }

                .booking {
                    text-align: center;
                    margin: 20px 0;
                }

                .booking button {
                    background: #007bff;
                    color: white;
                    border: none;
                    padding: 15px 30px;
                    font-size: 1.2em;
                    cursor: pointer;
                    border-radius: 5px;
                    transition: background 0.3s ease;
                }

                .booking button:hover {
                    background: #0056b3;
                }

                @media (min-width: 992px) {

                    .container,
                    .container-lg,
                    .container-md,
                    .container-sm {
                        max-width: 100%;
                    }

                    #booking_btn {
                        margin-left: 85%;
                        padding: 6px 17px;
                    }
                }
            </style>
        </head>

        <body>

            <div class="container" id="container">
                <div class="page_heading">
                    <h1> Discover <?php echo $title; ?> </h1>
                </div>
                <div class="content">
                    <div class="details">
                        <h2>Package Details</h2>
                        <p>
                            <?php
                            echo $description; ?>
                        </p>
                        <h5>Location: <?php echo $title; ?></h5>
                        <h5>Category: <?php echo $category; ?></h5>
                        <h5>Price: <?php echo $price; ?></h5>
                        <h5>Days: <?php echo $days; ?></h5>
                        <h5>Quantity: per persion</h5>
                    </div>

                    <div class="itinerary">
                        <h2>Itinerary</h2>
                        <ul>
                            <li>Day 1: Arrival and City Tour</li>
                            <li>Day 2: Visit to Eiffel Tower and Louvre Museum</li>
                            <li>Day 3: Day Trip to Versailles</li>
                            <li>Day 4: Seine River Cruise</li>
                            <li>Day 5: Free Day and Departure</li>
                        </ul>
                    </div>
                    <div class="booking">
                        <?php
                        if (is_login()) {
                        ?>
                            <button onclick="location.href='checkout.php?id=<?php echo $id; ?>'" id="booking_btn">Book Now</button>
                        <?php
                        } else {
                        ?>
                            <button onclick="location.href='signup.php'" id="booking_btn">Book Now</button>
                        <?php

                        }
                        ?>

                    </div>
                </div>
        <?php
    }
}
        ?>
            </div>
        </body>

        </html>

        <?php
        include('footer.php');
        ?>