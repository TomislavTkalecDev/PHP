<?php 
require 'vendor/autoload.php';

use Carbon\Carbon;


// Carbon Example 
$newYear = Carbon::create(2026, 1, 1, 00, 00, 00);
$nowDate = Carbon::now(); 

echo $newYear->diffForHumans($nowDate);

if ($newYear->isSunday() || $newYear->isSaturday()) {
    echo 'Day is weekend.';
    exit;
} else {
    echo 'Day is not weekend.';
    exit;
}


exit;
// DateTime Example 
// $christmasDate = new DateTime('2025-12-25 12:00:00');
// $nowDate = new DateTime();

// $day = $christmasDate->format('l');

// $diff = $christmasDate->diff($nowDate);

// $christmasDate->setTimezone(new DateTimeZone('America/New_York'));
// echo $christmasDate->format('Y-m-d H:i:s T'); // 2025-11-11 08:45:00 EST

// if ($day == 'Sunday' || $day == 'Saturday') {
//     echo $diff->days . ' to ' . $christmasDate->format('d.m.Y') . ' ,Day is weekend.';
//     exit;
// }else{
//     echo $diff->days . ' to ' .  $christmasDate->format('d.m.Y') . ' ,Day is not weekend.';
//     exit;
// }

