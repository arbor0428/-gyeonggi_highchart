<?
//관리자 페이지에서 모달창으로 페이지를 호출한 경우
if($_GET['jQueryLoad']){
	include '../class/class.DbCon.php';

	$uid = $_GET['uid'];
}

$xAxis = '';
$itemVal = Array();

//그래프 정보
include '/module/highchart/graph_func.php';

$c = 0;
foreach($gData as $g){
	//첫번째 레코드는 x축 라벨로 사용 ('가평군','고양시','과천시'....)
	if($g['name'] == 'xLabel'){
		$xAxis = "'".str_replace(",","','",$g['data'])."'";

	//두번째 레코드부터는 그래프 데이터로 사용
	}else{
		if($c == 0)	$str = '';
		else			$str = ",";

		$str .= "{name:'".$g['name']."',";
		$str .= "data:[".$g['data']."],";
		$str .= "color:'".$colorArr[$c]."'}";

		$itemVal[$c] = $str;

		$c++;
	}
}

$graphID = 'graph_'.$uid;	//그래프 ID
?>

<div id="<?=$graphID?>" style="margin: 0 auto; width: 95%;"></div>

<script>
Highcharts.setOptions({
	lang: {
		thousandsSep: ','
	}
});

Highcharts.chart('<?=$graphID?>', {
	chart: {
		type: 'column',
		height: 600,
		spacingRight: 10,
		spacingLeft: 10,
		spacingBottom: 10
	},
	title: {
		text: ''
	},
	xAxis: {
		categories: [<?=$xAxis?>],
		labels: {
			style: {
				fontSize: '14'
			}
		}
	},
	yAxis: {
		title: {
			text: ''
		},
		<?=$gmaxY?>
		<?=$gstepY?>
		labels: {
			style: {
				fontSize: '10'
			}
		},
		reversedStacks: false,  // 순서 위 아래 바꾸는 옵션
		plotLines: [{
			value: 0,
			width: 1,
			color: '#808080'
		}]
	},
	plotOptions: {
		column: {
			stacking: 'normal'
		}
	},
	legend: {
		enabled: true
	},
	exporting: {
		enabled: false
	},
	credits: {
		enabled: false
	},
	series: [<?foreach($itemVal as $g){echo $g;}?>]
});
</script>