<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentif extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	 /**
	 * Teste si un quelconque visiteur est connecté
	 * 
	 * @return vrai ou faux 
	 */
	public function estConnecte()
	{
	  return $this->session->userdata('idUser');
	}
	
	/**
	 * Enregistre dans une variable session les infos d'un visiteur
	 * 
	 * @param $id 
	 * @param $nom
	 * @param $prenom
	 */
	public function connecter($idUser,$nom,$prenom,$idmetier,$labelmetier)
	{	// TODO : s'assurer que les paramètres reçus sont cohérents avec ceux mémorisés en session

		$authUser = array(
                   'idUser'  => $idUser,
                   'nom' => $nom,
                   'prenom' => $prenom,
                   'idmetier' => $idmetier,
                   'labelmetier'=> $labelmetier

				);

		$this->session->set_userdata($authUser);
	}

	/**
	 * Détruit la session active et redirige vers le contrôleur par défaut
	 */
	public function deconnecter()
	{
		$authUser = array(
                   'idUser'  => '',
                   'nom' => '',
                   'prenom' => '',
                   'idmetier' => '',
                   'labelmetier'=>''
				);
	
		$this->session->unset_userdata($authUser);
		$this->session->sess_destroy();

		$this->load->helper('url');
		redirect('/c_default/');
	}

	/**
	 * Vérifie en base de données si les informations de connexions sont correctes
	 * 
	 * @return : renvoie l'id, le nom et le prenom de l'utilisateur dans un tableau s'il est reconnu, sinon un tableau vide.
	 */
	public function authentifier ($login, $mdp) 
	{	// TODO : s'assurer que les paramètres reçus sont cohérents avec ceux mémorisés en session
	
		$this->load->model('dataAccess');

		$authUser = $this->dataAccess->getInfosUser($login, $mdp);

		return $authUser;
	}


	
	public function check_access_group($idaccess_page){
			if ($idaccess_page == $this->session->userdata('idmetier')) {
				return true;
			}else{
				show_404();
			}
	
   }



}
