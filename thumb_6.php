<?
//그래프 정보
include '/www/module/highchart/graph_func.php';

foreach($gData as $g){
	if($g['name'] == 'xLabel'){
		$xArr = explode(',',$g['data']);
	}else{
		$dArr = explode(',',$g['data']);
		break;
	}
}

$pieColorTxt = '';		//그래프 색상
$pieDataTxt = '';		//그래프 값

$c = 0;

foreach($xArr as $k => $v){
	if($c > 0){
		$pieColorTxt .= ",";
		$pieDataTxt .= ",";
	}

	$pieColorTxt .= "'".$colorArr[$c]."'";
	$pieDataTxt .= "['".$v."',".$dArr[$c]."]";

	$c++;
}
?>

<?
	//메인페이지용
	if($mainThumb){
		$graphID = $mgNum.'thumb_'.$uid;	//그래프 ID
?>
<div id="<?=$graphID?>" style="margin:0 auto;  width: 100%; height: 100%;"></div>
<?
	//관리자 및 서브페이지용
	}else{
		$graphID = 'thumb_'.$uid;	//그래프 ID
?>
<div id="<?=$graphID?>" style="margin:0 auto;  width: 100%; height: 100%;"></div>
<?
	}
?>

<script>
$(function () {
	Highcharts.chart('<?=$graphID?>', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: ''
		},
		tooltip: {
			enabled: false
		},
		plotOptions: {
			pie: {
				size:240,
				innerSize: '0%',
				colors:[<?=$pieColorTxt?>],
				allowPointSelect: false,
				cursor: 'pointer',
				dataLabels: {
					distance: -30,
					format: '<b>{point.name}</b>',
//					format: '{y}%',
					color: '#fff',
					style: {
						fontSize:'10',
						fontWeight: 'bold',
						textOutline: '2px #666'
					}
				}
			},
			series: {
				enableMouseTracking: false
			}
		},
		stockTools: {
			gui: {
				enabled: false // disable the built-in toolbar
			}
		},
		exporting: {
			enabled: false
		},
		credits: {
			enabled: false
		},
		series: [{
			data: [<?=$pieDataTxt?>]
		}]
	});
});
</script>