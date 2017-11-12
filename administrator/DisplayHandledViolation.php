<?php
if(!session_start()) //checking whether $_SESSION has been started or not?
    session_start();
ob_start(); //Buffering the data
include_once '../commoninclude.php';

//Presentation Layer (PL) object declaration
$objPlStuff=new PlStuff();

//Pagination
$_SESSION['currentpagelimit']=$_SESSION['TotalRecordsOnAdminStuffPage'];
$pages = new Paginator();
$num_rows=$objPlStuff->PlTotalHandledReportViolation();
$style="
    <!--Paging-->
        <style type='text/css'>
        .paginate {
                font-family: Arial, Helvetica, sans-serif;
                font-size: .7em;
        }

        a.paginate {
                border: 1px solid #000080;
                padding: 2px 6px 2px 6px;
                text-decoration: none;
                color: #000080;
        }


        a.paginate:hover {
                background-color: #000080;
                color: #FFF;
                text-decoration: underline;
        }

        a.current {
                border: 1px solid #000080;
                font: bold .7em Arial,Helvetica,sans-serif;
                padding: 2px 6px 2px 6px;
                cursor: default;
                background:#000080;
                color: #FFF;
                text-decoration: none;
        }

        span.inactive {
                border: 1px solid #999;
                font-family: Arial, Helvetica, sans-serif;
                font-size: .7em;
                padding: 2px 6px 2px 6px;
                color: #999;
                cursor: default;
        }

        /*table {
                margin: 8px;
        }

        th {
                font-family: Arial, Helvetica, sans-serif;
                font-size: .7em;
                background: #666;
                color: #FFF;
                padding: 2px 6px;
                border-collapse: separate;
                border: 1px solid #000;
        }

        td {
                font-family: Arial, Helvetica, sans-serif;
                font-size: .7em;
                border: 1px solid #DDD;
        }*/
        </style>
        <script type='text/javascript' language='JavaScript'>
        function hilite(elem)
        {
                elem.style.background = '#FFC';
        }

        function lowlite(elem)
        {
                elem.style.background = '';
        }
        </script>
        <!--Paging-->
    ";
echo $style;
if($num_rows>0)
{
    $pages->items_total = $num_rows;
    $pages->paginate();
}
$limit=$pages->limit;

$output=$objPlStuff->PlDisplayAllHandledReportViolation($limit);
if($num_rows>0)
{
    echo "<div align='center'>".$pages->display_pages()."</div><br/>";
}
//Pagination

echo $output; //displaying output here

$menuLink="<a href='DisplayReportViolation.php?page=1&ipp=".$_SESSION['TotalRecordsOnAdminStuffPage']."'>Unhandled Report Violation List</a>";
$pageTitle="Handled Report Violation List";
$contentTitle="Handled Report Violation List";
$contentData=  ob_get_contents(); //Strogin the buffered data in to $contentData
ob_clean();
require_once 'AdminHome.php'; //Loading AdminHome Page
?>
