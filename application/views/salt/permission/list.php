				<div style="margin: 30px;">
					<?php echo $this->session->userdata('error_message');?>
					<table class="my_table display" style="width:100%">
						<thead>
							<tr>
								<th>Jabatan</th>
								<th>Kelola Data</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($position_data as $item):?>
							<tr>
								<td><?php echo $item['role'].' '.$item['division'];?></td>
								<td>
									<a href="<?php echo base_url('index.php/permission/edit/'.$item['role_id'].'/'.$item['division_id']);?>"><button onclick="edit_<?php echo $item['role_id'];?>()"><i class="fa fa-gavel"></i> Kelola Hak Akses</button></a>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<th>Jabatan</th>
								<th>Kelola Data</th>
							</tr>
						</tfoot>
					</table>
					<script>
						$(document).ready(function() {
							$('.my_table').DataTable();
						} );
					</script>
				</div>
