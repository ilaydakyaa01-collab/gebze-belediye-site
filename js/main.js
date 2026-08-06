(() => {
    const nav = document.getElementById("siteNav");
    const isTransparentNav = nav?.dataset.transparent === "1";
    const onScroll = () => {
        if (!nav || !isTransparentNav) return;
        nav.classList.toggle("is-scrolled", window.scrollY > 40);
    };
    if (isTransparentNav) {
        window.addEventListener("scroll", onScroll, { passive: true });
        onScroll();
    }

    const toggle = document.getElementById("navToggle");
    const menu = document.getElementById("mobileMenu");
    const backdrop = document.getElementById("mobileBackdrop");
    const closeBtn = document.getElementById("navClose");

    const openMenu = () => {
        if (!menu || !backdrop || !toggle) return;
        menu.hidden = false;
        backdrop.hidden = false;
        requestAnimationFrame(() => menu.classList.add("is-open"));
        toggle.setAttribute("aria-expanded", "true");
        document.body.style.overflow = "hidden";
    };

    const closeMenu = () => {
        if (!menu || !backdrop || !toggle) return;
        menu.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
        document.body.style.overflow = "";
        setTimeout(() => {
            menu.hidden = true;
            backdrop.hidden = true;
        }, 280);
    };

    toggle?.addEventListener("click", openMenu);
    closeBtn?.addEventListener("click", closeMenu);
    backdrop?.addEventListener("click", closeMenu);
    menu?.querySelectorAll("a").forEach((link) => link.addEventListener("click", closeMenu));

    const slides = [...document.querySelectorAll(".hero-slide")];
    const dotsWrap = document.getElementById("heroDots");
    let index = 0;
    let timer;

    const goTo = (next) => {
        if (!slides.length) return;
        slides[index].classList.remove("is-active");
        dotsWrap?.children[index]?.classList.remove("is-active");
        index = (next + slides.length) % slides.length;
        slides[index].classList.add("is-active");
        dotsWrap?.children[index]?.classList.add("is-active");
    };

    if (dotsWrap) {
        slides.forEach((_, i) => {
            const dot = document.createElement("button");
            dot.type = "button";
            dot.setAttribute("aria-label", `Slayt ${i + 1}`);
            if (i === 0) dot.classList.add("is-active");
            dot.addEventListener("click", () => {
                goTo(i);
                restart();
            });
            dotsWrap.appendChild(dot);
        });
    }

    const restart = () => {
        clearInterval(timer);
        timer = setInterval(() => goTo(index + 1), 5500);
    };

    document.getElementById("heroPrev")?.addEventListener("click", () => {
        goTo(index - 1);
        restart();
    });
    document.getElementById("heroNext")?.addEventListener("click", () => {
        goTo(index + 1);
        restart();
    });
    restart();

    const track = document.getElementById("tickerTrack");
    const pauseBtn = document.getElementById("tickerPause");
    let paused = false;
    pauseBtn?.addEventListener("click", () => {
        paused = !paused;
        track?.classList.toggle("is-paused", paused);
        pauseBtn.classList.toggle("is-paused", paused);
        const pauseIcon = pauseBtn.querySelector(".icon-pause");
        const playIcon = pauseBtn.querySelector(".icon-play");
        const text = pauseBtn.querySelector(".ticker-toggle-text");
        if (pauseIcon && playIcon) {
            pauseIcon.toggleAttribute("hidden", paused);
            playIcon.toggleAttribute("hidden", !paused);
        }
        if (text) text.textContent = paused ? "Devam Ettir" : "Duraklat";
        pauseBtn.setAttribute("aria-label", paused ? "Devam ettir" : "Duraklat");
        pauseBtn.setAttribute("aria-pressed", paused ? "true" : "false");
    });

    const sectionTitle = document.getElementById("sectionTitle");
    const sectionDesc = document.getElementById("sectionDesc");
    const sectionHeader = document.querySelector(".haber-bolumu .section-header");

    document.querySelectorAll(".tab-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const target = btn.dataset.tab;
            document.querySelectorAll(".tab-btn").forEach((b) => {
                b.classList.toggle("is-active", b === btn);
                b.setAttribute("aria-selected", b === btn ? "true" : "false");
            });
            document.querySelectorAll(".tab-panel").forEach((panel) => {
                const active = panel.id === target;
                panel.classList.toggle("is-active", active);
                panel.hidden = !active;
            });

            if (sectionTitle && sectionDesc && btn.dataset.title) {
                sectionHeader?.classList.add("is-switching");
                setTimeout(() => {
                    sectionTitle.textContent = btn.dataset.title;
                    sectionDesc.textContent = btn.dataset.desc || "";
                    sectionHeader?.classList.remove("is-switching");
                }, 160);
            }
        });
    });
})();
