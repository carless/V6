<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Optional;
use Illuminate\Support\Collection;


if (!function_exists('cesi_authentication_column')) {
    /**
     * Return the username column name.
     * The Laravel default (and Cesi default) is 'email'.
     *
     * @return string
     */
    function cesi_authentication_column()
    {
        return config('cesi.core.authentication_column', 'email');
    }
}

if (!function_exists('cesi_users_have_email')) {
    /**
     * Check if the email column is present on the user table.
     *
     * @return string
     */
    function cesi_users_have_email()
    {
        $user_model_fqn = config('cesi.core.user_model_fqn');
        $user = new $user_model_fqn();

        return \Schema::hasColumn($user->getTable(), 'email');
    }
}

if (!function_exists('cesi_url')) {
    /**
     * Appends the configured cesi prefix and returns
     * the URL using the standard Laravel helpers.
     *
     * @param $path
     *
     * @return string
     */
    function cesi_url($path = null, $parameters = [], $secure = null)
    {
        $path = !$path || (substr($path, 0, 1) == '/') ? $path : '/'.$path;

        return url(config('cesi.core.route_prefix', 'admin').$path, $parameters = [], $secure = null);
    }
}

if (!function_exists('cesi_middleware')) {
    /**
     * Return the key of the middleware used across Cesi.
     * That middleware checks if the visitor is an admin.
     *
     * @param $path
     *
     * @return string
     */
    function cesi_middleware()
    {
        return config('cesi.core.middleware_key', 'admin');
    }
}

if (!function_exists('cesi_guard_name')) {
    /*
     * Returns the name of the guard defined
     * by the application config
     */
    function cesi_guard_name()
    {
        return config('cesi.core.guard', config('auth.defaults.guard'));
    }
}

if (!function_exists('cesi_auth')) {
    /*
     * Returns the user instance if it exists
     * of the currently authenticated admin
     * based off the defined guard.
     */
    function cesi_auth()
    {
        return \Auth::guard(cesi_guard_name());
    }
}

if (!function_exists('cesi_user')) {
    /*
     * Returns back a user instance without
     * the admin guard, however allows you
     * to pass in a custom guard if you like.
     */
    function cesi_user()
    {
        $tmpUser = cesi_auth()->user();
        $cesiUser = Cesi\Core\app\Models\CesiUser::find($tmpUser->id);
        // return cesi_auth()->user();
        return $cesiUser;
    }
}

if (!function_exists('includeRouteFiles')) {

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

if (!function_exists('mb_ucfirst')) {
    /**
     * Capitalize the first letter of a string,
     * even if that string is multi-byte (non-latin alphabet).
     *
     * @param string   $string   String to have its first letter capitalized.
     * @param encoding $encoding Character encoding
     *
     * @return string String with first letter capitalized.
     */
    function mb_ucfirst($string, $encoding = false)
    {
        $encoding = $encoding ? $encoding : mb_internal_encoding();

        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);

        return mb_strtoupper($firstChar, $encoding).$then;
    }
}

if (! function_exists('str_random')) {
    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @param  int  $length
     * @return string
     *
     * @throws \RuntimeException
     */
    function str_random($length = 16)
    {
        return Str::random($length);
    }
}

if (! function_exists('collect')) {
    /**
     * Create a collection from the given value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Support\Collection
     */
    function collect($value = null)
    {
        return new Collection($value);
    }
}


if (! function_exists('array_add')) {
    /**
     * Add an element to an array using "dot" notation if it doesn't exist.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $value
     * @return array
     *
     * @deprecated Arr::add() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_add($array, $key, $value)
    {
        return Arr::add($array, $key, $value);
    }
}

if (! function_exists('array_collapse')) {
    /**
     * Collapse an array of arrays into a single array.
     *
     * @param  array  $array
     * @return array
     *
     * @deprecated Arr::collapse() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_collapse($array)
    {
        return Arr::collapse($array);
    }
}

if (! function_exists('array_divide')) {
    /**
     * Divide an array into two arrays. One with keys and the other with values.
     *
     * @param  array  $array
     * @return array
     *
     * @deprecated Arr::divide() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_divide($array)
    {
        return Arr::divide($array);
    }
}

if (! function_exists('array_dot')) {
    /**
     * Flatten a multi-dimensional associative array with dots.
     *
     * @param  array   $array
     * @param  string  $prepend
     * @return array
     *
     * @deprecated Arr::dot() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_dot($array, $prepend = '')
    {
        return Arr::dot($array, $prepend);
    }
}

if (! function_exists('array_except')) {
    /**
     * Get all of the given array except for a specified array of keys.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     *
     * @deprecated Arr::except() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_except($array, $keys)
    {
        return Arr::except($array, $keys);
    }
}

if (! function_exists('array_first')) {
    /**
     * Return the first element in an array passing a given truth test.
     *
     * @param  array  $array
     * @param  callable|null  $callback
     * @param  mixed  $default
     * @return mixed
     *
     * @deprecated Arr::first() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_first($array, callable $callback = null, $default = null)
    {
        return Arr::first($array, $callback, $default);
    }
}

if (! function_exists('array_flatten')) {
    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param  array  $array
     * @param  int  $depth
     * @return array
     *
     * @deprecated Arr::flatten() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_flatten($array, $depth = INF)
    {
        return Arr::flatten($array, $depth);
    }
}

if (! function_exists('array_forget')) {
    /**
     * Remove one or many array items from a given array using "dot" notation.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return void
     *
     * @deprecated Arr::forget() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_forget(&$array, $keys)
    {
        Arr::forget($array, $keys);
    }
}

if (! function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  \ArrayAccess|array  $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     *
     * @deprecated Arr::get() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_get($array, $key, $default = null)
    {
        return Arr::get($array, $key, $default);
    }
}

if (! function_exists('array_has')) {
    /**
     * Check if an item or items exist in an array using "dot" notation.
     *
     * @param  \ArrayAccess|array  $array
     * @param  string|array  $keys
     * @return bool
     *
     * @deprecated Arr::has() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_has($array, $keys)
    {
        return Arr::has($array, $keys);
    }
}

if (! function_exists('array_last')) {
    /**
     * Return the last element in an array passing a given truth test.
     *
     * @param  array  $array
     * @param  callable|null  $callback
     * @param  mixed  $default
     * @return mixed
     *
     * @deprecated Arr::last() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_last($array, callable $callback = null, $default = null)
    {
        return Arr::last($array, $callback, $default);
    }
}

if (! function_exists('array_only')) {
    /**
     * Get a subset of the items from the given array.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     *
     * @deprecated Arr::only() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_only($array, $keys)
    {
        return Arr::only($array, $keys);
    }
}

if (! function_exists('array_pluck')) {
    /**
     * Pluck an array of values from an array.
     *
     * @param  array   $array
     * @param  string|array  $value
     * @param  string|array|null  $key
     * @return array
     *
     * @deprecated Arr::pluck() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_pluck($array, $value, $key = null)
    {
        return Arr::pluck($array, $value, $key);
    }
}

if (! function_exists('array_prepend')) {
    /**
     * Push an item onto the beginning of an array.
     *
     * @param  array  $array
     * @param  mixed  $value
     * @param  mixed  $key
     * @return array
     *
     * @deprecated Arr::prepend() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_prepend($array, $value, $key = null)
    {
        return Arr::prepend($array, $value, $key);
    }
}

if (! function_exists('array_pull')) {
    /**
     * Get a value from the array, and remove it.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     *
     * @deprecated Arr::pull() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_pull(&$array, $key, $default = null)
    {
        return Arr::pull($array, $key, $default);
    }
}

if (! function_exists('array_random')) {
    /**
     * Get a random value from an array.
     *
     * @param  array  $array
     * @param  int|null  $num
     * @return mixed
     *
     * @deprecated Arr::random() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_random($array, $num = null)
    {
        return Arr::random($array, $num);
    }
}

if (! function_exists('array_set')) {
    /**
     * Set an array item to a given value using "dot" notation.
     *
     * If no key is given to the method, the entire array will be replaced.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $value
     * @return array
     *
     * @deprecated Arr::set() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_set(&$array, $key, $value)
    {
        return Arr::set($array, $key, $value);
    }
}

if (! function_exists('array_sort')) {
    /**
     * Sort the array by the given callback or attribute name.
     *
     * @param  array  $array
     * @param  callable|string|null  $callback
     * @return array
     *
     * @deprecated Arr::sort() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_sort($array, $callback = null)
    {
        return Arr::sort($array, $callback);
    }
}

if (! function_exists('array_sort_recursive')) {
    /**
     * Recursively sort an array by keys and values.
     *
     * @param  array  $array
     * @return array
     *
     * @deprecated Arr::sortRecursive() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_sort_recursive($array)
    {
        return Arr::sortRecursive($array);
    }
}

if (! function_exists('array_where')) {
    /**
     * Filter the array using the given callback.
     *
     * @param  array  $array
     * @param  callable  $callback
     * @return array
     *
     * @deprecated Arr::where() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_where($array, callable $callback)
    {
        return Arr::where($array, $callback);
    }
}

if (! function_exists('array_wrap')) {
    /**
     * If the given value is not an array, wrap it in one.
     *
     * @param  mixed  $value
     * @return array
     *
     * @deprecated Arr::wrap() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function array_wrap($value)
    {
        return Arr::wrap($value);
    }
}

if (! function_exists('str_slug')) {
    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param  string  $title
     * @param  string  $separator
     * @param  string  $language
     * @return string
     *
     * @deprecated Str::slug() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function str_slug($title, $separator = '-', $language = 'en')
    {
        return Str::slug($title, $separator, $language);
    }
}

if (! function_exists('str_limit')) {
    /**
     * Limit the number of characters in a string.
     *
     * @param  string  $value
     * @param  int     $limit
     * @param  string  $end
     * @return string
     *
     * @deprecated Str::limit() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }
}

if (! function_exists('square_brackets_to_dots')) {
    /**
     * Turns a string from bracket-type array to dot-notation array.
     * Ex: array[0][property] turns into array.0.property.
     *
     * @param $path
     *
     * @return string
     */
    function square_brackets_to_dots($string)
    {
        $string = str_replace(['[', ']'], ['.', ''], $string);

        return $string;
    }
}