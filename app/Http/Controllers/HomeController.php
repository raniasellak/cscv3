<?PHP 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Evenement;
use App\Models\Product;

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
}
