<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | eFinanceApp</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(120deg, #2b5876, #4e4376);
            color: white;
            overflow: hidden;
        }

        /* Container Styling */
        .container {
            text-align: center;
            padding: 50px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        /* Header Animation */
        h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            background: linear-gradient(90deg, #ffaf7b, #d76d77, #3a1c71);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: slideIn 1.5s ease-out;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0;
            animation: fadeIn 2s ease-in-out forwards;
        }

        /* Button Styles */
        .btn-custom {
            display: inline-block;
            padding: 12px 30px;
            font-size: 1rem;
            color: #fff;
            background-color: #6a11cb;
            border: none;
            border-radius: 50px;
            margin: 10px;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
            box-shadow: 0 4px 15px rgba(106, 17, 203, 0.5);
        }

        .btn-custom:hover {
            transform: scale(1.1);
            background-color: #2575fc;
        }

        /* Keyframe Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to eFinanceApp</h1>
        <p>Manage your finances effortlessly and securely with eFinanceApp.</p>
        <div>
            <button id="loginBtn" class="btn-custom">Login</button>
            <button id="signupBtn" class="btn-custom">Sign Up</button>
        </div>
    </div>

    <script src="public/jquery/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Button click redirects
            $('#loginBtn').click(function() {
                window.location.href = 'login.php'; // Redirect to login page
            });

            $('#signupBtn').click(function() {
                window.location.href = 'signup.php'; // Redirect to signup page
            });
        });
    </script>
</body>
</html>
