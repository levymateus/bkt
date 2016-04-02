
<!-- primeira section -->
<section class="pull-left">
	<div class="container">
		<div class="span5">
			<table class="table table-condensed table-striped span5">
				<div>
					<div class="control-group">
						<label>
							<h2>
								<?php
								if(isset($_POST['band']))
									echo "band=".$_POST['band'];
								
								if(isset($_POST['song']))
									echo "song=".$_POST['song'];
								?>
							</h2>
						</label>
					</div>
					<?php 

						include "action/banco.class.php";

						// criar o objeto banco de dados
						$banco = new banco("127.0.0.1", "root", "", "backing");

						// conectar o banco
						$link = $banco->conectar();

						// fazer a consulta 
						if(isset($_GET['l']))
							$src = $banco->get_banda( (string) $_GET['l']);

						if(isset($_POST['src']))
							$src = $banco->procura( (string) $_POST['src']);
						var_dump($src);

						// capturar o numero total de dados da pesquisa
						$bandas = 0;
						$bandas = mysql_num_rows($src);

					?>
					<div class="control-group">
						<p>Total bands: <?php echo $bandas ?> </p>
						<p>
							<?php 
								if($bandas == 0){
							?>
							<div class='alert alert-warning' role='alert'><strong>Atention !</strong> There is no band or music with this letter ...</div>
							<?php 
								}
							?>
						</p>
					</div>
				</div>
				<?php
					
					while ($banda = mysql_fetch_object($src)) {
						var_dump($banda);
						echo "<br>";
				?>
				<tr>	
					<td>
						<a href="http://localhost/bkt/index.php?menu=control&band=<?php echo $banda->nome; ?>"><?php echo $banda->nome; ?></a>
					</td>
					<td>
						<?php 
							$num_musicas = mysql_fetch_array($banco->num_musicas_banda($banda->nome));
							echo '[ '.$num_musicas[0].' ]';
						?>
					</td>
				</tr>
				<?php  
					}

					if(!$banco->fechar_conexao($link))
						echo "erro ao fechar conexao";
				?>
			</table>
			</div>
		</div>
	</div>
	<hr>
	<p class="alert alert-info text-center"><a href="#"><strong>Can't play "song"? Improve your playing via easy step-by-step video lessons!</strong></a></p>
</section>
