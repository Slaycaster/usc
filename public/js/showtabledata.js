function showTableData() {
  var tabledata = document.getElementById("tabledata").style.display = "block";
  var tableinfo = document.getElementById("tableinfo").style.display = "block";
  // var tablemeasure = document.getElementById("tablemeasure").style.display = "block";
}
setTimeout("showTableData()", 700);



$(document).ready(function(){

    $('#id_target_period').on('change', function() {
      if ( this.value == 'Monthly')
      {
        $("#monthlyform").show();
        $("#quarterlyform").hide();
      }
      else if ( this.value == 'Quarterly')
      {
        $("#quarterlyform").show();
        $("#monthlyform").hide();
      }
    });

    $( '#targetModal' )
        .on('hidden.bs.modal', function() {
            console.log("Set Target Closed");
            $("#monthlyform").hide();
            $("#quarterlyform").hide();
            document.getElementById('id_target_period').value = "";
        }
    );
});