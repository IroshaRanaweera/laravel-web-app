<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[readonly] {
            background-color: #f2f2f2; 
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
    </style>
</head>
<body>
   <div class="container">
       <h2>Update User</h2>

       <div id="update-user-form">
            <!-- Display ID -->
            <div>
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" value="{{ $user->id }}" readonly>
            </div>

            <!-- Display Username -->
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ $user->username }}" readonly>
            </div>

            <!-- Display Name (editable) -->
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}">
            </div>

            <!-- Display Email -->
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" readonly>
            </div>

            <!-- Display Role (editable) -->
            <div>
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="superadmin" {{ $user->role === 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                    <option value="guest" {{ $user->role === 'guest' ? 'selected' : '' }}>Guest</option>
                </select>
            </div>

            <!-- Password field for updating password -->
            <div>
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password">
            </div>

            <!-- Update button -->
            <button onclick="updateUser()">Update</button>
        </div>
   </div>

   <script>
       function updateUser() {
            var id = document.getElementById('id').value;
            var name = document.getElementById('name').value;
            var role = document.getElementById('role').value;
            var password = document.getElementById('password').value;
            var csrfToken = '{{ csrf_token() }}';

            // Send AJAX request to update user information
            $.ajax({
                url: '/user/' + id,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken 
                },
                data: {
                    name: name,
                    role: role,
                    password: password
                },
                success: function(response) {
                    // Handle success response
                    alert('User information updated successfully');
                    window.location.href = '/dashboard';
                },
                error: function(xhr) {
                    // Handle error response
                    console.error('Failed to update user:', xhr.statusText);
                    alert('Failed to update user information');
                }
            });
        }
   </script>
</body>
</html>
