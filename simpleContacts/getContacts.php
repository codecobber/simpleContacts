<?php

session_start();




/****************************************************
*
* @File:        gethint.php
* @Function:    Retrieve array and search
* @Author:      Craig Adams
*
*****************************************************/


//define_constants
define("SCOTHERPATH","../../data/other/simpleContacts/");

$searchCriteria = "s"; // set to surname by default
$locCriteria = '';
$tempArray=array();

$hint = "<tr>
            <th>Surname</th>
            <th>First Name</th>
            <th>Title</th>
            <th>Department</th>
            <th>Direct Tel</th>
            <th>Extension</th>
            <th>Mobile </th>
            ";

if(isset($_SESSION['userOnline']) && $_SESSION['userOnline'] == 1){
  $hint .= "
              <th>Edit </th>
              <th>Delete </th>
              ";
}


$hint .= "</tr>";


if(isset($_REQUEST['l']) && !empty($_REQUEST['l'])){
     $GLOBALS['locCriteria'] = htmlentities($_REQUEST['l']);
}



if(isset($_REQUEST['c']) && !empty($_REQUEST['c'])){

    $GLOBALS['searchCriteria'] = htmlentities($_REQUEST['c']);

    switch($searchCriteria){
        case 's':
            $searchCriteria = 0;
            break;
        case 'f':
            $searchCriteria = 1;
            break;
        case 't':
            $searchCriteria = 2;
            break;
        case 'd':
            $searchCriteria = 3;
            break;
        case 'n':
            $searchCriteria = 4;
            break;
        case 'e':
            $searchCriteria = 5;
            break;
        case 'm':
            $searchCriteria = 6;
            break;
    }

}

if(isset($_REQUEST["q"]) && !empty($_REQUEST["q"])){
    $q = htmlentities($_REQUEST["q"]);
}


function outputData($emps){

    $hint .= "<tr>
                <td>".$emps[0]."</td>
                <td>".$emps[1]."</td>
                <td>".$emps[2]."</td>
                <td>".$emps[3]."</td>
                <td>".$emps[4]."</td>
                <td>".$emps[6]."</td>
              </tr>";

    return $hint;
}



function getEmpData($num,$txtquery,$length){

    switch($num){
            case 1:
                include_once(SCOTHERPATH.'cardonald/data.php');
            break;
            case 2:
                include_once(SCOTHERPATH.'clyde/data.php');
            break;
            case 3:
                include_once(SCOTHERPATH.'east/data.php');
            break;
            case 4:
                include_once(SCOTHERPATH.'north/data.php');
            break;
            case 5:
                include_once(SCOTHERPATH.'local/data.php');
            break;

            default:
              echo "Bummer!!!";
            break;
        }

    $arrlength = count($employees);

    for($x = 0; $x < $arrlength; $x++) {

        if($txtquery == "x"){
           $GLOBALS['hint'] .= outputData($employees[$x]);
        }
        else{

            if(stristr($txtquery, substr($employees[$x][$GLOBALS['searchCriteria']], 0, $length))) {
                $GLOBALS['hint'] .= outputData($employees[$x]);
            }
        }
    }

}



// lookup all hints from array if $q is different from "" ==============

if (!empty($q)) {
    $q = strtolower($q);
    $len=strlen($q);
    $firstChar = substr($q,0,1);
    $locs = "";


    if(strpos($GLOBALS['locCriteria'], "-")>-1){

        $locs = explode("-", $locCriteria);

        foreach ($locs as $locVal) {
            getEmpData($locVal,$q,$len);
        }
    }
    else{
        getEmpData($locCriteria,$q,$len);
    }

}

echo $hint;


?>
