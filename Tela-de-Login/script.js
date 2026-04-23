function toggleTheme() {
    const body = document.body;
    const icon = document.querySelector(".icon");

    // Alterna o tema
    body.classList.toggle("dark-theme");

    // Salva no localStorage
    const isDark = body.classList.contains("dark-theme");
    localStorage.setItem("theme", isDark ? "dark" : "light");

    // Atualiza ícone
    icon.textContent = isDark ? "☀️" : "🌙";

    // Animação
    icon.classList.add("rotate");
    setTimeout(() => {
        icon.classList.remove("rotate");
    }, 300);
}

/* Atualiza ícone sozinho */
function updateIcon() {
    const icon = document.querySelector(".icon");

    if (!icon) return; // evita erro em páginas sem botão

    const isDark = document.body.classList.contains("dark-theme");
    icon.textContent = isDark ? "☀️" : "🌙";
}

/* Mantém o tema ao trocar de página */
window.onload = function () {
    const savedTheme = localStorage.getItem("theme");

    if (savedTheme === "dark") {
        document.body.classList.add("dark-theme");
    }

    updateIcon();
};

function toggleMenu() {
    const nav = document.querySelector(".header nav");
    const toggle = document.querySelector(".menu-toggle");

    nav.classList.toggle("active");
    toggle.classList.toggle("active");
}