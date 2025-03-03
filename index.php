<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");

// รับข้อมูลจาก Webhook
$raw = file_get_contents("php://input");

// Log ลงไฟล์
file_put_contents("webhook.log", date("Y-m-d H:i:s") . "\n" . $raw . "\n\n", FILE_APPEND);

// แปลง JSON เป็น Array
$data = json_decode($raw, true);

if (isset($data['events'][0]['source'])) {
    $source = $data['events'][0]['source'];

    if ($source['type'] === 'group' && isset($source['groupId'])) {
        $groupId = $source['groupId'];
        echo "📣 Group ID: " . $groupId;
        file_put_contents("group_id.log", $groupId . "\n", FILE_APPEND);
    } else {
        echo "This is not a group event.";
    }
} else {
    echo "No events received.";
}
