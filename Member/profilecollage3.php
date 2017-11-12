<?php
set_time_limit(0);

        $str=0;
	$strchk="";
	$size21=0; $size31=0; $size41=0; $size22=0; $size32=0; $size42=0; $size23=0; $size33=0;
	$size43=0; $size24=0; $size34=0; $size25=0; $size35=0; 
	$size36=0; $size37=0; $size38=0; $size39=0; $size310=0; 
	$size26=0; $size27=0; $size28=0; $size29=0; $size210=0;
	$strchk="o,";
	$cnt=0;

        $maxrows=4;
        $maxcols=18;
        /*if($mrows==0 && $mcols==0)
        {
            $maxrows=11;
            $maxcols=26;
        }
        else
        {
            $maxrows=$mrows;
            $maxcols=$mcols;
        }*/
$cnt=0;
	do
        {
        $cnt=$cnt+1;
		$str=(int)((rand(1,75)));
                //echo "1str:".$str;
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) )
                {
			$size21=$str;
			$strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
			break;
                }
                if ($cnt==50)
                {
                $size21=0;
                break;
                }
        }while(1);
	do
        {
		$str=(int)((rand(1,75)));
                //echo "2str:".$str;
		if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk, "," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
                {
			$size31=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
        }while(1);


	do
        {
		$str=(int)((rand(1,75)));
                if($str < ((($maxrows-1)*$maxcols)+1) && ($str % $maxcols) <> 0 && (int)strpos($strchk,"," . strval((int)$str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
                {
			$size41=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
        }while(1);


	do{
		$str=(int)((rand(1,75)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size22=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
                {
			$size32=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size42=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size23=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size33=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size43=$str;
			$strchk=$strchk . strval($str). "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));
		if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size24=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size34=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	
	do{
		$str=(int)((rand(1,75)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size25=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));

                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size35=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	
	do{
		$str=(int)((rand(1,75)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size26=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));

		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size36=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	
	do{
		$str=(int)((rand(1,75)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size27=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));

		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 )
		{
                        $size37=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	

	do{
		$str=(int)((rand(1,75)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size28=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,75)));
		if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size38=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	

	do{
		$str=(int)((rand(1,75)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size29=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);
	//Response.Write(size21 & "<br>" & size31 & "<br>" & size41 & "<br>" & size5 & "<br>" & size22 & "<br>" & size32 & "<br>" & size42 & "<br>" & size23 & "<br>" & size33 & "<br>" & size43 & "<br>" & size24 & "<br>" & size34 & "<br>" & size44 & "<br>" & $strchk)

        do{
            $str=(int)((rand(1,75)));
            if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
            {
                    $size39=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                break;
            }
        }while(1);

        do{
            $str=(int)((rand(1,75)));
            if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
            {
                $size210=$str;
                $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                break;
            }
        }while(1);

        do{
                $str=(int)((rand(1,75)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size310=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        

        $output="<table  class='collageimagetableborder' border='1' cellspacing='0'>";
        $cnt=0;
        $index=0;
        for($i=1;$i<=$maxrows;$i++)
        {
            $output.="<tr>";
            for($j=1;$j<=$maxcols;$j++)
            {
                $cnt=$cnt+1;
                if( $cnt == $size21 || $cnt == $size22 || $cnt == $size23 || $cnt == $size24 || $cnt == $size25 || $cnt == $size26 || $cnt == $size27 || $cnt == $size28 || $cnt == $size29 || $cnt == $size210)
                {
                    $output.="<td colspan='2' width='30px' height='30px' valign='top'>&nbsp;</td>";
                    
                }
                if( $cnt == $size31 || $cnt == $size32 || $cnt == $size33 || $cnt == $size34 || $cnt == $size35 || $cnt == $size36 || $cnt == $size37 || $cnt == $size38 || $cnt == $size39 || $cnt == $size310)
                {
                    $output.="<td rowspan='2'  width='30px' height='30px' valign='top'>&nbsp;</td>";                    
                }
                if( $cnt == $size41 || $cnt == $size42 || $cnt == $size43)
                {
                    $output.="<td colspan='2' rowspan='2'  width='30px' height='30px' valign='top'>&nbsp;</td>";
                    
                }
                if( (int)strpos( $strchk, "," . strval($cnt) . ",")>0)
                {

                }
                else
                {
                    $output.="<td  width='30px' height='30px' valign='top'>&nbsp;</td>";

                    //$output.="</td>";
                    //$index++;
                }
           }
           $output.="</tr>";
        }
        $output.="</table>";

        echo $output;

?>