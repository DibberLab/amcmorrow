<?php
// guest_list.php - Display RSVP guest list

// Set security code for deletion
$deleteCode = "2179";

// Handle delete request
$deleteMessage = '';
$deleteError = '';

if (isset($_POST['delete']) && isset($_POST['id']) && isset($_POST['delete_code'])) {
    $id = $_POST['id'];
    $code = $_POST['delete_code'];
    
    if ($code === $deleteCode) {
        try {
            // Database connection info
            $host = "localhost";
            $dbname = "amcmorrow_db2";
            $user = "amcmorrow_admin";
            $port = "5432";
            $password = "McMorrow!984!984";
            
            // Connect to PostgreSQL
            $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Delete the record
            $stmt = $db->prepare("DELETE FROM rsvps WHERE id = ?");
            $stmt->execute([$id]);
            
            $deleteMessage = "Record successfully deleted.";
        } catch (Exception $e) {
            $deleteError = "Error deleting record: " . $e->getMessage();
        }
    } else {
        $deleteError = "Incorrect delete code. Please try again.";
    }
}

// Database connection info
$host = "localhost";
$dbname = "db1";
$user = "amcmorrow";
$port = "5432";
$password = "McMorrow!984";

// Get sort parameters
$sortField = isset($_GET['sort']) ? $_GET['sort'] : 'name';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

// Validate sort field to prevent SQL injection
$validSortFields = ['name', 'email', 'attendance', 'guests', 'created_at'];
if (!in_array($sortField, $validSortFields)) {
    $sortField = 'name';
}

// Validate sort order
if ($sortOrder !== 'asc' && $sortOrder !== 'desc') {
    $sortOrder = 'asc';
}

// Calculate attendance stats
function calculateStats($guests) {
    $total = 0;
    $attending = 0;
    $notAttending = 0;
    $maybe = 0;
    $tubingOnly = 0;
    $bbqOnly = 0;
    
    foreach ($guests as $guest) {
        $guestCount = (int)$guest['guests'];
        $total += $guestCount;
        
        switch ($guest['attendance']) {
            case 'yes':
                $attending += $guestCount;
                break;
            case 'no':
                $notAttending += $guestCount;
                break;
            case 'maybe':
                $maybe += $guestCount;
                break;
            case 'tubing':
                $tubingOnly += $guestCount;
                break;
            case 'bbq_only':
                $bbqOnly += $guestCount;
                break;
        }
    }
    
    return [
        'total' => $total,
        'attending' => $attending,
        'notAttending' => $notAttending,
        'maybe' => $maybe,
        'tubingOnly' => $tubingOnly,
        'bbqOnly' => $bbqOnly
    ];
}

// Function to get attendance status in readable format
function getAttendanceStatus($status) {
    switch ($status) {
        case 'yes':
            return 'Yes, Attending All';
        case 'no':
            return 'Not Attending';
        case 'maybe':
            return 'Maybe';
        case 'tubing':
            return 'Tubing Only';
        case 'bbq_only':
            return 'BBQ/Camping Only';
        default:
            return $status;
    }
}

// Function to get time ago
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $now = time();
    $diff = $now - $time;
    
    if ($diff < 60) {
        return "Just now";
    } elseif ($diff < 3600) {
        return floor($diff / 60) . " minutes ago";
    } elseif ($diff < 86400) {
        return floor($diff / 3600) . " hours ago";
    } elseif ($diff < 604800) {
        return floor($diff / 86400) . " days ago";
    } elseif ($diff < 2592000) {
        return floor($diff / 604800) . " weeks ago";
    } else {
        return date("M j, Y", $time);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tubing Event - Guest List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        h1, h2 {
            color: #2c3e50;
            text-align: center;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .error-message {
            color: #e74c3c;
            margin-bottom: 15px;
            text-align: center;
        }
        .success-message {
            color: #27ae60;
            margin-bottom: 15px;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            cursor: pointer;
        }
        th:hover {
            background-color: #e6e6e6;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .sort-icon {
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 5px;
            vertical-align: middle;
        }
        .sort-asc {
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 5px solid #555;
        }
        .sort-desc {
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #555;
        }
        .attendance-count {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .attendance-box {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin: 10px;
            min-width: 120px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .attendance-box h3 {
            margin: 0 0 10px 0;
            color: #2c3e50;
        }
        .attendance-number {
            font-size: 24px;
            font-weight: bold;
            color: #3498db;
        }
        .status-attending {
            color: #27ae60;
        }
        .status-not-attending {
            color: #e74c3c;
        }
        .status-maybe {
            color: #f39c12;
        }
        .status-tubing {
            color: #2980b9;
        }
        .status-bbq {
            color: #8e44ad;
        }
        .export-btn {
            background-color: #2ecc71;
            margin-left: 10px;
        }
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .action-buttons {
            display: flex;
        }
        .print-btn {
            background-color: #9b59b6;
        }
        .search-container {
            margin-bottom: 20px;
        }
        #searchInput {
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .timestamp {
            font-size: 0.85em;
            color: #7f8c8d;
        }
        .delete-btn {
            background-color: #e74c3c;
            padding: 6px 10px;
            font-size: 14px;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 5px;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        
        .modal-title {
            margin-top: 0;
        }
        
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }
        
        .modal-buttons button {
            margin-left: 10px;
        }
        
        .cancel-btn {
            background-color: #95a5a6;
        }
        
        .confirm-btn {
            background-color: #e74c3c;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
                font-size: 12pt;
            }
            table {
                box-shadow: none;
            }
            th, td {
                padding: 8px;
            }
        }
        @media (max-width: 768px) {
            .attendance-count {
                flex-direction: column;
                align-items: center;
            }
            .attendance-box {
                width: 80%;
            }
            .header-actions {
                flex-direction: column;
            }
            .action-buttons {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <?php
    try {
        // Connect to PostgreSQL
        $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Get all guests
        $stmt = $db->query("SELECT * FROM rsvps ORDER BY $sortField $sortOrder");
        $guests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Calculate stats
        $stats = calculateStats($guests);
    } catch (Exception $e) {
        echo "<div class='error-message'>Database error: " . $e->getMessage() . "</div>";
        $guests = [];
        $stats = ['total' => 0, 'attending' => 0, 'notAttending' => 0, 'maybe' => 0, 'tubingOnly' => 0, 'bbqOnly' => 0];
    }
    ?>
    
    <h1>Tubing Event - Guest List</h1>
    
    <?php if (!empty($deleteMessage)): ?>
        <div class="success-message"><?= $deleteMessage ?></div>
    <?php endif; ?>
    
    <?php if (!empty($deleteError)): ?>
        <div class="error-message"><?= $deleteError ?></div>
    <?php endif; ?>
    
    <div class="attendance-count">
        <div class="attendance-box">
            <h3>Total Guests</h3>
            <div class="attendance-number"><?= $stats['total'] ?></div>
        </div>
        <div class="attendance-box">
            <h3>Attending All</h3>
            <div class="attendance-number status-attending"><?= $stats['attending'] ?></div>
        </div>
        <div class="attendance-box">
            <h3>Tubing Only</h3>
            <div class="attendance-number status-tubing"><?= $stats['tubingOnly'] ?></div>
        </div>
        <div class="attendance-box">
            <h3>BBQ/Camping Only</h3>
            <div class="attendance-number status-bbq"><?= $stats['bbqOnly'] ?></div>
        </div>
        <div class="attendance-box">
            <h3>Maybe</h3>
            <div class="attendance-number status-maybe"><?= $stats['maybe'] ?></div>
        </div>
        <div class="attendance-box">
            <h3>Not Attending</h3>
            <div class="attendance-number status-not-attending"><?= $stats['notAttending'] ?></div>
        </div>
    </div>
    
    <div class="header-actions">
        <div class="search-container no-print">
            <input type="text" id="searchInput" placeholder="Search for names, emails, etc...">
        </div>
        
        <div class="action-buttons no-print">
            <button onclick="window.print()" class="print-btn">Print List</button>
            <button onclick="exportToCSV()" class="export-btn">Export to CSV</button>
            <a href="https://camping-yelling.amcmorrow.com"><button class="export-btn">RSVP</button></a>
        </div>
    </div>
    
    <table id="guestTable">
        <thead>
            <tr>
                <th onclick="sortTable('name')">
                    Name
                    <?php if ($sortField === 'name'): ?>
                        <span class="sort-icon sort-<?= $sortOrder ?>"></span>
                    <?php endif; ?>
                </th>
                <th onclick="sortTable('email')">
                    Email
                    <?php if ($sortField === 'email'): ?>
                        <span class="sort-icon sort-<?= $sortOrder ?>"></span>
                    <?php endif; ?>
                </th>
                <th onclick="sortTable('attendance')">
                    Attendance
                    <?php if ($sortField === 'attendance'): ?>
                        <span class="sort-icon sort-<?= $sortOrder ?>"></span>
                    <?php endif; ?>
                </th>
                <th onclick="sortTable('guests')">
                    Guests
                    <?php if ($sortField === 'guests'): ?>
                        <span class="sort-icon sort-<?= $sortOrder ?>"></span>
                    <?php endif; ?>
                </th>
                <th>Message</th>
                <th onclick="sortTable('created_at')">
                    RSVP Date
                    <?php if ($sortField === 'created_at'): ?>
                        <span class="sort-icon sort-<?= $sortOrder ?>"></span>
                    <?php endif; ?>
                </th>
                <th class="no-print">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($guests as $guest): ?>
                <tr>
                    <td><?= htmlspecialchars($guest['name']) ?></td>
                    <td><?= htmlspecialchars($guest['email']) ?></td>
                    <td class="status-<?= $guest['attendance'] ?>"><?= getAttendanceStatus($guest['attendance']) ?></td>
                    <td><?= (int)$guest['guests'] ?></td>
                    <td><?= nl2br(htmlspecialchars($guest['message'] ?? '')) ?></td>
                    <td>
                        <?= date('M j, Y g:i A', strtotime($guest['created_at'])) ?>
                        <div class="timestamp no-print"><?= timeAgo($guest['created_at']) ?></div>
                    </td>
                    <td class="no-print">
                        <button class="delete-btn" onclick="showDeleteModal(<?= $guest['id'] ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($guests)): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">No RSVPs yet!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteModal()">&times;</span>
            <h3 class="modal-title">Confirm Deletion</h3>
            <p>Are you sure you want to delete this RSVP?</p>
            <form id="deleteForm" method="post" action="">
                <input type="hidden" id="deleteId" name="id" value="">
                <label for="delete_code">Enter delete code:</label>
                <input type="password" id="delete_code" name="delete_code" required>
                <div class="modal-buttons">
                    <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="confirm-btn" name="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Sort table function
        function sortTable(field) {
            const currentSort = '<?= $sortField ?>';
            const currentOrder = '<?= $sortOrder ?>';
            
            let newOrder = 'asc';
            if (field === currentSort && currentOrder === 'asc') {
                newOrder = 'desc';
            }
            
            window.location.href = `?sort=${field}&order=${newOrder}`;
        }
        
        // Search function
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const table = document.getElementById('guestTable');
            const rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;
                
                for (let j = 0; j < cells.length; j++) {
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.indexOf(searchValue) > -1) {
                        found = true;
                        break;
                    }
                }
                
                row.style.display = found ? '' : 'none';
            }
        });
        
        // Export to CSV function
        function exportToCSV() {
            const table = document.getElementById('guestTable');
            let csv = [];
            const rows = table.querySelectorAll('tr');
            
            for (let i = 0; i < rows.length; i++) {
                const row = [], cols = rows[i].querySelectorAll('td, th');
                
                for (let j = 0; j < cols.length - 1; j++) { // Skip the actions column
                    // Clean the text - remove newlines and quotes
                    let text = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, ' ').replace(/"/g, '""');
                    // Add quotes around the text to properly handle commas
                    row.push('"' + text + '"');
                }
                
                csv.push(row.join(','));
            }
            
            const csvContent = "data:text/csv;charset=utf-8," + csv.join('\n');
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement('a');
            link.setAttribute('href', encodedUri);
            link.setAttribute('download', 'tubing_event_guest_list.csv');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        
        // Delete modal functions
        function showDeleteModal(id) {
            document.getElementById('deleteId').value = id;
            document.getElementById('deleteModal').style.display = 'block';
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }
        
        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeDeleteModal();
            }
        }
    </script>
</body>
</html>