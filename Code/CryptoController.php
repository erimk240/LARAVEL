<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BitvavoService;

class CryptoController extends Controller
{
    protected $bitvavoService;

    public function __construct(BitvavoService $bitvavoService)
    {
        $this->bitvavoService = $bitvavoService;
    }

    public function index()
    {
        $markets = $this->bitvavoService->getMarkets();
        $prices = $this->bitvavoService->getTickerPrice();
        return view('crypto.index', compact('markets', 'prices'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $markets = $this->bitvavoService->getMarkets();
        $filteredMarkets = array_filter($markets, function($market) use ($query) {
            return stripos($market['market'], $query) !== false;
        });
        $prices = $this->bitvavoService->getTickerPrice();
        // Uncomment the line below to debug data
        // dd(['markets' => array_values($filteredMarkets), 'prices' => $prices, 'news' => $news]); 
        return view('crypto.index', [
            'markets' => array_values($filteredMarkets), // Ensure this is a zero-indexed array
            'prices' => $prices,
            
        ]);
    }

}
?>

