<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;

class NewsletterController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'image' => 'nullable|image|max:2048', // max 2 Mo
        ]);

        $messageContent = $request->input('message');
        $imagePath = null;

        if ($request->hasFile('image')) {
            // Stocke l'image dans storage/app/public/newsletters
            $imagePath = $request->file('image')->store('newsletters', 'public');
        }

        $subscribers = Newsletter::pluck('email')->toArray();

        foreach ($subscribers as $email) {
            Mail::to($email)->send(new NewsletterMail($messageContent, $imagePath));
        }

        return back()->with('newsletter_sent', 'Newsletter envoyée avec succès à tous les abonnés.');
    }
    public function index()
{
    return view('admin.newsletter');
}
}
