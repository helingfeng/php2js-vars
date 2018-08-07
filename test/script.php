<?php

require_once "../vendor/autoload.php";

$transfer = new \JavaScriptTransformer\JavaScriptTransformer();

$script = $transfer->put(['username'=>'Jon']);

echo $transfer->html($script);
