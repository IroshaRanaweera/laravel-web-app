<!-- users.blade.php -->
<table>
    <thead>
        <tr>
            <th data-sort-by="id">ID</th>
            <th data-sort-by="username">Username</th>
            <th data-sort-by="name">Name</th>
            <th data-sort-by="email">Email</th>
            <th data-sort-by="user_type">User Type</th>
            <th>Preview</th>
            <th>Deactivate</th>
        </tr>
    </thead>
    <tbody id="user-table-body"></tbody>
</table>
<div id="pagination-links"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    console.log("response.data");
    $(document).ready(function() {
        loadUsers();
    });

    function loadUsers(page = 1, sortBy = 'id', sortDir = 'asc') {
        $.ajax({
            url: '/users',
            type: 'GET',
            data: {
                page: page,
                sort_by: sortBy,
                sort_dir: sortDir
            },
            success: function(response) {
                // Clear existing table body content
                $('#user-table-body').empty();

                // Loop through each user object in the response data
                response.users.data.forEach(function(user) {
                    // Create a new table row
                    var row = $('<tr>');

                    // Append table data cells to the row
                    row.append($('<td>').text(user.id));
                    row.append($('<td>').text(user.username));
                    row.append($('<td>').text(user.name));
                    row.append($('<td>').text(user.email));
                    row.append($('<td>').text(user.role));

                    // Create and append table data cells for Preview and Deactivate links
                    var previewCell = $('<td>').html('<a href="/users/' + user.id + '/preview">Preview</a>');
                    var deactivateCell = $('<td>').html('<a href="/users/' + user.id + '/deactivate">Deactivate</a>');
                    row.append(previewCell);
                    row.append(deactivateCell);

                    // Append the row to the table body
                    $('#user-table-body').append(row);
                });

                // Display pagination links
                $('#pagination-links').html(response.users.links);

                // Add next and previous page buttons
                var currentPage = parseInt(response.pagination_info.current_page);
                var totalPages = response.pagination_info.total_pages;

                // Previous page button
                if (currentPage > 1) {
                    $('#pagination-links').append('<button onclick="loadUsers(' + (currentPage - 1) + ')">Previous</button>');
                }

                // Next page button
                if (currentPage < totalPages) {
                    $('#pagination-links').append('<button onclick="loadUsers(' + (currentPage + 1) + ')">Next</button>');
                }
            },
            error: function(xhr) {
                console.error('Failed to load users:', xhr.statusText);
            }
        });
    }

    $(document).on('click', 'th[data-sort-by]', function() {
        var sortBy = $(this).data('sort-by');
        var sortDir = $(this).hasClass('sorted-asc') ? 'desc' : 'asc';
        $('th[data-sort-by]').removeClass('sorted-asc sorted-desc');
        $(this).addClass('sorted-' + sortDir);
        loadUsers(1, sortBy, sortDir);
    });
</script>
