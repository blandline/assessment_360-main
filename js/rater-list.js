
var rowcounter = 1

function addrow() { // adds rows to the table at the end of the last row
    var table = document.getElementById("raterlisttable");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell3.colSpan = "2";            //adjust the size of columns to fit the table
    var cell4 = row.insertCell(3);
    cell4.colSpan = "2";
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);
    var cell10 = row.insertCell(9);
  
    cell1.innerHTML = ""; // row counter is added to give every column a unique name to assist in the php form handling
    cell2.innerHTML = "";
    cell3.innerHTML = "";
    cell4.innerHTML = "";
    cell5.innerHTML = "<input type='text' name='rows[" + rowcounter +"]Rater-first-name'>";
    cell6.innerHTML = "<input type='text' name='rows[" + rowcounter +"]Rater-last-name'>";
    cell7.innerHTML = "<select name='rows[" + rowcounter +"]Roles' id='roles'><option value='Focus' name='focus_role'>FOCUS</option><option value='manager' name='manager_role'>Manager</option><option value='colleague' name='colleague_role'>Colleague</option><option value='direct-report' name='direct_report_role'>Direct report</option><option value='Other' name='other_role'>Other</option></select>";
    cell8.innerHTML = "<select name='rows[" + rowcounter +"]Genders' id='genders'><option value='Male' name='male_gender'>Male</option><option value='Female' name='female_gender'>Female</option><option value='Other Gender' name='other_gender'>Other Gender</option></select>";
    cell9.innerHTML = "<input type='text' name='rows[" + rowcounter +"]position'>";
    cell10.innerHTML = "<input type='text' name='rows[" + rowcounter +"]email'>";
    rowcounter++;
  }

  function deleterow(){
    var table = document.getElementById("raterlisttable");
    var rowCount = table.rows.length;
  if (rowCount > 3) {
    table.deleteRow(rowCount - 1);
    
  }
  rowcounter--;
  
}

  function activate_button(){
      confirm("Are you sure");
      
  }
