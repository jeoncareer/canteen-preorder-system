<?php


function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function redirect($path)
{

    header("Location:" . ROOT . $path);
}

function convertTime($time)
{

    return date("g:i A", strtotime($time));
}

function timeAgoOrDate($datetime, $full = false, $threshold = '1 month')
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    // Check if difference is greater than threshold
    $thresholdDate = (new DateTime)->sub(DateInterval::createFromDateString($threshold));
    if ($ago < $thresholdDate) {
        // Show real date
        return $ago->format('j F Y, g:i A'); // e.g. "2 January 2025"
    }

    // Manually calculate weeks
    $weeks = floor($diff->days / 7);
    $days  = $diff->days - ($weeks * 7);

    $string = [
        'y' => $diff->y ? $diff->y . ' year' . ($diff->y > 1 ? 's' : '') : null,
        'm' => $diff->m ? $diff->m . ' month' . ($diff->m > 1 ? 's' : '') : null,
        'w' => $weeks ? $weeks . ' week' . ($weeks > 1 ? 's' : '') : null,
        'd' => $days ? $days . ' day' . ($days > 1 ? 's' : '') : null,
        'h' => $diff->h ? $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') : null,
        'i' => $diff->i ? $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') : null,
        's' => $diff->s ? $diff->s . ' second' . ($diff->s > 1 ? 's' : '') : null,
    ];

    // Remove null values
    $string = array_filter($string);

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }

    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function isValidPhoneNumber($phone)
{
    // Check if it's exactly 10 digits and contains only numbers
    return preg_match('/^\d{10}$/', $phone) === 1;
}

function isValidEmail($email)
{
    // Use PHP's built-in filter
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function formatLabel($string)
{
    // Replace underscores with spaces
    $string = str_replace('_', ' ', $string);
    // Capitalize each word
    return ucwords($string);
}

function getInitials($name)
{
    // Split the string by spaces, underscores, or hyphens
    $parts = preg_split('/[\s_-]+/', trim($name));

    // Filter out empty values
    $parts = array_filter($parts);

    // Take the first character of each part, uppercase it, and join
    $initials = '';
    foreach ($parts as $word) {
        $initials .= strtoupper($word[0]);
    }

    return $initials;
}
