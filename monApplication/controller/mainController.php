<?php

class mainController
{
    // index action
	public static function index($request,$context) {
		return context::SUCCESS;
	}

    // search trips with specific start and end cities
    public static function tripSearch($request,$context) {
        // departures and arrivals cities to populate our form
        $context->cities = trajetTable::getCities();

        // trip search
        $context->startCity = $request['startCity'] ?? null;
        $context->endCity = $request['endCity'] ?? null;

        $selectedRoute = null;
        if ($context->startCity && $context->endCity) {
            $selectedRoute = trajetTable::getTrajet($context->startCity, $context->endCity);
        }

        $context->trips = [];
        if ($selectedRoute) {
            $context->trips = voyageTable::getVoyagesByTrajet($selectedRoute);
        }

        return context::SUCCESS;
    }

}

?>
