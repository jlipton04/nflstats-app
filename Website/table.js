$(document).ready(function(){
  var urlParams = new URLSearchParams(window.location.search),
  tableName = urlParams.get('name');

 var tableContainer = $(".table-container");
 $.getJSON('tables/'+ tableName +'.json', function(json) {
   console.log(json);
   var table = json.table;
   for (var i = 0; i < table.columns.length; i++) {
     tableContainer.append("<th>"+ table.columns[i].displayName +"</th>");
   }
 });
});
