<?php

namespace App;

use App;
use Config;

class Locale
{
    public static  function lang()
    {
        $language = App::getLocale();
        $languages = Config::get('app.locales');
        $language = $languages[$language];
        $language = $language['name'];
        return $language;
    }
}

