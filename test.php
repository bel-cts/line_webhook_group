<?php
file_put_contents("group_id.log", "Test Write: " . date("Y-m-d H:i:s") . "\n", FILE_APPEND);
echo "Test Write OK";
