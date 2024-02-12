<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .logout-btn {
            float: right;
        }
    </style>
</head>
<body>
   <div class="container">
       <h1>Welcome {{$user->name}}</h1>
       <button class="logout-btn" onclick="logout()">Logout</button>
   </div>

   <script>
       function logout() {
        // Send AJAX request
        $.ajax({
            type: 'GET',
            url: '/logout',
            success: function(response) {
                // Handle success response
                console.log(response);
                window.location.href = '/';
            },
            error: function(xhr) {
                alert('Something is wrong! Please try again.');
            }
        });
       }
   </script>
</body>
</html>
