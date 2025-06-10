<?php // Code within app\Helpers\Helper.php

use Illuminate\Support\Facades\Storage;
use Nette\Utils\Random;

if (!function_exists('storage_url')) {
    function storage_url($path)
    {
        $url = Storage::url($path);
        return $url;
    }
}
