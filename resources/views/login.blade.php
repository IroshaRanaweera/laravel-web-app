<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Login</title>
</head>
<body>  
    <h2>Login</h2>
    <div id="error-container"></div> <!-- Container to display errors -->
    <form id="login-form" method="POST" action="{{ route('login') }}">
        @csrf <!-- CSRF token field -->
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <button type="button" onclick="login()">Login</button> <!-- Call login() function on button click -->
    </form>

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
                    console.log(response);
                    window.location.href = '/dashboard';
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
    </script>
</body>
</html>
