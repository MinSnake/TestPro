<?php

//$url = 'http://test.unify.login.ids111.com:1080/';

//account/basic_info


function check($nickname)
{
    if (!preg_match('/^[a-zA-Z0-9_\x{4e00}-\x{9fa5}]+$/u', $nickname)) {
        echo $nickname .  '  ============= 不匹配';
    }
    else
    {
        echo  $nickname .  '  ===================  ok';
    }

    echo '<br>';
}

check('');
check('123');
check('12ds3');
check('12d-s3');
check('123__');
check('__123__');
check('__123');
check('123!@#');
check('!@#%%^');
check('--123');
check('--123--');
check('123--');
check('汉字中文');
check('--汉字中文');
check('--汉字中文1123');
check('汉字中文1123');
check('汉字fsdf中文1123');
check('汉字fsdf中文1123#$%');
check('汉字fsdf中文112#$%3');
check('#$%#$汉字fsdf中文112#$%3');
check('#$%#$汉字fsdf中文1');
check('==中文1');
check('中=文1');
check('中文1=');










