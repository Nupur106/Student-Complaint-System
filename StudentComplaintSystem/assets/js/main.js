document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a[href*="delete"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (!confirm('Are you sure you want to delete this record?')) e.preventDefault();
        });
    });
});