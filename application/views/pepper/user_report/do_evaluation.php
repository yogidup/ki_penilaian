				<div style="margin: 30px;">
					<h3><?php echo $report_data['employe_name'];?></h3>
					<h5>Periode Penilaian : <?php echo $report_data['evaluation_period'];?></h5>
					
					<table>
						<tr>
							<td>
								<form method="post" action="<?php echo base_url('index.php/user_report/submit_evaluation/'.$report_data['id']);?>">
									<h5>Penilaian Umum</h5>
									<?php 
										foreach($general_aspect_data as $item):
										$evaluation_data = $this->evaluation_model->select_where(array('report_id' => $report_data['id'], 'aspect_id' => $item['id']))->row_array();
										$score = ($evaluation_data['score'] ? $evaluation_data['score'] : NULL);
									?>
										<label><?php echo $item['name'].' (Bobot '.$item['weight'].')';?></label><br>
										<input type="number" step=".01" name="<?php echo $item['id'];?>" value="<?php echo $score;?>" <?php echo ($report_data['is_approved'] == TRUE ? 'disabled' : FALSE);?> required/><br><br>
									<?php endforeach;?>
									<h5>Penilaian Khusus</h5>
									<?php 
										foreach($special_aspect_data as $item):
										$evaluation_data = $this->evaluation_model->select_where(array('report_id' => $report_data['id'], 'aspect_id' => $item['id']))->row_array();
										$score = ($evaluation_data['score'] ? $evaluation_data['score'] : NULL);
									?>
										<label><?php echo $item['name'].' (Bobot '.$item['weight'].')';?></label><br>
										<input type="number" step=".01" name="<?php echo $item['id'];?>" value="<?php echo $score;?>" <?php echo ($report_data['is_approved'] == TRUE ? 'disabled' : FALSE);?> required/><br><br>
									<?php endforeach;?>
									<?php if($report_data['is_approved'] == FALSE):?>
									<input type="submit" value="Simpan"/><br><br>
									<?php endif;?>
								</form>
								<?php if($user_data['priority'] == 1):?>
									<a href="<?php echo base_url('index.php/user_report/approve_report/'.$report_data['id']);?>"><button><i class="fa fa-check"></i> Setujui Laporan</button></a><br><br>
								<?php endif;?>
								<a href="<?php echo base_url('index.php/user_report/create/'.$report_data['employe_id']);?>"><button><i class="fa fa-plane"></i> Kembali</button></a>
							</div>
							</td>
							<td style="padding: 20px;" valign="top">
								<h1>asdjhasjkdhkajsd</h1>
							</td>
						</tr>
					</table>
