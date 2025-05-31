<?php
// Database connection
require_once __DIR__ . '/admin/inc/config.php';

// Start session if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get the session ID from the request
$sessionId = isset($_POST['session_id']) ? $_POST['session_id'] : null;

// Default response
$response = [
    'status' => 'error',
    'message' => 'No session ID provided',
    'history' => []
];

if ($sessionId) {
    try {
        // Get customer ID if logged in
        $custId = null;
        if (isset($_SESSION['customer']) && !empty($_SESSION['customer'])) {
            $custId = $_SESSION['customer']['cust_id'];
        }
        
        // Query to get chat history
        $query = "SELECT user_message, bot_reply, created_at FROM table_chatbot_messages WHERE 1=1";
        $params = [];
        
        // If user is logged in, get their messages
        if ($custId) {
            $query .= " AND cust_id = :cust_id";
            $params[':cust_id'] = $custId;
        } else {
            // For non-logged in users, use session ID (stored in a cookie)
            $query .= " AND session_id = :session_id";
            $params[':session_id'] = $sessionId;
        }
        
        // Order by creation time
        $query .= " ORDER BY created_at ASC";
        
        $stmt = $pdo->prepare($query);
        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value);
        }
        $stmt->execute();
        
        $chatHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $response = [
            'status' => 'success',
            'message' => 'Chat history retrieved successfully',
            'history' => $chatHistory
        ];
    } catch (PDOException $e) {
        $response = [
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage(),
            'history' => []
        ];
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>