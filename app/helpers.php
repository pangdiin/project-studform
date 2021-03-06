<?php

/**
 * Global helpers file with misc functions.
 */
if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

/**
 * Global helpers file with misc functions.
 */
if (! function_exists('company_name')) {
    /**
     * Helper to grab the application company name.
     *
     * @return mixed
     */
    function company_name()
    {
        return config('app.company.name');
    }
}

/**
 * Global helpers file with misc functions.
 */
if (! function_exists('company_link')) {
    /**
     * Helper to grab the company link.
     *
     * @return mixed
     */
    function company_link()
    {
        return config('app.company.link');
    }
}

if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access()
    {
        return app('access');
    }
}


if (! function_exists('setting')) {
    /**
     * setting (lol) the setting:: facade as a simple function.
     */
    function setting()
    {
        return app('setting');
    }
}


if (! function_exists('menu')) {
    /**
     * menu (lol) the menu:: facade as a simple function.
     */
    function menu()
    {
        return app('menu');
    }
}

if (! function_exists('block')) {
    /**
     * block (lol) the block:: facade as a simple function.
     */
    function block()
    {
        return app('block');
    }
}


if (! function_exists('history')) {
    /**
     * Access the history facade anywhere.
     */
    function history()
    {
        return app('history');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('includeRouteFiles')) {

    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        $directory = $folder;
        $handle = opendir($directory);
        $directory_list = [$directory];

        while (false !== ($filename = readdir($handle))) {
            if ($filename != '.' && $filename != '..' && is_dir($directory.$filename)) {
                array_push($directory_list, $directory.$filename.'/');
            }
        }

        foreach ($directory_list as $directory) {
            foreach (glob($directory.'*.php') as $filename) {
                require $filename;
            }
        }
    }
}

if (! function_exists('getRtlCss')) {

    /**
     * The path being passed is generated by Laravel Mix manifest file
     * The webpack plugin takes the css filenames and appends rtl before the .css extension
     * So we take the original and place that in and send back the path.
     *
     * @param $path
     *
     * @return string
     */
    function getRtlCss($path)
    {
        $path = explode('/', $path);
        $filename = end($path);
        array_pop($path);
        $filename = rtrim($filename, '.css');

        return implode('/', $path).'/'.$filename.'.rtl.css';
    }
}

if (! function_exists('pageLinks')) {

    function pageLinks()
    {
        return \App\Models\Page::where('priority', '<', 3)->orWhereNull('priority')->select(['title', 'slug', 'id'])->get();
    }
}



if (!function_exists('now')) {
    /**
     * @param string|array $messages
     * @param bool $error
     * @param int $responseCode
     * @param array $data
     * @return array
     */
    function now()
    {
        return \Carbon\Carbon::now();
    }
}


if (!function_exists('carbon')) {
    /**
     * @param string|array $messages
     * @param bool $error
     * @param int $responseCode
     * @param array $data
     * @return array
     */
    function carbon($date)
    {
        return \Carbon\Carbon::parse($date);
    }
}


if(! function_exists('decimal')){

    function decimal($number, $format=4)
    {
        return number_format($number, $format, '.', '');
    }

}

if(! function_exists('desc_limit')){

    function desc_limit($description, $limit=180)
    {
        return str_limit(strip_tags($description), $limit, $end = "...");
    }

}

if(! function_exists('ccMask')){

    function ccMask($number, $maskingCharacter = '*')
    {
        return substr($number, 0, 4) . str_repeat($maskingCharacter, strlen($number) - 8) . substr($number, -4);
    }
}


if(! function_exists('gallerySeeder')) {
    function gallerySeeder($model, $collection)
    {
        return $collection->each(function($item, $index)  use ($model){
             $model->galleries()->create([
                'path'  => $item['path'],
            ]);
        });
    }
}