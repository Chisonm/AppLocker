<?php

require_once 'AppLock.php';

// Define your password here
$password = 'my_password';

// Lock the app if the password is incorrect
$lock = new AppLock($password);
if (!$lock->isAuthenticated()) {
    $lock->lock();
    exit;
}