				<div style="margin: 30px; padding: 30px	; border: 1px solid #dddddd;">
					<table width="100%">
						<tr>
							<td width="50%">
								<h5>Detail Evaluasi</h5>
							</td>
							<td width="50%" style="text-align: right;">
								<a href="<?php echo base_url('index.php/user_evaluation/');?>"><button>Kembali</button></a>
								<input type="button" value="Print Sekarang!" onclick="printDiv('printArea')" />
							</td>
						</tr>
					</table>
				</div>
				<div style="margin: 30px; padding: 30px 60px; border: 1px solid #dddddd;" id="printArea">
					<table width="100%">
						<tr>
							<td colspan=4 style="text-align: center; text-transform: uppercase; padding-top: 30px;">
								<h1>Penilaian Bulan <?php echo $report_data['evaluation_period']?></h1>
							</td>
						</tr>
						<tr>
							<td colspan=4 style="text-align: center; text-transform: uppercase;">
								<h2>Nama : <?php echo $report_data['employe_name']?></h2>
							</td>
						</tr>
						<tr>
							<td colspan=4 style="text-align: center; text-transform: uppercase;">
								<h2>Jabatan : <?php echo $user_data['role'].' '.$user_data['division']?></h2>
							</td>
						</tr>
						<tr>
							<td colspan="4" height="30px">
							</td>
						</tr>
						<tr style="text-align: center; border-bottom: 1px solid #dddddd; padding: 10px; background-color: #dddddd;">
							<td width="40%" style="padding: 20px 0px 10px;">
								<h5>Aspek Umum</h5>
							</td>
							<td width="20%" style="padding: 20px 0px 10px;">
								<h5>Bobot</h5>
							</td>
							<td width="20%" style="padding: 20px 0px 10px;">
								<h5>Nilai</h5>
							</td>
							<td width="20%" style="padding: 20px 0px 10px;">
								<h5>Total</h5>
							</td>
						</tr>
						<?php foreach($general_evaluation_data as $item):?>
						<tr style="text-align: center; border-bottom: 1px solid #dddddd;">
							<td style="text-align: left; padding: 20px 0px 10px;">
								<h6><?php echo $item['aspect'];?></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $item['weight'];?></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $item['score'];?></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $item['total'];?></h6>
							</td>
						</tr>
						<?php endforeach;?>
						<tr>
							<td>
								<h6></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $general_total_score['total_weight'];?></h6>
							</td>
							<td>
								<h6></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $general_total_score['total_score'];?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="4" height="30px">
							</td>
						</tr>
						<tr style="text-align: center; border-bottom: 1px solid #dddddd; padding: 10px; background-color: #dddddd;">
							<td width="40%" style="padding: 20px 0px 10px;">
								<h5>Aspek Khusus</h5>
							</td>
							<td width="20%" style="padding: 20px 0px 10px;">
								<h5>Bobot</h5>
							</td>
							<td width="20%" style="padding: 20px 0px 10px;">
								<h5>Nilai</h5>
							</td>
							<td width="20%" style="padding: 20px 0px 10px;">
								<h5>Total</h5>
							</td>
						</tr>
						<?php foreach($special_evaluation_data as $item):?>
						<tr style="text-align: center; border-bottom: 1px solid #dddddd;">
							<td style="text-align: left; padding: 20px 0px 10px;">
								<h6><?php echo $item['aspect'];?></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $item['weight'];?></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $item['score'];?></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $item['total'];?></h6>
							</td>
						</tr>
						<?php endforeach;?>
						<tr>
							<td>
								<h6></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $special_total_score['total_weight'];?></h6>
							</td>
							<td>
								<h6></h6>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h6><?php echo $special_total_score['total_score'];?></h6>
							</td>
						</tr>
						<tr>
							<td colspan="4" height="30px">
							</td>
						</tr>
						<tr>
							<td style="text-align: right;">
								<h5>Total</h5>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h5><?php echo $total_score['total_weight'];?></h5>
							</td>
							<td>
								<h5></h5>
							</td>
							<td style="text-align: right; padding: 20px 0px 10px;">
								<h5><?php echo $total_score['total_score'];?></h5>
							</td>
						</tr>
						<tr>
							<td colspan="4" height="90px">
							</td>
						</tr>
						<tr>
							<td style="text-align: center; padding: 20px 0px 10px;">
								<h5>Tanda Tangan Penilai</h5>
							</td>
							<td>
								<h5></h5>
							</td>
							<td style="text-align: center; padding: 20px 0px 10px;" colspan="2">
								<h5>Tanda Tangan Karyawan</h5>
							</td>
						</tr>
						<tr>
							<td colspan="4" height="60px">
							</td>
						</tr>
						<tr>
							<td style="text-align: center; padding: 20px 0px 10px;">
								<h5>( <?php echo $report_data['evaluator_name'];?> )</h5>
							</td>
							<td>
								<h5></h5>
							</td>
							<td style="text-align: center; padding: 20px 0px 10px;" colspan="2">
								<h5>( <?php echo $report_data['employe_name'];?> )</h5>
							</td>
						</tr>
						<tr>
							<td colspan="4" height="30px">
							</td>
						</tr>
						<tr>
							<td style="text-align: center; padding: 20px 0px 10px;" colspan="4">
								<h5>Mengetahui</h5>
							</td>
						</tr>
						<tr>
							<td colspan="4" height="60px">
							</td>
						</tr>
						<tr>
							<td style="text-align: center; padding: 20px 0px 10px;" colspan="4">
								<h5>( <?php echo $report_data['approved_by'];?> )</h5>
							</td>
						</tr>
					</table>
				</div>
				<script>
					function printDiv(divName) {
						 var printContents = document.getElementById(divName).innerHTML;
						 var originalContents = document.body.innerHTML;

						 document.body.innerHTML = printContents;

						 window.print();

						 document.body.innerHTML = originalContents;
					}
				</script>
