<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $images = [
            [
                'id' => 195893,
                'userImageURL' => 'https://cdn.pixabay.com/user/2013/11/05/02-10-23-764_250x250.jpg',
            ],
            [
                'id' => 195894,
                'userImageURL' => 'https://cdn.pixabay.com/user/2013/11/05/02-10-23-764_250x250.jpg',
            ],
            [
                'id' => 195895,
                'userImageURL' => 'https://cdn.pixabay.com/user/2013/11/05/02-10-23-764_250x250.jpg',
            ],
            [
                'id' => 195896,
                'userImageURL' => 'https://cdn.pixabay.com/user/2013/11/05/02-10-23-764_250x250.jpg',
            ],
        ];

        return view('images', [
            'images' => $images
        ]);
    }
}
