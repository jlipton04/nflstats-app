$(document).ready(function(){
  $(".submitRecordButton").click(function () {
    var urlParams = new URLSearchParams(window.location.search),
    action = urlParams.get('action'),
    table = urlParams.get('table');

    $('body').append('<form id="recordForm" action="submitRecord.php" method="POST" target="_blank"></form>');

    var $recordForm = $('#recordForm');

    $recordForm.append('<input type="hidden" name="table" id="table"/>');
    $recordForm.find("#table").val(table);
    $recordForm.append('<input type="hidden" name="action" id="action"/>');
    $recordForm.find("#action").val(action);

    if (action == 'add') {
      var colNames = '';
      var values = '';

      $(".recordInput").each(function () {
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

      colNames = colNames.substring(0, colNames.length-1);
      values = values.substring(0, values.length-1);

      $recordForm.append('<input type="hidden" name="columns" id="columns"/>');
      $recordForm.find("#columns").val(colNames);
      $recordForm.append('<input type="hidden" name="values" id="values"/>');
      $recordForm.find("#values").val(values);

      console.log(colNames);
      console.log(values);
    } else {
      var setStmt = '';

      $(".recordInput").each(function () {
        setStmt += $(this).attr('name') + "=" ;

        var inputType = $(this).attr('type');
        if (inputType == 'text' || inputType == 'date') {
          setStmt += '"' + $(this).val() + '",';
        } else {
          setStmt += $(this).val() + ',';
        }
      });

      setStmt = setStmt.substring(0, setStmt.length-1);

      $recordForm.append('<input type="hidden" name="setStatement" id="setStatement"/>');
      $recordForm.find("#setStatement").val(setStmt);
    }

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

    $('body').append('<form id="recordForm" action="submitRecord.php" method="POST" target="_blank"></form>');

    var $recordForm = $('#recordForm');

    $recordForm.append('<input type="hidden" name="table" id="table"/>');
    $recordForm.find("#table").val(table);
    $recordForm.append('<input type="hidden" name="action" id="action"/>');
    $recordForm.find("#action").val("delete");
    $recordForm.append('<input type="hidden" name="whereStatement" id="whereStatement"/>');
    $recordForm.find("#whereStatement").val(whereStatement);

    $recordForm.submit();
    location.reload();
  });

  $(".returnButton").click(function () {
    window.close();
  });
});
