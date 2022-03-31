<?php

namespace SerefErcelik\PostaGuvercini\Facades;

use Illuminate\Support\Facades\Facade;

class PostaGuvercini extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'postaguvercini';
    }
}