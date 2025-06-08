<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "demoproject");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 1: Get customer coordinates
$customer_id = $_SESSION['user_id']; // Assume customer is logged in
$customer_query = "SELECT latitude, longitude FROM users WHERE id = $customer_id AND role = 'customer'";
$customer_result = mysqli_query($con, $customer_query);
$customer = mysqli_fetch_assoc($customer_result);

$customer_lat = $customer['latitude'];
$customer_lng = $customer['longitude'];

if (!$customer_lat || !$customer_lng) {
    die("Customer coordinates not found.");
}

// Step 2: Get all available technicians with coordinates
$tech_query = "SELECT id, name, latitude, longitude FROM users WHERE role = 'technician'";
$tech_result = mysqli_query($con, $tech_query);

$technicians = [];
$destinations = [];

while ($row = mysqli_fetch_assoc($tech_result)) {
    if ($row['latitude'] && $row['longitude']) {
        $technicians[] = $row;
        $destinations[] = $row['latitude'] . ',' . $row['longitude'];
    }
}

if (empty($technicians)) {
    die("No technicians found.");
}

// Step 3: Prepare API request
$origins = $customer_lat . ',' . $customer_lng;
$destinations_str = implode('|', $destinations);
$apiKey = "YOUR_GOOGLE_API_KEY";

$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origins&destinations=$destinations_str&key=$apiKey";

// Step 4: Call the API
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['status'] !== "OK") {
    die("Error fetching distance data.");
}

// Step 5: Collect distances and sort
$distances = [];

foreach ($data['rows'][0]['elements'] as $index => $element) {
    if ($element['status'] == 'OK') {
        $distance = $element['distance']['value']; // meters
        $technicians[$index]['distance'] = $distance;
        $distances[] = $technicians[$index];
    }
}

// Sort by distance
usort($distances, function ($a, $b) {
    return $a['distance'] <=> $b['distance'];
});

// Step 6: Output top 10 nearest technicians
$top_10 = array_slice($distances, 0, 10);
echo "<h3>Top 10 Nearest Technicians</h3>";
foreach ($top_10 as $tech) {
    echo "Name: " . $tech['name'] . " - Distance: " . round($tech['distance'] / 1000, 2) . " km<br>";
}
?>
