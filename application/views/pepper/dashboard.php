				<div style="font-size: 18px;">
					<p>RESERVED</p>
					<canvas id="myChart" width="400" height="100"></canvas>
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
							label: 'Nilai Bulanan',
							backgroundColor: 'rgba(23, 162, 184, 1)',
							borderColor: 'rgba(23, 162, 184, 1)',
							data: values,
							borderWidth: 4,
							pointRadius: 7,
							fill: false,
						}]
					}
				});
				</script>
