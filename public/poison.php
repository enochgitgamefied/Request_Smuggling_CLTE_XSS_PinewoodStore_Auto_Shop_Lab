<?php
header("X-Poisoned: success");
echo "SMUGGLED RESPONSE!";
file_put_contents('/app/poison.log', "Poisoned at ".date('Y-m-d H:i:s')."\n", FILE_APPEND);
?>