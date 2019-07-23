				<div style="margin: 30px;">
					<div style="color: red;">
						<?php echo validation_errors(); ?>
					</div>
					<form method="post" action="<?php echo base_url('index.php/aspect/insert/');?>">
						<label>Aspek Penilaian : </label><br>
						<input type="text" name="name" value="<?php echo set_value('name');?>"/><br><br>
						<label>Deskripsi : </label><br>
						<textarea rows="4" cols="60" name="description"><?php echo set_value('description');?></textarea><br><br>
						<label>Tipe : </label><br>
						<input id="general" type="radio" name="type" value="umum" onclick="disableMe()" <?php echo (set_value('type') == 'umum' ? 'checked' : NULL);?>> Umum &nbsp;&nbsp;&nbsp;
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
						<input id="special" type="radio" name="type" value="khusus" onclick="enableMe()" <?php echo (set_value('type') == 'khusus' ? 'checked' : NULL);?>> Khusus<br><br>
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
						<select id="division" name="division_id">
						<?php foreach($division_data as $item):?>
							<option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
						<?php endforeach;?>
						</select><br><br>
						<label>Khusus Jabatan : </label> 
						<select id="role" name="role_id">
						<?php foreach($role_data as $item):?>
							<option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
						<?php endforeach;?>
						</select><br><br>
						<label>Bobot : </label><br>
						<input type="text" name="weight" value=""/><br><br>
						<input type="submit" value="Tambah Aspek Penilaian" />
					</form>
					<br>
					<a href="<?php echo base_url('index.php/aspect/');?>"><button onclick="aspect_index()"><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
