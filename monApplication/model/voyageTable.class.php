<?php

require_once "voyage.class.php";

class voyageTable {

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

}

?>