	<?php if ($participantes != null): ?>
		<?php foreach ($participantes as $key =>  $participante): ?>
			<?php 
				$foto = ($participante->foto != "") ? $participante->foto : "participante.jpg" ;
				$image = 'assets/images/participantes/'.$foto; 
			?>
			<?php if (!file_exists($image)): ?>
				<?php $image = 'assets/images/participantes/participante.jpg';  ?>
			<?php endif ?>
			<div class="participante <?= ($key%2 != 0) ? "line" : "" ; ?>">
				<div class="avatar">
					<div class="avatar-content" style="background-image:url(<?= $image ?>);">
						<!-- <img src="" title="<?= $participante->nome ?>" alt="<?= $participante->nome ?>"> -->
					</div>
					<span><?= $key+1 ?></span>
				</div>
				<div class="dados">
					<h2 class="nome"><?= $participante->nome ?></h2>
					<p class="descricao"><?= $participante->descricao ?></p>
				</div>
				<div class="classificar">
					<button class="like <?= ($participante->votado == "1" && $participante->voto == "1") ? "active" : "" ; ?>" title="Like" onclick="Votacao(<?= $participante->id ?>, 'like')">
						<span class="icon-like-linha">

						</span>
					</button>
					<button class="dislike <?= ($participante->votado == "1" && $participante->voto == "0") ? "active" : "" ; ?>" title="Dislike" onclick="Votacao(<?= $participante->id ?>, 'dislike')">
						<span class="icon-dislike-linha">

						</span>
					</button>
				</div>
				<div class="votacao">
					<div class="resultado gostam">
						<div class="titulo">Gostam</div>
						<div class="porcentagem"><?=  round($participante->p_like, 1) ?>%</div>
					</div>
					<div class="resultado nao-gostam">
						<div class="titulo">Não Gostam</div>
						<div class="porcentagem"><?=  round($participante->p_dislike, 1) ?>%</div>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	<?php else: ?>
		<h4 style="text-align: center; font-weight: 300;">Nada para mostrar.</h4>
	<?php endif ?>