<?php

require_once 'db/db.php';
require_once 'models/crime.php';
require_once 'param_reader/param_helper.php';
require_once 'controllers/crime.php';

$params = ParamHelper::readParameters();
$controller = new CrimeController;

$action = !isset($params['action']) || !in_array(strtolower($params['action']), ParamHelper::getAllowedActions())
    ? 'InvalidAction' : strtolower($params['action']);

switch($action) {
    case strtolower('NumOfCrimesByCrimeType'):
        if(!isset($params['crime_type'])) {
            $controller->actionInvalidArgs();
        } else {
            $controller->actionNumOfCrimesByCrimeType($params['crime_type']);
        }
        break;
    case strtolower('AddressesByCrimeType'):
        if(!isset($params['crime_type'])) {
            $controller->actionInvalidArgs();
        } else {
            $page = isset($params['page']) ? $params['page'] : 1;
            $offset = isset($params['offset']) ? $params['offset'] : 100;

            $controller->actionAddressesByCrimeType($params['crime_type'], $page, $offset);
        }
        break;
    case strtolower('NumOfCrimesByArea'):
        if(!isset($params['area'])) {
            $controller->actionInvalidArgs();
        } else {
            $controller->actionNumOfCrimesByArea($params['area']);
        }
        break;
    default:
        $controller->actionInvalidAction();
        break;
}
exit(0);
