				<div style="margin: 30px;">
					<div style="color: red;">
						<?php echo validation_errors(); ?>
					</div>
					<form method="post" action="<?php echo base_url('index.php/aspect/update/'.$aspect_data['id']);?>">
						<label>Aspek Penilaian : </label><br>
						<input type="text" name="name" value="<?php echo $aspect_data['name']?>"/><br><br>
						<label>Deskripsi : </label><br>
						<textarea rows="4" cols="60" name="description"><?php echo $aspect_data['description']?></textarea><br><br>
						<label>Tipe : </label><br>
						<input id="general" type="radio" name="type" value="umum" <?php echo ($aspect_data['type'] == 'umum' ? 'checked' : NULL);?> onclick="disableMe()"> Umum &nbsp;&nbsp;&nbsp;
						<script>
						function disableMe() {
							var x = document.getElementById("general");
							if(x.checked == true)
							{
								document.getElementById('division').setAttribute("disabled", "disabled");
								document.getElementById('role').setAttribute("disabled", "disabled");
							}
						}
						</script>
						<input id="special" type="radio" name="type" value="khusus" <?php echo ($aspect_data['type'] == 'khusus' ? 'checked' : NULL);?> onclick="enableMe()"> Khusus<br><br>
						<script>
						function enableMe() {
							var x = document.getElementById("special");
							if(x.checked == true)
							{
								document.getElementById('division').removeAttribute("disabled");
								document.getElementById('role').removeAttribute("disabled");
							}
						}
						</script>
						<label>Khusus Divisi : </label> 
						<select id="division" name="division_id" <?php echo ($aspect_data['type'] == 'umum' ? 'disabled' : NULL);?>>
						<?php foreach($division_data as $item):?>
							<?php echo '<option value="'.$item['id'].'"'.($item['id'] == $aspect_data['division_id'] ? 'selected' : NULL).'>'.$item['name'].'</option>'?>
						<?php endforeach;?>
						</select><br><br>
						<label>Khusus Jabatan : </label> 
						<select id="role" name="role_id" <?php echo ($aspect_data['type'] == 'umum' ? 'disabled' : NULL);?>>
						<?php foreach($role_data as $item):?>
							<?php echo '<option value="'.$item['id'].'"'.($item['id'] == $aspect_data['role_id'] ? 'selected' : NULL).'>'.$item['name'].'</option>'?>
						<?php endforeach;?>
						</select><br><br>
						<label>Bobot : </label><br>
						<input type="text" name="weight" value="<?php echo $aspect_data['weight']?>"/><br><br>
						<input type="submit" value="Perbarui data" />
					</form>
					<br>
					<a href="<?php echo base_url('index.php/aspect/');?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
