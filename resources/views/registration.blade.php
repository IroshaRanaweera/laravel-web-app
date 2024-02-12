<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Registration</title>
</head>
<body>
   <h2>Registration Form</h2> 
   <form id="registration-form" method="POST" action="{{ route('register') }}">
        @csrf <!-- CSRF token field -->

       <label for="name">Name:</label><br>
       <input type="text" id="name" name="name" required><br><br>

       <label for="username">Username:</label><br>
       <input type="text" id="username" name="username" required><br><br>

       <label for="role">Role:</label><br>
        <select id="role" name="role">
            <option value="admin">Admin</option>
            <option value="superadmin">Superadmin</option>
            <option value="guest">Guest</option>
        </select><br><br>

       <label for="email">Email:</label><br>
       <input type="email" id="email" name="email" required><br><br>

       <label for="password">Password:</label><br>
       <input type="password" id="password" name="password" required><br><br>

       <button type="button" onclick="register()">Register</button>

       <button type="button" onclick="login()">Log in</button>
   </form>

   <div id="error-container"></div>

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
