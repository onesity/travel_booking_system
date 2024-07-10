<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* White background */
            color: #000;
            /* Black text color for readability */
        }

        .content {
            flex: 1;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            /* White background for the footer */
            color: #000;
            /* Black text color for readability */
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            height: 100px;
               box-shadow: rgba(0, 0, 0, 0.9) 0px 5px 15px;
            /* Optional: add a shadow for better separation */
        }

        .footer-left {
            display: flex;
            align-items: center;
        }

        .footer-logo {
            height: 50px;
            margin-right: 20px;
            margin-left: 20px;
        }

        .footer-nav {
            display: flex;
            gap: 15px;
        }

        .footer-nav a {
            color: #000;
            /* Black text color for readability */
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .footer-nav a:hover {
            background-color: #f0f0f0;
            /* Light grey background on hover for contrast */
        }

        .footer-center {
            text-align: center;
        }

        .footer-right {
            display: flex;
            gap: 10px;
            margin-left: 20px;
        }

        .social-icon img {
            height: 50px;
            width: 50px;
            margin-right: 20px;

            /* transition: transform 0.3s; */
        }

        .social-icon img:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <div class="content">
        <!-- Other content of the page -->
    </div>

    <footer class="footer">
        <div class="footer-left">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3420502Ztc7RjaetY17CYvJv3m21wM14scg&s" alt="Logo" class="footer-logo">
            <nav class="footer-nav">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#services">Services</a>
                <a href="#contact">Contact</a>
            </nav>
        </div>
   
        <div class="footer-right">
            <a href="#" class="social-icon">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBJyOpE2CeS_BiZgAemNWBPN_8SSRZ-gZIhQ&s" alt="Twitter">
            </a>
            <a href="#" class="social-icon">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv0f-JxHvNkn5575Lq-oX9Yz8V9G2spRv1zA&s" alt="Facebook">
            </a>
            <a href="#" class="social-icon">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBG22FpnIz2j8Fo3r0i8kZBR9i5SlMZOtEtA&s" alt="Instagram">
            </a>
         
        </div>
    </footer>
</body>

</html>