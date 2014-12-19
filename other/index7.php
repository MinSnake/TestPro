<?php
$a = '[{"8hFx7p_ZO9Zg--er10dDHvK_RnCySN28r6yN7N2cVJs2Vv0fjrK4hiuAlFskRIFn":"http:\/\/res.playwx.com\/upload\/t4Jy1GE9HljUSM3.jpg"},{"-Ff50XFdX0rzUW8igxW1J9MAmlFautn7miZDCe6rN3dEO4Hv_KPina2ckCWdEuKu":"http:\/\/res.playwx.com\/upload\/gHwqNBdPzMU3JCq.jpg"}]';
$b = json_decode($a);

var_dump($b);

$bb = $b[1];

$bb['123'] = '123';

var_dump($b);
