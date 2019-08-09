<?php

require_once "../vendor/autoload.php";

$transfer = new \JavaScriptTransformer\JavaScriptTransformer();

$script = $transfer->includeScript()->put(['username'=>'helingfeng']);

echo $script;
