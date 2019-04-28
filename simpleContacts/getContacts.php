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
$q="";









if(isset($_REQUEST['l']) && !empty($_REQUEST['l'])){
     $GLOBALS['locCriteria'] = htmlentities($_REQUEST['l']);
}



if(isset($_REQUEST['c']) && !empty($_REQUEST['c'])){

    $GLOBALS['searchCriteria'] = htmlentities($_REQUEST['c']);

    switch($searchCriteria){
        case 's':
            $GLOBALS['searchCriteria'] = "surname";
            break;
        case 'f':
            $GLOBALS['searchCriteria'] = "firstname";
            break;
        case 't':
            $GLOBALS['searchCriteria'] = "title";
            break;
        case 'd':
            $GLOBALS['searchCriteria'] = "department";
            break;
        case 'n':
            $GLOBALS['searchCriteria'] = "tel";
            break;
        case 'm':
            $GLOBALS['searchCriteria'] = "mobile";
            break;
    }

}

if(isset($_REQUEST["q"]) && !empty($_REQUEST["q"])){
    $GLOBALS['q'] = htmlentities($_REQUEST["q"]);
}

// Add tab colour for visual notification of selected seach pattern

$hint = "<tr>";

if($GLOBALS['searchCriteria'] == "firstname") {
    $hint .= "<th class='selectedSearch'>First name</th>";
}
else{
  $hint .= "<th>First name</th>";
}

if($GLOBALS['searchCriteria'] == "surname") {
    $hint .= "<th class='selectedSearch'>Surname</th>";
}
else{
  $hint .= "<th>Surname</th>";
}

if($GLOBALS['searchCriteria'] == "title") {
    $hint .= "<th class='selectedSearch'>Title</th>";
}
else{
  $hint .= "<th>Title</th>";
}

if($GLOBALS['searchCriteria'] == "department") {
    $hint .= "<th class='selectedSearch'>Department</th>";
}
else{
  $hint .= "<th>Department</th>";
}

if($GLOBALS['searchCriteria'] == "tel") {
    $hint .= "<th class='selectedSearch'>Tel</th>";
}
else{
  $hint .= "<th>Tel</th>";
}

if($GLOBALS['searchCriteria'] == "mobile") {
    $hint .= "<th class='selectedSearch'>Mobile</th>";
}
else{
  $hint .= "<th>Mobile</th>";
}

$hint .="<th>Extension</th>
         <th>Email</th>
         </tr>";




//params match the td below
function outputData($f,$s,$t,$d,$p,$ex,$m,$em){

    $hint .= "<tr class='animated fadeIn'>
                <td>".$f."</td>
                <td>".$s."</td>
                <td>".$t."</td>
                <td>".$d."</td>
                <td>".$p."</td>
                <td>".$ex."</td>
                <td>".$m."</td>
                <td><a href='".$em."'>" . $em . "</a></td>
              ";




    $hint .= "</tr>";
    return $hint;
}



function getEmpData($num,$txtquery,$length){

    //get the location file and data
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

          //output data from location folders
           foreach($jsonData as $row){

             $GLOBALS['hint'] .= outputData(
               $row->firstname,
               $row->surname,
               $row->title,
               $row->department,
               $row->tel,
               $row->extension,
               $row->mobile,
               $row->email);


           }
        }
        else{

            foreach ($jsonData as $jvalue) {

              switch ($GLOBALS['searchCriteria']) {
                case 'firstname':
                  $emp = $jvalue->firstname;
                  break;
                case 'surname':
                    $emp = $jvalue->surname;
                  break;
                case 'title':
                    $emp = $jvalue->title;
                  break;
                case 'department':
                      $emp = $jvalue->department;
                  break;
                case 'tel':
                        $emp = $jvalue->tel;
                  break;
                case 'tel':
                        $emp = $jvalue->tel;
                  break;
                case 'extension':
                        $emp = $jvalue->extension;
                  break;
                case 'department':
                        $emp = $jvalue->department;
                  break;


              }

                $emp = strtolower($emp);
                $len=strlen($txtquery);

                //pass each matched record for output
                if(stristr($txtquery, substr($emp, 0, $len))) {

                  $GLOBALS['hint'] .= outputData(
                    $jvalue->firstname,
                    $jvalue->surname,
                    $jvalue->title,
                    $jvalue->department,
                    $jvalue->direct_tel,
                    $jvalue->extension,
                    $jvalue->mobile,
                    $jvalue->email);
                }

            }
        }
}



// lookup all hints from array if $q is different from "" ==============

if (!empty($GLOBALS['q'])) {
    $sc_query = strtolower($GLOBALS['q']);
    $len=strlen($sc_query);
    $firstChar = substr($sc_query,0,1);
    $locs = "";

    //test for more than one location seperated with a hyphen. eg: 1-2-3-4-5
    if(strpos($GLOBALS['locCriteria'], "-") !== FALSE){

        $locs = explode("-", $GLOBALS['locCriteria']);

        foreach ($locs as $locVal) {
            getEmpData($locVal,$sc_query,$len);
        }
    }
    else{
      //else get value of the single location
        getEmpData($GLOBALS['locCriteria'],$sc_query,$len);
    }
}


echo $hint;


?>
