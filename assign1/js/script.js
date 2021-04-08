//adds or removes permission badges
function addPermission(perm) {
  var badge = document.getElementById(perm + "-badge");
  if (badge.style.display == "none" || badge.checked) {
    badge.style.display = "block";
  } else {
    badge.style.display = "none";
  }
}

function checkStatusCode() {
  var code = $(".id-input").val();
  $.ajax({
    url: "poststatusprocess.php",
    method: "POST",
    data: {
      statuscode: code,
    },
    success: function (data) {
      console.log(data);
      if (data.status == "success") {
        $("#error-msg").removeClass("text-danger").addClass("text-success");
      } else if (data.status == "error") {
        $("#error-msg").removeClass("text-success").addClass("text-danger");
      }
      $("#error-msg").text(data.status_message);
    },
  });
}

//changes share button text when another option is selected
function shareOptions(opt) {
  var chosenOption = document.getElementById(opt);
  var shareBtn = document.getElementById("share-with");
  shareBtn.innerHTML = chosenOption.value;
}

function initializePoppers() {
  var popoverTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="popover"]')
  );
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });

  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
}

//shorthand for $(document).ready()
$(function () {
  initializePoppers();

  $(".id-input").on("change", function (e) {
    e.preventDefault();
    var code = $(".id-input").val();
    $.ajax({
      url: "poststatusprocess.php",
      method: "POST",
      data: {
        statuscode: code,
      },
      success: function (data) {
        console.log(data);
        if (data.status == "success") {
          $("#error-msg").removeClass("text-danger").addClass("text-success");
        } else if (data.status == "error") {
          $("#error-msg").removeClass("text-success").addClass("text-danger");
        }
        $("#error-msg").text(data.status_message);
      },
    });
  });
});
