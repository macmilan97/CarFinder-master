<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Request;
use App;
use Illuminate\Support\Facades\Session;
use Exception;

class LocaleServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->set(true);
    }

    protected function set($ael = false)
    {
        $locale = Config::get('app.locale');
        $locale_default = Config::get('app.fallback_locale');
        $locales_config = Config::get('app.locales');
        if (!$locales_config) {
            throw new Exception("You must specify locales array in project_root/config/app.php as shown: 'locales' => [
              'ru' => ['title' => 'ru', 'prefix'=>'ru', 'db_prefix' => 'ru_', 'locale' => 'ru_RU.utf8', 'icon' => '/img/locals/ru.png'],
              'en' => ['title' => 'en', 'prefix'=>'en', 'db_prefix' => 'en_', 'locale' => 'en_EN.utf8', 'icon' => '/img/locals/en.png'],
              'kg' => ['title' => 'kg', 'prefix'=>'kg', 'db_prefix' => 'kg_', 'locale' => 'ky_KG.utf8', 'icon' => '/img/locals/kg.png'],
            ]");
        }
        if (!isset($locales_config[$locale_default])):
            throw new Exception('Your config.locales array must contain config.fallback_locale in project_root/config/app.php');
        endif;
        $locales = array_keys($locales_config);
        $locale_in_url = Request::segment(1);
        if (in_array($locale_in_url, $locales)):
            $locale = $locale_in_url;
            App::setLocale($locale);
            Session::put('locale', $locale);
            $locale_to_route = $locale;
        else:
            $locale = $locale_default;
            App::setLocale($locale);
            Session::put('locale', $locale);
            $locale_to_route = $ael ? '' : $locale;
        endif;

        Config::set('route_prefix', $locale_to_route);
    }
}
