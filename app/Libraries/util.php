<?php
function contents_path($path = '')
{
    return config('app.contents_path').($path ? DIRECTORY_SEPARATOR.$path : $path);
}
