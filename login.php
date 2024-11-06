<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-image: linear-gradient(to top, #d299c2 0%, #fef9d7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            animation: gradientAnimation 10s ease infinite;
        }
        
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        .card {
            background: #f0f3f8;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            width: 300px;
            padding: 20px;
            text-align: center;
        }
        
        .card input[type="text"],
        .card input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            background: #e6ecf5;
            color: #333;
            border-radius: 5px;
        }
        
        .card input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background: #ffa500;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .card input[type="submit"]:hover {
            background: #ff8c00;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Login</h2>
        <form action="process-login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
