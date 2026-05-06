document.addEventListener("DOMContentLoaded", function () {

    const bookButtons = document.querySelectorAll('.book-btn');

    bookButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const formId = btn.getAttribute('data-target');
            const form = document.getElementById(formId);

            if (form) {
                form.scrollIntoView({ behavior: 'smooth' });
                form.style.border = '2px solid #0a7cff';
                form.style.padding = '25px';
                setTimeout(() => {
                    form.style.border = '';
                    form.style.padding = '';
                }, 2000);
            } else {
                alert("Appointment form not found");
            }
        });
    });

});

// ----------------------
// Smooth submit for all forms
// ----------------------

// Function to handle AJAX form submit
function handleFormSubmit(formId, processFile) {
    const form = document.getElementById(formId);

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default page reload

        const formData = new FormData(form);

        fetch(processFile, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Show success/error message
            form.reset(); // Clear the form after submit
        })
        .catch(error => {
            alert('Error submitting form: ' + error);
        });
    });
}

// Apply to all forms
handleFormSubmit('consultForm', 'consultation_process.php');
handleFormSubmit('appointmentForm', 'appointment_process.php');
handleFormSubmit('contactForm', 'contact_process.php');
