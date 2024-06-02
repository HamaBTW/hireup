<?php

$promt = "";
if (isset($_GET['prompt'])) {
    $promt = htmlspecialchars($_GET['prompt']);
}

// Function to execute the Python script with parameters and return its output
function executePythonScript($scriptPath, $params) {
    // Build the command to execute the Python script with parameters
    $command = 'python ' . $scriptPath . ' ' . escapeshellarg($params);
    
    // Execute the command and capture the output
    $output = shell_exec($command);
    
    // Return the output
    return $output;
}

if ($promt != "") {

// Path to the Python script
$pythonScriptPath = './ai_mod.py';

// Parameters to pass to the Python script
$params = $promt; // Replace 'parameter_value' with the actual parameter value

// Execute the Python script with parameters and get its output
$scriptOutput = executePythonScript($pythonScriptPath, $params);

// Send the output as the response
echo $scriptOutput;

} else {
    echo 'no data';
}

?>