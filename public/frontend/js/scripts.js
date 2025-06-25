document.addEventListener("DOMContentLoaded", function () {
    const alerts = document.querySelectorAll(".alert-dismissible");
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.classList.remove("show");
            alert.classList.add("fade");
            setTimeout(() => {
                alert.remove();
            }, 100);
        }, 4000);
    });
});

document.getElementById("mobileMenuToggle").addEventListener("click", () => {
    const menu = document.getElementById("mobileMenu");
    menu.classList.toggle("hidden");
});
