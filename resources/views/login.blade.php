<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        h2 {
            margin-top: 0;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        #error-container {
            color: #ff0000;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>  
    <div class="container">
        <h2>Login</h2>
        <div id="error-container"></div> <!-- Container to display errors -->
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf <!-- CSRF token field -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <button type="button" onclick="login()">Login</button> 
            <br>
            <br>
            <a href="#" onclick="register()">Don't have an account? Sign in</a>
            
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function login() {
            // Get form data
            var formData = $('#login-form').serialize();
            
            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: '/login',
                data: formData,
                success: function(response) {
                    // Handle success response
                    if (response.role) {
                    // Redirect user based on role
                        if (response.role === 'admin' || response.role === 'superadmin') {
                            window.location.href = '/dashboard';
                        } else {
                            window.location.href = '/welcome';
                        }
                    } else {
                        alert("Failed to login! Try again.");
                    }
                },
                error: function(xhr) {
                    // Handle error response
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var errorHtml = '<ul>';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value + '</li>';
                        });
                        errorHtml += '</ul>';
                        $('#error-container').html(errorHtml);
                    } else {
                        // Handle other errors, such as server-side errors
                        alert("Failed to login! Try again.");
                    }
                }
            });
        }

        function register() {
            window.location.href = '/register';
        }
    </script>
</body>
</html>
