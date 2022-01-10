<?php

require_once "utilisateur.class.php";

class utilisateurTable {

    // récupérer les infos d'un utilisateur à partir de son identifiant et mot de passe
	public static function getUserByLoginAndPass($login,$pass) {
		$em = dbconnection::getInstance()->getEntityManager() ;
		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => $pass));
		return $user;
	}


    // récupérer les infos d'un utilisateur à partir de son id
    public static function getUserById($id) {
		$em = dbconnection::getInstance()->getEntityManager() ;
		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('id' => $id));
		return $user;
	}

    // générer un nouvel utilisateur
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