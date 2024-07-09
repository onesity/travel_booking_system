<?php
include('header.php');



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .carousel-item {
            height: 40%;
            background-size: cover;
        }

        .d-block {
            height: 350px;
            /* object-fit: scale-down; */
            max-width: 100%;
            image-resolution: 3000dpi;
            filter: blur(0);
        }

        .card-deck {
            /* display: flex; */
            margin-top: 20px;
            margin-left: 0px;
            margin-bottom: 50px;
            flex-wrap: wrap;

        }

        .card {
            /* float: left; */
            width: 21%;
            height: 400px;
            float: left;
            margin-top: 30px;
            margin-left: 35px;
            box-shadow: 0 26px 58px 0 rgba(0, 0, 0, .22), 0 5px 14px 0 rgba(0, 0, 0, .18);

        }


        #price-tag {
            margin-left: 20px;
            margin-right: 25%;
            font-size: 20px;
            font-weight: bold;
        }

        #card_image {
            width: 100%;
            height: 40%;
        }

        /* section#main-section {
            margin-bottom: 4%;
        } */
        .card {
            margin-left: 2%;
            margin-right: 2%;
        }



        .card_body {
            width: 100%;
        }

        .main_card_body {
            height: 100%;
        }

        .card-body {
            flex: 1 1 auto;
            padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
            color: var(--bs-card-color);
            height: 45%;
        }

        #carouselExampleAutoplaying {
            margin-top: 2%;
            box-shadow: 0 26px 58px 0 rgba(0, 0, 0, .22), 0 5px 14px 0 rgba(0, 0, 0, .18);

        }

        .card-text:last-child {
            margin-bottom: 0;
            text-align: left;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-title {
            font-weight: 600;
        }

        #search {
            height: 40px;
            box-shadow: 0 26px 58px 0 rgba(0, 0, 0, .22), 0 5px 14px 0 rgba(0, 0, 0, .18);
            margin-left: 49%;
            margin-top: 35px;
            width: 30%;

        }

        img#nodatafoundimage {
            width: 55%;
            height: 100%;
            margin-left: 25%;
        }

        .filter-div {
            display: flex;
        }

        #total_records {
            margin-top: 35px;
            margin-left: 2%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/111_images (20).jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/112_images (21).jpg" class="d-block w-100 " alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/107_images (15).jpg" class="d-block w-100 " alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="filter-div">
        <h3 id="total_records"></h3>
        <input type="text" class="form-control" id="search" placeholder="Search...">
    </div>

    <div class="card-deck"></div>

    <div class="category-section">
    </div>
    <div id="data-container"></div>
    <div id="pagination-container"></div>
    <script src="../js/pagination.js"></script>
    <script>
        $('#pagination-container').pagination({
            dataSource: [1, 2, 3, 4, 5, 6, 7, 195],
            callback: function(data, pagination) {
                // template method of yourself
                var html = template(data);
                $('#data-container').html(html);
            }
        })
    </script>

    <script src="../js/index.js"></script>
</body>

</html>

<?php

include('footer.php');

?>