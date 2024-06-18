<?php
// Check if the file parameter is set in the URL
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Read the content of the file
    $fileContent = file_get_contents($file);

    
    $complaintData = json_decode($fileContent, true);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the new status from the form
        $newStatus = $_POST['new_status'] ?? '';

        // Update the status in the array
        $complaintData['Status'] = $newStatus;

        // Convert the array back to JSON
        $newFileContent = json_encode($complaintData);

        // Write the updated content back to the file
        file_put_contents($file, $newFileContent);

        echo "Status updated successfully.";
    }

    // Display the content in a table
    echo "<h2>File: $file</h2>";
    echo "<table>";
    foreach ($complaintData as $columnName => $columnValue) {
        echo "<tr>";
        echo "<th>$columnName</th>";
        echo "<td>$columnValue</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Add a button to change the status
    echo "<button onclick=\"changeStatus('$file', '{$complaintData['Status']}')\">Change Status</button>";

    // JavaScript function to handle the status change
    echo "<script>
            function changeStatus(file, currentStatus) {
                var newStatus = prompt('Enter the new status (open/closed):', currentStatus);

                if (newStatus !== null && newStatus !== '') {
                    // Create a form and append necessary values
                    var form = document.createElement('form');
                    form.method = 'post';
                    form.action = '';

                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'new_status';
                    input.value = newStatus;

                    form.appendChild(input);
                    document.body.appendChild(form);

                    // Submit the form
                    form.submit();
                }
            }
          </script>";
} else {
    echo "<p>No file selected.</p>";
}
?>
