<?php
require './config/database.php';

class Connexion {

    private $email;
    private $mdp;

    public function __construct($username, $pasword) {
        $this->username = $username;
        $this->password = $password;
    }
    

    public function login($username,$password) {
		if (!isset($_SESSION)){
			session_start();
		}
		
		$unUtilisateurDAO = new UtilisateurDAO();		
		//$util = $unUtilisateurDAO->getUtilisateurByEmail($email);
                
                
		if ($util){
			$mdpBD = $util->get_motDePasse();
			if (trim($mdpBD) == trim(crypt($motDePasse, $mdpBD))) {
				// le mot de passe est celui de l'utilisateur dans la base de donnees
				$_SESSION["email"]=$email;
				$_SESSION["motDePasse"]=$mdpBD;
                                
                                
			}
		}

 /* // Retourne un article en fonction de l'id reçu
function getBlogByID(int $id): array {
    $sql = "SELECT * FROM blog where id = :id;";
    $query = dbConnect()->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $blogs = $query->fetch();
    $query->closeCursor();
    return $blogs;
  }*/
}