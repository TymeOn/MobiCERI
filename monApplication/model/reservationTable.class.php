<?php

require_once "reservation.class.php";

class reservationTable {

    public static function getReservationByVoyage($voyage) {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $reservationRepository = $em->getRepository('reservation');
        $reservations = $reservationRepository->findBy(array('voyage' => $voyage->id));
        if ($reservations == false) {
            echo 'Erreur sql';
        }
        return $reservations;
    }

    public static function getReservationByUserId($userId) {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $reservationRepository = $em->getRepository('reservation');
        $reservations = $reservationRepository->findBy(array('voyageur' => $userId));
        return $reservations;
    }

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