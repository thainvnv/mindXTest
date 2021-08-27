<?php


namespace App\Http\Service;


use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

abstract class BaseService
{
    protected $base_url;
    public function __construct()
    {
        $this->base_url = "https://" . config('app.rapidapi_host');
    }

    public function request(string $method, string $uri = '', array $params = [], array $config = [])
    {
        $url = $this->appendToUri($this->base_url, $uri);
        $header = [
            'x-rapidapi-host' => config('app.rapidapi_host'),
            'x-rapidapi-key' => config('app.rapidapi_key')
        ];
        $config['http_errors'] = false;
        $response = http_request($method, $url, $params, $header, $config);

        try {
            $contents =  $response->getBody()->getContents();
            return json_decode($contents, true);
        } catch (RequestException $ex) {
            Log::info(json_encode($ex));
        }
        return null;
    }

    private function appendToUri(string $uri, string $string): string
    {
        if (! trim($string)) {
            return $uri;
        }

        $uri = preg_replace('/[\/]+$/', '', $uri);
        $string = preg_replace('/^[\/]+/', '', $string);

        return sprintf('%s/%s', $uri, $string);
    }

    protected function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $options = ['path' => url('api/world-population')];
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
