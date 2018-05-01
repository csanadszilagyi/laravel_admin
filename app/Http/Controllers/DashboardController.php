<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = User::all();
        $user = Auth::user();
        $userRoles = $user->getOutputRoleNames();
        return view('admin.dashboard', compact('user', 'allUsers', 'userRoles'));
    }

    /**
     * Show the application admin's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdmins()
    {
        return view('admin.admins');
    }

    /**
     * Show the application editor's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditors()
    {
        return view('admin.editors');
    }

    /**
     * Show the application signed-in user's page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        return view('admin.users');
    }
}
