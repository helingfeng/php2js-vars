# PHP-JavaScript-Transformer
将PHP变量转换成JavaScript变量扩展包

## Installation

配置追加composer.json文件

```
 "repositories": [
    {
      "type": "git",
      "url": "https://github.com/helingfeng/PHP-JavaScript-Transformer.git"
    }
  ]
```

执行 require

```
composer require helingfeng/php-java-script-transformer 1.0

## 成功输出
./composer.json has been updated
Loading composer repositories with package information                                                                          Updating dependencies (including require-dev)         Package operations: 1 install, 0 updates, 0 removals
  - Installing helingfeng/php-java-script-transformer (1.0): Cloning c88a2cc375 from cache
Writing lock file
Generating autoload files

```

## Usage


### PHP变量转换JavaScript

- 字符串 String

```
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use JavaScriptTransformer\JavaScriptTransformer;

$transfer = new JavaScriptTransformer();

$script = $transfer->put(['username'=>'helingfeng']);

echo $script;



# output

window.username = 'helingfeng';


```

- 数组 Array

```
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use JavaScriptTransformer\JavaScriptTransformer;

$transfer = new JavaScriptTransformer();

$script = $transfer->put(['person'=>['name'=>'helingfeng','age'=>18]]);

echo $script;


# output 

window.person = {"name":"helingfeng","age":18};

```

### 使用不同的作用域，默认window

```
$transfer = new JavaScriptTransformer('home');

$script = $transfer->put(['person'=>['name'=>'helingfeng','age'=>18]]);

echo $script;

# output 

window.home = window.home || {};home.person = {"name":"helingfeng","age":18};

```

## Thanks

TIM

