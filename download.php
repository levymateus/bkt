<div class="play-box span6 pull-right">

	<p>
		<?php 
			$letra = substr($_GET['band'], 0, -(strlen($_GET['band'])) + 1 );
		?>
		<h5>Archive - <a href="http://localhost/bkt/index.php?menu=list&l=<?php echo $letra; ?>"><?php echo $letra; ?></a> - <a href="http://localhost/bkt/index.php?menu=control&band=<?php echo $_GET['band'];  ?>"><?php echo $_GET['band']; ?></a> - <?php if(isset($query)) echo $query['nome']; ?>
	free guitar backing track</h5>
	</p>

	<div>
		<h2 class="span6">

			<?php 
				echo $_GET['band']; 
				if(isset($query)) 
					echo " <small>".$query['nome']."</small>"; 
			?>

		</h2>

		<p class="span6">
			<?php  
				$visualizacoes = mysql_fetch_array($banco->get_visualizacao($_GET['music']));
				echo $visualizacoes['numvisualizacoes'];
			?>
			clicked times
		</p>

		<?php  

			if(!file_exists($query['local'])){

		?>

		<p class='text-danger' style='font-size: 24px;'>Sorry... file dont exists !</p>
		<a href='http://localhost/bkt/index.php?menu=contact&error=not_file'>report this problem to web master ...</a>

		<?php

			}else{

		?>

		<audio controls>

			<source src="<?php echo $query['local']; ?>" type="audio/mpeg"> 
				Seu navegador não suporta audio.
		</audio>

		<?php  

			}

		?>
		<div class="well" style="margin-top: 30px;">
	
			<label>Instruments:</label>

			<?php

				$info = $banco->get_instrumentos($_GET['music']);

				while($instr = mysql_fetch_object($info)){

					$nome_instrumento = mysql_query("select instr.nome from instr where instr.idinstr = ".$instr->idinstr );
					$nome_instrumento = mysql_fetch_array($nome_instrumento);

					echo " <span>".ucfirst($nome_instrumento['nome'])."</span>";

				}
				
				if($query['comentario'] != null){

					echo "<br><label>Comment/Description: </label> <p>".$query['comentario']."</p>";

				}

				if($query['chave'] != null){

					echo "<br><label>Key: </label> ".$query['chave'];

				}


			?>

			<p><a href="#">Customize this track</a> | <a href="">Help</a></p><hr>

			<p>
				<a class="btn btn-primary" href="<?php if(file_exists( $query['local']) ) echo $query['local']; ?>" <?php if(file_exists( $query['local']) ) echo "download"; ?> ><span class="glyphicon glyphicon-save"></span> Download this backing track as MP3</a>
			</p>

			<p>Bad track? <a href="#">Report to moderator</a></p>

		</div>

	</div>	

</div> <!-- end dowload -->