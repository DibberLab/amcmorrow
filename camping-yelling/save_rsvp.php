<?php
// save_rsvp.php - Save RSVP data to PostgreSQL

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection info
$host = "localhost";
$dbname = "db1";
$user = "amcmorrow";
$port = "5432";
$password = "McMorrow!984";

// Response array
$response = array('success' => false, 'message' => '');

try {
    // Log connection attempt
    error_log("Attempting to connect to database: $host:$port/$dbname as $user");
    
    // Connect to PostgreSQL
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    error_log("Database connection successful");
    
    // Get form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $attendance = $_POST['attendance'] ?? '';
    $guests = (int)($_POST['guests'] ?? 1);
    $message = $_POST['message'] ?? '';
    
    // Log received data
    error_log("Received form data - Name: $name, Email: $email, Attendance: $attendance, Guests: $guests");
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($attendance)) {
        throw new Exception("Please fill all required fields");
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
    }
    
    // Insert into database
    error_log("Preparing to insert data into rsvps table");
    $stmt = $db->prepare("
        INSERT INTO rsvps (name, email, attendance, guests, message, created_at)
        VALUES (:name, :email, :attendance, :guests, :message, CURRENT_TIMESTAMP)
    ");
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':attendance', $attendance);
    $stmt->bindParam(':guests', $guests);
    $stmt->bindParam(':message', $message);
    
    $result = $stmt->execute();
    error_log("Insert result: " . ($result ? "Success" : "Failed"));
    
    $response['success'] = true;
    $response['message'] = 'Thank you for your RSVP!';
    
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    $response['message'] = $e->getMessage();
    
    // Add more detailed error info for debugging
    $response['error_details'] = $e->getMessage();
    if (isset($db) && $db->errorInfo()[0] !== '00000') {
        $response['db_error'] = $db->errorInfo()[2];
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>