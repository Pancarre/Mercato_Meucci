document.addEventListener('DOMContentLoaded', function() {
    var toggleIcon = document.getElementById('toggle1');
    var profiloContainer = document.getElementById('profilo-container');

    toggleIcon.addEventListener('click', function() {
        if (profiloContainer.classList.contains('d-none')) {
            profiloContainer.classList.remove('d-none');
            profiloContainer.classList.add('d-block');
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            profiloContainer.classList.remove('d-block');
            profiloContainer.classList.add('d-none');
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var toggleIcon = document.getElementById('toggle2');
    var profiloContainer = document.getElementById('profilo-container');

    toggleIcon.addEventListener('click', function() {
        if (profiloContainer.classList.contains('d-none')) {
            profiloContainer.classList.remove('d-none');
            profiloContainer.classList.add('d-block');
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            profiloContainer.classList.remove('d-block');
            profiloContainer.classList.add('d-none');
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    });
});