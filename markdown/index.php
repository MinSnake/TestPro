<?php
require_once 'Parsedown.php';
$Parsedown = new Parsedown();

$content = 
'##123
#4444
```php
<?php echo "123"; ?>
```			
```html
<div>
123123		
</div>				
```		
![Alt text](http://s0.hao123img.com/res/img/logo/logonew1.png "123")
Use the `printf()` function.';

$new_content = $Parsedown->text($content);

$str=strip_tags($new_content);

echo $new_content; 