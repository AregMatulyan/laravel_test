<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProcessImageSaving implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $basePath = null;
    private $imageId = null;
    private $largeImageURL = null;
    private $webFormatURL = null;
    private $tags = null;

    /**
     * ProcessImageSaving constructor.
     *
     * @param $imageId
     * @param $largeImageURL
     * @param $webFormatURL
     * @param $tags
     *
     */
    public function __construct($imageId, $largeImageURL, $webFormatURL, $tags)
    {
        $this->basePath = env('PIXABAY_STORAGE_PATH');
        $this->imageId = $imageId;
        $this->largeImageURL = $largeImageURL;
        $this->webFormatURL = $webFormatURL;
        $this->tags = $tags;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->saveImageToStorage($this->largeImageURL);
        $this->saveImageToStorage($this->webFormatURL);
        $this->saveImageToDatabase();
    }

    /**
     * Stores saved images to the database.
     */
    private function saveImageToDatabase()
    {
        DB::table('saved_images')->insert([
            'external_id' => $this->imageId,
            'image_path' => basename($this->largeImageURL),
            'thumbnail_path' => basename($this->webFormatURL),
            'tags' => $this->tags
        ]);
    }

    /**
     * Stores saved image to the storage.
     *
     * @param string $url
     */
    private function saveImageToStorage($url)
    {
        $fileContent = file_get_contents($url);
        $name = basename($url);
        $path = sprintf('public/%s/%s/', $this->basePath, $this->imageId);

        Storage::disk('local')->put($path . $name , $fileContent);
    }
}
