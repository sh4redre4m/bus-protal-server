<?php
/**
* 
*/
class page_model{	
	public static function styleOne($p,$totalPage,$defaultPage,$pre,$next){
      		if($p>$totalPage){
      			return '';
      		}
      		$showPagePreNum = 4;
      		$showPageNextNum = 5;
      		if($totalPage - $p >= $showPageNextNum){
      			$endIndex = $p+$showPageNextNum;
      		}else{
      			$endIndex = $totalPage;
      			$showPagePreNum += $showPageNextNum - ($totalPage - $p);
      		}

      		if($p > $showPagePreNum){
      			$startIndex = $p - $showPagePreNum;
      		}else{
      			$startIndex = 1;
      			$showPageNextNum += $showPagePreNum - ($p - 1);

	      		if($totalPage - $p >= $showPageNextNum){
	      			$endIndex = $p+$showPageNextNum;
	      		}else{
	      			$endIndex = $totalPage;
	      		}
      		}
      		$pageStr = '';
      		if($p != 1){
      			$pageStr .= '<li><a href="'.$pre.($p-1).$next.'">&laquo;</a></li>';
      		}
      		for($i = $startIndex;$i<=$endIndex;$i++){
      			if($i==$p){
				$pageStr .= '<li><li class="active"><a href="javascript:void(0)">'.$i.'</a></li></li>';
      			}else{
      				$pageStr .= '<li><a href="'.$pre.$i.$next.'">'.$i.'</a></li>';
      			}      			
      		}
      		if($p!=$totalPage){
      			$pageStr .= '<li><a href="'.$pre.($p+1).$next.'">&raquo;</a></li>';
      		}
      		return $pageStr;
	}
}
?>