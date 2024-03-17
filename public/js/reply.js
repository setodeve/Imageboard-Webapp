document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('create-form');
  
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
  
        fetch('/form/create/reply', {
            method: 'POST',
            body: formData
        })
          .then(response => response.json())
          .then(data => {
              if (data.status === 'success') {
                if (!formData.has('id')) form.reset();
                location.reload();
              } else if (data.status === 'error') {
                alert('created failed');
              }
          })
          .catch((error) => {
              alert('An error occurred. Please try again.');
          });
      });
  });