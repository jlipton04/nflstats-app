$(document).ready(function(){
  var urlParams = new URLSearchParams(window.location.search),
  tableName = urlParams.get('name');

 var tableContainer = $(".table-container");
 $.getJSON('tables/'+ tableName +'.json', function(json) {
   console.log(json);
   var table = json.table;
   tableContainer.append("<tr>");
   for (var i = 0; i < table.columns.length; i++) {
     tableContainer.append("<th>"+ table.columns[i].displayName +"</th>");
   }
   tableContainer.append("</tr>");
   for (var x = 0; x < 10; x++) {
     tableContainer.append("<tr>");
     for (var y = 0; y < table.columns.length; y++) {
       tableContainer.append("<td>asdf</td>");
     }
     tableContainer.append("</tr>");
   }
 });
});
