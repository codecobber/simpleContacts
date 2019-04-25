<script>

function criteriaSet(crit){


        var x = document.getElementsByClassName("choices");
        var specific = document.getElementsByClassName("specificCriteria");
        var list ="";
        var textVal = document.getElementById('searchVal').value;
        fullname = "";

        //check the checkboxes for checked value
        for(var i=0;i<5;i++){
          if(x[i].checked == true){
              list += (i+1) + "-"; // adding 1 as zero causes problem
          }
        }



        //remove trailing comma from string for displaying heading
        var comma = list.lastIndexOf("-");
        list = list.substring(0,comma);
        locCriteria = list;


        list = list.split("-");

        for(var k = 0; k<list.length;k++){

          switch(list[k]){
            case '1':
              if(fullname === ""){
                fullname = "Cardonald "
              }
              else{
                fullname += "Cardonald + ";
              }
            break;
            case '2':
               if(fullname === ""){
                fullname = "Clyde "
              }
              else{
                fullname += "+ Clyde ";
              }
            break;
            case '3':
               if(fullname === ""){
                fullname = "East"
              }
              else{
                fullname += "+ East ";
              }
            break;
            case '4':
               if(fullname === ""){
                fullname = "North"
              }
              else{
                fullname += "+ North ";
              }
            break;
            case '5':
               if(fullname === ""){
                fullname = "Locals"
              }
              else{
                fullname += "+ Locals ";
              }
            break;
          }
        }



        switch(crit){

            case 'f':
               criteria = "f";
               fullTitle ="First Name + ";
            break;
            case 's':
               criteria = "s";
               fullTitle ="Surname + ";
            break;
            case 't':
               criteria = "t";
               fullTitle ="Title + ";
            break;
            case 'd':
               criteria = "d";
               fullTitle ="Department + ";
            break;
            case 'n':
               criteria = "n";
               fullTitle ="Direct Tel No + ";
            break;
            case 'e':
               criteria = "e";
               fullTitle ="Extension + ";
            break;
            case 'm':
               criteria = "m";
               fullTitle ="Mobile no + ";
            break;
        }

       document.getElementById('searchLoc').innerHTML = "Results for: " + fullTitle + fullname;

       if(textVal=="" || textVal==" "){
        showHint("x"); // call function based on criteria -if field empty then send x
       }
       else{
        showHint(textVal); // call function based on criteria that exists in the field

       }

    }
</script>
