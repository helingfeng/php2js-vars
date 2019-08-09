# PHP-JavaScript-Transformer

将 `PHP` 变量输出为 `JavaScript` 变量声明定义脚本 扩展包

## Usage

```
composer require helingfeng/php-javascript-transformer
```


### Laravel5.5 框架

直接使用容器构建：

```php

// 包含特殊字符输出
app('js.transformer')->put(['username' => "'helingfeng"]);
# window.username = '\'helingfeng';

// 修改 namespace 输出
app('js.transformer')->setNamespace('profile')->put(['username' => 'helingfeng']);
# window.profile = window.profile || {};profile.username = 'helingfeng';

// 输出包含 script 标签
app('js.transformer')->includeScript()->put(['username' => 'helingfeng']);
# <script>
#    window.username = 'helingfeng';
#</script>
```

模板中使用 `{!!  !!}` 非转义输出

### 其他方式

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

