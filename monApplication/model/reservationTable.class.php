<?php

require_once "reservation.class.php";

class reservationTable {

    // recuperer toutes les reservations relatives à un voyage
    public static function getReservationByVoyage($voyage) {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $reservationRepository = $em->getRepository('reservation');
        $reservations = $reservationRepository->findBy(array('voyage' => $voyage->id));
        if ($reservations == false) {
            echo 'Erreur sql';
        }
        return $reservations;
    }

    // recuperer toutes les reservations relatives à un utilisateur
    public static function getReservationByUserId($userId) {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $reservationRepository = $em->getRepository('reservation');
        $reservations = $reservationRepository->findBy(array('voyageur' => $userId));
        return $reservations;
    }

    // générer un nouveau voyage
    public static function createReservation($tripId, $userId) {
        $em = dbconnection::getInstance()->getEntityManager();

        $trip = $em->getRepository('voyage')->find($tripId);
        $user = $em->getRepository('utilisateur')->find($userId);
        $rValue = false;

        if ($trip->nbplace > 1) {
            $resa = new reservation();
            $resa->voyage = $trip;
            $resa->voyageur = $user;
            $trip->nbplace--;

            $em->persist($resa);
            $em->flush();

            $rValue = $resa;
        }

        return $rValue;
    }

}

?>