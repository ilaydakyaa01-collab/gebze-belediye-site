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

    const trackEl = document.getElementById("etkinlikTrack");
    const viewport = document.getElementById("etkinlikViewport");
    const prevBtn = document.getElementById("etkinlikPrev");
    const nextBtn = document.getElementById("etkinlikNext");
    let eventIndex = 0;
    let eventTimer;

    const getStep = () => {
        const card = trackEl?.querySelector(".etkinlik-kart");
        if (!card || !trackEl) return 300;
        const styles = getComputedStyle(trackEl);
        const gap = parseFloat(styles.columnGap || styles.gap) || 0;
        return card.getBoundingClientRect().width + gap;
    };

    const maxIndex = () => {
        if (!trackEl || !viewport) return 0;
        const overflow = trackEl.scrollWidth - viewport.clientWidth;
        if (overflow <= 4) return 0;
        return Math.round(overflow / getStep());
    };

    const syncSlideWidth = () => {
        if (!viewport) return;
        viewport.style.setProperty("--slide-w", `${viewport.clientWidth}px`);
    };

    const updateEvents = () => {
        if (!trackEl) return;
        syncSlideWidth();
        const max = maxIndex();
        eventIndex = ((eventIndex % (max + 1)) + (max + 1)) % (max + 1);
        trackEl.style.transform = `translateX(-${eventIndex * getStep()}px)`;
    };

    const restartEventTimer = () => {
        clearInterval(eventTimer);
        if (!trackEl || maxIndex() <= 0) return;
        eventTimer = setInterval(() => {
            eventIndex += 1;
            updateEvents();
        }, 4000);
    };

    prevBtn?.addEventListener("click", () => {
        eventIndex -= 1;
        updateEvents();
        restartEventTimer();
    });
    nextBtn?.addEventListener("click", () => {
        eventIndex += 1;
        updateEvents();
        restartEventTimer();
    });

    viewport?.addEventListener("mouseenter", () => clearInterval(eventTimer));
    viewport?.addEventListener("mouseleave", restartEventTimer);

    window.addEventListener("resize", () => {
        updateEvents();
        restartEventTimer();
    });
    updateEvents();
    restartEventTimer();

    const projeTrack = document.getElementById("projeTrack");
    const projeViewport = document.getElementById("projeViewport");
    const projePrev = document.getElementById("projePrev");
    const projeNext = document.getElementById("projeNext");

    const syncProjeWidth = () => {
        if (!projeViewport) return;
        projeViewport.style.setProperty("--proje-w", `${projeViewport.clientWidth}px`);
    };

    const getProjeStep = () => {
        const card = projeTrack?.querySelector(".proje-kart:not([hidden])");
        if (!card || !projeTrack) return 300;
        const styles = getComputedStyle(projeTrack);
        const gap = parseFloat(styles.columnGap || styles.gap) || 0;
        return card.getBoundingClientRect().width + gap;
    };

    const applyProjeFilter = (filter) => {
        projeTrack?.querySelectorAll(".proje-kart").forEach((card) => {
            const match = filter === "tumu" || card.dataset.durum === filter;
            card.toggleAttribute("hidden", !match);
        });
        if (projeViewport) projeViewport.scrollLeft = 0;
        syncProjeWidth();
    };

    document.querySelectorAll(".proje-filtre").forEach((btn) => {
        btn.addEventListener("click", () => {
            document.querySelectorAll(".proje-filtre").forEach((b) => {
                b.classList.toggle("is-active", b === btn);
            });
            applyProjeFilter(btn.dataset.filter || "tumu");
        });
    });

    projePrev?.addEventListener("click", () => {
        projeViewport?.scrollBy({ left: -getProjeStep(), behavior: "smooth" });
    });
    projeNext?.addEventListener("click", () => {
        projeViewport?.scrollBy({ left: getProjeStep(), behavior: "smooth" });
    });

    if (projeViewport) {
        let isDown = false;
        let startX = 0;
        let scrollStart = 0;

        const onMove = (clientX) => {
            if (!isDown) return;
            const dx = clientX - startX;
            projeViewport.scrollLeft = scrollStart - dx;
        };

        const onUp = () => {
            if (!isDown) return;
            isDown = false;
            projeViewport.classList.remove("is-dragging");
            document.removeEventListener("mousemove", onMouseMove);
            document.removeEventListener("mouseup", onUp);
            document.removeEventListener("touchmove", onTouchMove);
            document.removeEventListener("touchend", onUp);
        };

        const onMouseMove = (e) => {
            e.preventDefault();
            onMove(e.clientX);
        };

        const onTouchMove = (e) => {
            if (e.touches[0]) onMove(e.touches[0].clientX);
        };

        projeViewport.addEventListener("mousedown", (e) => {
            if (e.button !== 0) return;
            e.preventDefault();
            isDown = true;
            startX = e.clientX;
            scrollStart = projeViewport.scrollLeft;
            projeViewport.classList.add("is-dragging");
            document.addEventListener("mousemove", onMouseMove);
            document.addEventListener("mouseup", onUp);
        });

        projeViewport.addEventListener("touchstart", (e) => {
            if (!e.touches[0]) return;
            isDown = true;
            startX = e.touches[0].clientX;
            scrollStart = projeViewport.scrollLeft;
            projeViewport.classList.add("is-dragging");
            document.addEventListener("touchmove", onTouchMove, { passive: true });
            document.addEventListener("touchend", onUp);
        }, { passive: true });

        projeViewport.addEventListener("dragstart", (e) => e.preventDefault());
    }

    window.addEventListener("resize", syncProjeWidth);
    syncProjeWidth();
})();
