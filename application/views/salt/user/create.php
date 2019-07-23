				<div style="margin: 30px;">
					<?php echo validation_errors(); ?>
					<form method="post" action="<?php echo base_url('index.php/user/insert/');?>">
						<label>NIP : </label><br>
						<input type="text" name="nip" value="<?php echo set_value('nip');?>"/><br><br>
						<label>Nama Depan : </label><br>
						<input type="text" name="first_name" value="<?php echo set_value('first_name');?>"/><br><br>
						<label>Nama Belakang : </label><br>
						<input type="text" name="last_name" value="<?php echo set_value('last_name');?>"/><br><br>
						<label>Jabatan : </label>
						<select id="role" name="role_id">
						<?php foreach($role_data as $item):?>
							<option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
						<?php endforeach;?>
						</select><br><br>
						<label>Divisi : </label>
						<select id="division" name="division_id">
						<?php foreach($division_data as $item):?>
							<option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
						<?php endforeach;?>
						</select><br><br>
						<label>Password : </label><br>
						<input type="password" name="password" value=""/><br><br>
						<input type="submit" value="Tambah Pengguna" />
					</form>
					<br>
					<a href="<?php echo base_url('index.php/user/');?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
