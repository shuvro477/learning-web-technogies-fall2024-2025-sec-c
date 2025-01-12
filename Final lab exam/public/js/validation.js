document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const inputs = form.querySelectorAll('input[required]');
        inputs.forEach(input => {
            if (!input.value.trim()) {
                e.preventDefault();
                alert(`${input.name} is required.`);
            }
        });
    });
});
