<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

function isVendor()
{
    return auth()->user()->getRoleNames()->first() == 'vendor';
}

function isAdmin()
{
    return auth()->user()->getRoleNames()->first() == 'super_admin';
}

function getNamePart($name, $part = 'first_name')
{
    $parts = explode(' ', $name);

    if (count($parts) > 1) {
        $firstname = $parts[0];
        unset($parts[0]);
        $lastname = implode(' ', $parts);
    } else {
        $firstname = $name;
        $lastname = null;
    }

    return $part == 'first_name' ? $firstname : $lastname;
}

function getUserInitials(string $fullName)
{
    $words = explode(' ', $fullName);
    return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
}

function getNoImage()
{
    return asset('images/no-image.jpg');
}

function formatDateTime(string $datetime, $isTime = true)
{
    if ($isTime) return \Carbon\Carbon::parse($datetime)->format('d M, Y H:i A');
    return \Carbon\Carbon::parse($datetime)->format('d M, Y');
}

function datepicker($date)
{
    return \Carbon\Carbon::parse($date)->format('d-M-Y');
}

function dbdate($date)
{
    return \Carbon\Carbon::parse($date)->format('Y-m-d');
}

function getUserStatusBadge(string $status)
{
    $class = 'secondary';

    if ($status == 'pending') $class = 'warning';
    if ($status == 'active') $class = 'success';
    if ($status == 'inactive') $class = 'primary';
    if ($status == 'suspended') $class = 'danger';
    if ($status == 'completed') $class = 'success';
    if ($status == 'Available') $class = 'success';
    if ($status ==  'Not Available') $class = 'danger';

    $status = ucwords(str_replace('_', ' ', $status));

    return "<span class='badge badge-dot badge-{$class}'>{$status}</span>";
}

function getDiscountStatusBadge(string $type)
{
    $class = 'secondary';

    if ($type == 'percent') $class = 'primary';
    if ($type == 'fixed_amount') $class = 'success';

    $type = ucwords(str_replace('_', ' ', $type));
    $type = Str::ucfirst($type);

    return "<span class='badge badge-dot badge-{$class}'>{$type}</span>";
}

function getNotificationStatusBadge(string $status)
{
    $class = 'secondary';

    if ($status == 'pending') $class = 'warning';
    if ($status == 'sent') $class = 'success';

    $status = ucwords(str_replace('_', ' ', $status));

    return "<span class='badge badge-{$class}'>{$status}</span>";
}

function addEllipsis($text, $max = 20)
{
    return strlen($text) > $max ? mb_substr($text, 0, $max, 'UTF-8') . '...' : $text;
}

function canEmpty($value)
{
    return empty($value) ? '<small><i>Unavailable</i></small>' : $value;
}

function getFileNameFromInput($file, $extension = null)
{
    $extension = !empty($extension) ? $extension : $file->getClientOriginalExtension();
    return sprintf('%s_%s.%s', Illuminate\Support\Str::uuid(), time(), $extension);
}

function getFileNameFromUrl($url)
{
    if (empty($url) || !is_string($url)) return $url;

    $parts = explode('/', $url);

    return $parts[array_key_last($parts)];
}

function getUuid()
{
    return bin2hex(random_bytes(5));
}

function getQRCode()
{
    return bin2hex(random_bytes(16));
}

function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}

function uploadPublicFile($file, $directory, $oldFile = null)
{
    if (!empty($oldFile) && Storage::disk('public')->exists($oldFile)) {
        Storage::disk('public')->delete($oldFile);
    }

    if (!Storage::exists($directory)) Storage::makeDirectory($directory);

    return Storage::disk('public')->putFileAs(
        $directory,
        $file,
        getFileNameFromInput($file)
    );
}

function uploadPublicImage($file, $directory, string $oldImage = null, $size = 285)
{
    if (!empty($oldImage)) {
        // remove original image
        if (Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        // remove thumbnail as well
        if (Storage::disk('public')->exists('thumbnails/' . $oldImage)) {
            Storage::disk('public')->delete('thumbnails/' . $oldImage);
        }
    }

    $isThumbnail = strpos($directory, 'thumbnails') !== false;

    $img = Intervention\Image\Facades\Image::make($file)->encode(
        'png',
        $isThumbnail ? 40 : 85
    );

    if ($isThumbnail) {
        $img->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }

    $fileName = getFileNameFromInput($file, 'png');
    $path = "$directory/$fileName";

    Storage::disk('public')->put(
        $path,
        $img->stream()->detach(),
        'public'
    );

    return $path;
}

function isEmail(string $input)
{
    if (empty($input)) return false;

    return filter_var($input, FILTER_VALIDATE_EMAIL);
}

function pathToUrl($path)
{
    if (empty($path) || $path == '/') return null;
    if (strpos($path, 'http') !== false) return $path;
    if (strpos($path, 'examples') !== false) return url($path);

    return url('storage/' . $path);
}

function getRandomColorClass()
{
    $classes = ['bg-warning', 'bg-info', 'bg-danger', 'bg-blue', 'bg-pink', 'bg-indigo', 'bg-secondary', 'bg-purple'];
    return $classes[mt_rand(0, count($classes) - 1)];
}

function humanTime($time)
{
    return \Carbon\Carbon::parse($time)->diffForHumans();
}

function getModelFromPath($model)
{
    $exploded = explode('\\', $model);
    if (is_array($exploded) && !empty($exploded)) return end($exploded);

    return $model;
}

function prettifyRole($role)
{
    if ($role == 'super_admin') return 'Administrator';
    if ($role == 'vendor') return 'Vendor';
    if ($role == 'customer') return 'Customer';

    return 'Unknown';
}

function firstThreeLetter($name)
{
    $threeLetter = substr($name, 0, 3);
    $capital = strtoupper($threeLetter);

    return $capital;
}

function currency($number, $withSymbol = true)
{
    $number = number_format((float)$number, 2, '.', '');

    return $withSymbol ? env('CURRENCY').' '. $number : $number;
}
