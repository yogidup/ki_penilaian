				<div style="margin: 30px;">
					<?php echo validation_errors(); ?>
					<form method="post" action="<?php echo base_url('index.php/admin/update/'.$admin_data['id']);?>">
						<label>Username : </label><br>
						<input type="text" name="username" value="<?php echo $admin_data['username']?>"/><br><br>
						<label>Nama Depan : </label><br>
						<input type="text" name="first_name" value="<?php echo $admin_data['first_name']?>"/><br><br>
						<label>Nama Belakang : </label><br>
						<input type="text" name="last_name" value="<?php echo $admin_data['last_name']?>"/><br><br>
						<input type="submit" value="Perbarui data" />
					</form>
					<br>
					<a href="<?php echo base_url('index.php/admin/');?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
