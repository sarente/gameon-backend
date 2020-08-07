<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Str;

class Language
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // TODO: "tr-TR,tr;q=0.8,en-US;q=0.6,en;q=0.4"
        $language = $request->header('Accept-Language');
        view()->share('locales', \App\Models\Language::locales());

        $this->setLanguage($language);

        return $next($request);
    }

    public function setLanguage($language)
    {
        $language = substr($language, 0, 2);
        $locales = \App\Models\Language::locales();

        $currentLocale = !empty($language) ? $language : Setting::DEFAULT_LANGUAGE;
        foreach ($locales as $locale) {
            if (Str::startsWith($locale, $language)) {
                $currentLocale = $locale;
                break;
            }
        }
        //Set application default language  with request
        app()->setLocale($currentLocale);
        Carbon::setLocale($currentLocale);
    }
}
