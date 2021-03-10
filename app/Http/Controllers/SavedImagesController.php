<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavedImagesController extends Controller
{
    /**
     * Show the saved images page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $savedImages = [
            [
                'id' => 1111,
                'userImageURL' => 'https://cdn.pixabay.com/photo/2018/10/14/07/19/dusk-3745864__340.jpg',
            ],
        ];

        return view('images', [
            'images' => $savedImages
        ]);
    }
}
