$(document).ready(function(){
  var urlParams = new URLSearchParams(window.location.search),
  tableName = urlParams.get('name');

 var tableContainer = $(".table-container");
 /*$.getJSON('tables/'+ tableName +'.json', function(json) {
   var table = json.table;

   $(".table-title").text(table.tableName);

   var str = '';

   tableContainer.append("<tr>");
   for (var i = 0; i < table.columns.length; i++) {
     str += '"' + table.columns[i].column + '", ';
     tableContainer.append("<th>"+ table.columns[i].displayName +"</th>");
   }

   console.log(str);

   tableContainer.append("</tr>");
   for (var x = 0; x < 10; x++) {
     tableContainer.append("<tr>");
     for (var y = 0; y < table.columns.length; y++) {
       tableContainer.append("<td>asdf</td>");
     }
     tableContainer.append("</tr>");
   }
 });*/
});
