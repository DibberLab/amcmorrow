<?php
// Define the path to Nginx sites-available directory
$nginx_files = glob('/etc/nginx/sites-available/*');
$nginx_info = []; // This array will store parsed Nginx configuration details

// --- Docker Container Information Collection ---
$docker_containers = []; // This associative array will map ports to Docker container details (e.g., [port => ['name' => 'container_name', 'id' => 'container_id']])

// Execute 'docker ps' command to get running containers, their IDs, and exposed ports.
// '2>/dev/null' redirects standard error to /dev/null to suppress command not found or permission errors.
$docker_output = shell_exec('docker ps --format "{{.ID}}\t{{.Names}}\t{{.Ports}}" 2>/dev/null');

// Process the output from the 'docker ps' command if it was successful and not empty.
if ($docker_output !== null && $docker_output !== '') {
    $lines = explode("\n", trim($docker_output)); // Split the output into individual lines
    foreach ($lines as $line) {
        if (empty($line)) continue; // Skip empty lines

        $parts = explode("\t", $line, 3); // Split each line into container ID, name, and port string
        if (count($parts) < 3) continue; // Skip malformed lines

        list($id, $name, $ports_str) = $parts; // Assign the parts to variables

        // Split the port string by comma to handle multiple port mappings for a single container
        $port_mappings = explode(', ', $ports_str);
        foreach ($port_mappings as $mapping) {
            $port_to_match = null;

            // Case 1: Matches host port mapping (e.g., "0.0.0.0:8080->80/tcp")
            // Extracts '8080' from the example.
            if (preg_match('/:(\d+)->\d+\/tcp$/', $mapping, $m)) {
                $port_to_match = $m[1];
            }
            // Case 2: Matches container port exposed without explicit host mapping (e.g., "80/tcp")
            // Extracts '80' from the example.
            elseif (preg_match('/^(\d+)\/tcp$/', $mapping, $m)) {
                $port_to_match = $m[1];
            }
            // Case 3: Matches a simple port number (less common in 'docker ps' but for robustness)
            // Extracts '8080' from "8080".
            elseif (preg_match('/^(\d+)$/', $mapping, $m)) {
                $port_to_match = $m[1];
            }

            // If a valid port was extracted, store it with the container name and ID.
            if ($port_to_match !== null) {
                $docker_containers[$port_to_match] = [
                    'name' => $name,
                    'id' => $id
                ];
            }
        }
    }
}
// --- End Docker Container Information Collection ---

// Loop through each Nginx configuration file found
foreach ($nginx_files as $file) {
    $content = file_get_contents($file); // Read the content of the Nginx config file
    if ($content === false) {
        // If the file cannot be read (e.g., permission issues), skip to the next file.
        continue;
    }

    // Gather all 'server_name' matches from the config file
    preg_match_all('/server_name\s+([^;]+);/', $content, $snm);
    $server_names = [];
    foreach ($snm[1] ?? [] as $names) {
        foreach (preg_split('/\s+/', trim($names)) as $s) {
            if ($s !== '') $server_names[] = $s;
        }
    }

    $target = '<span class="text-muted">No proxy or server_name</span>'; // Default target display
    $target_port = null; // Variable to store the extracted target port
    $docker_match_name = 'N/A'; // Default Docker container name match status
    $docker_match_id = 'N/A'; // Default Docker container ID match status

    // Gather 'proxy_pass' directive (only the first one found)
    if (preg_match('/proxy_pass\s+([^\s;]+);/', $content, $ppm)) {
        $target = $ppm[1]; // Set the target to the proxy_pass value

        // Attempt to extract the port from the 'proxy_pass' target URL/address
        $parsed_url = parse_url($target);
        if ($parsed_url && isset($parsed_url['port'])) {
            // If a port is explicitly defined in the URL (e.g., http://localhost:8080)
            $target_port = $parsed_url['port'];
        } elseif ($parsed_url && isset($parsed_url['scheme']) && in_array($parsed_url['scheme'], ['http', 'https'])) {
            // If it's an HTTP/HTTPS scheme but no port is specified, use default ports
            $target_port = ($parsed_url['scheme'] === 'https') ? 443 : 80;
        } elseif (preg_match('/:(\d+)$/', $target, $port_match_raw)) {
            // For targets like "127.0.0.1:8080" that don't have a scheme
            $target_port = $port_match_raw[1];
        }

    } elseif ($server_names) {
        // If no 'proxy_pass' is found, use the *first* 'server_name' as the "Target URL"
        $target = 'https://' . $server_names[0];
        $target_port = 443; // Assume default HTTPS port for this case
    }

    // Attempt to match the extracted target port with a Docker container
    if ($target_port !== null && isset($docker_containers[$target_port])) {
        $docker_match_name = htmlspecialchars($docker_containers[$target_port]['name']); // Found a match, store container name
        $docker_match_id = htmlspecialchars($docker_containers[$target_port]['id']); // Found a match, store container ID
    }

    // Add all collected information for the current Nginx file to the main array
    $nginx_info[] = [
        'file' => $file,
        'server_names' => $server_names,
        'target' => $target,
        'docker_container_name' => $docker_match_name, // Docker container name
        'docker_container_id' => $docker_match_id,   // Docker container ID
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Nginx sites-available Simplified Table</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f7f7fa; }
        .card { margin-top: 40px; }
        .badge { font-size: 0.97em; }
        pre { background: #222; color: #fff; border-radius: 6px; padding: 8px 12px; }
        .terminal-command {
            background-color: #333;
            color: #0f0;
            padding: 4px 8px;
            border-radius: 4px;
            font-family: monospace;
            white-space: nowrap;
            overflow-x: auto;
            display: inline-block;
            cursor: pointer;
        }
        .terminal-command:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Nginx sites-available: Main Host & Target Table</h2>
        </div>
        <div class="card-body">
            <?php if (empty($nginx_info)): ?>
                <div class="alert alert-warning">No nginx config files found or readable.</div>
            <?php else: ?>
                <table class="table table-bordered align-middle table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Config File</th>
                            <th>Server Name(s)</th>
                            <th>Target</th>
                            <th>Docker Container (Name)</th> <!-- Updated Column Header -->
                            <th>Docker Container (ID)</th> <!-- New Column Header -->
                            <th>Remove Command</th> <!-- New Column Header -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nginx_info as $info): ?>
                        <tr>
                            <td><code><?= htmlspecialchars(basename($info['file'])) ?></code></td>
                            <td>
                                <?php if ($info['server_names']): ?>
                                    <?php foreach ($info['server_names'] as $sn): ?>
                                        <a href="https://<?= htmlspecialchars($sn) ?>" target="_blank" class="badge bg-dark mb-1 text-white text-decoration-none"><?= htmlspecialchars($sn) ?></a>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="text-muted">None</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                // Display the target with appropriate styling based on its type
                                if (preg_match('#^https?://#', $info['target'])) {
                                    echo '<span class="badge bg-warning text-dark">' . htmlspecialchars($info['target']) . '</span>';
                                } elseif (strpos($info['target'], '<span') === 0) {
                                    // If target is already a styled span (e.g., "No proxy or server_name")
                                    echo $info['target'];
                                } else {
                                    echo '<span class="badge bg-success">' . htmlspecialchars($info['target']) . '</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($info['docker_container_name'] !== 'N/A'): ?>
                                    <span class="badge bg-info text-dark"><?= $info['docker_container_name'] ?></span>
                                <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($info['docker_container_id'] !== 'N/A'): ?>
                                    <span class="badge bg-secondary"><?= $info['docker_container_id'] ?></span>
                                <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($info['docker_container_id'] !== 'N/A'): ?>
                                    <code class="terminal-command" onclick="copyToClipboard('docker rm -f <?= $info['docker_container_id'] ?>')">docker rm -f <?= $info['docker_container_id'] ?></code>
                                <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <div class="mt-4">
                <a href="" class="btn btn-sm btn-outline-secondary">Refresh</a>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to copy text to clipboard
    function copyToClipboard(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        alert('Command copied to clipboard!'); // Simple alert for demonstration
    }
</script>
</body>
</html>
