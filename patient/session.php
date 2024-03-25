<?php

class SessionManager {
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroySession() {
        session_destroy();
    }

    public static function setUserSession($user) {
        $_SESSION["user"] = $user;
    }

    public static function getUserSession() {
        return isset($_SESSION["user"]) ? $_SESSION["user"] : null;
    }

    public static function setUserTypeSession($usertype) {
        $_SESSION["usertype"] = $usertype;
    }

    public static function getUserTypeSession() {
        return isset($_SESSION["usertype"]) ? $_SESSION["usertype"] : null;
    }
}

SessionManager::startSession();

?>
