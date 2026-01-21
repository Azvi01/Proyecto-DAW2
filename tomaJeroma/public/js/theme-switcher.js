const savedTheme = localStorage.getItem('theme') || 'dark';
document.documentElement.setAttribute('data-theme', savedTheme);

document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.querySelector('.theme-controller[type="checkbox"]');
    
    if (checkbox) {
        checkbox.checked = (savedTheme === 'dark');
        
        checkbox.addEventListener('change', function() {
            const newTheme = this.checked ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    }
});