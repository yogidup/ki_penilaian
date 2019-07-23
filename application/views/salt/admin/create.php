				<div style="margin: 30px;">
					<?php echo validation_errors(); ?>
					<form method="post" action="<?php echo base_url('index.php/admin/insert/');?>">
						<label>Username : </label><br>
						<input type="text" name="username" value="<?php echo set_value('username');?>"/><br><br>
						<label>Nama Depan : </label><br>
						<input type="text" name="first_name" value="<?php echo set_value('first_name');?>"/><br><br>
						<label>Nama Belakang : </label><br>
						<input type="text" name="last_name" value="<?php echo set_value('last_name');?>"/><br><br>
						<label>Password : </label><br>
						<input type="password" name="password" value=""/><br><br>
						<input type="submit" value="Tambah Admin" />
					</form>
					<br>
					<a href="<?php echo base_url('index.php/admin/');?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
