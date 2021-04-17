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
  var statcode = $("#sc").val();
  $.ajax({
    url: "poststatusprocess.php",
    method: "POST",
    data: { action: "1", statuscode: statcode },
    success: function (data) {
      if (data.status == "Success") {
        code = 1;
        $("#error-msg").text("");
      } else {
        code = 0;
        $("#error-msg").text(data.statusmessage);
      }
      watch();
    },
  });
}

function checkStatusPost() {
  var statpost = $("#statustext").val();
  $.ajax({
    url: "poststatusprocess.php",
    method: "POST",
    data: { action: "2", statuspost: statpost },
    success: function (data) {
      if (data.status == "Success") {
        post = 1;
        $("#post-error-msg").text("");
      } else {
        post = 0;
        $("#post-error-msg").text(data.statusmessage);
      }
      watch();
    },
  });
}

function submitForm() {
  console.log(form);
}

function clearForm() {
  $("#post_form").trigger("reset");
  $("input:checked").removeAttr("checked");

  $(".badge").each(function () {
    $(this).attr("style", "display: none");
  });

  code = 0;
  post = 0;
  $("#postsubmit").prop("disabled", true);
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

function watch() {
  if (code == 1 && post == 1) {
    $("#postsubmit").prop("disabled", false);
  } else {
    $("#postsubmit").prop("disabled", true);
  }
}

function toggleAlert(type) {
  if (type == "Success") {
    $(".toast-success").toast("show");
  } else {
    $(".toast-error").toast("show");
  }
}

//global variables
code = 0;
post = 0;

//shorthand for $(document).ready()
$(function () {
  initializePoppers();

  $("#sc").on("input", function (e) {
    e.preventDefault();
    checkStatusCode();
  });

  $("#statustext").on("input", function (e) {
    e.preventDefault();
    checkStatusPost();
  });

  $("#postsubmit").on("click", function (e) {
    var ajaxSubmitted = false;
    e.preventDefault();
    var thisForm = $("#post_form").serialize();
    $.ajax({
      url: "poststatusprocess.php",
      method: "POST",
      dataType: "json",
      data: { action: "3", formdata: thisForm },
      success: function (post) {
        if (post.status == "Success") {
          ajaxSubmitted = true;
          $("#notif").modal("show");
          $("#notif").on("hidden.bs.modal", function () {
            clearForm();
            $("form").attr("action", "poststatusform.php");
            $("form").trigger("submit");
          });
        } else {
          $("#notif-error").modal("show");
        }
      },
    });
    return ajaxSubmitted;
  });
});
