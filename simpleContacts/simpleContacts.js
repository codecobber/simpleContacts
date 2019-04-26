

<script>

var criteria = '';
var locCriteria = '';
var fullTitle="";

function showHint(str) {

    if (str.length == 0) {
        //document.getElementById("txtHint").innerHTML = "";
        criteriaSet(criteria);
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "./plugins/simpleContacts/getContacts.php?l=" + locCriteria + "&c="+ criteria +"&q=" + str, true);
        xmlhttp.send();
    }
}




</script>
