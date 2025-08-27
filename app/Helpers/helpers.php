<?php

function active_class($path, $active = 'active') {
    return request()->is(...(array)$path) ? $active : '';
}

function is_active_route($path) {
    return request()->is(...(array)$path) ? 'true' : 'false';
}

function show_class($path) {
    return request()->is(...(array)$path) ? 'show' : '';
}

function generateOtpCode($length = 6): int
{
    $min = pow(10, $length - 1);
    $max = pow(10, $length) - 1;

    return random_int($min, $max);
}

function formatDate($date, string $format = 'd-M-Y H:i:s'): string
{
    return \Illuminate\Support\Carbon::parse($date)->format($format);
}
