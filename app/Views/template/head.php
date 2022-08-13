
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $tittle ?? 'Dashboard'; ?></title>
    <link rel="shortcut icon" href="/img/buleleng.png">

    <!-- Custom fonts for this template-->
    <link href="/startbootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/startbootstrap/css/sb-admin-2.min.css" rel="stylesheet">
	<script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>


	<?php
 
		$dataPoints = array();
		foreach ($tampildata as $d ) :
			array_push($dataPoints, array("label"=> $d['nama_pmks'], "y"=> $d['jumlah']));
		endforeach;
	?>
    <!-- chart -->
	<script>
		// window.onload = function () {

		// var chart = new CanvasJS.Chart("chartContainer", {
		// theme: "light1", // "light1", "light2", "dark1"
		// animationEnabled: true,
		// exportEnabled: false,
		// title: {
		// 	text: ""
		// },
		// axisX: {
		// 	margin: 15,
		// 	labelPlacement: "outside",
		// 	tickPlacement: "inside"
		// },
		// axisY2: {
		// 	title: "",
		// 	titleFontSize: 14,
		// 	includeZero: true,
		// 	suffix: "jiwa"
		// },
		// data: [{
		// 	type: "bar",
		// 	axisYType: "secondary",
		// 	yValueFormatString: "#,###.## jiwa",
		// 	indexLabel: "{y}",
		// 	// create dataPoints array from database
		// 	dataPoints:<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		// 	// [
		// 	// { label: "Sugar - Maroon 5", y: 2000 },
		// 	// { label: "Sorry - Justin Bieber", y: 2000 },
		// 	// { label: "Johny Johny Yes Papa", y: 3000 },
		// 	// { label: "Gangnam Style", y: 4000 },
		// 	// { label: "Uptown Funk", y: 5000 },
		// 	// { label: "Masha and the Bear", y: 6000 },
		// 	// { label: "See You Again", y: 7000 },
		// 	// { label: "Shape of You", y: 8000 },
		// 	// { label: "Baby Shark Dance", y: 9000 },
		// 	// { label: "Despacito", y: 10000 }
		// 	// ]
		// }]
		// });
		// chart.render();
		
		// }
		window.onload = function () {
	
			var chart = new CanvasJS.Chart("myAreaChart", {
				animationEnabled: true,
				
				title:{
					text:""
				},
				axisX:{
					interval: 1
				},
				axisY2:{
					interlacedColor: "rgba(1,77,101,.2)",
					gridColor: "rgba(1,77,101,.1)",
					title: ""
				},
				data: [{
					type: "bar",
					name: "companies",
					axisYType: "secondary",
					color: "#014D65",
					dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
					// [
					// 	{ label: "Sweden", y: 3 },
					// 	{ y: 7, label: "Taiwan" },
					// 	{ y: 5, label: "Russia" },
					// 	{ y: 9, label: "Spain" },
					// 	{ y: 7, label: "Brazil" },
					// 	{ y: 7, label: "India" },
					// 	{ y: 9, label: "Italy" },
					// 	{ y: 8, label: "Australia" },
					// 	{ y: 11, label: "Canada" },
					// 	{ y: 15, label: "South Korea" },
					// 	{ y: 12, label: "Netherlands" },
					// 	{ y: 15, label: "Switzerland" },
					// 	{ y: 25, label: "Britain" },
					// 	{ y: 28, label: "Germany" },
					// 	{ y: 29, label: "France" },
					// 	{ y: 52, label: "Japan" },
					// 	{ y: 103, label: "China" },
					// 	{ y: 134, label: "US" }
					// ]
				}]
			});
			chart.render();
			
			}

	</script>
<!-- chart -->