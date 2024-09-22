document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.openModalBtn4').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            console.log("Button clicked, user ID: " + userId);
            document.querySelector('#myModal4 input[name="id"]').value = userId;
            $('#myModal4').modal('show');
        });
    });
});