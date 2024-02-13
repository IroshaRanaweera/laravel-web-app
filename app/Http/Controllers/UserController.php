<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'in:admin,superadmin,guest'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); // Hash the password before storing
        $user->role = $validatedData['role'];

        // Save the user to the database
        $user->save();

        // Redirect the user after successful registration
        return redirect('/')->with('success', 'Registration successful! Please log in.');
    }

    public function showRegisterPage()
    {
        return view('registration');
    }

    public function index(Request $request)
    {
        $users = User::query();

        // Apply sorting if requested
        if ($request->has('sort_by')) {
            $users->orderBy($request->input('sort_by'), $request->input('sort_dir', 'asc'));
        }

        // Paginate the results
        $perPage = $request->input('per_page', 1);
        $currentPage = $request->input('page', 1); // Get current page from the request
        $users = $users->paginate($perPage);

        // Add current page information to the response
        $paginationInfo = [
            'current_page' => $currentPage,
            'total_pages' => $users->lastPage(),
            'total_records' => $users->total(),
        ];

        return response()->json([
            'users' => $users,
            'pagination_info' => $paginationInfo,
        ]);

    }

    public function show($id)
    {
        // Fetch the user by ID
        $user = User::findOrFail($id);

        // Pass the user data to the view
        return view('user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', // Password is optional and must be at least 6 characters long
            'role' => 'required|in:admin,superadmin,guest', // Role must be one of these values
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update only the editable fields
        $user->name = $validatedData['name'];
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']); // Hash the password if provided
        }
        $user->role = $validatedData['role'];

        // Save the updated user information
        $user->save();

        // Redirect back
        return $user;
    }

    public function status($id){

        $user = User::findOrFail($id);

        // Toggle the activation status
        $user->deactivate = !$user->deactivate;
        $user->save();

        return $user;
        
    }


}
