				<div style="margin: 30px;">
					<?php echo $this->session->userdata('error_message');?>
					<form method="post" action="<?php echo base_url('index.php/role/insert/');?>">
						<label>Nama Jabatan : </label><br>
						<input type="text" name="name" value=""/><br><br>
						<label>Prioritas : </label><br>
						<input type="text" name="priority" value=""/><br><br>
						<label>Deskripsi : </label><br>
						<textarea rows="4" cols="60" name="description"></textarea><br><br>
						<input type="submit" value="Tambah Jabatan" />
					</form>
					<br>
					<a href="<?php echo base_url('index.php/role/');?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
