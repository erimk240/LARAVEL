<?php
namespace App\Http\Controllers;

use App\Services\BitvavoService;

class TopCryptoController extends Controller
{
    protected $bitvavoService;

    public function __construct(BitvavoService $bitvavoService)
    {
        $this->bitvavoService = $bitvavoService;
    }

    public function index()
    {
        $prices = collect($this->bitvavoService->getTickerPrice());
        $top10 = $prices->sortByDesc('price')->take(10);

        return view('crypto.top10', compact('top10'));
    }
}
?>