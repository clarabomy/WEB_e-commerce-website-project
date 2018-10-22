<?php
ob_start(); ?>
	<section id="pagePanier">
		<h2 id="title1">VOTRE PANIER</h2>
		
		<?php if (!empty($_SESSION['panier'])) { ?>
			<table>
				<thead>
					<tr>
						<th>Aperçu</th>
						<th>Article</th>
						<th>Prix unitaire</th>
						<th>Quantité</th>
						<th>Total</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php $positionPanier = 0;
						foreach($_SESSION['panier'] as $produitCommande) { ?>
							<tr>
								<td><img class="visuel" src="Vue/images/produit<?= htmlspecialchars($produitCommande['id_produit']) ?>.jpg" alt="Visuel article"></td>
								<td><?= htmlspecialchars($produitCommande['nom']) ?></td>
								<td><?= htmlspecialchars($produitCommande['prix']) ?> €</td>
								<td><?= htmlspecialchars($produitCommande['quantite']) ?><!--bouton modifier?--></td>
								<td><?= htmlspecialchars($produitCommande['prix'] * $produitCommande['quantite']) ?> €</td>
								<td>
									<form method="post" action="index.php?action=panier">
										<input type="hidden" name="supprimerArticle" 	value="true">
										<input type="hidden" name="posSupprime" 		value="<?= htmlspecialchars($positionPanier) ?>">
										<input id="supprimerArticle" type="image" src="Vue/images/annule.jpg" width="20">
									</form>
								</td>
							</tr>
						<?php $positionPanier++;
						}
					?>
				</tbody>
				<?php if (!empty($_SESSION['panier']) && $total != 0) {?>
					<tfoot>
						<tr>
							<th colspan="3"></th>
							<th>Quantité totale<br><?= htmlspecialchars($quantite_total) ?></th>
							<th>Prix total<br><?= htmlspecialchars($total) ?> €</th>
							<th></th>
						</tr>
					</tfoot>
				<?php } ?>
			</table>
		<?php } ?>
		
		<span>
			<a class="button1" href="index.php?action=boutique"><?= (empty($_SESSION['panier']))? 'Commencer' : 'Continuer' ?> mes achats</a>
			<?php if (!empty($_SESSION['panier'])) { ?>
				<form method="post" action="index.php?action=panier">
					<input type="hidden" name="viderTable" 	value="true">
					<input class="button1" type="submit" value="Vider mon panier"/>
				</form>
				<a class="button1" href="index.php?action=validation">Valider ma commande</a>
			<?php } ?>
		</span>
	</section>
<?php $sessionPage = ob_get_clean();

require("template.php");
