<?php
	$this->load->helper('url');
?>
<div id="contenu">
	<h2>Liste des fiches de frais validées</h2>
	 	
	<?php if(!empty($notify)) echo '<p id="notify" >'.$notify.'</p>';?>
	 
	<table class="listeLegere">
		<thead>
			<tr>
				<th >Mois</th>
				<th >Visiteur</th>  
				<th >Montant</th>  
				<th >Date modif.</th>  
				<th  colspan="4">Actions</th>              
			</tr>
		</thead>
		<tbody>
          
		<?php foreach( $fichesValidees as $uneFiche) 
			{
				$modLink = '';
				$signeLink = '';

				
				echo 
				'<tr>
					<td class="date">'.$uneFiche['mois'].'</td>
					<td class="libelle">'.$uneFiche['prenom'].' '.$uneFiche['nom'].'</td>
					<td class="montant">'.$uneFiche['montantValide'].'</td>
					<td class="date">'.$uneFiche['dateModif'].'</td>
					<td class="action">'.anchor('c_comptable/fiche/'.$uneFiche['idvisiteur'].'/'.$uneFiche['mois'], 'voir',  'title="voir la fiche"').'</td>
					<td class="action">'.anchor('c_comptable/fiche/'.$uneFiche['idvisiteur'].'/'.$uneFiche['mois'].'/paiement', ' mettre en paiement',  'title=" mettre en paiement"').'</td>
				
				</tr>';
			}
		?>	  
		</tbody>
    </table>
    <h2>Liste des fiches en paiements</h2>
    <table class="listeLegere">
		<thead>
			<tr>
				<th >Mois</th>
				<th >Visiteur</th>  
				<th >Montant</th>  
				<th >Date modif.</th>  
				<th  colspan="4">Actions</th>              
			</tr>
		</thead>
		<tbody>
          
		<?php foreach( $fichesPaiements as $uneFiche) 
			{
				$modLink = '';
				$signeLink = '';

			
				
				echo 
				'<tr>
					<td class="date">'.$uneFiche['mois'].'</td>
					<td class="libelle">'.$uneFiche['prenom'].' '.$uneFiche['nom'].'</td>
					<td class="montant">'.$uneFiche['montantValide'].'</td>
					<td class="date">'.$uneFiche['dateModif'].'</td>
					<td class="action">'.anchor('c_comptable/fiche/'.$uneFiche['idvisiteur'].'/'.$uneFiche['mois'], 'voir',  'title="voir la fiche"').'</td>
					<td class="action">'.anchor('c_comptable/fiche/'.$uneFiche['idvisiteur'].'/'.$uneFiche['mois'].'/remboursee', 'Fiche remboursée',  'title="Fiche remboursée"').'</td>
		
				</tr>';
			}
		?>	  
		</tbody>
    </table>

</div>
