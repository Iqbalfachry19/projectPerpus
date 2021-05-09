
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
  const target =  document.getElementById("icon");
 target.classList.toggle("iup");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (e) {
  
  if (!e.target.matches(".dropbtn")) {
    var myDropdown = document.getElementById("myDropdown");

 

    if (myDropdown.classList.contains("show")) {
      const target =  document.getElementById("icon");
      target.classList.remove("iup")
      myDropdown.classList.remove("show");
      
    }
  }
};
