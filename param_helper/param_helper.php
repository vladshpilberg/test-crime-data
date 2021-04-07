<?php

// I do not want to include rewrining /etc/hosts file into this project
// to make RESTful API urls. So I just do usual GET name/value
// pairs in query string. In real life I'd do it differently
// I would do a url parcer here instead of just returning $_GET
class ParamHelper
{
    private static $allowedActions = [
        'NumOfCrimesByCrimeType',
        'AddressesByCrimeType',
        'NumOfCrimesByArea',
    ];

    public static function readParameters() {
        return $_GET;
    }

    public static function getAllowedActions() {
        $result = [];
        foreach(self::$allowedActions as $action) {
            $result[] = strtolower($action);
        }

        return $result;
    }
}
