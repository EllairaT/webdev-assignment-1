//adds or removes permission badges
function addPermission(perm) {
  var badge = document.getElementById(perm + "-badge");
  if (badge.style.display === "none") {
    badge.style.display = "block";
  } else {
    badge.style.display = "none";
  }
}

//changes share button text when another option is selected
function shareOptions(opt) {
  var chosenOption = document.getElementById(opt);
  var shareBtn = document.getElementById("share-with");
  shareBtn.innerHTML = chosenOption.value;
}

function validateForm() {
  $("btn-submit").on("submit", function (event) {
    event.preventDefault();
  });

  var status_code = $(".").val();
  var status_content = $(".").val();
  var status_date = $(".").val();
  var status_visibility = $(".btn-check").val();
  var status_permissions = $(".form-check-input").val();

  $(".test-result");
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

function checkStatusCode() {}

