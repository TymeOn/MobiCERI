<?php

class mainController
{
    // index action
	public static function index($request,$context) {
		return context::SUCCESS;
	}

    // displays the trip search page
    public static function tripSearch($request,$context) {
        // departures and arrivals cities to populate our form
        $context->cities = trajetTable::getCities();
        return context::SUCCESS;
    }

    // search trips with specific start and end cities
    public static function tripSearchResults($request,$context) {
        $context->startCity = $request['startCity'] ?? null;
        $context->endCity = $request['endCity'] ?? null;

        // finding the route
        $selectedRoute = null;
        if ($context->startCity && $context->endCity) {
            $selectedRoute = trajetTable::getTrajet($context->startCity, $context->endCity);
        }

        // finding trips
        $context->trips = [];
        if ($selectedRoute) {
            $context->trips = voyageTable::getVoyagesByTrajet($selectedRoute);
        }

        // setting the notification
        $context->alerts = array();
        array_push($context->alerts, [
            "type" => "INFO",
            "message" => "Recherche terminée",
        ]);

        return context::SUCCESS;
    }

}
?>
