				<div style="margin: 30px;">
					<?php echo $this->session->userdata('error_message');?>
					<a href="<?php echo base_url('index.php/aspect/create/');?>"><button>Tambah Aspek Penilaian</button></a><br><br>
					<table class="my_table display" style="width:100%">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Tipe Penilaian</th>
								<th>Khusus Divisi</th>
								<th>Khusus Jabatan</th>
								<th>Bobot Nilai</th>
								<th>Kelola Data</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($aspect_data as $item):?>
							<tr>
								<td><?php echo $item['name'];?></td>
								<td><?php echo $item['type'];?></td>
								<td><?php echo $item['division'];?></td>
								<td><?php echo $item['role'];?></td>
								<td><?php echo $item['weight'];?></td>
								<td>
									<button onclick="edit_<?php echo $item['id'];?>()"><i class="fa fa-edit"></i> Perbarui</button>
									<script>
									function edit_<?php echo $item['id'];?>() {
									  location.replace("<?php echo base_url('index.php/aspect/edit/'.$item['id'])?>")
									}
									</script>
									<button onclick="delete_<?php echo $item['id'];?>()"><i class="fa fa-eraser"></i> Hapus</button>
									<script>
									function delete_<?php echo $item['id'];?>() {
										Swal.fire({
										  title: 'Hapus <?php echo $item['name'];?>?',
										  text: "Data yang sudah dihapus tidak bisa dikembalikan!",
										  type: 'warning',
										  showCancelButton: true,
										  confirmButtonColor: '#d33',
										  cancelButtonColor: '#3085d6',
										  confirmButtonText: 'Hapus!',
										  cancelButtonText: 'Tidak jadi'
										}).then((result) => {
										  if (result.value) {
											location.replace("<?php echo base_url('index.php/aspect/delete/'.$item['id']);?>")
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
								<th>Nama</th>
								<th>Tipe Penilaian</th>
								<th>Khusus Divisi</th>
								<th>Khusus Jabatan</th>
								<th>Bobot Nilai</th>
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
