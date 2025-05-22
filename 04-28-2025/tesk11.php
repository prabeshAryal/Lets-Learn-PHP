<?php
function generateUUIDFromInt($int) {
    $hex = str_pad(dechex($int), 8, '0', STR_PAD_LEFT);
    return sprintf('%s-%s-%s-%s-%s',
        substr($hex, 0, 8),
        substr($hex, 8, 4),
        '4000', // Version 4
        substr($hex, 12, 4),
        substr($hex, 16, 12)
    );
}

// Example usage
$integerId = 3412423423423;
$uuid = generateUUIDFromInt($integerId);
echo "UUID: " . $uuid;
?>