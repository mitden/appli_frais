<?php
	$this->load->helper('url');
?>
<div id="contenu">
	<h2>Liste des fiches de frais</h2>
	 	
	<?php if(!empty($notify)) echo '<p id="notify" >'.$notify.'</p>';?>
	 
	<table class="listeLegere">
		<thead>
			<tr>
				<th >Mois</th>
				<th >Etat</th>  
				<th >Montant</th>  
				<th >Date modif.</th>  
				<th  colspan="4">Actions</th>              
			</tr>
		</thead>
		<tbody>
          
		<?php foreach( $fiches as $uneFiche) 
			{
				$modLink = '';
				$signeLink = '';

				if ($uneFiche['id'] == 'CR') {
					$modLink = anchor('c_visiteur/modFiche/'.$uneFiche['mois'], 'modifier',  'title="Modifier la fiche"');
					$signeLink = anchor('c_comptable/signeFiche/'.$uneFiche['mois'], 'signer',  'title="Signer la fiche"  onclick="return confirm(\'Voulez-vous vraiment signer cette fiche ?\');"');
				}
				
				echo 
				'<tr>
					<td class="date">'.$uneFiche['mois'].'</td>
					<td class="libelle">'.$uneFiche['prenom'].' '.$uneFiche['nom'].'</td>
					<td class="montant">'.$uneFiche['montantValide'].'</td>
					<td class="date">'.$uneFiche['dateModif'].'</td>
					<td class="action">'.anchor('c_comptable/fiche/'.$uneFiche['idvisiteur'].'/'.$uneFiche['mois'], 'voir',  'title="voir la fiche"').'</td>
					<td class="action">'.anchor('c_comptable/fiche/'.$uneFiche['idvisiteur'].'/'.$uneFiche['mois'].'/valider', 'valider',  'title="valider la fiche"').'</td>
					<td class="action">'.anchor('c_comptable/fiche/'.$uneFiche['idvisiteur'].'/'.$uneFiche['mois'].'/refuser', 'refuser',  'title="refuser la fiche"').'</td>
				</tr>';
			}
		?>	  
		</tbody>
    </table>

</div>
