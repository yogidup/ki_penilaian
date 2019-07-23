				<div style="margin: 30px;">
					<?php echo $this->session->userdata('error_message');?>
					<table class="my_table display" style="width:100%">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Kelola Data</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($report_data as $item):?>
							<tr>
								<td><?php echo $item['object_first_name'].' '.$item['object_last_name'];?></td>
								<td><?php echo $item['object_role'].' '.$item['object_division'];?></td>
								<td>
									<button onclick="edit_<?php echo $item['object_id'];?>()"><i class="fa fa-edit"></i> Buat Laporan</button>
									<script>
									function edit_<?php echo $item['object_id'];?>() {
									  location.replace("<?php echo base_url('index.php/user_report/create/'.$item['object_id'])?>")
									}
									</script>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<th>Nama</th>
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
