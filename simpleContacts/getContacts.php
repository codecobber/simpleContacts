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
            <th>First name</th>
            <th>Surname</th>
            <th>Title</th>
            <th>Department</th>
            <th>Direct Tel</th>
            <th>Extension</th>
            <th>Mobile </th>
            <td>Email</td>
            ";
// if user is set and has  a value of 1 then added two th
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


function outputData($jsonData){

  foreach($jsonData as $row){
    $hint .= "<tr>
                <td>".$row->firstname."</td>
                <td>".$row->surname."</td>
                <td>".$row->title."</td>
                <td>".$row->department."</td>
                <td>".$row->direct_tel."</td>
                <td>".$row->extension."</td>
                <td>".$row->mobile."</td>
                <td>".$row->email."</td>
              ";
              
              if(isset($_SESSION['userOnline']) && $_SESSION['userOnline'] == 1){
                $hint .= "<td><button>Edit</button></td>
                          <td><button>Delete</button></td>";
              }
  }





    $hint .= "</tr>";
    return $hint;
}



function getEmpData($num,$txtquery,$length){




    switch($num){
            case 1:
                $jsonData = json_decode(file_get_contents(SCOTHERPATH.'cardonald/data.json'));
            break;
            case 2:
                $jsonData = json_decode(file_get_contents(SCOTHERPATH.'clyde/data.json'));
            break;
            case 3:
                $jsonData = json_decode(file_get_contents(SCOTHERPATH.'east/data.json'));
            break;
            case 4:
                $jsonData = json_decode(file_get_contents(SCOTHERPATH.'north/data.json'));
            break;
            case 5:
                $jsonData = json_decode(file_get_contents(SCOTHERPATH.'local/data.json'));
            break;
        }

        //if the search value $q is just one then pass
        if($txtquery == "x"){
           $GLOBALS['hint'] .= outputData($jsonData);
        }
        else{

            if(stristr($txtquery, substr($employees[$x][$GLOBALS['searchCriteria']], 0, $length))) {
                $GLOBALS['hint'] .= outputData($employees[$x]);
            }

        }
}



// lookup all hints from array if $q is different from "" ==============

if (!empty($q)) {
    $q = strtolower($q);
    $len=strlen($q);
    $firstChar = substr($q,0,1);
    $locs = "";

    //test for more than one location seperated with a hyphen. eg: 1-2-3-4-5
    if(strpos($GLOBALS['locCriteria'], "-") !== FALSE){

        $locs = explode("-", $locCriteria);

        foreach ($locs as $locVal) {
            getEmpData($locVal,$q,$len);
        }
    }
    else{
      //else get value of the single location
        getEmpData($locCriteria,$q,$len);
    }

}

echo $hint;


?>
