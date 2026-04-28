<?php
// Database connection info
$host = "localhost";
$dbname = "db1";
$user = "amcmorrow";
$port = "5432";
$password = "McMorrow!984";

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

// Fetch guest data
$guests = [];
$stats = ['total' => 0, 'attending' => 0, 'notAttending' => 0, 'maybe' => 0, 'tubingOnly' => 0, 'bbqOnly' => 0];
$dbError = '';

try {
    // Connect to PostgreSQL
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get all guests - always sorted by created_at date
    $stmt = $db->query("SELECT * FROM rsvps ORDER BY created_at ASC");
    $guests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculate stats
    $stats = calculateStats($guests);
} catch (Exception $e) {
    $dbError = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>Tubing, Camping, Yelling. RSVP</title>
    
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />
    
    <!-- Custom CSS for color accents -->
    <style>
        body {
            background-image: url(https://www.toptal.com/designers/subtlepatterns/uploads/y-so-serious-white.png);
        }
        .uk-button-primary {
            background-color: #3498db;
        }
        .uk-button-primary:hover {
            background-color: #2980b9;
        }
        .uk-button-secondary {
            background-color: #27ae60;
        }
        .uk-button-danger {
            background-color: #e74c3c;
        }
        .status-yes {
            color: #27ae60;
        }
        .status-no {
            color: #e74c3c;
        }
        .status-maybe {
            color: #f39c12;
        }
        .status-tubing {
            color: #2980b9;
        }
        .status-bbq_only {
            color: #8e44ad;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
        }
        .uk-modal-success {
            border-top: 5px solid #2ecc71;
        }
        .uk-modal-error {
            border-top: 5px solid #e74c3c;
        }
        .timestamp {
            font-size: 0.85em;
            color: #7f8c8d;
        }
        .uk-card-attendance {
            text-align: center;
        }
        @media print {
            .uk-card, form, .uk-section-muted, .uk-button {
                background: white !important;
                box-shadow: none !important;
                border: 1px solid #eee !important;
            }
            .no-print {
                display: none !important;
            }
        }
        .uk-heading-medium {
             font-size: 2.5rem;
        }       
        .uk-container > :last-child {
            padding: 20px;
            background-color: #acacac24;
        }
        .uk-table th {
            padding: 16px 45px;
        }
        .uk-table-striped tbody tr:nth-of-type(even) {
            background-color: rgba(255, 255, 255, 0.48);
        }
    </style>
    
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
    
    <!-- Custom JS -->
    <script src="events.js" defer></script>
    <script src="guest-list.js" defer></script>
</head>
<body>
    <!-- Event Banner -->
    <div class="uk-container uk-container-small"><br>
        <img class="uk-width-1-1 uk-border-rounded" src="/sad-dino.png" alt="Event banner">
        
        <h1 class="uk-heading-medium uk-text-center uk-margin-medium-top">Tubing, Camping, Yelling. RSVP</h1>
        
        <!-- Event Details Card -->
        <div class="uk-card uk-card-default uk-card-body uk-margin-medium-bottom">
            <h2 class="uk-card-title">Event Details</h2>
            <p><strong>What:</strong><br>Tubing, Camping, Yelling.</p>
            <p><strong>When:</strong><br>Friday, June 20 to Sunday, June 22 - Tubing on Saturday 11:00am (Meet at Fish Lake) </p>
        <p><strong>Where:</strong> <br>Our place: <a href="https://www.google.com/maps/dir/45.0914807,-93.4176979/7860+Fish+Lake+Rd,+Siren,+WI+54872">7860 Fish Lake Road, Siren, WI</a> <br>Tubing Place: <a href="https://maps.app.goo.gl/b8GmWnTQX5JkiDXg8">Yellow River & St. Croix, Danbury</a></p>
        <p><strong>Details:</strong><br>Come celebrate with food, drinks, and fun! No gifts necessary, just your presence. <br>Show up on Friday if you want to set up early and be ready for Saturday morning. <br>We'll meet up, go tubing or canoeing, then 
                                    back and have a bonfire and BBQ. <br>Tent up in the yard, and stay the night! Stay the whole weekend!</p>
            <p class="uk-text-bold">Please RSVP so that we can make reservations with the tubing folks.</p>
            <p><strong>Tubing Route:</strong><br><a href="/TubingRoute.png" target="_blank"><img src="/TubingRoute.png"></a><br>The tubing place will shuttle us to and from our locations. They leave every 30 minutes, but obviously we all want to tube together. We need everyone to sign the waiver prior to boarding. (I'll have that at the house.)</p>
        </div>

        <!-- RSVP Form -->
        <div class="uk-card uk-card-default uk-card-body uk-margin-medium-bottom">
            <h2 class="uk-card-title">Please RSVP</h2>
            
            <form id="rsvp-form" class="uk-form-stacked">
                <div class="uk-margin">
                    <label class="uk-form-label" for="name">Your Name:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="text" id="name" name="name" required>
                    </div>
                </div>
                
                <div class="uk-margin">
                    <label class="uk-form-label" for="email">Email:</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="email" id="email" name="email" required>
                    </div>
                </div>
                
                <div class="uk-margin">
                    <label class="uk-form-label" for="attendance">Will you attend?</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="attendance" name="attendance" required>
                            <option value="">-- Select --</option>
                            <option value="yes">Yes, I'll be there!</option>
                            <option value="tubing">Tubing Only</option>
                            <option value="bbq_only">Camping/Bonfire/BBQ Only</option>
                            <option value="no">Sorry, I can't make it</option>
                            <option value="maybe">Maybe, I'll confirm later</option>
                        </select>
                    </div>
                </div>
                
                <div class="uk-margin">
                    <label class="uk-form-label" for="guests">Number of guests (including yourself):</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="number" id="guests" name="guests" min="1" max="5" value="1">
                    </div>
                </div>
                
                <div class="uk-margin">
                    <label class="uk-form-label" for="message">Message (optional):</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea" id="message" name="message" rows="3"></textarea>
                    </div>
                </div>
                
                <button type="submit" class="uk-button uk-button-primary uk-width-1-1">Submit RSVP</button>
            </form>
        </div>
        
        <!-- Calendar Buttons -->
        <div class="uk-grid-small uk-margin-medium-bottom" uk-grid>
            <div class="uk-width-1-2@s">
                <button id="google-calendar" class="uk-button uk-button-secondary uk-width-1-1">
                    <span uk-icon="calendar"></span> Add to Google Calendar
                </button>
            </div>
            <div class="uk-width-1-2@s">
                <button id="ics-download" class="uk-button uk-button-secondary uk-width-1-1">
                    <span uk-icon="download"></span> Download Calendar File (.ics)
                </button>
            </div>
        </div>
        
        <!-- Guest List Section -->
        <div class="uk-section uk-section-muted uk-border-rounded uk-margin-large-bottom" id="guestList">
            <div class="uk-container">
            <h2 class="uk-heading-line uk-text-center"><span>5 Day Forecast</span></h2>
            <a class="weatherwidget-io" href="https://forecast7.com/en/45d79n92d38/siren/?unit=us" data-label_1="SIREN, WI" data-label_2="WEATHER" data-theme="original" >SIREN, WI WEATHER</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>

                <h2 class="uk-heading-line uk-text-center"><span>Current Guest List</span></h2>
                
                <?php if (!empty($dbError)): ?>
                    <div class="uk-alert uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p><?= $dbError ?></p>
                    </div>
                <?php endif; ?>
                
                <!-- Attendance Stats -->
                <div class="uk-child-width-1-3@m uk-child-width-1-2@s uk-grid-match" uk-grid>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-card-attendance">
                            <h3 class="uk-card-title">Total Guests</h3>
                            <div class="stat-number"><?= $stats['total'] ?></div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-card-attendance">
                            <h3 class="uk-card-title">Attending All</h3>
                            <div class="stat-number status-yes"><?= $stats['attending'] ?></div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-card-attendance">
                            <h3 class="uk-card-title">Tubing Only</h3>
                            <div class="stat-number status-tubing"><?= $stats['tubingOnly'] ?></div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-card-attendance">
                            <h3 class="uk-card-title">BBQ/Camping Only</h3>
                            <div class="stat-number status-bbq_only"><?= $stats['bbqOnly'] ?></div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-card-attendance">
                            <h3 class="uk-card-title">Maybe</h3>
                            <div class="stat-number status-maybe"><?= $stats['maybe'] ?></div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-card-attendance">
                            <h3 class="uk-card-title">Not Attending</h3>
                            <div class="stat-number status-no"><?= $stats['notAttending'] ?></div>
                        </div>
                    </div>
                </div>
                
                <!-- Search and Actions -->
                <div class="uk-margin-medium-top uk-grid-small no-print" uk-grid>
                    <div class="uk-width-expand@s">
                        <div class="uk-search uk-search-default uk-width-1-1">
                            <span uk-search-icon></span>
                            <input id="search-input" class="uk-search-input" type="search" placeholder="Search guest list...">
                        </div>
                    </div>
                    <div class="uk-width-auto@s">
                        <button onclick="window.print()" class="uk-button uk-button-default">
                            <span uk-icon="print"></span> Print
                        </button>
                    </div>
                    <div class="uk-width-auto@s">
                        <button onclick="exportToCSV()" class="uk-button uk-button-primary">
                            <span uk-icon="file-text"></span> Export CSV
                        </button>
                    </div>
                </div>
                
                <!-- Guest Table -->
                <div class="uk-overflow-auto uk-margin-medium-top">
                    <table id="guest-table" class="uk-table uk-table-striped uk-table-hover uk-table-responsive">
                        <thead>
                            <tr>
                                <th class="uk-table-shrink uk-text-nowrap uk-text-center">
                                    Name
                                </th>
                                <th class="uk-table-shrink uk-text-nowrap uk-text-center">
                                    Attendance
                                </th>
                                <th class="uk-width-small uk-text-center">
                                    Guests
                                </th>
                                <th class="uk-width-medium uk-text-center">
                                    Message
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($guests)): ?>
                                <?php foreach ($guests as $guest): ?>
                                    <tr>
                                        <td class="uk-text-bold uk-text-center"><?= htmlspecialchars($guest['name']) ?></td>
                                        <td class="status-<?= $guest['attendance'] ?> uk-text-center"><?= getAttendanceStatus($guest['attendance']) ?></td>
                                        <td class="uk-text-center"><?= (int)$guest['guests'] ?></td>
                                        <td class="uk-text-center"><?= nl2br(htmlspecialchars($guest['message'] ?? '')) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="uk-text-center">No RSVPs yet!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Response Modal -->
    <div id="response-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-text-center">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 id="modal-title" class="uk-modal-title">RSVP Status</h2>
            <p id="modal-message"></p>
            <div class="uk-text-right">
                <button class="uk-button uk-button-primary uk-modal-close">Close</button>
            </div>
        </div>
    </div>
</body>
</html>