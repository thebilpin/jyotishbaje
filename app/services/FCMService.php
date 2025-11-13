<?php

namespace App\Services;
use GuzzleHttp\Client;

class FCMService
{


     // Public property to store the service account key
     public $serviceAccountKey = [
            "type"=>"service_account",
            "project_id"=> "astro",
            "private_key_id"=> "878r87767768765768g86g767678g676g7",
            "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDO3Bv/cb7IUXQ0\nntwNZTsG4JnvD8NSOIcaInhgrtkueyt7wyt845yt75yt7n75cy875t7yUG+qgLpRvyF\nXWUWg8cFPmR3MaXMKypXWffnOrZ2xkjR/IIu2bWkiRcG/5mOqNGTjUw0Vw6j5eaj\nLMTbSiNLspleds67OV/F3hytm4OAkF01anxS5Ynngt8AMU4RCbkuqZ21Ben9quUD\nH28tAkGuVAldeV/71YqiggLgWzWneYrao+NC4l2yvVJPj4kx8pvyF04QQFbPTftV\nVnzBql4xAgMBAAECggEAMHAWFkCaPenk3hV8zZ4wrjGVmgcE45HdAN/0R4k7pFI6\nbFkxAyOCChCb87t8975n87t437ne7tetn34774yt74tTJuDlvIgjZ/z6M\njmf9sWddgCsTp6G319RLzYwHow/IUruOkeQGsbj1t2Kev9JeUmqhJYcpp3l2FGV5\nzc7U7kSfMGt25BIYPlv3y8+TQdTgVZI0qut3PjnA8GiPtNVsfKd+pTDKk69JLncN\nStM/cVGjI1qj2iXWXn3jDnAceORpH4UIpl/3xxK90VNq5pfk9yOxgbqdnmxpsfS1\n11PZnweIGsEXgvPOqYXqnuksB8FnoJnkXXHuAgYb4QKBgQD2Zx0mrtolDmwMjMPG\nCJ9F+Q6B07Ws8Bx7er7t7834ntc4GIS18OHPNux\nZGOtTTretkOKXMCdoqubSTVR5d7SvbxCWTdHGmE589gY2AjQZsFVxg5pDLwgd4RN\noqfVk+lOjWZNh012BWygiTuulQKBgQDW6rY1JY6BDguR4BOmrNX2XwSpUuppgH9p\nmCF8evzyer7ty7e7c467bn7ryt7MGbKgSKUuFab7\nN5rcWMxr3JbGBWsMXnHyKs7BGXPdAz9adu0c+GvgDunnAiB95eUL4lZAnydRJYuZ\nG6CrV+R2LQKBeryt8n8n74mOp0brQ\nOgeAIgs9/Q5qwFEIA/wPvagiSK8rmw1kuudWJx5Gzr6jlMDRbco9fT1jmN2sREV7\nxzHgZ51OTgIrr2//ydTPyqu5P5eR9c0OwJna8G5gzMqg0tTfmmldI+KmvQKBgE8L\ndIiHetr6eettnc4/P2YMbnilK/3DMph4JdKyns\nUCj67EG5ww+zlW512UKcEP6yuU4B2LB8+xAf+M+TCkE6rOyXsAEJjZGn8t1O3HZB\nV2etr66t6re6t63encb4n6b4cnt43bhp8Kz7YzWd9TPF/XI\nKrV38McdGrBfLq1ZRvDBkmKj+2orkW0xsBsm6HxrKqk2ZvOkgW0BiGJIm6NJbYma\nD6er7bec78e6t7y7enc7nyt7ytcmyt+kn7MZg1MGHA6fY\nACw1G+X47Qea6g3CDO4j7tUc\n-----END PRIVATE KEY-----\n",
            "client_email"=> "firebase-astro-nn@astroway-astro.iam.astro.com",
            "client_id"=> "118243690510425066312",
            "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
            "token_uri"=> "https://oauth2.astro.com/token",
            "auth_provider_x509_cert_url"=> "https://www.astro.com/oauth2/v1/certs",
            "client_x509_cert_url"=> "https://www.astro.com/robot/v1/metadata/x509/firebase-adminsdk-nnrom%40astroway-diploy.iam.astro.com",
            "universe_domain"=> "googleapis.com"
    ];


public static function send($userDeviceDetail, $notification)
{
    $fcmService = new self();
    $projectId = 'astroway-diploy';
    $serverApiKey = env('FCM_SERVER_KEY');
    $accessToken = $fcmService->getAccessToken($serverApiKey);

    $endpoint = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';

    $responses = []; // Array to store individual responses

    foreach ($userDeviceDetail->pluck('fcmToken')->all() as $token) {
        $notificationType = isset($notification['body']['notificationType']) ? (string) $notification['body']['notificationType'] : null;


        // $payload = [
        //     'message' => [
        //         'token' => $token,
        //         'notification' => [
        //             'title' => $notification['title'],
        //             'body' => $notification['body']['description'],
        //         ],
        //         'data' => [
        //             'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        //             'body' => json_encode($notification['body']),

        //         ],
        //         'android' => [
        //             'priority' => 'high',
        //         ],
        //     ],
        // ];

        $payload = [
            'message' => [
                'token' => $token,
                // 'notification' => [
                //   'title' => $notification['title'],
                // ],
                'data' => [
                    'title' => $notification['title'],
                     'description' => $notification['body']['description'],
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    'body' => json_encode($notification['body']),

                ],
                'android' => [
                    'priority' => 'high',
                ],
            ],
        ];


        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $responses[] = json_decode($response, true);
    }

    return $responses;
}


    private function getAccessToken($serverApiKey)
    {
        $url = 'https://www.googleapis.com/oauth2/v4/token';
        $data = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $this->generateJwtAssertion($serverApiKey),
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $body = json_decode($response, true);

        return $body['access_token'];
    }


    private function generateJwtAssertion($serverApiKey)
{
    $now = time();
    $exp = $now + 3600; // Token expires in 1 hour

    $jwtClaims = [
        'iss' => $this->serviceAccountKey['client_email'],
        'sub' => $this->serviceAccountKey['client_email'],
        'aud' => 'https://www.googleapis.com/oauth2/v4/token',
        'scope' => 'https://www.googleapis.com/auth/cloud-platform',
        'iat' => $now,
        'exp' => $exp,
    ];

    $jwtHeader = [
        'alg' => 'RS256',
        'typ' => 'JWT',
    ];

    $base64UrlEncodedHeader = $this->base64UrlEncode(json_encode($jwtHeader));
    $base64UrlEncodedClaims = $this->base64UrlEncode(json_encode($jwtClaims));

    $signatureInput = $base64UrlEncodedHeader.'.'.$base64UrlEncodedClaims;

    $privateKey = openssl_pkey_get_private($this->serviceAccountKey['private_key']);
    openssl_sign($signatureInput, $signature, $privateKey, OPENSSL_ALGO_SHA256);
    openssl_free_key($privateKey);

    $base64UrlEncodedSignature = $this->base64UrlEncode($signature);

    return $signatureInput.'.'.$base64UrlEncodedSignature;
}



    private function base64UrlEncode($input)
    {
        return rtrim(strtr(base64_encode($input), '+/', '-_'), '=');
    }



    // public static function send($userDeviceDetail, $notification)
    // {
    //     $serverApiKey = env('FCM_SERVER_KEY');
    //     $payload = [
    //         "notification" => [
    //             "title" => $notification['title'],
    //             "body" => $notification['body']['description'],
    //         ],
    //         "data" => [
    //             "click_action" => "FLUTTER_NOTIFICATION_CLICK",
    //             "body" => $notification['body'],

    //         ],
    //         "android" => [
    //             "priority" => 'high',
    //         ],
    //         "registration_ids" => $userDeviceDetail->pluck('fcmToken')->all(),
    //     ];
    //     $dataString = json_encode($payload);
    //     $headers = [
    //         'Authorization: key=' . $serverApiKey,
    //         'Content-Type: application/json',
    //     ];
    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    //     return curl_exec($ch);

	// 	curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
	// 	curl_setopt($ch, CURLOPT_POST, true);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
	// 	// Set a short timeout to make the request asynchronous
	// 	curl_setopt($ch, CURLOPT_TIMEOUT, 1);
	// 	 // Execute the request in the background
	// 	curl_exec($ch);
	// 	// Close the cURL handle
	// 	curl_close($ch);
	// 	return true;
    // }
}

