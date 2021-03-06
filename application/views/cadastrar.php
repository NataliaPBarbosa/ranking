<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar | TopWay Ranking</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
		.input-group{
			width: 100%;
			padding: 10px 5px 10px 0;
		}
		.input-group label{
			text-align: left;
			width: 100px;
			padding: 2px 0 0 0 ;
			float: left;
		}

		.input-group input[type="text"], .input-group textarea{
			width: 300px;
			padding: 5px 15px;
			font-family: 'Montserrat', sans-serif;
		}
		.input-group textarea{
			resize: none;
		}
		.input-group .error{
			color: #e74c3c;
			font-weight: 500;
			font-size: 14px;
			text-indent: 100px;
			margin: 5px 0 0 0 ;
		}

		.cadastrar{
			border: 1px solid #ba78ff;
			color: #ba78ff;
			background-color: #fff;
			padding: 15px 20px;
			font-size: 18px;
			cursor: pointer;
			outline: none;
			width: 300px;
			margin: 0 0 0 100px ;
		}
		.cadastrar:hover, .cadastrar:focus, .cadastrar:active{
			color: #fff;
			background-color: #ba78ff;
		}

		@media(max-width: 652px){
			.content {
				background-color: #fff;
				width: 90%;
				margin: 20px auto 20px auto;
			}
			
			.input-group label,
			.input-group input,
			.input-group textarea,
			.input-group .error{
				width: 100% !important;
				float: left;
				clear: both;
				margin: 10px 0 0 0; 
				text-indent: 0px;
			}

			.input-group .cadastrar{
				width: 100% !important;
				margin: 10px 0 0 0; 
			}
		}
	</style>
</head>
<body>
	<div class="content">

		<ol class="breadcrumb">
			<li><a href="<?=base_url()?>">Votação</a> / </li>
			<li><a href="<?=base_url()?>listagem">Listagem</a> / </li>
			<li class="active">Cadastrar</li>
		</ol>

		<h1>Cadastrar Novo Participante</h1>
		<form method="post" action="" enctype=multipart/form-data>
			<div class="input-group">
				<?= $this->session->flashdata("cadastro"); ?>
			</div>
			<div class="input-group">
				<label>Imagem</label>
				<input type="file" name="foto">
				<div class="error"><?= form_error("foto"); ?>
					<?= ($mensagem != "") ? $mensagem : "" ; ?>
				</div>
			</div>
			<div class="input-group">
				<label>Nome</label>
				<input type="text" name="nome" placeholder="Nome do Participante" value="<?= set_value("nome") ?>" maxlength="50">
				<div class="error"><?= form_error("nome"); ?></div>
			</div>
			<div class="input-group">
				<label>Descrição</label>
				<textarea maxlength="100" name="descricao" placeholder="Descrição"><?= set_value("descricao") ?></textarea>
				<div class="error"><?= form_error("descricao"); ?></div>
			</div>
			<div class="input-group">
				<button class="cadastrar">Cadastrar</button>
			</div>
		</form>
	</div>

</body>
</html>