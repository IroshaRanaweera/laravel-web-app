<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none; /* Added text-decoration */
            text-align: center; /* Center the text */
        }

        button:hover, a:hover {
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
       <h2>Registration Form</h2> 
       <form id="registration-form" method="POST" action="{{ route('register') }}">
            @csrf <!-- CSRF token field -->

           <label for="name">Name:</label>
           <input type="text" id="name" name="name" required>

           <label for="username">Username:</label>
           <input type="text" id="username" name="username" required>

           <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="admin">Admin</option>
                <option value="superadmin">Superadmin</option>
                <option value="guest">Guest</option>
            </select>

           <label for="email">Email:</label>
           <input type="email" id="email" name="email" required>

           <label for="password">Password:</label>
           <input type="password" id="password" name="password" required>

           <button type="button" onclick="register()">Register</button><br>

           <a href="#" onclick="login()">Already have an account? Log in</a>
       </form>

       <div id="error-container"></div>
   </div>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
       function register() {
            // Get form data
            var formData = $('#registration-form').serialize();
            
            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: '/register',
                data: formData,
                success: function(response) {
                    // Handle success response
                    alert("Successfully registered");
                    window.location.href = '/';
                },
                error: function(xhr) {
                    // Handle error response
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value + '</li>';
                    });
                    errorHtml += '</ul>';
                    $('#error-container').html(errorHtml);
                }
            });
        }

        function login() {
            window.location.href = '/';
        }
   </script>
</body>
</html>
