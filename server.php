<?php
$host = "127.0.0.1";
$port = 8080;

// Create TCP/IP socket
$sock = stream_socket_server("tcp://$host:$port", $errno, $errstr);

if (!$sock) {
    die("Error: $errstr ($errno)\n");
}

echo "PHP HTTP server running on http://$host:$port\n";

while (true) {
    $conn = @stream_socket_accept($sock);
    if (!$conn) continue;

    // Read the HTTP request from client
    $request = fread($conn, 1024);
    echo "\n--- Request ---\n$request\n";

    // Parse the request line (GET / HTTP/1.1)
    $lines = explode("\r\n", $request);
    $requestLine = $lines[0];
    [$method, $path, $version] = explode(' ', $requestLine);

    // Choose response based on path
    if ($path === "/") {
        $body = "<h1>Welcome to my PHP server!</h1>";
    } elseif ($path === "/about") {
        $body = "<h1>About Page</h1><p>This is a pure PHP HTTP server.</p>";
    } else {
        $body = "<h1>404 Not Found</h1>";
    }

    // Build HTTP response
    $headers = "HTTP/1.1 200 OK\r\n" .
               "Content-Type: text/html; charset=UTF-8\r\n" .
               "Content-Length: " . strlen($body) . "\r\n" .
               "Connection: close\r\n\r\n";

    fwrite($conn, $headers . $body);
    fclose($conn);
}
