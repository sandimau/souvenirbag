const STORAGE_KEY = 'sb-theme';

export function getTheme() {
    return localStorage.getItem(STORAGE_KEY) || 'light';
}

export function applyTheme(theme) {
    const resolved = theme === 'dark' ? 'dark' : 'light';

    document.documentElement.setAttribute('data-theme', resolved);
    document.documentElement.setAttribute('data-bs-theme', resolved);

    const metaTheme = document.querySelector('meta[name="theme-color"]');
    if (metaTheme) {
        metaTheme.setAttribute('content', resolved === 'dark' ? '#0f172a' : '#6366f1');
    }

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        const icon = button.querySelector('i');
        if (icon) {
            icon.className = resolved === 'dark' ? 'bx bx-sun' : 'bx bx-moon';
        }

        const label = resolved === 'dark' ? 'Mode terang' : 'Mode gelap';
        button.setAttribute('aria-label', label);
        button.setAttribute('title', label);
    });
}

export function setTheme(theme) {
    const resolved = theme === 'dark' ? 'dark' : 'light';
    localStorage.setItem(STORAGE_KEY, resolved);
    applyTheme(resolved);
}

export function toggleTheme() {
    setTheme(getTheme() === 'dark' ? 'light' : 'dark');
}

document.addEventListener('DOMContentLoaded', () => {
    applyTheme(getTheme());

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', toggleTheme);
    });
});
