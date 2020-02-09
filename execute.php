<?php

$chatId = '---YOUR USER ID---';

$request = [
    'chat_id' => $chatId,
    'text' => 'Fai tap su condividi numero telefonico',
    'reply_markup' => [
        'keyboard' => [
            [
                [
                    'text' => 'Condividi numero telefonico',
                    'request_contact' => true
                ]
            ]
        ],
        'one_time_keyboard' => true,
        'resize_keyboard' => true
    ]
];

apiRequest('---INSERT API TOKEN HERE---', $request);

function apiRequest(string $apiToken, array $request): array
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, sprintf('https://api.telegram.org/bot%s/sendMessage', $apiToken));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($ch);
    curl_close($ch);

    if(!$content) {

        return [];
    }

    return json_decode($content, true);
}
