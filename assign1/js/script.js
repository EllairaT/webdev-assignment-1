function addPermission(perm) {
  var badge = document.getElementById(perm + "-badge");
  if (badge.style.display === "none") {
    badge.style.display = "block";
  } else {
    badge.style.display = "none";
  }
}

function shareOptions(opt){
  var chosenOption = document.getElementById(opt);
  var shareBtn = document.getElementById('share-with');
  shareBtn.innerHTML = chosenOption.value;
}