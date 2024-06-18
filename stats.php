<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Information</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
        }
        .pie-chart-container {
            width: 400px;
            height: 400px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Complaints Information</h2>

<?php
// Directory to scan
$complaintsFolderPath = 'complaints/';

// Read station details from station_details.txt
$stationDetailsFile = 'station_details.txt';
$stationDetails = file_get_contents($stationDetailsFile);
$currentStation = trim($stationDetails);

// Function to get all JSON files in a directory and its subdirectories
function getAllJsonFiles($dir) {
    $files = [];
    $items = scandir($dir);

    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        $path = $dir . '/' . $item;

        if (is_dir($path)) {
            // Recursively get JSON files from subdirectory
            $files = array_merge($files, getAllJsonFiles($path));
        } else {
            // Check if the file is a JSON file
            if (pathinfo($path, PATHINFO_EXTENSION) === 'json') {
                $files[] = $path;
            }
        }
    }

    return $files;
}

// Get all JSON files in the complaints folder and its subdirectories
$complaintFiles = getAllJsonFiles($complaintsFolderPath);

// Initialize status count array
$statusCount = [];

// Count occurrences of different status values
foreach ($complaintFiles as $file) {
    $fileContent = file_get_contents($file);
    $complaintData = json_decode($fileContent, true);

    // Check if JSON decoding was successful and the station matches
    if ($complaintData !== null && isset($complaintData['Status']) && isset($complaintData['PoliceStation']) && $complaintData['PoliceStation'] === $currentStation) {
        $status = $complaintData['Status'];
        if (isset($statusCount[$status])) {
            $statusCount[$status]++;
        } else {
            $statusCount[$status] = 1;
        }
    }
}
?>

<div class="pie-chart-container">
    <canvas id="pie-chart"></canvas>
</div>

<script>
    // Get status data for chart
    var statusData = <?php echo json_encode($statusCount); ?>;

    // Prepare data for chart
    var statusLabels = Object.keys(statusData);
    var statusCounts = Object.values(statusData);

    // Create pie chart
    var ctx = document.getElementById('pie-chart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusCounts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Status Distribution'
            }
        }
    });
</script>

</body>
</html>
