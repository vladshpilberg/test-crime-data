<?php

class CrimeController
{
    public function actionInvalidArgs() {
        echo 'Invalid arguments';
        return;
    }

    public function actionNumOfCrimesByCrimeType($crimeType) {
        $model = new CrimeModel;

        $numOfCrimes = $model->getNumberOfCrimesByCrimeType($crimeType);
        echo $numOfCrimes;
        return;
    }

    public function actionAddressesByCrimeType($crimeType, $page, $offset) {
        $model = new CrimeModel;

        $addresses = $model->getAddressesByCrimeType($crimeType, $page, $offset);

        echo json_encode($addresses);
        return;
    }

    public function actionNumOfCrimesByArea($area) {
        $model = new CrimeModel;

        $numOfCrimes = $model->getNumberOfCrimesByArea($area);
        echo $numOfCrimes;
        return;
    }

    public function actionInvalidAction() {
        echo 'Invalid action';
        return;
    }
}
