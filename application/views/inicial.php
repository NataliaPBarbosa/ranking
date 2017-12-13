<!DOCTYPE html>
<html>
<head>
	<title>Listagem Participantes | TopWay Ranking</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/style.css">
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500');
		body{
			background-color: #eff1f4;
			width: 100%;
			height: auto;	
			padding: 0;
			margin: 0;
			font-family: 'Montserrat', sans-serif;
		}

		body *{	
			box-sizing: border-box;
		}
		.content {
			background-color: #fff;
			width: 70%;
			min-height: 430px;
			margin: 80px auto 0 auto; 
			padding: 20px 25px;
		}

		.content .breadcrumb{
			list-style: none;
			padding: 0;
		}
		.content .breadcrumb li{
			display: inline-block;			
		}
		.content .breadcrumb li a{
			font-weight: 13px;
			text-decoration: none;
			color: #03A9F4;
		}
		.content h1{
			font-weight: 300;
		}

		.error{
			color: #e74c3c;
			font-weight: 500;
		}
		.success{
			color:#2ecc70;
			font-weight: 500;
		}
		

		.cadastrar{
			border: 1px solid #ba78ff;
			color: #ba78ff;
			background-color: #fff;
			padding: 9px 20px;
			font-size: 18px;
			cursor: pointer;
			outline: none;
			float: right;
			text-decoration: none;
		}
		.cadastrar:hover, .cadastrar:focus, .cadastrar:active{
			color: #fff;
			background-color: #ba78ff;
		}

		table, td, th {    
			border: 1px solid #ddd;
			text-align: left;
		}

		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			padding: 15px;
		}
		table img{
			width: 60px;
			height: auto;
		}
		table h3{
			margin: 0;
			font-size: 18px;
			color:#999;
			font-weight: 300;
		}
		table h5{
			color:#909090;
			font-size: 12px;
			margin: 0;	
		}

		table button, table a{
			border:none;
			background: transparent;
			outline: none;
			cursor: pointer;
			font-size: 13px;
			padding: 2px 1px;
			text-decoration: none;
		}

		table a.editar{
			color: #03A9F4;
		}
		table button.excluir{
			color: #e74c3c;
		}
		.paginacao{
			width: 100%;
		}
		.paginacao ul {
			list-style: none;
		}
		.paginacao ul li{			
			display: inline-block;
			
		}
		.paginacao ul li a{
			text-decoration: none;
			color: #909090;
			padding: 5px 10px;
		}		
		.paginacao ul li.active a,
		.paginacao ul li:hover a{
			background-color: #ba78ff;
			color: #fff;
		}

		/*Media Query*/
		@media(max-width: 576px){
			.cadastrar{
				clear: both;
				width: 100%;
				text-align: center;
				margin: 8px 0; 
			}
			thead{
				display: none;
			}

			tbody td{
				display: block;
				border:none;
			}
			tbody tr{
				border: 1px solid #ddd;
			}
		}	
	</style>
</head>
<body>
	<div class="content">

		<ol class="breadcrumb">
			<li><a href="<?=base_url()?>">Votação</a> / </li>
			<li class="active">Listagem</li>
		</ol>
		
		<h1>Participantes

			<a class="cadastrar" href="<?= base_url() ?>cadastrar">
				Cadastrar
			</a>
		</h1>
		<?= $this->session->flashdata("cadastro"); ?>
		<table>
			<thead>
				<tr>
					<th colspan="2">Participante</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($participantes != null): ?>
					<?php foreach ($participantes as $key =>  $participante): ?>	
						<?php 
						$foto = ($participante->foto != "") ? $participante->foto : "participante.jpg" ;
						$image = 'assets/images/participantes/'.$foto; 
						if (!file_exists($image)): ?>
						<?php $image = 'assets/images/participantes/participante.jpg';  ?>
					<?php endif ?>
					<tr class='<?= ($key%2 != 0) ? "line" : "" ; ?>'>
						<td style="width: 80px;">
						<img src="<?= base_url() . $image?>" title="<?= $participante->nome ?>" alt="<?= $participante->nome ?>">
						</td>
						<td>
							<h3><?= $participante->nome ?></h3>
							<h5><?= $participante->descricao ?></h5>
							<p style="font-size: 13px;"><?= round($participante->p_like) ?>% <small>(<?= $participante->votos_like ?>) <span class="icon-like-linha"> </span></small>  | <?= round($participante->p_dislike) ?>% <small>(<?= $participante->votos_dislike ?>) <span class="icon-dislike-linha"> </span></small> | Total de votos: <?= $participante->total_votos ?></p>
						</td>
						<td> 
							<a href="<?=base_url().'editar/'.$participante->id?>/" class="editar">Editar</a>
							<button class="excluir" onclick="Excluir(<?= $participante->id; ?>)">Excluir</button>
						</td>
					</tr>
				<?php endforeach ?>		
			<?php else: ?>
				<tr>
					<td colspan="3">Não há participantes para mostrar</td>
				</tr>				
			<?php endif ?>
		</tbody>
	</table>
	<?= $paginacao ?>		
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert2@7.0.9/dist/sweetalert2.all.js" "></script>
<script type="text/javascript">
	function Excluir(participante) {
		swal({
			title: 'Deletar?',
			text: "Tem certeza de que deseja deletar este participante?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sim',
			cancelButtonText: 'Não, cancelar'
		}).then((result) => {
			if (result.value) {
				$.post( "<?= base_url() ?>/excluir", {id: participante}, function( data ) {
					if (data == "") {

						swal({
							title: 'Excluido com sucesso',
							text: 'Página será atualizada em 3 segundos...',
							timer: 3000,
							onOpen: () => {
								swal.showLoading()
							}
						}).then((result) => {
							if (result.dismiss === 'timer') {
								location.reload();
							}
						})
					}else{
						swal(
							'Oops...',
							'Erro ao tentar excluir!',
							'error'
							)
					}
				});
			}else{
				swal(
					'Oops...',
					'Erro ao tentar excluir!',
					'error'
					)
			}
		})
	}
</script>
</body>
</html>