				<div style="margin: 30px;">
					<h3><?php echo $object_data['first_name'].' '.$object_data['last_name'];?></h3>
					<form method="post" action="<?php echo base_url('index.php/user_report/insert/'.$object_data['id']);?>">
						<label>Periode Evaluasi : </label>
						<input type="month" name="evaluation_period">
						<input type="submit" value="Buat Laporan" />
					</form>
					<hr>
					<h5>Daftar Laporan yang Tersedia</h5>
					<?php echo $this->session->userdata('error_message');?>
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
									<a href="<?php echo base_url('index.php/user_report/do_evaluation/'.$item['id'])?>"><button onclick="edit_<?php echo $item['id'];?>()"><i class="fa fa-check"></i> Berikan Penilaian</button></a>
									<button onclick="delete_<?php echo $item['id'];?>()"><i class="fa fa-eraser"></i> Hapus</button>
									<script>
									function delete_<?php echo $item['id'];?>() {
										Swal.fire({
										  title: 'Hapus Laporan <?php echo $item['id'];?>?',
										  text: "Data yang sudah dihapus tidak bisa dikembalikan!",
										  type: 'warning',
										  showCancelButton: true,
										  confirmButtonColor: '#d33',
										  cancelButtonColor: '#3085d6',
										  confirmButtonText: 'Hapus!',
										  cancelButtonText: 'Tidak jadi'
										}).then((result) => {
										  if (result.value) {
											location.replace("<?php echo base_url('index.php/user_report/delete/'.$item['id']);?>")
										  }
										})
									}
									</script>
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
