<!-- upload_patient_record.php -->
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["record_file"]) && isset($_POST["patient_id"])) {
    // File upload directory
    $targetDir = "../admin/uploads/";

    // Get the file name
    $fileName = basename($_FILES["record_file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow only PDF files to be uploaded
    $allowTypes = array('pdf');

    if (in_array($fileType, $allowTypes)) {
        // Upload file to the server
        if (move_uploaded_file($_FILES["record_file"]["tmp_name"], $targetFilePath)) {
            // Database connection
            include("../connection.php");

            // Retrieve patient ID from the form
            $patientId = $_POST["pid"];

            // Insert uploaded file path into the database
            $stmt = $database->prepare("INSERT INTO patient_records (patient_id, file_path) VALUES (?, ?)");
            $stmt->bind_param("is", $patientId, $targetFilePath);
            if ($stmt->execute()) {
                echo "The file ".$fileName." has been uploaded and saved to the database.";
            } else {
                echo "Sorry, there was an error saving the file path to the database.";
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo 'Sorry, only PDF files are allowed to upload.';
    }
    // Redirect back to patient.php page
    header("location: patient.php");
    exit; 
}
?>
