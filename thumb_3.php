<?
$xAxis = '';
$itemVal = Array();

//그래프 정보
include '/www/module/highchart/graph_func.php';

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

//최대 그래프 갯수제한
$xNum = count(explode(',',$xAxis)) - 1;
if($xNum >= 10)	$xNum = 10;
?>

<?
	//메인페이지용
	if($mainThumb){
		$graphID = $mgNum.'thumb_'.$uid;	//그래프 ID
?>
<div style="padding:  30px 0; height: 230px;">
	<div id="<?=$graphID?>" style="margin:0 auto; width: 350px; height: 100%;"></div>
</div>
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
Highcharts.chart('<?=$graphID?>', {
	chart: {
		type: 'bar',
		spacingRight: 10,
		spacingLeft: 10,
		spacingBottom: 10
	},
	title: {
		text: ''
	},
	xAxis: {
		categories: [<?=$xAxis?>],
		min: 0,
		max: <?=$xNum?>,
		labels: {
			style: {
				fontSize: '10'
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
		plotLines: [{
			value: 0,
			width: 1,
			color: '#808080'
		}]
	},
	legend: {
		enabled: false
	},
	exporting: {
		enabled: false
	},
	credits: {
		enabled: false
	},
	tooltip:	{
		enabled: false
	},
	plotOptions: {
		series: {
			enableMouseTracking: false
		}
	},
	series: [<?foreach($itemVal as $g){echo $g;}?>]
});
</script>