				<div style="margin: 30px;">
					<?php echo $this->session->userdata('error_message');?>
					<a href="<?php echo base_url('index.php/role/create/');?>"><button>Tambah Jabatan</button></a><br><br>
					<table class="my_table display" style="width:100%">
						<thead>
							<tr>
								<th>Jabatan</th>
								<th>Prioritas</th>
								<th>Deskripsi</th>
								<th>Total Personil</th>
								<th>Kelola Data</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($role_data as $item):?>
							<tr>
								<td><?php echo $item['name'];?></td>
								<td><?php echo $item['priority'];?></td>
								<td><?php echo $item['description'];?></td>
								<td><?php echo $item['total_personnel'];?></td>
								<td>
									<a href="<?php echo base_url('index.php/role/edit/'.$item['id'])?>"><button onclick="edit_<?php echo $item['id'];?>()"><i class="fa fa-edit"></i> Perbarui</button></a>
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
											location.replace("<?php echo base_url('index.php/role/delete/'.$item['id']);?>")
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
								<th>Jabatan</th>
								<th>Prioritas</th>
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
