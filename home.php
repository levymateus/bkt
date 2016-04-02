<section id="first-section">
	<div class="container">
		<p><h2>guitar backing tracks in the archive!</h2></p>
		<!-- conteudo -->
		<div class="span8 well">
			<h3>Welcome to <span>GuitarBackingTrack.com!</span></h3>
			<p>This page contains free guitar backing tracks (BTs) for popular songs as well as jam tracks. The backing tracks can be played onsite or downloaded in MP3 format.</p>
			<p>Please use the <a href="">contact form</a> for any feedback or questions. Use the <a href="">forum</a> for requests, comments and general chit-chat.</p>
			<p>A quick introduction to BTs can be found in <a href="">this post</a>.</p>
		</div>
		<!-- App android -->
		<div class="span3 pull-right">
			<p><h4>Get Your Android App</h4><a href="#"><img alt="Android app on Google Play" src="http://developer.android.com/images/brand/en_app_rgb_wo_45.png"></a></p>
		</div>
	</div>
</section>

<!-- segunda section -->
<section id="second-section" class="pull-left">

	<div class="container">

		<p><h2>Check out our <a href="">top submitters</a>.</h2></p>
		<div class="box span5">
			<h3>New backing tracks</h3>
			<ol>
				<?php 

					include "action/banco.class.php";

					$banco = new banco("127.0.0.1", "root", "", "backing");
					$link = $banco->conectar();// fazer conexao

					if (get_resource_type($link) == "mysql link"){
						// conexao com o banco ok
						$resultado = $banco->arquivos_recentes();
						
						for($i = 1;  $i <= 10; $i += 1){
							$obj = mysql_fetch_object( $resultado );
							$banda = mysql_fetch_array($banco->get_banda((int)$obj->idbanda));
				?>
				<li>
					<a href="http://localhost/bkt/index.php?menu=control&band=<?php echo $banda['nome']; ?>&music=<?php echo $obj->idarquivo; ?>"><?php echo $obj->nome; ?></a>
				</li>
				<?php  
						}// end for

					}else{
						// tratar erro
						echo mysql_error();
					}
				?>
			</ol>
			<a href="">More new tracks</a>
		</div>

		<div class="box span5 pull-right">
			<h3>Popular backing tracks</h3>
			<ol>
				<?php 
				$i = 0;
				$resultado = $banco->select_visualizacao();

					while($obj = mysql_fetch_object( $resultado )){

						$musica = $banco->get_arquivo( (int) $obj->idarquivo );

						$musica = mysql_fetch_object($musica);

						$banda = mysql_fetch_array($banco->get_banda( (int) $musica->idbanda ));
						
						if($i == 10) break;
				?>
				<li><a href="http://localhost/bkt/index.php?menu=control&band=<?php echo $banda[0]; ?>&music=<?php echo $obj->idarquivo; ?>" ><?php echo $musica->nome; ?></a></li>
				<?php 
						$i += 1;
					}
				?>
			</ol>
			<a href="">More top tracks</a>
		</div>

</section>