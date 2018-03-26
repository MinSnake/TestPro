<?php
require_once 'Parsedown.php';
$Parsedown = new Parsedown();
$Parsedown->setMarkupEscaped(true);
$content = 
'##123
#4444
<input type="text">		
<input type="submit">			
```php
<?php echo "123"; ?>
```			
```html
<div>
123123		
</div>				
```		
| header 1 | header 2 |
| -------- | -------- |
| cell 1.1 | cell 1.2 |
| cell 2.1 | cell 2.2 |
    
![Alt text](http://s0.hao123img.com/res/img/logo/logonew1.png "123")
Use the `printf()` function.';

$new_content = $Parsedown->text($content);

$str=strip_tags($new_content);
// echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"local.css\" />";
// echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"reset.css\" />";
echo $new_content; 