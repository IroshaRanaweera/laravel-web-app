<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
}
