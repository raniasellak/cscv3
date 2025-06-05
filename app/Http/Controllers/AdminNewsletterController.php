<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminNewsletterController extends Controller
{
    /**
     * Afficher la page de gestion de la newsletter
     */
    public function index()
    {
        $subscribers = Newsletter::orderBy('created_at', 'desc')->get();
        return view('admin.newsletter', compact('subscribers'));
    }

    /**
     * Envoyer un message à tous les abonnés
     */
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Récupérer tous les abonnés
            $subscribers = Newsletter::all();
            
            if ($subscribers->isEmpty()) {
                return back()->with('error', 'Aucun abonné trouvé.');
            }

            $message = $request->input('message');
            $imagePath = null;

            // Traiter l'image si elle est uploadée
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('newsletter-images', 'public');
            }

            // Envoyer l'email à chaque abonné
            foreach ($subscribers as $subscriber) {
               Mail::send('emails.newsletter', [
    'content' => $message, // <--- changé ici
    'imagePath' => $imagePath
], function ($mail) use ($subscriber) {
    $mail->to($subscriber->email)
         ->subject('Newsletter - ' . config('app.name'))
         ->from(config('mail.from.address'), config('mail.from.name'));
});

            }

            return back()->with('newsletter_sent', 'Message envoyé avec succès à ' . $subscribers->count() . ' abonnés !');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'envoi : ' . $e->getMessage());
        }
    }
}