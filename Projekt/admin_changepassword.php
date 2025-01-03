<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include './inc/functions.php';
include './inc/dbconnection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['UserInformation']['Role_ID'] != 1) {
    header('location: index.php');
    exit;
}

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $newPassword = sanitize_input($_POST['new_password']);
        $confirmPassword = sanitize_input($_POST['confirm_password']);
        $_SESSION['PasswordChanged'] = false;

        $errors = [];

        if (!validate_Repeat_Password($newPassword, $confirmPassword)) {
            $errors[] = 'Passwords do not match!';
        }

        if (strlen($newPassword) < 3) {
            $errors[] = 'Password must be at least 3 characters long.';
        }

        if (empty($errors)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $stmt = $conn->prepare('UPDATE User SET password_hash = ? WHERE User_ID = ?');
            $stmt->bind_param('si', $hashedPassword, $user_id);

            if ($stmt->execute()) {
                $_SESSION['PasswordChanged'] = true;
                header('Location: user_management.php?id=' . $user_id);
                exit;
            } else {
                $errors[] = 'Failed to update password.';
                $_SESSION['PasswordChanged'] = false;
            }
            $stmt->close();
        }

        $errorString = urlencode(implode(', ', $errors));
        $_SESSION['PasswordChanged'] = false;
        header('Location: user_management.php?id=' . $user_id . '&error=' . $errorString);
        exit;
    } else {
        $_SESSION['PasswordChanged'] = false;
        header('Location: user_management.php?id=' . $user_id . '&error=' . urlencode('Please fill in all required fields.'));
        exit;
    }
} else {
    $_SESSION['PasswordChanged'] = false;
    header('Location: user_management.php?id=' . $user_id);
    exit;
}