<?
//관리자 페이지에서 모달창으로 페이지를 호출한 경우
if($_GET['jQueryLoad']){
	include '../class/class.DbCon.php';

	$uid = $_GET['uid'];
}

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

$graphID = 'graph_'.$uid;	//그래프 ID
?>

<div id="<?=$graphID?>" style="margin: 0 auto; width: 95%; height:100%;"></div>

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
			pointFormat: "<b>{point.y}%</b>"
		},
		plotOptions: {
			pie: {
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
						fontSize:'12',
						fontWeight: 'bold',
						textOutline: '2px #666'
					}
				}
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