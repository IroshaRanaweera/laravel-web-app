<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Update User</title>
</head>
<body>
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
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
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
