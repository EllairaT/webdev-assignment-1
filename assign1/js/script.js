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

//check if all inputs are valid. if yes, enable the submit button
function watch() {
  if (code == 1 && post == 1) {
    $("#postsubmit").prop("disabled", false);
  } else {
    $("#postsubmit").prop("disabled", true);
  }
}

function checkTables(string) {
  $.ajax({
    url: "searchstatusprocess.php",
    method: "GET",
    dataType: "text",
    data: { searchpost: string },
    success: function (data) {
      $("#posts").html(data);
    },
    error: function (data, error) {
      console.log("something went wrong: " + error);
    },
  });
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

  $("#searchpost").on("keyup", function (e) {
    e.preventDefault();
    var searchString = $("#searchpost").val();

    if (searchString != "") {
      checkTables(searchString);
    } else {
      checkTables();
    }
  });

  $("#searchpost").on("keydown", function (e) {
    if (e.key == "Enter") {
      e.preventDefault();
    }
  });

  $("#postsubmit").on("click", function (e) {
    var ajaxSubmitted = false;
    e.preventDefault();

    var formCode = $("#sc").val();
    var formDate = $("#postdate").val();
    var formContent = $("#statustext").val();
    var formShare = $(".btn-check").val();
    var perms = [];

    $("input:checkbox[name=type]:checked").each(function () {
      perms.push($(this).val());
    });

    if (perms == "undefined" || perms.length == 0) {
      perms = "No perms";
    }

    $.ajax({
      url: "poststatusprocess.php",
      method: "POST",
      dataType: "text",
      data: {
        action: "3",
        statuscode: formCode,
        status: formContent,
        date: formDate,
        shareoptions: formShare,
        permissions: perms,
      },
      success: function (post) {
        $response = JSON.parse(post);
        if ($response.status == "Success") {
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
