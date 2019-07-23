				<div style="margin: 30px;">
					<?php echo $this->session->userdata('error_message');?>
					<h3><?php echo $subject_role_data['name'].' '.$subject_division_data['name'];?></h3>
					<p><b>Tanggung jawab</b> : <?php echo $subject_role_data['description'];?></p>
					<p><b>Detail divisi</b> : <?php echo $subject_division_data['description'];?></p>
					<hr>
					<form method="post" action="<?php echo base_url('index.php/permission/update/'.$subject_role_data['name'].'/'.$subject_division_data['name']);?>">
					<?php foreach($position_data as $item):?>
						<label><?php echo $item['role'].' '.$item['division'];?></label><br>
						<?php 
							$permission_enum = array(
								'edit' => 'Kelola Laporan', 
								#'view' => 'Lihat Laporan', 
								'forbidden' => 'Terbatas'
							);
							
							foreach($permission_enum as $enum => $label):

							$condition = array(
								'subject_role_id' => $subject_role_data['id'],
								'subject_division_id' => $subject_division_data['id'],
								'object_role_id' => $item['role_id'],
								'object_division_id' => $item['division_id'],
								'permission' => $enum
							);
							
							$def_condition = array(
								'subject_role_id' => $subject_role_data['id'],
								'subject_division_id' => $subject_division_data['id'],
								'object_role_id' => $item['role_id'],
								'object_division_id' => $item['division_id']
							);
							
							if ($this->report_permission_model->num_rows($def_condition) == 0)
							{
								$is_checked = 'checked';
							}
							elseif($this->report_permission_model->num_rows($condition) == 1)
							{
								$is_checked = 'checked';
							}
							elseif ($this->report_permission_model->num_rows($condition) == 0)
							{
								$is_checked = NULL;
							}
						?>
						<input name="<?php echo $subject_role_data['id'].'|'.$subject_division_data['id'].'|'.$item['role_id'].'|'.$item['division_id'];?>" type="radio" value="<?php echo $enum;?>" <?php echo $is_checked;?>/> <?php echo $label;?>
						<?php endforeach;?>
						<br><br>
					<?php endforeach;?>
					<input type="submit" value="Perbarui Perizinan"/>
					</form>
					<br>
					<a href="<?php echo base_url('index.php/permission/');?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
				</div>
