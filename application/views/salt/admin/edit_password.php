				<div style="margin: 30px;">
					<?php echo validation_errors(); ?>
					<p><?php echo $admin_data['first_name'].' '.$admin_data['last_name']; ?></p>
					<form method="post" action="<?php echo base_url('index.php/admin/update_password/'.$admin_data['id']);?>">
						<label>Password : </label><br>
						<input type="password" name="password" value=""/><br><br>
						<label>Konfirmasi Password : </label><br>
						<input type="password" name="passconf" value=""/><br><br>
						<input type="submit" value="Ganti Password" />
					</form>
					<br>
					<a href="<?php echo base_url('index.php/admin/');?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
