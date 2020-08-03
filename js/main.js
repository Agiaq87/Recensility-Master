/**
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */
function callModal(id){
  var modal = document.getElementById(id);

  modal.style.display="block";
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}

function closeModal(id){
  var modal = document.getElementById(id);
  var span = document.getElementById(id+"-close");

  span.onclick = modal.style.display = "none";
}

