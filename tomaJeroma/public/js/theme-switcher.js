// Aplicar tema inmediatamente (antes de que cargue el DOM)
const savedTheme = localStorage.getItem('theme') || 'light';
document.documentElement.setAttribute('data-theme', savedTheme);

// Cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.querySelector('.theme-controller[type="checkbox"]');
    
    if (checkbox) {
        // Establecer el estado inicial del checkbox
        checkbox.checked = (savedTheme === 'dark');
        
        // Escuchar cambios
        checkbox.addEventListener('change', function() {
            const newTheme = this.checked ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    }
});