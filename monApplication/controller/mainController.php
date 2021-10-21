<?php

class mainController
{

	public static function helloWorld($request,$context) {
		$context->mavariable="hello world";
		return context::SUCCESS;
	}

	public static function index($request,$context) {
		return context::SUCCESS;
	}

    public static function superTest($request,$context) {
        $context->param1=$request["param1"];
        $context->param2=$request["param2"];
        return context::SUCCESS;
    }

    public static function testModel($request,$context) {
        $context->loginTry = 'User1';
        $context->passTry = '0bc8658ea4e2f64af9d6890eace91a819f9f2046';
        $context->user = utilisateurTable::getUserByLoginAndPass($context->loginTry, $context->passTry);
        $context->userWithId = utilisateurTable::getUserByID(2);
        $context->trajet = trajetTable::getTrajet('Paris','Lyon');
        $context->voyages = voyageTable::getVoyagesByTrajet($context->trajet);
//        $context->reservations = reservationTable::getReservationByVoyage($context->voyages[0]);
        return context::SUCCESS;
    }

}

?>
