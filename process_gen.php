<?php
session_start();
include 'db.php'; // Database connection file

if (isset($_POST['generate'])) {
    $owner_id = $_SESSION['user_id']; // Current logged in owner/reseller
    $pkg = $_POST['gamePackage'];
    $days = $_POST['keyDuration'];
    $limit = $_POST['deviceLimit'];
    
    // Price Calculation
    $price = ($days == 30) ? 10000 : 20000;

    // 1. Check Owner Balance
    $check_bal = $conn->query("SELECT balance FROM users WHERE id='$owner_id'");
    $row = $check_bal->fetch_assoc();
    
    if ($row['balance'] < $price) {
        die("<script>alert('Low Balance!'); window.location='generate_key.php';</script>");
    }

    // 2. Generate Random Key
    $new_key = "ARK-" . strtoupper(substr(md5(microtime()), 0, 12));
    
    // 3. Deduct Balance & Save Key (Transaction)
    $conn->begin_transaction();
    try {
        // Paisa Kaato
        $conn->query("UPDATE users SET balance = balance - $price WHERE id='$owner_id'");
        
        // Key Save Karo (access_keys table mein)
        $conn->query("INSERT INTO access_keys (key_code, duration, device_limit, status) 
                      VALUES ('$new_key', '$days', '$limit', 'Unused')");
        
        $conn->commit();
        echo "Key Generated Successfully: " . $new_key;
        // Yahan aap redirect karke result dikha sakte hain
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>