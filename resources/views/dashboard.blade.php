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
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
            text-align: center;
            margin-bottom: 20px;
        }
        .logout-btn {
            float: right;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
   <div class="container">
       <h1>Welcome {{$user->name}} to Dashboard</h1>
       <button class="logout-btn" onclick="logout()">Logout</button>

       <!-- Include the users.blade.php file -->
       @include('users')
   </div>

   <script>
       function logout() {
        // Send AJAX request
        $.ajax({
            type: 'GET',
            url: '/logout',
            success: function(response) {
                // Handle success response
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
