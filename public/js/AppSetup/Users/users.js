window.onload = () => {
  loadTable();
};

const checkAll = document.getElementById('selectAll');
const checkBox = document.querySelectorAll('.row-checkbox');

checkAll.addEventListener('click', function () {
  var isChecked = this.checked;
  $('.row-checkbox').prop('checked', isChecked);
});

$('#dataTable tbody').on('click', '.row-checkbox', function () {
  var totalCheckbox = $('.row-checkbox').length;
  var totalChecked = $('.row-checkbox:checked').length;

  if (totalCheckbox === totalChecked) {
    $('#selectAll').prop('checked', true);
  } else {
    $('#selectAll').prop('checked', false);
  }
});

function countChecked() {
  var checkedBoxes = $('.row-checkbox:checked');
  var count = checkedBoxes.length;
  console.log('Checked boxes count:', count);
  return count;
}

// Call countChecked when checkbox state changes
$('#dataTable tbody').on('click', '.row-checkbox', function () {
  countChecked();
});

const buttons = {
  add: document.getElementById("btnAdd"),
  filter: document.getElementById("btnFilter"),
  refresh: document.getElementById("btnRefresh"),
  export: document.getElementById("btnExport"),
  delete: document.getElementById("btnDelete")
};

function loadTable() {
  $("#dataTable").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    bDestroy: true,
    pageLength: 25,
    search: {
      return: true,
    },
    order: [],
    ajax: {
      url: baseurl + "/users/table",
      type: "POST",
      data: "raw",
      action: "calls",
    },
    deferRender: true,
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        className: "text-center align-middle",
        render: function (data, type, row) {
          return (
            '<input type="checkbox" class="row-checkbox form-check-input border-1 rounded-0 border-primary" name="token[]" value="' +
            data +
            '">'
          );
        },
      },
    ],
  });
}

function refreshTable() {
  $("#dataTable").DataTable().ajax.reload(null, false);
}

buttons.add.addEventListener("click", () => {
  loading();
  window.location.href = baseurl + "/users/add";
});

buttons.refresh.addEventListener("click", () => {
  refreshTable();
});
