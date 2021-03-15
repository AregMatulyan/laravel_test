<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PixabayService;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $search = $request->input('search');
        $pixabayService = new PixabayService();

        $params = [
            'q' => $search,
            'tags' => $search,
        ];

        $result = $pixabayService->getData($params);

        return view('images', [
            'isCache' => $result['isCache'],
            'cacheExpiration' => $result['cacheExpiration'],
            'hideSaveButton' => false,
            'images' => $result['data']['hits'] ?: []
        ]);
    }
}
