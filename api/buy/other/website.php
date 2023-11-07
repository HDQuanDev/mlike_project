<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$myheader = $_SERVER['HTTP_XXXXXX_XXXX'];

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->query) &&
    !empty($data->appPackageName) &&
    !empty($data->messengerPackageName) &&
    !empty($data->query->sender) &&
    !empty($data->query->message)
) {

    $appPackageName = $data->appPackageName;
    $messengerPackageName = $data->messengerPackageName;
    $sender = $data->query->sender;
    $message = $data->query->message;
    $message = ltrim($message, "/");
    $isGroup = $data->query->isGroup;
    $groupParticipant = $data->query->groupParticipant;
    $ruleId = $data->query->ruleId;
    $isTestMessage = $data->query->isTestMessage;


    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.openai.com/v1/completions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
        "model": "text-davinci-003",
        "prompt": "' . $message . '",
        "max_tokens": 1500,
        "temperature": 0,
        "top_p": 1,
        "frequency_penalty": 0.0,
        "presence_penalty": 0.0
    }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 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',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $result = json_decode($response, true);
    $mess = $result["choices"][0]["text"];
    $cut = str_replace("\n", "\r\n", $mess);
    http_response_code(200);

    echo json_encode(array("replies" => array(
        array("message" => "
        - Câu hỏi: $message
        - Trả lời: $cut
        (QBOT là công nghệ áp dụng Trí tuệ nhân tạo AI giúp giải đáp mọi câu hỏi một cách dễ dàng được phát triển bởi QDevTeam)")
    )));
} else {
    http_response_code(400);
    echo json_encode(array("replies" => array(
        array("message" => "Error ❌"),
        array("message" => "JSON data is incomplete. Was the request sent by AutoResponder?")
    )));
}
