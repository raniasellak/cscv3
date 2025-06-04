<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class ChatbotController extends Controller
{
    private $clubInfo = [
        'nom' => 'Computer Science Club (CSC)',
        'creation' => '2024',
        'localisation' => 'Faculté des Sciences et Techniques Gueliz, Marrakech',
        'mission' => 'Promouvoir la culture informatique et organiser des événements techniques',
        'president' => 'Hatim Abahri',
        'vice_president' => 'Abdessamad lmider',
        'email' => 'csclubofficiel@gmail.com',
        'membres' => '50 membres actifs',
        'activites' => [
            'Formations en programmation',
            'Workshops cybersécurité', 
            'Hackathons',
            'Conférences et séminaires',
            'Compétitions techniques'
        ],
        'cellules' => [
            'Cyber Security - Dirigée par Hiba El Hjouji',
            'Développement - Dirigée par Mohammed El Allali', 
            'Intelligence Artificielle - Dirigée par Mohammed Ezzaim'
        ]
    ];

    public function index()
    {
        return view('chatbot.index');
    }

    public function sendMessage(Request $request): JsonResponse
    {
        try {
            // Validation de la requête
            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $userMessage = strtolower($request->input('message'));
            
            // Simuler une réponse intelligente basée sur les mots-clés
            $response = $this->generateResponse($userMessage);

            return response()->json([
                'success' => true,
                'message' => $response
            ]);

        } catch (Exception $e) {
            Log::error('Erreur Chatbot: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Désolé, une erreur est survenue. Veuillez réessayer.'
            ], 500);
        }
    }

    private function generateResponse($message)
    {
        // Réponses basées sur les mots-clés
        if (str_contains($message, 'rejoindre') || str_contains($message, 'adhérer') || str_contains($message, 'inscription')) {
            return "Pour rejoindre le CSC, le recrutement a lieu chaque année à la rentrée universitaire via un formulaire en ligne suivi d'un petit entretien de motivation. Vous pouvez nous contacter à : csclubofficiel@gmail.com 📧";
        }
        
        if (str_contains($message, 'activité') || str_contains($message, 'formation') || str_contains($message, 'événement')) {
            return "Nos principales activités incluent :\n• Formations en programmation 💻\n• Workshops cybersécurité 🔒\n• Hackathons 🏆\n• Conférences et séminaires 🎤\n• Compétitions techniques ⚡\n\nToutes nos activités sont gratuites pour les étudiants !";
        }
        
        if (str_contains($message, 'président') || str_contains($message, 'responsable') || str_contains($message, 'dirigeant')) {
            return "Voici notre bureau central :\n• Président : Hatim Abahri 👨‍💼\n• Vice-président : Abdessamad lmider\n• Secrétaire : Mohammed El Mehdaoui\n• Chef communication : Souhaib\n\nNous avons aussi 3 cellules spécialisées avec leurs propres responsables !";
        }
        
        if (str_contains($message, 'cellule') || str_contains($message, 'équipe') || str_contains($message, 'département')) {
            return "Le CSC est organisé en 3 cellules :\n• 🔒 Cyber Security - Dirigée par Hiba El Hjouji\n• 💻 Développement - Dirigée par Mohammed El Allali\n• 🤖 Intelligence Artificielle - Dirigée par Mohammed Ezzaim\n\nChaque cellule a ses propres projets et formations !";
        }
        
        if (str_contains($message, 'contact') || str_contains($message, 'email') || str_contains($message, 'joindre')) {
            return "Vous pouvez nous contacter via :\n📧 Email : csclubofficiel@gmail.com\n💼 LinkedIn : CSC Club\n📱 Instagram : csc.club\n\nN'hésitez pas à nous écrire pour toute question !";
        }
        
        if (str_contains($message, 'lieu') || str_contains($message, 'où') || str_contains($message, 'localisation')) {
            return "Le CSC est basé à la Faculté des Sciences et Techniques Gueliz, Marrakech 🏛️\n\nNous organisons nos activités principalement dans les locaux de la faculté.";
        }
        
        if (str_contains($message, 'gratuit') || str_contains($message, 'prix') || str_contains($message, 'coût')) {
            return "Excellente nouvelle ! 🎉\nToutes nos activités sont entièrement GRATUITES pour les étudiants. Notre mission est de rendre l'apprentissage accessible à tous !";
        }
        
        if (str_contains($message, 'temps') || str_contains($message, 'heure') || str_contains($message, 'disponibilité')) {
            return "En moyenne, nous demandons 2 à 3 heures par semaine pour les formations hebdomadaires, avec un grand événement à la fin de l'année. C'est flexible selon votre emploi du temps ! ⏰";
        }
        
        if (str_contains($message, 'compétence') || str_contains($message, 'niveau') || str_contains($message, 'débutant')) {
            return "Aucune compétence technique préalable n'est requise ! 😊\nLe club est justement là pour vous aider à développer vos compétences. Que vous soyez débutant ou expérimenté, vous êtes le bienvenu !";
        }
        
        if (str_contains($message, 'membre') || str_contains($message, 'étudiant') || str_contains($message, 'nombre')) {
            return "Notre club compte environ 50 membres actifs (2024) 👥\nNous accueillons tous les étudiants : DEUST, Licence, Master, Cycle Ingénieur, et tout passionné d'informatique !";
        }
        
        if (str_contains($message, 'bonjour') || str_contains($message, 'salut') || str_contains($message, 'hello')) {
            return "Salut ! 👋 Je suis l'assistant virtuel du Computer Science Club (CSC). Je suis là pour répondre à toutes vos questions sur notre club. Que voulez-vous savoir ?";
        }
        
        if (str_contains($message, 'merci') || str_contains($message, 'merci beaucoup')) {
            return "De rien ! 😊 Je suis là pour vous aider. N'hésitez pas si vous avez d'autres questions sur le CSC !";
        }
        
        // Réponse par défaut
        return "Je suis spécialisé dans les questions concernant le Computer Science Club (CSC). 🤖\n\nVous pouvez me demander des informations sur :\n• Comment rejoindre le club\n• Nos activités et formations\n• Nos responsables\n• Comment nous contacter\n• Nos différentes cellules\n\nQue souhaitez-vous savoir ?";
    }

    // Version simple du test sans OpenAI
    public function testOpenAI()
    {
        return response()->json([
            'success' => true,
            'message' => 'Mode démo activé ! Le chatbot fonctionne sans OpenAI.',
            'note' => 'Pour utiliser OpenAI, ajoutez du crédit à votre compte.'
        ]);
    }
}