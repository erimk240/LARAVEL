<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BitvavoService;

class ChartsController extends Controller
{
    protected $bitvavoService;

    public function __construct(BitvavoService $bitvavoService)
    {
        $this->bitvavoService = $bitvavoService;
    }
   
    public function index()
    {
        $topCryptos = ['BTC-EUR', 'ETH-EUR', 'ADA-EUR', 'XRP-EUR', 'LTC-EUR']; // Voeg hier de top 5 cryptos toe
        return view('crypto.charts', compact('topCryptos'));
    }

    public function getLiveData(Request $request)
    {
        $market = $request->input('market', 'BTC-EUR');
        $priceData = collect($this->bitvavoService->getTickerPrice())->firstWhere('market', $market);
        return response()->json([
            'price' => $priceData['price'] ?? null
        ]);
    }
}

?>