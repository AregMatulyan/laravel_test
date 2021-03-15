<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class SavedImagesController extends Controller
{
    /**
     * Show the saved images page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $savedImages = DB::table('saved_images')->get();
        $pathPrefix = env('PIXABAY_STORAGE_PATH');
        $result = [];

        foreach ($savedImages as $savedImage) {
            $imagePath = sprintf('storage/%s/%s/', $pathPrefix, $savedImage->external_id);

            $result[] = [
                'id' => $savedImage->external_id,
                'largeImageURL' => asset($imagePath . $savedImage->image_path),
                'webformatURL' => asset($imagePath . $savedImage->thumbnail_path),
                'tags' => $savedImage->tags
            ];
        }

        return view('images', [
            'hideSaveButton' => true,
            'images' => $result
        ]);
    }
}
