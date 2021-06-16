function setUppercase() {
  var tags = ["h1", "h2", "h3", "h4", "h5", "h6"];
  for (var i = 0; i < tags.length; i++) {
    var allTagsOfType = document.getElementsByTagName(tags[i]);
    for (var j = 0; j < allTagsOfType.length; j++) {
      allTagsOfType[j].innerText = allTagsOfType[j].innerText.toUpperCase();
    }
  }
}

window.onload = setUppercase;
