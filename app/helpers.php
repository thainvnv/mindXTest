<?php

use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * @param string $method
 * @param string $uri
 * @param null $params
 * @param array $headers
 * @param array $options
 * @return ResponseInterface|null
 */
if (!function_exists('http_request')) {
    function http_request($method, $uri, $params = null, array $headers = [], $options = [])
    {
        if (!isset($options[RequestOptions::SYNCHRONOUS]) || $options[RequestOptions::SYNCHRONOUS] != false) {
            $options[RequestOptions::SYNCHRONOUS] = true;
        }
        if (!empty($params)) {
            if (strtolower($method) == 'get') {
                if (strpos($uri, '?')) {
                    $uri = $uri . '&' . http_build_query($params);
                } else {
                    $uri = $uri . '?' . http_build_query($params);
                }
            } else {
                if (isset($options['raw']) && $options['raw'] == true) {
                    if (!is_string($params)) {
                        $params = json_encode($params);
                    }
                    $options['body'] = $params;
                    $headers['Content-Type'] = 'Application/json';
                    $headers['Content-Length'] = strlen($options['body']);
                } else {
                    $options['form_params'] = $params;
                }
            }
        }

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }


        /** @var ClientInterface $client */
        $client = app(ClientInterface::class);
        $res = $client->requestAsync($method, $uri, $options);
        if ($options[RequestOptions::SYNCHRONOUS] == true) {
            $res = $res->wait();
        }

        return $res;
    }
}

