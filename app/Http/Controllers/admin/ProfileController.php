<?php

namespace App\Http\Controllers;

use App\Models\KomunitasModel;
use App\Models\memberKomunitasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $memberKomunitas = memberKomunitasModel::where('user_id', Auth::user()->id)->get();
        return view('user.profile', compact('user', 'memberKomunitas'));
    }
}
