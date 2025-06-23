function openForm() {
  document.getElementById("form").style.display = "block";
}

function closeForm() {
  document.getElementById("form").style.display = "none";
}

window.onclick = function(event) {
  if (event.target == document.getElementById("form")) {
    closeForm();
  }
};

const signupForm = document.getElementById('signupForm');
signupForm.addEventListener('submit', (e) => {
  e.preventDefault();
  alert('Dziękujemy za zgłoszenie! Do zobaczenia na starcie!');
  signupForm.reset();
  closeForm();
});





