$(document).ready(function(){
  var urlParams = new URLSearchParams(window.location.search),
  tableName = urlParams.get('name');

 var tableContainer = $(".table-container");

 $(".filterAdd").click(function () {
   var column = $(this).parent().find(".columnSelect").val(),
   mode = $(this).parent().find(".modeSelect").val(),
   value = $(this).parent().find(".filterVal").val(),
   filterString = urlParams.get('filter');

   if ($(this).parent().find(".filterVal").attr('type') == "text") {
     if (mode.includes('LIKE')) {
       mode = ' ' + mode + ' ';
       value = "'%" + value + "%'";
     } else {
       value = '"' + value + '"';
     }
   }

   if (filterString == '' || filterString == null) {
     filterString = column + mode + value;
   } else {
     filterString += ' AND ' + column + mode + value;
   }

   $('body').append('<form id="filterForm" action="table.php" method="GET"></form>');

   var $filterForm = $('#filterForm');

   $filterForm.append('<input type="hidden" name="name" id="name"/>');
   $filterForm.find("#name").val(tableName);
   $filterForm.append('<input type="hidden" name="filter" id="filter"/>');
   $filterForm.find("#filter").val(filterString);

   $filterForm.submit();

   console.log(column + "," + mode + "," + value);
 });

 $(".filterClear").click(function () {
   $('body').append('<form id="filterForm" action="table.php" method="GET"></form>');

   var $filterForm = $('#filterForm');

   $filterForm.append('<input type="hidden" name="name" id="name"/>');
   $filterForm.find("#name").val(tableName);
   $filterForm.append('<input type="hidden" name="filter" id="filter"/>');
   $filterForm.find("#filter").val('');

   $filterForm.submit();
 });
});
