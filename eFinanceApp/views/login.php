<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | eFinanceApp</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add your existing CSS styles here */
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

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-container h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            background: linear-gradient(90deg, #ffaf7b, #d76d77, #3a1c71);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 50px;
            padding: 12px 20px;
            margin-bottom: 20px;
            color: white;
            font-size: 1rem;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(106, 17, 203, 0.2);
            border: none;
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            color: #fff;
            background-color: #6a11cb;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
        }

        .btn-custom:hover {
            transform: scale(1.05);
            background-color: #2575fc;
        }

        .link {
            margin-top: 15px;
            display: block;
            color: #ddd;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .link:hover {
            color: #fff;
            text-decoration: underline;
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
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login to eFinanceApp</h2>
        <form id="loginForm" action="processLogin.php" method="POST">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required id="password">
            <button type="submit" class="btn-custom">Login</button>
        </form>
        <a href="signup.php" class="link">Don't have an account? Sign Up</a>
        <a href="index.php" class="link">Back to Home</a>
    </div>

    <!-- Include jQuery -->
    <script src="public/jquery/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;

            $('#loginForm').on('submit', function(e) {
                const password = $('#password').val();

                if (!passwordRegex.test(password)) {
                    e.preventDefault(); 
                    alert('Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 special character, and be at least 8 characters long.');
                    return false;
                }
                return true;
            });
        });
    </script>
</body>
</html>
