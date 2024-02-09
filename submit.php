<?php
// This is your server-side script (e.g., submit.php)

// Get form data from the POST request
$data = array(
    "entry.1945349790" => $_POST['entry_1'],
    // Add more form fields as needed
);

// URL of the Google Forms endpoint
$googleFormsUrl = "https://docs.google.com/forms/d/e/1FAIpQLSfzkY2p1bgssE3W3tZXgFVZjd5hTfD5B1msKSlLG4W7m_W1og/formResponse";

// Send data to Google Forms
$response = submitToGoogleForms($googleFormsUrl, $data);

// Handle response from Google Forms
if ($response === true) {
    echo "Form submitted successfully!";
} else {
    echo "Error submitting form: " . $response;
}

// Function to submit data to Google Forms using cURL
function submitToGoogleForms($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode >= 200 && $httpCode < 300) {
        return true; // Success
    } else {
        return "HTTP Error: " . $httpCode; // Error
    }
}
?>
