
function addrow() {
    var $row = $("#basic-row");
    var $table = $row.closest('table');
    var $insert = $('<tr></tr>').append($row.html());
    $insert.find('input[disabled="disabled"]').removeAttr("disabled");
    $table.append($insert);
}

function removerow(self) {
    $(self).closest('tr').remove();
}