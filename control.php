
<!-- primeira section -->
<section class="pull-left">
	<div class="container">
		<div class="span5">
			<table class="table table-condensed table-striped span5">
				<div>
					<div class="control-group">
						<label class=""><h2><?php echo $_GET['band'] ?></h2></label>
					</div>
				
				</div>
				<?php  

					include "action/banco.class.php";

					// criar o objeto banco de dados
					$banco = new banco("127.0.0.1", "root", "", "backing");

					// conectar o banco
					$link = $banco->conectar();

					// fazer a consulta de todas as bandas na base de dados
					$query_songs = $banco->get_arquivo($_GET['band']);

					// capturar o numero total de dados da pesquisa
					$songs = mysql_num_rows($query_songs);

					if(isset($_GET['music'])){
						$query = $banco->get_arquivo( (int) $_GET['music']);
						$query = mysql_fetch_assoc($query);
					}

					while($song = mysql_fetch_object($query_songs)){
						
				?>
				<tr>
					<td><a href="http://localhost/bkt/index.php?menu=control&band=<?php echo $_GET['band'] ?>&music=<?php echo $song->idarquivo; ?>"><?php echo $song->nome ?></a></td>
					<td>
						<?php 

							$info = $banco->get_instrumentos( $song->idarquivo );
							while($instr = mysql_fetch_object($info)){

								$nome_instrumento = mysql_query("select instr.nome from instr where instr.idinstr = ".$instr->idinstr );
								$nome_instrumento = mysql_fetch_array($nome_instrumento);

						?>
						<small> <?php echo ucfirst($nome_instrumento['nome']); ?> </small>
						<?php  
							}
						?>
					</td>
				</tr>
				<?php  
					}
				?>
			</table>
		</div>
		<?php  
			if(isset($_GET['music'])){
				include "download.php";
				$banco->incrementa_visualizacao($_GET['music']);// incrementa o numero de clicks deste arquivo 
			}
		?>
	</div>
	<hr>
	<p class="alert alert-info text-center"><a href="#"><strong>Can't play "song"? Improve your playing via easy step-by-step video lessons!</strong></a></p>
</section>
<!-- tab no songster -->
<div class="tab-song span12">
	<div class="container">
		<a style="display: block; width: 728px; height: 90px; background-image: url('http://s3.amazonaws.com/images.tirbojn.com/728x90_animation.gif'); font-family: Tahoma; font-size: 15px; color: #055bc9; font-weight: normal; text-decoration: none; margin: auto;" href="http://adclick.g.doubleclick.net/aclk%253Fsa%253DL%2526ai%253DB8OxMsc26U8vQE_TX0AGQooHYB-6s54QCAAAAEAEgka33ATgAWOb00IIZYM3I5oCYA7IBGnd3dy5ndWl0YXJiYWNraW5ndHJhY2suY29tugEJZ2ZwX2ltYWdlyAEJ2gFKaHR0cDovL3d3dy5ndWl0YXJiYWNraW5ndHJhY2suY29tL3BsYXkvb3Nib3VybmUsX296enkvYmFya19hdF90aGVfbW9vbi5odG2pAjIt20cuxIU-wAIC4AIA6gINTGVhZGVyUGxheUdCVPgC_9EegAMBkAOcBJgDyAaoAwHgBAGgBhY%2526num%253D0%2526sig%253DAOD64_2qvx4LmwIvPXPO4BO-2UMviW_ANg%2526client%253Dca-pub-5466549699047272%2526adurl%253Dhttp://www.songsterr.com/a/wa/bestMatchForQueryString?s=Bark At The Moon&amp;a=Ozzy Osbourne" target="_blank">
		<div style="margin:0 auto; padding-top:7px; width:700px; overflow: hidden; text-align: center; overflow: hidden; white-space: nowrap;">Band - Song Tab</div></a>
	</div>
</div>