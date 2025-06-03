<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $newsletter = Newsletter::create([
            'email' => $request->email,
        ]);

        // Envoyer un email à tous les inscrits sauf le nouvel inscrit
        $emails = Newsletter::where('email', '!=', $request->email)->pluck('email')->toArray();
        if (!empty($emails)) {
            Mail::raw('Nouvelle newsletter !', function ($message) use ($emails) {
                $message->to($emails)
                        ->subject('Nouvelle newsletter du CSC');
            });
        }

        return back()->with('newsletter_success', 'Merci pour votre inscription à la newsletter !');
    }
     public function index()
    {
        return view('admin.newsletter');
    }
} 