
// Get the modal
var modal = document.getElementById("myModal");
var modal1 = document.getElementById("myDelModal");
var modal2 = document.getElementById("myEdModal");
var modal3 = document.getElementById("mySeModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var span1 = document.getElementsByClassName("close")[1];
var span2 = document.getElementsByClassName("close")[2];
var span3 = document.getElementsByClassName("close")[3];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

span1.onclick = function() {
  modal1.style.display = "none";
}

span2.onclick = function() {
  modal1.style.display = "none";
}

span3.onclick = function() {
  modal1.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
  if (event.target == modal3) {
    modal3.style.display = "none";
  }
}

$(document).ready(async function() {
  let ipgeo  = await $.get("https://ipgeolocation.abstractapi.com/v1/?api_key=8abb3226210848f3872e343751def7a6");
  let location  = ipgeo['city'];
  let locCode  = ipgeo['region_iso_code'];
  let country  = ipgeo['country'];
var loc = document.getElementById("location");

loc.innerHTML = location + " ("+locCode+") " + country;

});

/* Set the width of the side navigation to 250px */
function openNav() {
document.getElementById("mySidenav").style.width = "350px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
document.getElementById("mySidenav").style.width = "0";
}

var checkSwap = 0;
swindex1 = 0;
swindex2 = 0;
swname1 = "";
swname2 = "";
swurl1 = "";
swurl2 = "";
swimg1 = "";
swimg2 = "";
function swap(index, pos, name, url, img){
if(checkSwap == 0){
document.getElementsByClassName("itemText")[index].style.backgroundColor = "green";
index1 = pos;
swname1 = name;
swurl1 = url;
swimg1 = img;
checkSwap = 1;
}
else{
document.getElementsByClassName("itemText")[index].style.backgroundColor = "red";
index2 = pos;
swname2 = name;
swurl2 = url;
swimg2 = img;
checkSwap = 0;
document.getElementById('swicon1').value = index1;
document.getElementById('swicon2').value = index2;
document.getElementById('swname1').value = swname1;
document.getElementById('swname2').value = swname2;
document.getElementById('swurl1').value = swurl1;
document.getElementById('swurl2').value = swurl2;
document.getElementById('swimg1').value = swimg1;
document.getElementById('swimg2').value = swimg2;
document.getElementById('swbtn').click();
setTimeout(() => { $("#autodata").load("php/items.php"); }, 200);
}
}

function remove(i){
var modal = document.getElementById("myDelModal");
modal.style.display = "block";
document.getElementById('id').value = i;
}

function edit(i,name,url,img){
var modal = document.getElementById("myEdModal");
modal.style.display = "block";
document.getElementById('edid').value = i;
document.getElementById('edName').value = name;
document.getElementById('edUrl').value = url;
document.getElementById('edImg').value = img;
}

function settings(){
var modal = document.getElementById("mySeModal");
modal.style.display = "block";
}

function updateTime(){
var currentTime = new Date();
var year = currentTime.getFullYear();
var month = currentTime.getMonth()+1;
var days = currentTime.getDate();
var hours = currentTime.getHours();
var minutes = currentTime.getMinutes();

if (minutes < 10){
    minutes = "0" + minutes;
}
var t_str = days + "." + month + "." + year + " | " + hours + ":" + minutes;

document.getElementById('t').innerHTML = t_str;
}
setInterval(updateTime, 1000);
