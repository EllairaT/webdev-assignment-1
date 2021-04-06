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

function openNav() {
  document.getElementById("mySidepanel").style.width = "200px";
  document.getElementById("toggleBtn").style.marginLeft = "200px";
}

/* Set the width of the sidebar to 0 (hide it) */
function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
  document.getElementById("toggleBtn").style.marginLeft = "0";
}
