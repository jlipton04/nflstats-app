$(document).ready(function(){
  var urlParams = new URLSearchParams(window.location.search),
  tableName = urlParams.get('name');

 var tableContainer = $(".table-container");

 //Adds crafted filter to filter string
 $(".filterAdd").click(function () {
   var column = $(this).parent().find(".columnSelect").val(),
   mode = $(this).parent().find(".modeSelect").val(),
   value = $(this).parent().find(".filterVal").val(),
   filterString = urlParams.get('filter');

   //LIKE parameters require special chars, such as %, and must be added to val
   if ($(this).parent().find(".filterVal").attr('type') == "text") {
     if (mode.includes('LIKE')) {
       mode = ' ' + mode + ' ';
       value = "'%" + value + "%'";
     } else {
       value = '"' + value + '"';
     }
   }

   //If the filter string is empty, it will not lead with an AND for the SQL query
   if (filterString == '' || filterString == null) {
     filterString = column + mode + value;
   } else {
     filterString += ' AND ' + column + mode + value;
   }

   //Builds form for querystring
   $('body').append('<form id="filterForm" action="table.php" method="GET"></form>');

   var $filterForm = $('#filterForm');

   //Puts table name and filter string in the querystring
   $filterForm.append('<input type="hidden" name="name" id="name"/>');
   $filterForm.find("#name").val(tableName);
   $filterForm.append('<input type="hidden" name="filter" id="filter"/>');
   $filterForm.find("#filter").val(filterString);

   //Submits the form and reloads the page
   $filterForm.submit();
 });

 //Clears all current filters from the table
 $(".filterClear").click(function () {
   //Builds form for querystring
   $('body').append('<form id="filterForm" action="table.php" method="GET"></form>');

   var $filterForm = $('#filterForm');

   //Puts table name and empty filter string in the querystring
   $filterForm.append('<input type="hidden" name="name" id="name"/>');
   $filterForm.find("#name").val(tableName);
   $filterForm.append('<input type="hidden" name="filter" id="filter"/>');
   $filterForm.find("#filter").val('');

   //Submits the form and reloads the page
   $filterForm.submit();
 });
});
