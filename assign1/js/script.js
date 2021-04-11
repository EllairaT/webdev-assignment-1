
var code = 0;
var post = 0;
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
      $("#error-msg").text(data.statusmessage);
      if (data.status == "Error") {
        code = 0;
      } else {
        console.log("success!");
        code = 1;
      }
    },
  });
}

function checkStatusPost() {
  var statpost = $("#statustext").val();
  $.ajax({
    url: "poststatusprocess.php",
    method: "POST",
    data: { action: "2", statuspost: statpost },
    success: function (text) {
      $("#post-error-msg").text(text.statusmessage);
      if (text.status == "Error") {
        post = 0;
      } else {
        console.log("success!");
        post = 1;
      }
    },
  });
}

function submitForm() {
  var form = $("#post_form").serialize();
  $.ajax({
    url: "poststatusprocess.php",
    method: "POST",
    data: { action: "3", formdata: form },
    success: function (post) {
      if (post.status == "Success") {
        $("#post_form").trigger("reset");
      } else {
       
      }
    },
  });
}

function clearForm() {
  var form = $("#post_form");
  form.trigger("reset");
  // form.find("input:text").val("");
  // form.find("input:checkbox").removeAttr("checked");
  // form.find("input:radio").prop("checked", function () {
  //   $("#onlyfriends").attr("checked") == "checked";
  // });
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

  $("#sc").on("change", function (e) {
    e.preventDefault();
    checkStatusCode();
  });

  $("#statustext").on("change", function (e) {
    e.preventDefault();
    checkStatusPost();
  });

  $("#postsubmit").on("click", function (e) {
    e.preventDefault();
    submitForm();
  });
});
