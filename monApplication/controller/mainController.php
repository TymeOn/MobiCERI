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
                            'tripIds' => $t->id,
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
                            'tripIds' => $t['f_vid'],
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
                    $currentTrip['info']['tripIds'] .= '/' . $t['f_vid'];
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

    // login action
    public static function login($request,$context) {
        $login = $request['login'] ?? null;
        $password = $request['password'] ?? null;
        if ($login && $password) {
//            $user = utilisateurTable::getUserByLoginAndPass($login, $password);
//            if ($user) {
//                $context->setSessionAttribute('userId', $user->id);
//                $context->setSessionAttribute('userName', $user->nom);
//                $context->setSessionAttribute('userFirstName', $user->prenom);
            if (true) {
                $context->setSessionAttribute('userId', 100);
                $context->setSessionAttribute('userName', 'Test');
                $context->setSessionAttribute('userFirstName', 'Johny');
                $context->redirect('monApplication.php');
                die();
            } else {
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "Identifiant ou mot de passe erroné",
                ]);
            }
        }

        return context::SUCCESS;
    }

    // logout action
    public static function logout($request,$context) {
        session_unset();
        $context->redirect('monApplication.php');
        die();
    }

    // register action
    public static function register($request,$context)
    {
        $login = $request['login'] ?? null;
        $name = $request['name'] ?? null;
        $firstName = $request['firstName'] ?? null;
        $password = $request['password'] ?? null;
        $confirmPassword = $request['confirmPassword'] ?? null;

        if ($login !== null && $name !== null && $firstName !== null && $password !== null && $confirmPassword !== null) {

            $validRegistration = true;

            if (empty($login)) {
                $validRegistration = false;
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "La saisie d un identifiant est obligatoire",
                ]);
            } else if (strlen($login) > 45) {
                $validRegistration = false;
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "L identifiant saisi est trop long",
                ]);
            }

            if (empty($name)) {
                $validRegistration = false;
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "La saisie d un nom est obligatoire",
                ]);
            } else if (strlen($name) > 45) {
                $validRegistration = false;
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "Le nom saisi est trop long",
                ]);
            }

            if (empty($firstName)) {
                $validRegistration = false;
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "La saisie d un prénom est obligatoire",
                ]);
            } else if (strlen($firstName) > 45) {
                $validRegistration = false;
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "Le prénom saisi est trop long",
                ]);
            }

            if (empty($password)) {
                $validRegistration = false;
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "La saisie d un mot de passe est obligatoire",
                ]);
            } else if (strlen($password) > 45) {
                $validRegistration = false;
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "Le mot de passe saisi est trop long",
                ]);
            }

            if (empty($confirmPassword) || $password != $confirmPassword) {
                $validRegistration = false;
                array_push($context->alerts, [
                    "type" => "ERREUR",
                    "class" => "danger",
                    "message" => "Les deux mots de passe saisis ne correspondent pas",
                ]);
            }

            // final check and
            if ($validRegistration) {
                $newUser = utilisateurTable::createUser($login, $password, $name, $firstName);
                if ($newUser) {
                    array_push($context->alerts, [
                        "type" => "SUCCES",
                        "class" => "success",
                        "message" => "Le compte a été créé avec succès",
                    ]);
                } else {
                    array_push($context->alerts, [
                        "type" => "ERREUR",
                        "class" => "danger",
                        "message" => "Une erreur est survenue, veuillez réessayer",
                    ]);
                }
            }
        }

        return context::SUCCESS;
    }

    // view trips of a user action
    public static function userTrips($request,$context)
    {
        $userId = $context->getSessionAttribute('userId');
        if (!$userId) {
            $context->redirect('monApplication.php');
            die();
        }

        $reservations = reservationTable::getReservationByUserId($userId);

        $context->trips = [];

        foreach ($reservations as $r) {
            $context->trips = array_push($context->trips, voyageTable::getVoyage($r['voyage']));
        }

        return context::SUCCESS;
    }

}
?>
