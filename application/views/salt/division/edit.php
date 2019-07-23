				<div style="margin: 30px;">
					<?php echo $this->session->userdata('error_message');?>
					<form method="post" action="<?php echo base_url('index.php/division/update/'.$division_data['id']);?>">
						<label>Nama Divisi : </label><br>
						<input type="text" name="name" value="<?php echo $division_data['name']?>"/><br><br>
						<label>Deskripsi : </label><br>
						<textarea rows="4" cols="60" name="description"><?php echo $division_data['description']?></textarea><br><br>
						<input type="submit" value="Perbarui data" />
					</form>
					<br>
					<a href="<?php echo base_url('index.php/division/');?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
