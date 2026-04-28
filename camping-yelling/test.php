<?php
// Database connection parameters
$dbhost = "localhost";
$dbname = "db1";
$dbuser = "amcmorrow";
$dbpass = "McMorrow!984";

try {
    // Create PDO connection
    $pdo = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare and execute query
    $stmt = $pdo->query("SELECT * FROM rsvps ORDER BY created_at DESC");
    $rsvps = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSVP List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>RSVP List</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Attending</th>
                    <th>Guests</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rsvps as $rsvp): ?>
                <tr>
                    <td><?= htmlspecialchars($rsvp['name']) ?></td>
                    <td><?= htmlspecialchars($rsvp['email']) ?></td>
                    <td><?= htmlspecialchars($rsvp['attendance']) ?></td>
                    <td><?= htmlspecialchars($rsvp['guests']) ?></td>
                    <td><?= htmlspecialchars($rsvp['message']) ?></td>
                    <td><?= date('M j, Y g:i A', strtotime($rsvp['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="total">
            <?php
            $total_guests = array_sum(array_column($rsvps, 'guests'));
            $total_responses = count($rsvps);
            echo "Total Responses: $total_responses<br>";
            echo "Total Guests: $total_guests";
            ?>
        </div>
    </div>
</body>
</html>