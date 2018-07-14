# PHP-JavaScript-Transformer
将PHP变量转换成JavaScript变量扩展包

## Usage


### PHP变量转换JavaScript

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

