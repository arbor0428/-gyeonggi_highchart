<?
//그래프 테마색상
$gtColor = Array();
/*
$gtColor[1] = Array("#ffe257","#a0d8ff","#ffb9d3","#ffe257","#a0d8ff","#ffb9d3","#ffe257","#a0d8ff","#ffb9d3","#ffe257");
$gtColor[2] = Array("#ff8787","#f8c4b4","#bce29e","#ff8787","#f8c4b4","#bce29e","#ff8787","#f8c4b4","#bce29e","#ff8787");
$gtColor[3] = Array("#937dc2","#c689c6","#ffabe1","#ffe6f7","#8b5fa5","#937dc2","#c689c6","#ffabe1","#ffe6f7","#8b5fa5");
$gtColor[4] = Array("#0d4c92","#59c1bd","#a0e4cb","#0d4c92","#59c1bd","#a0e4cb","#0d4c92","#59c1bd","#a0e4cb","#0d4c92");
*/

$gtColor[1] = Array("#51574a","#447c69","#74c493","#8e8c6d","#e4bf80","#fbd971","#e2975d","#f19670","#e16552","#c94a53");
$gtColor[2] = Array("#e2975d","#f19670","#e16552","#c94a53","#be5168","#a34974","#993767","#65387d","#4e2472","#9163b6");
$gtColor[3] = Array("#6ce6c6","#f4a3a3","#fbd971","#f04b8d","#bfbfe8","#04ccc3","#53c5ff","#ffd698","#c7ee9b","#4489e0");
$gtColor[4] = Array("#0075e2","#06acf1","#0ce3ff","#51f0e8","#95fed0","#bbee9e","#e0de6d","#f0c17f","#ffa391","#e78166");




//그래프 정보
if($uid){
	$gArr = sqlRow("select * from ks_data where uid='".$uid."'");
	$gColor = $gArr['gColor'];			//색상
	$gmaxY = $gArr['maxY'];			//Y 최대값
	$gstepY = $gArr['stepY'];			//Y 간격

	$colorArr = $gtColor[$gColor];
	if($gmaxY)	$gmaxY = "max:".$gmaxY.",";
	if($gstepY)	$gstepY = "tickInterval:".$gstepY.",";

	//데이터값
	$gData = sqlArray("select * from ks_dataList where pid='".$uid."' order by uid");
}
?>