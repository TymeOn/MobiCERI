<?php

require_once "utilisateur.class.php";

class utilisateurTable {

	public static function getUserByLoginAndPass($login,$pass) {
		$em = dbconnection::getInstance()->getEntityManager() ;
		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => $pass));
		return $user;
	}

	public static function getUserById($id) {
		$em = dbconnection::getInstance()->getEntityManager() ;
		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('id' => $id));

		return $user;
	}

    public static function createUser($login, $password, $name, $firstName) {
        $em = dbconnection::getInstance()->getEntityManager();
        $user = new utilisateur();
        $user->identifiant = $login;
        $user->pass = $password;
        $user->nom = $name;
        $user->prenom = $firstName;

        $em->persist($user);
        $em->flush();

        return $user;
    }

}

?>