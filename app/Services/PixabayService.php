<?php
namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PixabayService
{
    private $apiUrl = null;
    private $apiKey = null;
    private $cacheExpiration = 60 * 60 * 24;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->apiUrl = env('PIXABAY_API_URL');
        $this->apiKey = env('PIXABAY_API_KEY');
    }

    /**
     * Returns data from the Pixabay API if exists or from the cache database.
     *
     * @param array $params
     * @return array
     */
    public function getData($params)
    {
        $url = sprintf('%s?key=%s', $this->apiUrl, $this->apiKey);

        foreach ($params as $key => $value) {
            $url .= sprintf('&%s=%s', $key, urlencode($value));
        }

        $result = [
            'status' => 'OK',
            'isCache' => false,
            'cacheExpiration' => $this->cacheExpiration,
            'data' => null
        ];

        if (Cache::has($url)) {
            $result['isCache'] = true;
            $result['data'] = Cache::get($url);
            $result['cacheExpiration'] = $this->getCacheExpiration($url);
        } else {
            $response = Http::get($url);
            $responseJson = $response->json();

            if ($response->failed()) {
                $result['status'] = 'NOK';
                $result['cacheExpiration'] = 0;

                return $result;
            }

            Cache::put($url, $responseJson, $this->cacheExpiration);

            $result['data'] = $responseJson;
        }

        return $result;
    }

    /**
     * Get the registered name of the component.
     *
     * @param string $key
     * @return string
     */
    private function getCacheExpiration($key)
    {
        $expirationTimestamp = DB::table('cache')
            ->select('expiration')
            ->where('key', $key)
            ->first()
            ->expiration;

        $expirationDate = \DateTime::createFromFormat('U', $expirationTimestamp);
        $serverDate = Carbon::now();

        return date_diff($expirationDate, $serverDate)->format('%h Hours %i Minutes %s Seconds');
    }
}
