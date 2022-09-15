// Henter modal afsnittet fra vores html
var modal = document.getElementById("myModal");

// Henter knappen som åbner vores modal, i html
var btn = document.getElementById("writePipButton");

// Henter span (<span class="close">&times;</span>) som er et kryds der lukker modal box
var span = document.getElementsByClassName("close")[0];

// Når brugeren klikker på knappen, åbnes modal boxen
btn.onclick = function() {
  modal.style.display = "block";
}

// Når brugeren klikker på krydset (<span class="close">&times;</span>), lukkes modal boxen
span.onclick = function() {
  modal.style.display = "none";
}

// Når brugeren klikker steder uden for boxen, lukkes den
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}











//START DENITSA
// Henter modal afsnittet fra vores html
var modal = document.getElementById("myModal");

// Henter knappen som åbner vores modal, i html
var btn = document.getElementById("writePipButton");

// Henter span (<span class="close">&times;</span>) som er et kryds der lukker modal box
var span = document.getElementsByClassName("close")[0];

// Når brugeren klikker på knappen, åbnes modal boxen
btn.onclick = function() {
  modal.style.display = "block";
}

// Når brugeren klikker på krydset (<span class="close">&times;</span>), lukkes modal boxen
span.onclick = function() {
  modal.style.display = "none";
}

// Når brugeren klikker steder uden for boxen, lukkes den
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
