<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessImageSaving;


class SaveImageController extends Controller
{
    protected $basePath = null;

    /**
     * SaveImageController constructor.
     */
    public function __construct()
    {
        $this->basePath = env('PIXABAY_STORAGE_PATH');
    }

    /**
     * Saves image locally.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $imageId = (int) $request->input('id', 0);
        $largeImageURL = $request->input('largeImageURL');
        $webFormatURL = $request->input('webformatURL');
        $tags = $request->input('tags', '');

        if ($imageId <= 0) {
            return response('Image ID id not specified', 400);
        }

        if (! $largeImageURL) {
            return response('Image large URL is not specified', 400);
        }

        if (! $webFormatURL) {
            return response('Image web format URL is not specified', 400);
        }

        ProcessImageSaving::dispatch($imageId, $largeImageURL, $webFormatURL, $tags);

        return response(
            sprintf(
                'The image by id %s will be saved. Please wait few seconds until the process will be finished.',
                $imageId
            ),
            200
        );
    }
}
