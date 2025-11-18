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


// Function 1: Get formatted time
function formatTime($datetime)
{
    $time = date('g:i A', strtotime($datetime)); // 12-hour format with AM/PM
    return $time;
}

// Function 2: Get human-readable date
function formatDate($datetime)
{
    $date = strtotime($datetime);
    $today = strtotime('today');
    $yesterday = strtotime('yesterday');

    if (date('Y-m-d', $date) === date('Y-m-d', $today)) {
        return "Today";
    } elseif (date('Y-m-d', $date) === date('Y-m-d', $yesterday)) {
        return "Yesterday";
    } else {
        return date('F j', $date); // Example: September 3
    }
}

function isCurrentTimeBefore($time) {
    $now = date("H:i:s");
    return strtotime($now) < strtotime($time);
}

function isCurrentTimeAfter($time) {
    $now = date("H:i:s");
    return strtotime($now) > strtotime($time);
}

function isCurrentTimeBetween($start, $end) {
    $now = strtotime(date("H:i:s"));
    $startTime = strtotime($start);
    $endTime = strtotime($end);

    // Case 1: normal range (e.g., 08:00 to 17:00)
    if ($startTime < $endTime) {
        return ($now >= $startTime && $now <= $endTime);
    }

    // Case 2: range crossing midnight (e.g., 22:00 to 04:00)
    return ($now >= $startTime || $now <= $endTime);
}


function formatDaysArray($days) {
    return json_encode(array_values($days));
}

function validateEmail($email) {
    // First, check if the email is properly formatted
    

    // Extract the domain part
    $domain = strtolower(substr(strrchr($email, "@"), 1));

    // List of allowed/known domains
    $validDomains = [
        'gmail.com',
        'yahoo.com',
        'hotmail.com',
        'outlook.com',
        'icloud.com',
        'edu.com', // add any other domains you want to allow
    ];

    // Check if domain is in the allowed list
    if (!in_array($domain, $validDomains)) {
        return false; // Invalid domain
    }

    return true; // Email is valid
}

