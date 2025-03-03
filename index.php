// <?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
// date_default_timezone_set("Asia/Bangkok");

// $raw = file_get_contents("php://input");
// file_put_contents("webhook.log", date("Y-m-d H:i:s") . "\n" . $raw . "\n\n", FILE_APPEND);

// $data = json_decode($raw, true);

// if (isset($data['events'][0]['source']['groupId'])) {
//     $groupId = $data['events'][0]['source']['groupId'];
//     file_put_contents("group_id.log", $groupId . "\n", FILE_APPEND);
//     echo "Group ID: " . $groupId;
// } else {
//     echo "This is not a group event.";
// }


<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");

// รับข้อมูลจาก Webhook (LINE ส่งมา)
$raw = file_get_contents("php://input");

// Log ลงไฟล์เก็บไว้ดู (ถ้าอยากเช็คย้อนหลังด้วย)
file_put_contents("webhook.log", date("Y-m-d H:i:s") . "\n" . $raw . "\n\n", FILE_APPEND);

// แปลง JSON เป็น Array
$data = json_decode($raw, true);

// ตรวจสอบว่ามี Event หรือไม่
if (isset($data['events'][0]['source'])) {
    $source = $data['events'][0]['source'];

    if ($source['type'] === 'group' && isset($source['groupId'])) {
        $groupId = $source['groupId'];
        
        // แสดง Group ID ออกหน้าจอเลย
        echo "📣 Group ID: " . $groupId;

        // จะเก็บลงไฟล์ด้วยก็ได้ (กรณีอยากดูย้อนหลัง)
        file_put_contents("group_id.log", $groupId . "\n", FILE_APPEND);
    } else {
        echo "This is not a group event.";
    }
} else {
    echo "No events received.";
}
