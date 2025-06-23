// submit.js
document.addEventListener('DOMContentLoaded', () => {
    const form    = document.getElementById('signupForm');
    const toastEl = document.getElementById('toast');
  
    function showToast(message, duration = 4000) {
      toastEl.textContent = message;
      toastEl.classList.add('show');
      setTimeout(() => toastEl.classList.remove('show'), duration);
    }
  
    form.addEventListener('submit', e => {
      e.preventDefault();
      const data = new FormData(form);
  
      fetch(form.action, {
        method: form.method,
        body: data
      })
      .then(res => res.json())
      .then(json => {
        if (json.status === 'success') {
          showToast(json.message, 4000);
          form.reset();
        } else {
          showToast(json.errors.join('\n'), 5000);
        }
      })
      .catch(err => {
        console.error(err);
        //showToast('Wystąpił błąd podczas wysyłki.', 5000);
      });
    });
  });
  