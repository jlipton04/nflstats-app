$(document).ready(function(){
  $(".submitRecordButton").click(function () {
    var urlParams = new URLSearchParams(window.location.search),
    action = urlParams.get('action'),
    table = urlParams.get('table');

    //Creates form to store values for submitting record to DB
    $('body').append('<form id="recordForm" action="submitRecord.php" method="POST" target="_blank"></form>');

    var $recordForm = $('#recordForm');

    //Adds table name and action
    $recordForm.append('<input type="hidden" name="table" id="table"/>');
    $recordForm.find("#table").val(table);
    $recordForm.append('<input type="hidden" name="action" id="action"/>');
    $recordForm.find("#action").val(action);

    if (action == 'add') {
      var colNames = '';
      var values = '';

      $(".recordInput").each(function () {
        //Only add column to SQL if it is not null
        if ($(this).val() != '') {
          colNames += $(this).attr('name') + ',';

          var inputType = $(this).attr('type');
          if (inputType == 'text' || inputType == 'date') {
            values += '"' + $(this).val() + '",';
          } else {
            values += $(this).val() + ',';
          }
        }
      });

      //Takes off hanging commas
      colNames = colNames.substring(0, colNames.length-1);
      values = values.substring(0, values.length-1);

      //Puts columns and values in the form for the SQL query
      $recordForm.append('<input type="hidden" name="columns" id="columns"/>');
      $recordForm.find("#columns").val(colNames);
      $recordForm.append('<input type="hidden" name="values" id="values"/>');
      $recordForm.find("#values").val(values);

      console.log(colNames);
      console.log(values);
    } else {
      var setStmt = '';

      $(".recordInput").each(function () {
        //Only add column to SQL if it is not null
        if ($(this).val() != '') {
          setStmt += $(this).attr('name') + "=" ;

          var inputType = $(this).attr('type');
          if (inputType == 'text' || inputType == 'date') {
            setStmt += '"' + $(this).val() + '",';
          } else {
            setStmt += $(this).val() + ',';
          }
        }
      });

      //Takes off hanging comma
      setStmt = setStmt.substring(0, setStmt.length-1);

      //Puts update string in form
      $recordForm.append('<input type="hidden" name="setStatement" id="setStatement"/>');
      $recordForm.find("#setStatement").val(setStmt);
    }

    //Submits the record to the DB and reloads it to reflect the changes
    $recordForm.submit();
    location.reload();
  });

  $(".deleteRecordButton").click(function () {
    var $idInput = $(".page-content").find(".recordInput").first()
    whereStatement = $($idInput).attr('name') + '=',
    urlParams = new URLSearchParams(window.location.search),
    table = urlParams.get('table');

    var inputType = $idInput.attr('type');
    if (inputType == 'text' || inputType == 'date') {
      whereStatement += '"' + $idInput.val() + '"';
    } else {
      whereStatement += $idInput.val();
    }

    //Creates the form to delete the record
    $('body').append('<form id="recordForm" action="submitRecord.php" method="POST" target="_blank"></form>');

    var $recordForm = $('#recordForm');

    //Adds table, action, and the where statement nessesary to delete the record
    $recordForm.append('<input type="hidden" name="table" id="table"/>');
    $recordForm.find("#table").val(table);
    $recordForm.append('<input type="hidden" name="action" id="action"/>');
    $recordForm.find("#action").val("delete");
    $recordForm.append('<input type="hidden" name="whereStatement" id="whereStatement"/>');
    $recordForm.find("#whereStatement").val(whereStatement);

    //Submits the record to the DB and reloads it to reflect the changes
    $recordForm.submit();
    location.reload();
  });

  //Closes the page to go back to the table view
  $(".returnButton").click(function () {
    window.close();
  });
});
