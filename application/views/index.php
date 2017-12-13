<!DOCTYPE html>
<html>
<head>
	<title>TopWay Ranking</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/style.css">
</head>
<body>
	<?php if (!isset($_SESSION["session"])): ?>
		<?php $this->session->set_userdata("session", uniqid()); ?>
	<?php endif ?>
	<!-- Div Principal -->
	<div id="principal">
		<!-- Início do Topo -->
		<div id="topo">
			<img src="<?= base_url()?>assets/images/logo.svg">
		</div>
		<!-- Fim do Topo -->
		<!-- Início do Corpo -->
		<div id="conteudo">
			
			
			
		</div>	
		<!-- Fim do Corpo -->
	</div>
	<!-- Fim Div Principal -->

	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

	<script type="text/javascript">
		function Votacao(participante, voto) {
			$(".participante").css("opacity", "0.5");
			$.post( "<?= base_url()?>votar", {participante_id: participante, voto: voto},function( data ) {
				if (data == "") {
					Load();					
				}
			});
		}

		function Load(){
			$.post( "<?= base_url()?>carregar",function( data ) {
				$("#conteudo").html(data);
				$(".participante").css("opacity", "1");
			});
		}

		$(function(){
			Load();
		});
	</script>
</body>
</html>