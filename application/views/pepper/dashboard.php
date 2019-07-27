				<div style="font-size: 18px;">
					<p>Nilai Evaluasi 6 Bulan Terakhir</p>
					<canvas id="myChart" width="auto" height="auto"></canvas>
				</div>

				<script type="text/javascript">
				var ar = <?php echo json_encode($report_data)?>;
				
				var labels = ar.map(function(e){
					return e.evaluation_period
				});
				
				var values = ar.map(function(e){
					return e.total_score
				});

				var ctx = document.getElementById('myChart');
				var myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: labels,
						datasets: [{
							label: 'Total Nilai',
							backgroundColor: 'rgba(23, 162, 184, 0.5)',
							borderColor: 'rgba(23, 162, 184, 1)',
							data: values,
							borderWidth: 1,
							pointRadius: 2,
							fill: true,
						}]
					}
				});
				</script>
