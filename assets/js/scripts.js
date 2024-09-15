// scripts.js
document.addEventListener('DOMContentLoaded', function() {
    const deleteLinks = document.querySelectorAll('a[href*="delete.php"]');

    deleteLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            if (!confirm('Tem certeza de que deseja excluir este jogo?')) {
                event.preventDefault();
            }
        });
    });
});

