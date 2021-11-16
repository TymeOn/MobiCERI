<?php

require_once "trajet.class.php";

class trajetTable {

    // get the route starting with city A and ending with city B
    public static function getTrajet($depart,$arrivee) {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $trajetRepository = $em->getRepository('trajet');
        $trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee'=> $arrivee));
        if ($trajet == false) {
            echo 'Erreur sql';
        }
        return $trajet;
    }

    // get all the departure and arrivales cities
    public static function getCities() {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $trajetRepository = $em->getRepository('trajet');
        $trajets = $trajetRepository->findAll();
        if ($trajets == false) {
            echo 'Erreur sql';
        }
        return [
            "departures" => array_unique(array_column($trajets, 'depart')),
            'arrivals' => array_unique(array_column($trajets, 'arrivee')),
        ];
    }

}

?>