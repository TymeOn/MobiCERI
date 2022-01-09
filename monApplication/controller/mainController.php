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

        $nbPlace = $request['nbPlace'] ?? 0;
        $directRoute = $request['directRoute'] ?? false;
        if ($directRoute == 'true') {
            // finding the route
            $selectedRoute = null;
            if ($context->startCity && $context->endCity) {
                $selectedRoute = trajetTable::getTrajet($context->startCity, $context->endCity);
            }

            // finding trips
            $context->trips = [];
            if ($selectedRoute) {
                $trips = voyageTable::getVoyagesByTrajet($selectedRoute);
                $counter = 0;

                foreach ($trips as $t) {
                    $currentTrip = [
                        'info' => [
                            'title' => $context->startCity . " - " . $context->endCity,
                            'connections' => '',
                            'price' => $t->tarif,
                            'id' => $counter,
                        ],
                        'path' => [$t],
                    ];
                    $counter++;
                    $context->trips = array_merge($context->trips, [$currentTrip]);
                }

            }

        } else {

            // finding trips
            $trips = voyageTable::getVoyagesBetweenCities($context->startCity, $context->endCity, $nbPlace);
            $context->trips = [];
            $counter = 0;
            foreach ($trips as $t) {
                if ($t['f_vdep'] == $context->startCity) {
                    $currentTrip = [
                        'info' => [
                            'title' => $context->startCity . " - " . $context->endCity,
                            'connections' => '',
                            'price' => 0,
                            'id' => $counter,
                        ],
                        'path' => [],
                    ];
                    $counter++;
                }
                $fullTrip = voyageTable::getVoyage($t['f_vid']);
                $currentTrip['path'] = array_merge($currentTrip['path'], $fullTrip);
                $currentTrip['info']['price'] += $fullTrip[0]->tarif;
                if ($t['f_varr'] == $context->endCity) {
                    $context->trips = array_merge($context->trips, [$currentTrip]);
                } else {
                    $currentTrip['info']['connections'] .= $t['f_varr'] . ' ';
                }
            }
        }

        // setting the notification
        $context->alerts = array();
        array_push($context->alerts, [
            "type" => "INFO",
            "class" => "info",
            "message" => "Recherche terminée",
        ]);

        return context::SUCCESS;
    }

}
?>
