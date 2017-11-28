<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_comptable extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

		// chargement du modèle d'accès aux données qui est utile à toutes les méthodes
		$this->load->model('dataAccess');
    }

	/**
	 * Accueil du comptable
	 * La fonction intègre un mécanisme de contrôle d'existence des 
	 * fiches de frais sur les 6 derniers mois. 
	 * Si l'une d'elle est absente, elle est créée
	*/
	public function accueil()
	{	// TODO : Contrôler que toutes les valeurs de $unMois sont valides (chaine de caractère dans la BdD)
	
		// chargement du modèle contenant les fonctions génériques
		$this->load->model('functionsLib');

		// obtention de la liste des 6 derniers mois (y compris celui ci)
		$lesMois = $this->functionsLib->getSixDerniersMois();
		
		// obtention de l'id de l'utilisateur mémorisé en session
		$iduser = $this->session->userdata('idUser');
		
	
		// envoie de la vue accueil du visiteur
		$this->templates->load('t_base_comptable', 'comptable/v_visAccueil');
	}
	
	public function fiches ($message=null)
	{	// TODO : s'assurer que les paramètres reçus sont cohérents avec ceux mémorisés en session
		
		$iduser = $this->session->userdata('idUser');

		
		$data['notify'] = $message;

		$data['fiches'] = $this->dataAccess->getFichesSigned();	

	
		$this->templates->load('t_base_comptable', 'comptable/v_visFiches', $data);	
	}


	public function fiche($param){

			
					$idVisiteur = $param[0];
					$mois = $param[1];
					  if (isset($param[2])) {$action = $param[2];}else{$action = null;};
					
					if (!$this->dataAccess->existeFiche($idVisiteur,$mois)) {
							echo "Fiche inexistante";
					}elseif ($action == "show") {
						
						$data['numAnnee'] = substr( $mois,0,4);
						$data['numMois'] = substr( $mois,4,2);
						$data['lesFraisHorsForfait'] = $this->dataAccess->getLesLignesHorsForfait($idVisiteur,$mois);
						$data['lesFraisForfait'] = $this->dataAccess->getLesLignesForfait($idVisiteur,$mois);		

						$this->templates->load('t_base_comptable', 'visiteur/v_visVoirListeFrais', $data);
						
				}elseif ($action == "valider") {
					echo "valider";

						$this->dataAccess->majEtatFicheFrais($idVisiteur,$mois,'VA');

						redirect('/c_comptable/fiches');



				}elseif ($action == "refuser") {
					echo "valider";

						$this->dataAccess->majEtatFicheFrais($idVisiteur,$mois,'RE');

						redirect('/c_comptable/fiches');



				}elseif ($action == "paiement") {
					echo "paiement";

						$this->dataAccess->majEtatFicheFrais($idVisiteur,$mois,'MP');

						redirect('/c_comptable/paiements');



				}elseif ($action == "remboursee") {
					echo "remboursee";

						$this->dataAccess->majEtatFicheFrais($idVisiteur,$mois,'RB');

						redirect('/c_comptable/paiements');



				}else{
						$data['numAnnee'] = substr( $mois,0,4);
						$data['numMois'] = substr( $mois,4,2);
						$data['lesFraisHorsForfait'] = $this->dataAccess->getLesLignesHorsForfait($idVisiteur,$mois);
						$data['lesFraisForfait'] = $this->dataAccess->getLesLignesForfait($idVisiteur,$mois);		

						$this->templates->load('t_base_comptable', 'visiteur/v_visVoirListeFrais', $data);



				}				




	}	



	public function paiements($message=null){
		$iduser = $this->session->userdata('idUser');

		
		$data['notify'] = $message;

		$data['fichesValidees'] = $this->dataAccess->getFichesValidees();	
		$data['fichesPaiements'] = $this->dataAccess->getFichesPaiements();
		
		$this->templates->load('t_base_comptable', 'comptable/v_paiements', $data);	


	}

	
	
}