				<div style="margin: 30px;">
					<?php echo $this->session->userdata('error_message');?>
					<a href="<?php echo base_url('index.php/division/create/');?>"><button>Tambah Divisi</button></a><br><br>
					<table class="my_table display" style="width:100%">
						<thead>
							<tr>
								<th>Nama Divisi</th>
								<th>Deskripsi</th>
								<th>Total Personil</th>
								<th>Kelola Data</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($division_data as $item):?>
							<tr>
								<td><?php echo $item['name'];?></td>
								<td><?php echo $item['description'];?></td>
								<td><?php echo $item['total_personnel'];?></td>
								<td>
									<button onclick="edit_<?php echo $item['id'];?>()"><i class="fa fa-edit"></i> Perbarui</button>
									<script>
									function edit_<?php echo $item['id'];?>() {
									  location.replace("<?php echo base_url('index.php/division/edit/'.$item['id'])?>")
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
											location.replace("<?php echo base_url('index.php/division/delete/'.$item['id']);?>")
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
								<th>Nama Divisi</th>
								<th>Deskripsi</th>
								<th>Total Personil</th>
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
