<?php

namespace App\General\Admin;
use Google\Client;
use GuzzleHttp\Client as GuzzleClient;

class Indexing
{


    public function multiples($urls)
    {

        $exurl = is_array($urls) ? $urls : explode("\n", trim($urls));
        $newURLS = array_filter($exurl, function($url) {
            return filter_var(trim($url), FILTER_VALIDATE_URL);
        });

        $error = [];
        $success = false;
        $message = "";

        if(empty($newURLS)) {
            $error[] = "No valid urls provided";
        }

        $responses = [];

        $client = new GuzzleClient();

        foreach($newURLS as $url) {
            $response = $this->indexUrl($client, $url);

            if($response == false) {
                $error[] = "Unsupported Secret Service.json File";
            } else {

                $parts = explode('--batch--', $response);

                foreach($parts as $part) {
                    if(trim($part) === "") {
                        continue;
                    }
    
                    preg_match('/\{.*\}/s', $part, $matches);
                    if(!empty($matches)) {
                        $decodeR = json_encode($matches[0], true);
                        if($decodeR === null) {
                            $error[] = 'Failed to decode API response';
                        }
    
                        $firstDecode = json_decode($decodeR , true);
                        $secondDecode = json_decode($firstDecode, true);

                        if(isset($decodeR['error']) && $decodeR['error']['code'] === 429) {
                            $error[] = 'Quota limit exceeded for Google indexing API pls try again after 24 hours';
                        } 
                        
                        if(isset($secondDecode['error']) && $secondDecode['error']['code'] === 400) {
                            $error[] = $secondDecode['error']['message'];
                        }
    
                        $responses[] = [
                            'url' => $url,
                            'response' => $decodeR,
                        ];
                    }
                }
            }
    
            $logDir = __DIR__.'/../../../Log/';
            $logFile = $logDir.'instantindex.json';
    
            if (!is_dir($logDir)) {
                if (!mkdir($logDir, 0777, true) && !is_dir($logDir)) {
                    $error[] = 'Failed to create logs directory';
                }
            }
    
            if (!file_exists($logFile)) {
                $file = fopen($logFile, 'w'); // 'w' mode creates the file if it doesn't exist
                if ($file) {
                    fclose($file);
                }
            } 
    
            if(file_put_contents($logFile, json_encode($responses, JSON_PRETTY_PRINT), FILE_APPEND) === false) {
                $error[] = "Failed to write to log file";
            }

            }

            if(count($error) > 0) {
                $message = $error[0];
            } else {
                $success = true;
                $message = "Urls indexed successfully ";
            }

        return ['success' => $success, 'message' => $message];

    }

    public function indexUrl($client, $url) {

        $keyFilePath = __DIR__.'/../../../config/secret.json';
        
        if(!file_exists($keyFilePath)) {
            return false;
        } else  {

            if(file_get_contents($keyFilePath) == '')
            {
                return false; 
            } else {

                $googleClient = new Client();
                $googleClient->setAuthConfig($keyFilePath);
                $googleClient->addScope('https://www.googleapis.com/auth/indexing');
                $googleClient->fetchAccessTokenWithAssertion();
                $accessToken = $googleClient->getAccessToken()['access_token'];
            
                $content = json_encode(['url' => $url, 'type' => 'URL_UPDATED']);
                $boundary = '-------314159265358979323846';
                $body = "--$boundary\n";
                $body .= "Content-Type: application/http\n\n";
                $body .= "POST /v3/urlNotifications:publish HTTP/1.1\n";
                $body .= "Content-Type: application/json\n\n";
                $body .= "$content\n";
                $body .= "--$boundary--";
            
                $response = $client->request('POST', 'https://indexing.googleapis.com/batch', [
                    'headers' => [
                        'Content-Type' => 'multipart/mixed; boundary=' . $boundary,
                        'Authorization' => 'Bearer ' . $accessToken
                    ],
                    'body' => $body
                ]);
            
                return $response->getBody()->getContents();
            }


        }
    }

}
