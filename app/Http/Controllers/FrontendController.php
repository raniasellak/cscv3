<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
     public function about()
    {
        $members = Member::all(); // Récupère tous les membres
        return view('about', compact('members'));
    }
}
