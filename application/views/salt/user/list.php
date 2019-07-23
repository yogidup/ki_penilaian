				<div style="margin: 30px;">
					<?php echo $this->session->userdata('error_message');?>
					<a href="<?php echo base_url('index.php/user/create/');?>"><button>Tambah Pengguna</button></a><br><br>
					<table class="my_table display" style="width:100%">
						<thead>
							<tr>
								<th>NIP</th>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Divisi</th>
								<th>Kelola Data</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($user_data as $item):?>
							<tr>
								<td><?php echo $item['nip'];?></td>
								<td><?php echo $item['first_name'].' '.$item['last_name'];?></td>
								<td><?php echo $item['role'];?></td>
								<td><?php echo $item['division'];?></td>
								<td>
									<a href="<?php echo base_url('index.php/user/edit_password/'.$item['id'])?>"><button onclick="edit_<?php echo $item['id'];?>()"><i class="fa fa-key"></i> Password</button></a>
									<a href="<?php echo base_url('index.php/user/edit/'.$item['id'])?>"><button onclick="edit_<?php echo $item['id'];?>()"><i class="fa fa-edit"></i> Perbarui</button></a>
									<button onclick="delete_<?php echo $item['id'];?>()"><i class="fa fa-eraser"></i> Hapus</button>
									<script>
									function delete_<?php echo $item['id'];?>() {
										Swal.fire({
										  title: 'Hapus <?php echo $item['first_name'].' '.$item['last_name'];?>?',
										  text: "Data yang sudah dihapus tidak bisa dikembalikan!",
										  type: 'warning',
										  showCancelButton: true,
										  confirmButtonColor: '#d33',
										  cancelButtonColor: '#3085d6',
										  confirmButtonText: 'Hapus!',
										  cancelButtonText: 'Tidak jadi'
										}).then((result) => {
										  if (result.value) {
											location.replace("<?php echo base_url('index.php/user/delete/'.$item['id']);?>")
										  }
										})
									}
									</script>
									<a href="<?php echo base_url('index.php/user/login_as/'.$item['id'])?>"><button onclick="edit_<?php echo $item['id'];?>()"><i class="fa fa-child"></i> Login Sebagai</button></a>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<th>NIP</th>
								<th>Nama</th>
								<th>Jabatan</th>
								<th>Divisi</th>
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
