
document.querySelectorAll('.buy-btn').forEach(button => {
    button.addEventListener('click', () => {
        const link = button.getAttribute('data-link');
        alert('Budete presmerovaní na oficiálny Apple obchod:\n' + link);
        window.open(link, '_blank'); 
    });
});
