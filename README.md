# PHP-JavaScript-Transformer

将 `PHP` 变量输出为 `JavaScript` 变量声明脚本 扩展包

## Usage

```
composer require helingfeng/php-javascript-transformer
```


### Laravel

```php

app('js.transformer')->put(['username' => 'helingfeng']);
#window.username = 'helingfeng';

app('js.transformer')->setNamespace('profile')->put(['username' => 'helingfeng']);
# window.profile = window.profile || {};profile.username = 'helingfeng';

app('js.transformer')->includeScript()->put(['username' => 'helingfeng']);
# <script>
#    window.username = 'helingfeng';
#</script>
```



### 其他

- 字符串 String

```
$transfer = new JavaScriptTransformer();

$script = $transfer->put(['username'=>'helingfeng']);

echo $script;



# output

window.username = 'helingfeng';


```

- 数组 Array

```
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

