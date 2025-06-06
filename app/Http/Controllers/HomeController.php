<?PHP 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Evenement;
use App\Models\Product;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $formations = Formation::orderBy('date')->take(3)->get();
        $Events = Evenement::orderBy('date')->take(3)->get();
        $Products = Product::take(3)->get();

        $stats = [
            'formations' => Formation::count(),
            'evenements' => Evenement::count(),
            'participants' => 1234, // Remplace par une vraie logique si besoin
            'certificats' => 567,
        ];

        return view('home', compact('formations', 'Events', 'Products', 'stats'));
    }

    public function subscribeNewsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Cette adresse email est déjà inscrite à notre newsletter.'
            ], 422);
        }

        try {
            Newsletter::create([
                'email' => $request->email
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Merci pour votre inscription ! Vous recevrez bientôt nos actualités.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue. Veuillez réessayer plus tard.'
            ], 500);
        }
    }
}
