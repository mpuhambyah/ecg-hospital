var elem = document.documentElement;

var url = window.location.href.split('/');
if (url.includes('record')) {
	document.getElementById("btn_convert").addEventListener("click", function () {
		$.ajax({
			url: base + "data/getdataPasien/" + url[6] + "/" + url[7],
			type: 'POST',
			dataType: 'json',
			async: true,
			cache: false,
			success: function (response) {
				html2canvas(document.getElementById("html-content-holder"), {
					allowTaint: true,
					useCORS: true
				}).then(function (canvas) {
					var anchorTag = document.createElement("a");
					document.body.appendChild(anchorTag);
					document.getElementById("previewImg").appendChild(canvas);
					anchorTag.download = response.nama + "_rekaman" + url[7] + ".jpg";
					anchorTag.href = canvas.toDataURL();
					anchorTag.target = '_blank';
					anchorTag.click();
				});
				$.ajax({
					url: base + "dokter/getActivities/" + url[6] + "/" + url[7] + "/5",
					type: 'POST',
					dataType: 'json',
					async: true,
					cache: false,
					success: function (response) {
						console.log(response)
					},
					error: function (thrownError) {

					}
				});
			},
			error: function (thrownError) {
				console.log(thrownError)
			}
		});
	});

	function download() {
		$.ajax({
			url: base + "data/getdata/" + url[6] + "/" + url[7],
			type: 'POST',
			dataType: 'json',
			async: true,
			cache: false,
			success: function (response) {
				console.log(response);
				//define the heading for each row of the data  
				var csv = 'avf;avl;avr;i;ii;iii;v1;v2;v3;v4;v5;v6\n';

				//merge the data with CSV  
				response.forEach(function (row) {
					const resRow = Object.values(row);
					csv += resRow.join(';');
					csv += "\n";
				});

				var hiddenElement = document.createElement('a');
				hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
				hiddenElement.target = '_blank';

				//provide the name for the CSV file to be downloaded 
				$.ajax({
					url: base + "data/getdataPasien/" + url[6] + "/" + url[7],
					type: 'POST',
					dataType: 'json',
					async: true,
					cache: false,
					success: function (response) {
						hiddenElement.download = response.nama + "_recordAll_rekaman" + url[7] + '.csv';
						hiddenElement.click();
						$.ajax({
							url: base + "dokter/getActivities/" + url[6] + "/" + url[7] + "/1",
							type: 'POST',
							dataType: 'json',
							async: true,
							cache: false,
							success: function (response) {
								console.log(response)
							},
							error: function (thrownError) {

							}
						});
					},
					error: function (thrownError) {
						console.log(thrownError)
					}
				});
			},
			error: function (thrownError) {
				console.log(thrownError)
			}
		});
	}


	function downloadII() {
		$.ajax({
			url: base + "data/getdataII/" + url[6] + "/" + url[7],
			type: 'POST',
			dataType: 'json',
			async: true,
			cache: false,
			success: function (response) {
				console.log(response);
				//define the heading for each row of the data  
				var csv = 'ii\n';

				//merge the data with CSV  
				response.forEach(function (row) {
					const resRow = Object.values(row);
					csv += resRow.join(';');
					csv += "\n";
				});

				var hiddenElement = document.createElement('a');
				hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
				hiddenElement.target = '_blank';

				//provide the name for the CSV file to be downloaded 
				$.ajax({
					url: base + "data/getdataPasien/" + url[6] + "/" + url[7],
					type: 'POST',
					dataType: 'json',
					async: true,
					cache: false,
					success: function (response) {
						hiddenElement.download = response.nama + "_recordII_rekaman" + url[7] + '.csv';
						hiddenElement.click();
						$.ajax({
							url: base + "dokter/getActivities/" + url[6] + "/" + url[7] + "/1",
							type: 'POST',
							dataType: 'json',
							async: true,
							cache: false,
							success: function (response) {
								console.log(response)
							},
							error: function (thrownError) {

							}
						});
					},
					error: function (thrownError) {
						console.log(thrownError)
					}
				});
			},
			error: function (thrownError) {
				console.log(thrownError)
			}
		});
	}

	function openFullscreen() {
		if (elem.requestFullscreen) {
			elem.requestFullscreen();
			$('body').addClass('sidebar-mini');
			$('#FS').prop("hidden", true);
			$('#closeFS').prop("hidden", false);
			window.parent.document.body.style.zoom = 0.75;
		} else if (elem.webkitRequestFullscreen) {
			/* Safari */
			elem.webkitRequestFullscreen();
			$('body').addClass('sidebar-mini');
			window.parent.document.body.style.zoom = 0.75;
		} else if (elem.msRequestFullscreen) {
			/* IE11 */
			elem.msRequestFullscreen();
			$('body').addClass('sidebar-mini');
			window.parent.document.body.style.zoom = 0.75;
		}
	}

	function closeFullscreen() {
		if (document.exitFullscreen) {
			document.exitFullscreen();
			$('body').removeClass('sidebar-mini');
			$('#FS').prop("hidden", false);
			$('#closeFS').prop("hidden", true);
			window.parent.document.body.style.zoom = 1;
		} else if (document.webkitExitFullscreen) {
			/* Safari */
			document.webkitExitFullscreen();
			$('body').removeClass('sidebar-mini');
			window.parent.document.body.style.zoom = 1;
		} else if (document.msExitFullscreen) {
			/* IE11 */
			document.msExitFullscreen();
			$('body').removeClass('sidebar-mini');
			window.parent.document.body.style.zoom = 1;
		}
	}

	var options = {
		title: {
			text: '',
			align: 'center',
		},
		series: [{
			name: 'voltage',
			data: []
		}],
		chart: {
			type: 'area',
			stacked: false,
			height: 350,
			width: '100%',
			toolbar: {
				show: true
			},
			sparkline: {
				enabled: true
			}
		},
		dataLabels: {
			enabled: false
		},
		markers: {
			size: 0,
		},
		fill: {
			type: 'solid',
			opacity: 0,
		},
		xaxis: {
			min: undefined,
			max: 200,
			labels: {
				show: false
			},
			tooltip: {
				enabled: true
			}
		},
		yaxis: {

			labels: {
				show: false
			},
		},
		colors: ['#ff2121']
	};

	$(document).ready(function () {
		$('#check').removeAttr('hidden');
		$.ajax({
			url: base + "data/getDataRekaman/" + url[6] + "/" + url[7],
			type: 'POST',
			dataType: 'json',
			async: true,
			cache: false,
			success: function (response) {
				if (response.status == 1) {
					$('#check').removeClass('btn-secondary');
					$('#check').addClass('btn-success');
				} else {
					$('#check').removeClass('btn-success');
					$('#check').addClass('btn-secondary');
				}
			},
			error: function (thrownError) {
				console.log(thrownError)
			}
		});
	});

	function checked() {
		$.ajax({
			url: base + "dokter/checkDataRekaman/" + url[6] + "/" + url[7],
			type: 'POST',
			dataType: 'json',
			async: true,
			cache: false,
			success: function (response) {
				if (response.status == 1) {
					$('#check').removeClass('btn-secondary');
					$('#check').addClass('btn-success');
					$.ajax({
						url: base + "dokter/getActivities/" + url[6] + "/" + url[7] + "/3",
						type: 'POST',
						dataType: 'json',
						async: true,
						cache: false,
						success: function (response) {
							console.log(response)
						},
						error: function (thrownError) {

						}
					});
				} else {
					$('#check').removeClass('btn-success');
					$('#check').addClass('btn-secondary');
					$.ajax({
						url: base + "dokter/getActivities/" + url[6] + "/" + url[7] + "/5",
						type: 'POST',
						dataType: 'json',
						async: true,
						cache: false,
						success: function (response) {
							console.log(response)
						},
						error: function (thrownError) {

						}
					});
				};
			},
			error: function (thrownError) {
				console.log(thrownError)
			}
		});
	}

	var chart_i = new ApexCharts(document.querySelector("#chart_i"), options);
	var chart_ii = new ApexCharts(document.querySelector("#chart_ii"), options);
	var chart_iii = new ApexCharts(document.querySelector("#chart_iii"), options);
	var chart_avr = new ApexCharts(document.querySelector("#chart_avr"), options);
	var chart_avl = new ApexCharts(document.querySelector("#chart_avl"), options);
	var chart_avf = new ApexCharts(document.querySelector("#chart_avf"), options);
	var chart_v1 = new ApexCharts(document.querySelector("#chart_v1"), options);
	var chart_v2 = new ApexCharts(document.querySelector("#chart_v2"), options);
	var chart_v3 = new ApexCharts(document.querySelector("#chart_v3"), options);
	var chart_v4 = new ApexCharts(document.querySelector("#chart_v4"), options);
	var chart_v5 = new ApexCharts(document.querySelector("#chart_v5"), options);
	var chart_v6 = new ApexCharts(document.querySelector("#chart_v6"), options);
	var chart_ii_full = new ApexCharts(document.querySelector("#chart_ii_full"), options);

	chart_i.render();
	chart_ii.render();
	chart_iii.render();
	chart_avr.render();
	chart_avl.render();
	chart_avf.render();
	chart_v1.render();
	chart_v2.render();
	chart_v3.render();
	chart_v4.render();
	chart_v5.render();
	chart_v6.render();
	chart_ii_full.render();
	chart_i.updateOptions({
		title: {
			text: 'i'
		},
		yaxis: {
			show: false,
			min: 3,
			max: 5
		},
		xaxis: {
			min: 0,
			max: 199,
		}
	});
	chart_ii.updateOptions({
		title: {
			text: 'ii'
		},
		yaxis: {
			show: false,
			min: 0,
			max: 2
		},
		xaxis: {
			min: 0,
			max: 199,
		}
	});
	chart_iii.updateOptions({
		title: {
			text: 'iii'
		},
		yaxis: {
			show: false,
			min: -1,
			max: 1
		},
		xaxis: {
			min: 0,
			max: 199,
		}
	});
	chart_avr.updateOptions({
		title: {
			text: 'avr'
		},
		yaxis: {
			show: false,
			min: -4,
			max: -1
		},
		xaxis: {
			min: 200,
			max: 399,
		}
	});
	chart_avl.updateOptions({
		title: {
			text: 'avl'
		},
		yaxis: {
			show: false,
			min: 1,
			max: 2.5
		},
		xaxis: {
			min: 200,
			max: 399,
		}
	});
	chart_avf.updateOptions({
		title: {
			text: 'avf'
		},
		yaxis: {
			show: false,
			min: -0.5,
			max: 1.5
		},
		xaxis: {
			min: 200,
			max: 399,
		}
	});
	chart_v1.updateOptions({
		title: {
			text: 'v1'
		},
		yaxis: {
			show: false,
			min: -4,
			max: -2
		},
		xaxis: {
			min: 400,
			max: 599,
		}
	});
	chart_v2.updateOptions({
		title: {
			text: 'v2'
		},
		yaxis: {
			show: false,
			min: -3.8,
			max: -2.3
		},
		xaxis: {
			min: 400,
			max: 599,
		}
	});
	chart_v3.updateOptions({
		title: {
			text: 'v3'
		},
		yaxis: {
			show: false,
			min: -4.5,
			max: -2
		},
		xaxis: {
			min: 400,
			max: 599,
		}
	});
	chart_v4.updateOptions({
		title: {
			text: 'v4'
		},
		yaxis: {
			show: false,
			min: -5.5,
			max: -2
		},
		xaxis: {
			min: 600,
			max: 799,
		}
	});
	chart_v5.updateOptions({
		title: {
			text: 'v5'
		},
		yaxis: {
			show: false,
			min: 1,
			max: 3
		},
		xaxis: {
			min: 600,
			max: 799,
		}
	});
	chart_v6.updateOptions({
		title: {
			text: 'v6'
		},
		yaxis: {
			show: false,
			min: 5.5,
			max: 7.5
		},
		xaxis: {
			min: 600,
			max: 799,
		}
	});
	chart_ii_full.updateOptions({
		title: {
			text: 'ii'
		},
		xaxis: {
			min: 0,
			max: 799,
		},
		yaxis: {
			show: false,
			min: 0,
			max: 2,
		}

	});

	var arai = []
	$.ajax({
		url: base + "data/getdata/" + url[6] + "/" + url[7],
		type: 'POST',
		dataType: 'json',
		async: true,
		cache: false,
		success: function (response) {
			let i = response.map(({
				i
			}) => i);
			let ii = response.map(({
				ii
			}) => ii);
			let iii = response.map(({
				iii
			}) => iii);
			let avr = response.map(({
				avr
			}) => avr);
			let avl = response.map(({
				avl
			}) => avl);
			let avf = response.map(({
				avf
			}) => avf);
			let v1 = response.map(({
				v1
			}) => v1);
			let v2 = response.map(({
				v2
			}) => v2);
			let v3 = response.map(({
				v3
			}) => v3);
			let v4 = response.map(({
				v4
			}) => v4);
			let v5 = response.map(({
				v5
			}) => v5);
			let v6 = response.map(({
				v6
			}) => v6);

			i = i.slice(0, 199);
			ii_full = ii.slice(0, 799);
			ii = ii.slice(0, 199);
			iii = iii.slice(0, 199);
			avr = avr.slice(0, 399);
			avl = avl.slice(0, 399);
			avf = avf.slice(0, 399);
			v1 = v1.slice(0, 599);
			v2 = v2.slice(0, 599);
			v3 = v3.slice(0, 599);
			v4 = v4.slice(0, 799);
			v5 = v5.slice(0, 799);
			v6 = v6.slice(0, 799);


			chart_i.updateSeries([{
				name: 'voltage',
				data: i,
			}]);
			chart_ii.updateSeries([{
				name: 'voltage',
				data: ii
			}]);
			chart_iii.updateSeries([{
				name: 'voltage',
				data: iii
			}]);
			chart_avr.updateSeries([{
				name: 'voltage',
				data: avr
			}]);
			chart_avl.updateSeries([{
				name: 'voltage',
				data: avl
			}]);
			chart_avf.updateSeries([{
				name: 'voltage',
				data: avf
			}]);
			chart_v1.updateSeries([{
				name: 'voltage',
				data: v1
			}]);
			chart_v2.updateSeries([{
				name: 'voltage',
				data: v2
			}]);
			chart_v3.updateSeries([{
				name: 'voltage',
				data: v3
			}]);
			chart_v4.updateSeries([{
				name: 'voltage',
				data: v4
			}]);
			chart_v5.updateSeries([{
				name: 'voltage',
				data: v5
			}]);
			chart_v6.updateSeries([{
				name: 'voltage',
				data: v6
			}]);
			chart_ii_full.updateSeries([{
				name: 'voltage',
				data: ii_full
			}]);
		},
		error: function (thrownError) {
			console.log(thrownError)
		}
	});
}
