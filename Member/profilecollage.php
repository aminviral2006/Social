<?php
set_time_limit(0);
include_once 'commoninclude.php';
$objPlTotalStuff = new PlStuff();
$membersTotalStuff = $objPlTotalStuff->PlTotalStuffOfMember(30);
echo $membersTotalStuff;

$collagememberid = 30;
/*if (isset($_REQUEST['profileid']))
    $collagememberid = $_REQUEST['profileid'];
else
    $collagememberid=$_REQUEST['id'];*/
$objPlStuff = new PlStuff();
//$membersCollage = $objPlStuff->PlShowCollageOnHome(165);
$membersCollage=$objPlStuff->PlShowCollageOnMemberProfile(80, $collagememberid);
echo $membersCollage;
?>
<?php
        $str=0;
	$strchk="";
	$size21=0; $size31=0; $size41=0; $size5=0; $size22=0; $size32=0; $size42=0; $size23=0; $size33=0;
	$size43=0; $size24=0; $size34=0; $size44=0; $size25=0; $size35=0; $size45=0; $size46=0; $size47=0; $size48=0;
	$size36=0; $size37=0; $size38=0; $size39=0; $size310=0; $size311=0; $size312=0; $size313=0; $size314=0; $size315=0; $size316=0; $size317=0; $size318=0; $size319=0; $size320=0; $size321=0; $size322=0; $size323=0; $size324=0; $size325=0; $size326=0; $size327=0; $size328=0; $size329=0; $size330=0;
	$size26=0; $size27=0; $size28=0; $size29=0; $size210=0; $size211=0; $size212=0; $size213=0; $size214=0; $size215=0; $size216=0; $size217=0; $size218=0; $size219=0; $size220=0; $size221=0; $size222=0; $size223=0; $size224=0; $size225=0; $size226=0; $size227=0; $size228=0; $size229=0; $size230=0;
	$strchk="o,";

        $maxrows=11;
        $maxcols=26;
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

	do
        {
		$str=(int)((rand(1,400)));
                //echo "1str:".$str;
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) )
                {
			$size21=$str;
			$strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
			break;
                }
        }while(1);
	do
        {
		$str=(int)((rand(1,400)));
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
		$str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && ($str % $maxcols) <> 0 && (int)strpos($strchk,"," . strval((int)$str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
                {
			$size41=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
        }while(1);


	do
        {
		$str=(int)((rand(1,400)));

                if ($str < ((($maxrows-4)*$maxcols)+1) && ($str % $maxcols) <> 0 && ($str % $maxcols) < 24 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)+2) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+3) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+3) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*2)+3) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+($maxcols*3)+3) . ",")===0)
		{
                        $size5=$str;
			$strchk= $strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+($maxcols*2)) . "," .  strval((int)($str)+($maxcols*3)) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . "," .  strval((int)($str)+($maxcols*2)+1) . "," .  strval((int)($str)+($maxcols*3)+1) . "," .  strval((int)($str)+2) . "," .  strval((int)($str)+$maxcols+2) . "," .  strval((int)($str)+($maxcols*2)+2) . "," .  strval((int)($str)+($maxcols*3)+2) . ","  .  strval((int)($str)+3) . "," .  strval((int)($str)+$maxcols+3) . "," .  strval((int)($str)+($maxcols*2)+3) . "," .  strval((int)($str)+($maxcols*3)+3) . ",";
                        break;
                }
        }while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size22=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
                {
			$size32=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size42=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size23=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size33=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size43=$str;
			$strchk=$strchk . strval($str). "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size24=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size34=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size44=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size25=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));

                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size35=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size45=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size26=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));

		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size36=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size46=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size27=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));

		if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 )
		{
                        $size37=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size47=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size28=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0)
		{
                        $size38=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str < ((($maxrows-1)*$maxcols)+1) && $str % $maxcols <> 0 && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+$maxcols+1) . ",")===0)
		{
                        $size48=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+$maxcols) . "," .  strval((int)($str)+1) . "," .  strval((int)($str)+$maxcols+1) . ",";
			break;
                }
	}while(1);

	do{
		$str=(int)((rand(1,400)));
		if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos($strchk,"," . strval($str) . ",")===0 && (int)strpos($strchk,"," . strval((int)($str)+1) . ",")===0)
		{
                        $size29=$str;
			$strchk=$strchk . strval($str) . "," .  strval((int)($str)+1) . ",";
			break;
                }
	}while(1);
	//Response.Write(size21 & "<br>" & size31 & "<br>" & size41 & "<br>" & size5 & "<br>" & size22 & "<br>" & size32 & "<br>" & size42 & "<br>" & size23 & "<br>" & size33 & "<br>" & size43 & "<br>" & size24 & "<br>" & size34 & "<br>" & size44 & "<br>" & $strchk)

        do{
            $str=(int)((rand(1,400)));
            if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
            {
                    $size39=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                break;
            }
        }while(1);

        do{
            $str=(int)((rand(1,400)));
            if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
            {
                $size210=$str;
                $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                break;
            }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size310=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size211=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size311=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size212=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size312=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0 )
                {
                       $size213=$str;
                       $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                       break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size313=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size214=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size314=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size215=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0 )
                {
                    $size315=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0 )
                {
                    $size216=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size316=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size217=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0 )
                {
                    $size317=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size218=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);
        //Upto this output is also good and if possible below loops also can be ignored
	//echo "<br>finished:".time();
        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size318=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size219=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size319=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size220=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);


        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size320=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size221=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size321=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size222=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size322=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));

                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size223=$str;

                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size323=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size224=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size324=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size225=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size325=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                       $size226=$str;
                       $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                       break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size326=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                    $size227=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0 )
                {
                        $size327=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size228=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if($str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size328=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size229=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                        $size329=$str;
                        $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                        break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));
                if( $str % $maxcols <> 0 && $str < ($maxrows*$maxcols) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+1) . ",")===0)
                {
                        $size230=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+1) . ",";
                    break;
                }
        }while(1);

        do{
                $str=(int)((rand(1,400)));

                if( $str < ((($maxrows-1)*$maxcols)+1) && (int)strpos( $strchk, "," . strval($str) . ",")===0 && (int)strpos( $strchk, "," . strval((int)($str)+$maxcols) . ",")===0)
                {
                    $size330=$str;
                    $strchk=$strchk . strval($str) . "," . strval((int)($str)+$maxcols) . ",";
                    break;
                }
        }while(1);

        $output="<table  class='collageimagetableborder' border='0' cellspacing='0'>";
        $cnt=0;
        $index=0;
        for($i=1;$i<=$maxrows;$i++)
        {
            $output.="<tr>";
            for($j=1;$j<=$maxcols;$j++)
            {
                $cnt=$cnt+1;
                if( $cnt == $size21 || $cnt == $size22 || $cnt == $size23 || $cnt == $size24 || $cnt == $size25 || $cnt == $size26 || $cnt == $size27 || $cnt == $size28 || $cnt == $size29 || $cnt == $size210 || $cnt == $size211 || $cnt == $size212 || $cnt == $size213 || $cnt == $size214 || $cnt == $size215 || $cnt == $size216 || $cnt == $size217 || $cnt == $size218 || $cnt == $size219 || $cnt == $size220 || $cnt == $size221 || $cnt == $size222 || $cnt == $size223 || $cnt == $size224 || $cnt == $size225 || $cnt == $size226 || $cnt == $size227 || $cnt == $size228 || $cnt == $size229 || $cnt == $size230)
                {
                    $output.="<td colspan='2' width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size2/".$rows[$index]['ImagePath']."' style='height:28px;width:58px;' VSPACE='0' HSPACE='0'></a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                if( $cnt == $size31 || $cnt == $size32 || $cnt == $size33 || $cnt == $size34 || $cnt == $size35 || $cnt == $size36 || $cnt == $size37 || $cnt == $size38 || $cnt == $size39 || $cnt == $size310 || $cnt == $size311 || $cnt == $size312 || $cnt == $size313 || $cnt == $size314 || $cnt == $size315 || $cnt == $size316 || $cnt == $size317 || $cnt == $size318 || $cnt == $size319 || $cnt == $size320 || $cnt == $size321 || $cnt == $size322 || $cnt == $size323 || $cnt == $size324 || $cnt == $size325 || $cnt == $size326 || $cnt == $size327 || $cnt == $size328 || $cnt == $size329 || $cnt == $size330)
                {
                    $output.="<td rowspan='2'  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size3/".$rows[$index]['ImagePath']."' style='min-height:60px;width:28px;' VSPACE='0' HSPACE='0'></a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                if( $cnt == $size41 || $cnt == $size42 || $cnt == $size43 || $cnt == $size44 || $cnt == $size45 || $cnt == $size46 || $cnt == $size47 || $cnt == $size48 )
                {
                    $output.="<td colspan='2' rowspan='2'  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size4/".$rows[$index]['ImagePath']."' style='height:58px;width:58px;' VSPACE='0' HSPACE='0'></a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }
                /*if($cnt == $size5)
                {
                    $output.="<td colspan='4' rowspan='4'  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size5/".$rows[$index]['ImagePath']."' style='height:123px;width:128px;' VSPACE='0' HSPACE='0'></a>";
                            $index++;
                        }
                        else
                            $output."&nbsp;</td>";
                    //$output.="</td>";
                    //$index++;
                }*/
                if( (int)strpos( $strchk, "," . strval($cnt) . ",")>0)
                {

                }
                else
                {
                    $output.="<td  width='30px' height='30px' valign='top'>";
                        if(isset($rows[$index]['ImagePath']))
                        {
                            $output.="<a class='borderit' href='../Stuff/StuffDetail.php?stuffid=".$rows[$index]['StuffID']."' title='".$rows[$index]['Title']."'><img src='Stuff/StuffImages/size1/".$rows[$index]['ImagePath']."' style='height:28px;width:28px;' VSPACE='0' HSPACE='0' ></a>";
                            //onmouseover=\"ajax_showTooltip(window.event,'demo-pages/ajax-tooltip.html',this);return false\" onmouseout=\"ajax_hideTooltip()\"
                            $index++;
                        }
                        else
                            $output.="&nbsp;</td>";

                    //$output.="</td>";
                    //$index++;
                }
           }
           $output.="</tr>";
        }
        $output.="</table>";

        echo $output;

?>