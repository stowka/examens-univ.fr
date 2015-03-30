<?php
	/**
	 * Default home view
	 * @author François-Xavier Béligat
	 */
?>

<!doctype html>
<html>
	<?php require_once('sections/head.sec.php') ?>

	<body>
		<?php require_once('sections/menu.sec.php'); ?>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<p>
                        <div class="table-responsive">
                            <table class="table">
                                <caption>Promotions</caption>
                                <thead>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Effectif</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <?php foreach($promos as $promo): ?>
                                        <tr>
                                        <td><?= $promo->getId() ?></td>
                                        <td><?= $promo->getNom() ?></td>
                                        <td><?= $promo->getEffectif() ?></td>
                                        <td><form action="index.php?page=promos"
                                                  method="POST">
                                            <input type="hidden" name="deleteIdPromo" value="<?= $promo->getId() ?>"/>
                                            <button class="btn btn-danger btn-xs" type="submit">x</button>
                                            </form>
                                        <tr/>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
					</p>
				</div>
                <div class="col-xs-0 col-sm-2 col-md-2 col-lg-2">
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <h3>Ajouter une nouvelle promotion</h3>
                    <form method="POST" action="index.php?page=promos">
                        <div class="form-group">
                            <label for="nomPromo">Nom de la promo</label>
                            <input type="text" class="form-control" id="nomPromo" name="nomPromo" placeholder="nom de la promo"/>
                        </div>
                        <div class="form-group">
                            <label for="effectifPromo">Effectif</label>
                            <input type="number" class="form-control" id="effectifPromo" name="effectifPromo" value="1" min="1"/> 
                        </div>
                        <button type="button" class="btn btn-default">Effacer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
			</div>
		</div>
	</body>
</html>
