<!-- Write a PHP script that calculates how many kilometers a person has walked based on their step count. Create variables for user's name, number of steps walked and average step length in meters (assume 0.8 meters per step). Write a function to convert the total distance to kilometers. Print a personalized message including the result. -->

<?php
// Variables
$userName = "John";
$stepsWalked = 10000;
$averageStepLength = 0.8; // in meters

// Function to convert meters to kilometers
function convertToKilometers($meters) {
    return $meters / 1000;
}

// Calculate total distance in meters
$totalDistance = $stepsWalked * $averageStepLength;

// Convert to kilometers
$totalDistanceInKm = convertToKilometers($totalDistance);

// Print personalized message
echo "Hello $userName, you have walked approximately " . round($totalDistanceInKm, 2) . " kilometers.";
?>  