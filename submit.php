<section>
		<?php
			// fazer o upload e cadastrar o arquivo no banco de dados

			include "action/arquivo.php";
			include "action/banco.class.php";

			$inputBand = $inputSong = $inputName = $inputEmail = $inputKey = $inputComment = $inputFile = null;
			$errorBand = $errorSong = $errorName = $errorEmail = $errorKey = $errorComment = $errorFile = $errorCheck = null;

			$banco = new banco("127.0.0.1", "root", "", "backing");
			$file = new arquivo();
			$file->inserir_instrumentos();// capturar os instrumentos selecionados

			if($_SERVER["REQUEST_METHOD"] == "POST"){

				if(file_exists($file->path_server))
					$errorFile = "File exists";

				if($file->tipo != "mp3")
					$errorFile = "File is not mp3";

				if($_FILES["inputFile"]["error"] == UPLOAD_ERR_NO_FILE)// arquivo nao selecionado
					$errorFile = "No file selected";
				
				// O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML. 
				if($_FILES["inputFile"]["error"] == UPLOAD_ERR_FORM_SIZE)
					$errorFile = "File exceeds 8 MegaBytes";

				if($_POST["inputBand"] == ''){

					$errorBand = "Band is required";

				}else{

					$inputBand = test_input($_POST["inputBand"]);

				  // check if band only contains letters and whitespace
				  if (!preg_match("/^[a-zA-Z ]*$/",$inputBand)) 
				      $errorBand = "Only letters and white space allowed in band";

			  }
				
				if($_POST["inputSong"] == ''){

					$errorSong = "Song is required";

				}else{

					$inputSong = test_input($_POST["inputSong"]);

					if(!preg_match("/^[a-zA-Z ]*$/", $inputSong))
						$errorSong = "Only letters and white space allowed in song";

				}

				if($_POST["inputName"] != ''){
					$inputName = test_input($_POST["inputName"]);
			    // check if e-mail address is well-formed
			    if (!preg_match("/^[a-zA-Z ]*$/",$inputBand)) 
				    $errorName = "Only letters and white space allowed in name";
				}else{

					$inputName = null;

				}

				if($_POST["inputEmail"] != ''){
					$inputEmail = test_input($_POST["inputEmail"]);
			    if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
			      $emailErr = "Invalid email format";
			    }
				}else{

					$inputEmail = null;

				}

				if($_POST["inputComment"] != ''){
					$inputComment = test_input($_POST["inputComment"]);
			    if (!preg_match("/^[a-zA-Z ]*$/",$inputComment)) 
				    $errorComment = "Only letters and white space allowed in comment";
				}else{

					$inputComment = null;

				}

				if($_POST["inputKey"] != ''){
					$inputKey = test_input($_POST["inputKey"]);
			    if (!preg_match("/^[a-zA-Z ]*$/",$inputKey)) 
				    $errorKey = "Only letters and white space allowed in key";
				}else{

					$inputKey = null;

				}

				#var_dump($file->instrumentos);

				if($file->instrumentos['bass'] == null && $file->instrumentos['drums'] == null &&
					$file->instrumentos['vocals'] == null && $file->instrumentos['lead'] == null &&
					$file->instrumentos['rhythm'] == null && $file->instrumentos['keys'] == null){

					$errorCheck = "It is necessary to select at least one instrument";

				}


			}

			if(empty($errorBand) && empty($errorSong) && empty($errorFile) && empty($errorCheck)){


				if($file->upload()){

					$upload = $banco->cadastrar_upload_banco($file);

					if($banco->fechar_conexao($upload["link"]))
						$uploadError = $upload["erro"];// erro correspondente ao mysql
					else
						$uploadError = $upload["erro"];// erro correspondente ao mysql

				}

				$uploadError = $file->error;// erro correspondente a $_FILES
				echo $uploadError;

			}

			function test_input($data) {
			    $data = trim($data);
			    $data = stripslashes($data);
			    $data = htmlspecialchars($data);
			    return $data;
			}

		?>

		<div class="span6">
			<h2>Submit backing track</h2>
			<p><span class="label label-info">Note:</span> This form is <strong><span>not</span> for requesting tracks</strong>.<br> Please use the <a href="#">forum</a> if you want a backing track that we don't have.</p>
			<div class="paragraph span6">
				<p class="text-center">If you have many tracks, you can send them by e-mail to:<br> 
				<strong>webmaster {at} guitarbackingtrack.com</strong></p>
			</div>
			<div class="paragraph span6">
				<p class="text-center">Or use the attachment feature on the forum to upload tracks.<br> 
				You can find instructions <a href="">here</a>.</p>
			</div>	
		</div>
		<div class="span4">

			<form class="form form-horizontal span4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?menu=".$_GET['menu'];?>" method="post" enctype="multipart/form-data">
				<?php 
					if(isset($uploadError))
						echo 
						"<div class='alert alert-success' role='alert'>
							Upload success 
						</div>";
				?>
				<div class="form-group <?php if($errorBand != null) echo "has-error"; else if($inputBand != null) echo "has-success"; ?>">
					<label class="control-label" for="inputBand">Artist/band name:</label>
					<input type="text" class="form-control" id="inputBand" name="inputBand" value="<?php echo $inputBand; ?>">
					<span id="inputBand" class="help-block"><?php if($errorBand != null) echo $errorBand ?></span>
				</div>

				<div class="form-group <?php if($errorSong != null) echo "has-error"; else if($inputSong != null) echo "has-success"; ?>">
					<label class="control-label" for="inputSong">Song name:</label>
					<input type="text" class="form-control" id="inputSong" name="inputSong" value="<?php echo $inputSong; ?>">
					<span id="inputSong" class="help-block"><?php if($errorSong != null) echo $errorSong ?></span>
				</div>

				<div class="form-group">
					<label class="control-label" for="inputName">Author/submitter name <span class="text-info">(optional)</span>:</label>
					<input type="text" class="form-control" id="inputName" name="inputName" value="<?php echo $inputName; ?>">
				</div>

				<div class="form-group">
					<label class="control-label" for="inputEmail">Your E-mail address <span class="text-info">(optional)</span>:</label>
					<input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?php echo $inputEmail; ?>">
				</div>

				<div class="form-group <?php if($errorFile != null) echo "has-error"; ?>">
					<label class="control-label">MP3 File:
						<span><?php if($errorFile != null) echo $errorFile; ?></span>
					</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
					<input type="file" class="" id="inputFile" name="inputFile" ><br>
					<p class="help-block"><strong>Only MP3 format accepted for now.</strong></p>
				</div>

				<div class="form-group">
					<label class="control-label" for="textarea">Comments:</label>
					<textarea class="form-control" id="textarea" name="inputComment" rows="3" placeHolder="Comment"></textarea>
				</div>

				<div class="form-group <?php if($errorCheck != null) echo "has-error"; ?>">
					<label class="control-label">Please specify the instruments included:</label>
					<span id="" class="help-block"><?php if($errorCheck != null) echo $errorCheck; ?></span>
					<div class="checkbox">
						<label class="checkbox">
							<input type="checkbox" id="inlineCheckbox1" value="Bass" name="bass" <?php if($file->instrumentos['bass'] == true) echo "checked"; ?> > Bass 
						</label>
						<label class="checkbox">
							<input type="checkbox" id="inlineCheckbox2" value="Drums" name="drums" <?php if($file->instrumentos['drums'] == true) echo "checked"; ?> > Drums  
						</label>
						<label class="checkbox">
							<input type="checkbox" id="inlineCheckbox3" value="Volcas" name="vocals" <?php if($file->instrumentos['vocals'] == true) echo "checked"; ?> > Vocals  
						</label>
						<label class="checkbox">
							<input type="checkbox" id="inlineCheckbox4" value="Lead" name="lead" <?php if($file->instrumentos['lead'] == true) echo "checked"; ?> > Lead   
						</label>
						<label class="checkbox">
							<input type="checkbox" id="inlineCheckbox5" value="Rhythm" name="rhythm" <?php if($file->instrumentos['rhythm'] == true) echo "checked"; ?> > Rhythm   
						</label>
						<label class="checkbox">
							<input type="checkbox" id="inlineCheckbox6" value="Keys" name="keys" <?php if($file->instrumentos['keys'] == true) echo "checked"; ?> > Keys   
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="inputKey">Which key is the track in? <span class="text-info">(optional)</span></label>
					<input type="text" class="form-control" id="inputKey" name="inputKey" value="<?php echo $inputKey; ?>">
				</div>
				<input type="submit" class="btn btn-primary" value="Submit the track">
			</form>
		</div>
	</div>
</section>

