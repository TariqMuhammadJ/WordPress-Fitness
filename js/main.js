document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popup");
    const popupClose = document.querySelector(".popup-close");
    const gotIt = document.querySelector(".btn-primary");
    const menu = document.querySelector(".material-icons.menu-toggle");
    const main = document.querySelector(".top_main");

    // --- popup logic ---
    if (popup && popupClose && gotIt) {
        let clicked = getCookie("clicked");
        if (!clicked) popup.classList.add("active");

        popupClose.addEventListener("click", function() {
            popup.classList.remove("active");
            document.cookie = "clicked=true";
        });

        gotIt.addEventListener("click", function(){
            popup.classList.remove("active");
            document.cookie = "clicked=true";
        });
    }

    // --- menu logic ---
    if (menu && main) {
        menu.addEventListener("click", function () {
            main.classList.toggle("active");

            // only add close button if it's not there
            if (!main.querySelector(".menu-close")) {
                const closeBtn = document.createElement("i");
                closeBtn.className = "material-icons menu-close";
                closeBtn.textContent = "close";
                main.insertAdjacentElement("afterbegin", closeBtn);

                closeBtn.addEventListener("click", function () {
                    main.classList.remove("active");
                    closeBtn.remove();
                });
            }
        });
    }

    function getCookie(name) {
        const cookies = document.cookie.split("; ");
        for (let cookie of cookies) {
            const [key, value] = cookie.split("=");
            if (key === name) return value;
        }
        return null;
    }
});
