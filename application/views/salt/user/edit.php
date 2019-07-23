				<div style="margin: 30px;">
					<?php echo validation_errors(); ?>
					<form method="post" action="<?php echo base_url('index.php/user/update/'.$user_data['id']);?>">
						<label>Username : </label><br>
						<input type="text" name="nip" value="<?php echo $user_data['nip']?>"/><br><br>
						<label>Nama Depan : </label><br>
						<input type="text" name="first_name" value="<?php echo $user_data['first_name']?>"/><br><br>
						<label>Nama Belakang : </label><br>
						<input type="text" name="last_name" value="<?php echo $user_data['last_name']?>"/><br><br>
						<label>Jabatan : </label> 
						<select id="role" name="role_id">
						<?php foreach($role_data as $item):?>
							<?php echo '<option value="'.$item['id'].'"'.($item['id'] == $user_data['role_id'] ? 'selected' : NULL).'>'.$item['name'].'</option>'?>
						<?php endforeach;?>
						</select><br><br>
						<label>Divisi : </label> 
						<select id="division" name="division_id">
						<?php foreach($division_data as $item):?>
							<?php echo '<option value="'.$item['id'].'"'.($item['id'] == $user_data['division_id'] ? 'selected' : NULL).'>'.$item['name'].'</option>'?>
						<?php endforeach;?>
						</select><br><br>
						<input type="submit" value="Perbarui data" />
					</form>
					<br>
					<a href="<?php echo base_url('index.php/user/');?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
