<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Popup</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables JS -->
     
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../css/page_style.css">
    
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: whitesmoke;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: white;
            color: black;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            position:relative;
            width: 100%;
            
        }

        .logo img {
            height: 50px;
        }

        .nav-auth {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav {
            display: flex;
            gap: 15px;
        }

        .nav a {
            color: black;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .login-btn,
        .signup-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-btn {
            background-color: orange;
            color: #fff;
        }

        .signup-btn {
            background-color: lightblue;
            color: #fff;
        }

        .profile {
            position: relative;
        }

        .profile-icon {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .profile-popup {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            z-index: 1000;

        }

        .profile-content {
            padding: 20px;
            position: relative;
        }

        .profile-content h2 {
            margin-top: 0;
        }

        .profile-toggle {
            display: none;
        }

        .profile-toggle:checked+label+.profile-popup {
            display: block;
            width: 250px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .logout-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #ff4b5c;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #d7384a;
        }

        #login-btn,
        #signup-btn {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3420502Ztc7RjaetY17CYvJv3m21wM14scg&s" alt="Logo">
        </div>
        <div class="nav-auth">
            <nav class="nav">
                <a href="index.php">Home</a>
                <a href="#about">About</a>
                <a href="#services">Services</a>
                <a href="#contact">Contact</a>
            </nav>
            <div class="auth-buttons">
                <?php
                require_once('lib.php');
                $is_login = is_login();
                if ($is_login == false) { ?>
                    <button class="login-btn"><a href='login.php' id="login-btn">Login</a></button>
                    <button class="signup-btn"><a href='signup.php' id="signup-btn">Signup</a></button>
                <?php
                } else {
                ?>

                    <div class="profile">

                        <input type="checkbox" id="profileToggle" class="profile-toggle">
                        <label for="profileToggle">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRp0xKoXUryp0JZ1Sxp-99eQiQcFrmA1M1qbQ&s" alt="Profile" class="profile-icon">
                        </label>
                        <div class="profile-popup">
                            <div class="profile-content">
                                <label for="profileToggle" class="close">&times;</label>
                                <h2>Profile</h2>
                                <p>Name: <?php echo $is_login->data->username ?></p>
                                <p>Email: <?php echo $is_login->data->email ?></p>
                                <button class="logout-btn"><a href='logout.php'>Logout</a></button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </header>
</body>

</html>
