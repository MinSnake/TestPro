<?php

namespace Lib\App;
use Lib\Log\Log;

class BaseApp
{

    function __construct()
    {
        Log::log('被构造');

    }

    function __destruct()
    {
        Log::log('被析构');
    }

}