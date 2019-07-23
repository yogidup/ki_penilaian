				<div style="margin: 30px;">
					<table class="my_table display" style="width:100%">
						<thead>
							<tr>
								<th>Periode Evaluasi</th>
								<th>ID Laporan</th>
								<th>Nama Karyawan</th>
								<th>Evaluator</th>
								<th>Disetujui Oleh</th>
								<th>Disetujui Tanggal</th>
								<th>Total Skor</th>
								<th>Kelola Data</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($report_data as $item):?>
							<tr>
								<td><?php echo $item['evaluation_period'];?></td>
								<td><?php echo $item['id'];?></td>
								<td><?php echo $item['employe_name'];?></td>
								<td><?php echo $item['evaluator_name'];?></td>
								<td><?php echo $item['approved_by'];?></td>
								<td><?php echo $item['approval_date'];?></td>
								<td><?php echo $this->evaluation_model->get_total_score(array('report_id' => $item['id']))->row_array()['total_score'];?></td>
								<td>
									<a href="<?php echo base_url('index.php/user_evaluation/detail/'.$item['id'])?>"><button onclick="edit_<?php echo $item['id'];?>()"><i class="fa fa-info"></i> Lihat Evaluasi</button></a>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<th>Periode Evaluasi</th>
								<th>ID Laporan</th>
								<th>Nama Karyawan</th>
								<th>Evaluator</th>
								<th>Disetujui Oleh</th>
								<th>Disetujui Tanggal</th>
								<th>Total Skor</th>
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
