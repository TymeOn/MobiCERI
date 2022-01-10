<?php

require_once "voyage.class.php";

class voyageTable {

    // get all the trips using route A
    public static function getVoyage($id) {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $voyageRepository = $em->getRepository('voyage');
        $voyage = $voyageRepository->findBy(array('id' => $id));
        if ($voyage == false) {
            echo 'Erreur sql';
        }
        return $voyage;
    }

    // get all the trips using route A
    public static function getVoyagesByTrajet($trajet) {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $voyageRepository = $em->getRepository('voyage');
        $voyages = $voyageRepository->findBy(array('trajet' => $trajet->id));
        if ($trajet == false) {
            echo 'Erreur sql';
        }
        return $voyages;
    }

    // get all the trips between two cities, including the connections
    public static function getVoyagesBetweenCities($cityA, $cityB, $nbPlace) {
        $em = dbconnection::getInstance()->getEntityManager()->getConnection();
        $query = $em->prepare('SELECT * from tripSearch(\'' . $cityA . '\', \'' . $cityB . '\', ' . $nbPlace . ');');
        $bool = $query->execute();
        if ($bool == false){
            return NULL;
        }
        return $query->fetchAll();
    }

    public static function createTrip($userId, $startCity, $endCity, $price, $nbSeats, $depTime, $constraints) {
        $em = dbconnection::getInstance()->getEntityManager();
        $user = $em->getRepository('utilisateur')->find($userId);
        $path = $em->getRepository('trajet')->findOneBy(array('depart' => $startCity, 'arrivee' => $endCity));

        $trip = new voyage();
        $trip->conducteur = $user;
        $trip->trajet = $path;
        $trip->tarif = $price;
        $trip->nbplace = $nbSeats;
        $trip->heureDepart = $depTime;
        $trip->contraintes = $constraints;

        $em->persist($trip);
        $em->flush();

        return $trip;
    }

}

?>