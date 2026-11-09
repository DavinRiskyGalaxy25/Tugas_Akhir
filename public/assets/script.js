document.addEventListener("DOMContentLoaded", function () {
    /* =====================================================
       HEADER TRANSPARENT / SOLID ON SCROLL
    ===================================================== */
    const siteHeader = document.getElementById("siteHeader") || document.querySelector(".site-header");
    if (siteHeader) {
        function checkHeaderScroll() {
            if (window.scrollY > 30) {
                siteHeader.classList.add("scrolled");
            } else {
                siteHeader.classList.remove("scrolled");
            }
        }
        window.addEventListener("scroll", checkHeaderScroll, { passive: true });
        checkHeaderScroll();
    }


    /* =====================================================
       ACTIVE NAVBAR
    ===================================================== */

    const currentPage =
        window.location.pathname
            .split("/")
            .pop()
            .toLowerCase();


    const navItems =
        document.querySelectorAll(
            ".nav-link, .nav-dropdown"
        );


    navItems.forEach(function (item) {

        item.classList.remove("active");

    });


    if (
        currentPage === "" ||
        currentPage === "index.html"
    ) {

        const home =
            document.querySelector(
                '.nav-link[href="index.html"]'
            );

        if (home) {

            home.classList.add("active");

        }

    }


    if (currentPage === "profil.html") {

        const profil =
            document.querySelector(
                ".menu-profil"
            );

        if (profil) {

            profil.classList.add("active");

        }

    }


    if (currentPage === "akademik.html") {

        const akademik =
            document.querySelector(
                ".menu-akademik"
            );

        if (akademik) {

            akademik.classList.add("active");

        }

    }


    if (currentPage === "kesiswaan.html") {

        const kesiswaan =
            document.querySelector(
                ".menu-kesiswaan"
            );

        if (kesiswaan) {

            kesiswaan.classList.add("active");

        }

    }


    if (
        currentPage === "informasi.html" ||
        currentPage === "alumni-form.html" ||
        currentPage === "informasi.html#ppdb"
    ) {

        const informasi =
            document.querySelector(
                ".menu-informasi"
            );

        if (informasi) {

            informasi.classList.add("active");

        }

    }



    /* =====================================================
       DROPDOWN NAVBAR DESKTOP
    ===================================================== */

    const dropdowns =
        document.querySelectorAll(
            ".nav-dropdown"
        );


    dropdowns.forEach(function (dropdown) {

        const button =
            dropdown.querySelector(
                ".dropdown-toggle"
            );


        if (!button) {

            return;

        }


        button.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                event.stopPropagation();


                dropdowns.forEach(
                    function (item) {

                        if (item !== dropdown) {

                            item.classList.remove(
                                "open"
                            );

                        }

                    }
                );


                dropdown.classList.toggle(
                    "open"
                );

            }
        );

    });


    document.addEventListener(
        "click",
        function (event) {

            if (
                !event.target.closest(
                    ".nav-dropdown"
                )
            ) {

                dropdowns.forEach(
                    function (dropdown) {

                        dropdown.classList.remove(
                            "open"
                        );

                    }
                );

            }

        }
    );



    /* =====================================================
       MOBILE SIDEBAR
    ===================================================== */

    const mobileMenuButton =
        document.querySelector(
            ".mobile-menu-trigger"
        );


    const mobileSidebar =
        document.querySelector(
            ".mobile-sidebar"
        );


    const mobileOverlay =
        document.querySelector(
            ".mobile-overlay"
        );


    const mobileClose =
        document.querySelector(
            ".mobile-close"
        );


    const mobileDropdowns =
        document.querySelectorAll(
            ".mobile-dropdown"
        );


    function openMobileSidebar() {

        if (!mobileSidebar) {

            return;

        }


        document.body.classList.add(
            "mobile-menu-open"
        );


        if (mobileMenuButton) {

            mobileMenuButton.setAttribute(
                "aria-expanded",
                "true"
            );

        }

    }


    function closeMobileSidebar() {

        document.body.classList.remove(
            "mobile-menu-open"
        );


        if (mobileMenuButton) {

            mobileMenuButton.setAttribute(
                "aria-expanded",
                "false"
            );

        }


        mobileDropdowns.forEach(
            function (dropdown) {

                dropdown.classList.remove(
                    "open"
                );

            }
        );

    }


    if (mobileMenuButton) {

        mobileMenuButton.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                openMobileSidebar();

            }
        );

    }


    if (mobileClose) {

        mobileClose.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                closeMobileSidebar();

            }
        );

    }


    if (mobileOverlay) {

        mobileOverlay.addEventListener(
            "click",
            function () {

                closeMobileSidebar();

            }
        );

    }



    /* =====================================================
       DROPDOWN SIDEBAR MOBILE
    ===================================================== */

    mobileDropdowns.forEach(
        function (dropdown) {

            const toggle =
                dropdown.querySelector(
                    ".mobile-dropdown-toggle"
                );


            if (!toggle) {

                return;

            }


            toggle.addEventListener(
                "click",
                function (event) {

                    event.preventDefault();

                    event.stopPropagation();


                    mobileDropdowns.forEach(
                        function (item) {

                            if (
                                item !== dropdown
                            ) {

                                item.classList.remove(
                                    "open"
                                );

                            }

                        }
                    );


                    dropdown.classList.toggle(
                        "open"
                    );

                }
            );

        }
    );



    /* =====================================================
       LINK PADA MOBILE SIDEBAR
    ===================================================== */

    const mobileLinks =
        document.querySelectorAll(
            ".mobile-sidebar a"
        );


    mobileLinks.forEach(
        function (link) {

            link.addEventListener(
                "click",
                function () {

                    closeMobileSidebar();

                }
            );

        }
    );



    /* =====================================================
       TUTUP MENU SAAT RESIZE
    ===================================================== */

    window.addEventListener(
        "resize",
        function () {

            if (
                window.innerWidth > 800
            ) {

                closeMobileSidebar();

            }

        }
    );



    /* =====================================================
       SEARCH
    ===================================================== */

    const searchOverlay =
        document.getElementById(
            "searchOverlay"
        );


    const searchButtons =
        document.querySelectorAll(
            ".search-trigger"
        );


    const searchClose =
        document.querySelector(
            ".modal-close"
        );


    const searchInput =
        document.getElementById(
            "searchInput"
        );


    const searchResults =
        document.getElementById(
            "searchResults"
        );


    const searchData = [

        {
            title: "Tentang Sekolah",
            url: "profil.html#tentang",
            keywords:
                "tentang sekolah profil"
        },

        {
            title: "Sejarah",
            url: "profil.html#sejarah",
            keywords:
                "sejarah"
        },

        {
            title: "Visi dan Misi",
            url: "profil.html#visi-misi",
            keywords:
                "visi misi"
        },

        {
            title: "Identitas Sekolah",
            url: "profil.html#identitas",
            keywords:
                "identitas sekolah npsn"
        },

        {
            title: "Struktur Organisasi",
            url: "profil.html#struktur",
            keywords:
                "struktur organisasi kepala sekolah waka"
        },

        {
            title: "Guru dan Tenaga Kependidikan",
            url: "akademik.html#guru",
            keywords:
                "guru tenaga kependidikan"
        },

        {
            title: "Fasilitas",
            url: "akademik.html#fasilitas",
            keywords:
                "fasilitas sekolah"
        },

        {
            title: "Kegiatan",
            url: "kesiswaan.html#kegiatan",
            keywords:
                "kegiatan siswa"
        },

        {
            title: "Prestasi",
            url: "kesiswaan.html#prestasi",
            keywords:
                "prestasi lomba"
        },

        {
            title: "Ekstrakurikuler",
            url: "kesiswaan.html#ekstrakurikuler",
            keywords:
                "ekstrakurikuler"
        },

        {
            title: "Berita",
            url: "informasi.html#berita",
            keywords:
                "berita informasi"
        },

        {
            title: "Alumni",
            url: "informasi.html#alumni",
            keywords:
                "alumni kesan pesan"
        },

        {
            title: "PPDB",
            url: "informasi.html#ppdb",
            keywords:
                "ppdb spmb pendaftaran"
        },

        {
            title: "Kontak",
            url: "informasi.html#kontak",
            keywords:
                "kontak whatsapp email telepon"
        }

    ];


    function openSearch() {

        if (!searchOverlay) {

            return;

        }


        searchOverlay.classList.add(
            "open"
        );


        document.body.classList.add(
            "modal-open"
        );


        if (searchInput) {

            setTimeout(
                function () {

                    searchInput.focus();

                },
                100
            );

        }

    }


    function closeSearch() {

        if (!searchOverlay) {

            return;

        }


        searchOverlay.classList.remove(
            "open"
        );


        document.body.classList.remove(
            "modal-open"
        );

    }


    searchButtons.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function (event) {

                    event.preventDefault();

                    openSearch();

                }
            );

        }
    );


    if (searchClose) {

        searchClose.addEventListener(
            "click",
            closeSearch
        );

    }


    if (searchOverlay) {

        searchOverlay.addEventListener(
            "click",
            function (event) {

                if (
                    event.target ===
                    searchOverlay
                ) {

                    closeSearch();

                }

            }
        );

    }


    function escapeHTML(value) {

        return String(value)

            .replace(
                /&/g,
                "&amp;"
            )

            .replace(
                /</g,
                "&lt;"
            )

            .replace(
                />/g,
                "&gt;"
            )

            .replace(
                /"/g,
                "&quot;"
            )

            .replace(
                /'/g,
                "&#039;"
            );

    }


    function renderSearchResults(
        keyword
    ) {

        if (!searchResults) {

            return;

        }


        const value =
            String(keyword)
                .trim()
                .toLowerCase();


        if (!value) {

            searchResults.innerHTML = `
                <p class="search-empty">
                    Ketik informasi yang ingin dicari.
                </p>
            `;

            return;

        }


        const results =
            searchData.filter(
                function (item) {

                    return (

                        item.title
                            .toLowerCase()
                            .includes(value)

                        ||

                        item.keywords
                            .toLowerCase()
                            .includes(value)

                    );

                }
            );


        if (
            results.length === 0
        ) {

            searchResults.innerHTML = `
                <p class="search-empty">
                    Informasi tidak ditemukan.
                </p>
            `;

            return;

        }


        searchResults.innerHTML =
            results
                .map(
                    function (item) {

                        return `

                            <a
                                href="${item.url}"
                                class="search-result"
                            >

                                <strong>
                                    ${escapeHTML(
                                        item.title
                                    )}
                                </strong>

                                <span>
                                    Buka
                                    <i class="fa-solid fa-arrow-right"></i>
                                </span>

                            </a>

                        `;

                    }
                )
                .join("");

    }


    if (searchInput) {

        searchInput.addEventListener(
            "input",
            function () {

                renderSearchResults(
                    searchInput.value
                );

            }
        );

    }



    /* =====================================================
       PENCARIAN GURU
    ===================================================== */

    const teacherInput =
        document.getElementById(
            "teacherSearch"
        );


    if (teacherInput) {

        teacherInput.addEventListener(
            "input",
            function () {

                const keyword =
                    teacherInput.value
                        .trim()
                        .toLowerCase();


                const teacherCards =
                    document.querySelectorAll(
                        ".teacher-card"
                    );


                teacherCards.forEach(
                    function (card) {

                        const text =
                            card.textContent
                                .toLowerCase();


                        card.style.display =
                            text.includes(
                                keyword
                            )
                            ? ""
                            : "none";

                    }
                );

            }
        );

    }



    /* =====================================================
       GALERI FILTER
    ===================================================== */

    const filterButtons =
        document.querySelectorAll(
            ".gallery-filter-button"
        );


    const galleryCards =
        document.querySelectorAll(
            ".gallery-card"
        );


    filterButtons.forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    const filter =
                        button.dataset.filter;


                    filterButtons.forEach(
                        function (item) {

                            item.classList.remove(
                                "active"
                            );

                        }
                    );


                    button.classList.add(
                        "active"
                    );


                    galleryCards.forEach(
                        function (card) {

                            const category =
                                card.dataset.category;


                            if (
                                filter === "all"
                                ||
                                category === filter
                            ) {

                                card.style.display =
                                    "";

                            } else {

                                card.style.display =
                                    "none";

                            }

                        }
                    );

                }
            );

        }
    );



    /* =====================================================
       GALERI MODAL
    ===================================================== */

    const galleryModal =
        document.getElementById(
            "galleryModal"
        );


    const galleryImage =
        document.getElementById(
            "galleryModalImage"
        );


    const galleryTitle =
        document.getElementById(
            "galleryModalTitle"
        );


    const galleryDate =
        document.getElementById(
            "galleryModalDate"
        );


    const galleryClose =
        document.querySelector(
            ".gallery-close"
        );


    const galleryPrev =
        document.querySelector(
            ".gallery-prev"
        );


    const galleryNext =
        document.querySelector(
            ".gallery-next"
        );


    let currentGalleryIndex = 0;

    let visibleGalleryCards = [];


    function updateGallery() {

        if (
            visibleGalleryCards.length ===
            0
        ) {

            return;

        }


        const card =
            visibleGalleryCards[
                currentGalleryIndex
            ];


        if (galleryImage) {

            galleryImage.src =
                card.dataset.image || "";

            galleryImage.alt =
                card.dataset.title || "";

        }


        if (galleryTitle) {

            galleryTitle.textContent =
                card.dataset.title || "";

        }


        if (galleryDate) {

            galleryDate.textContent =
                card.dataset.date || "";

        }

    }


    function refreshVisibleGalleryCards() {

        visibleGalleryCards =
            Array.from(
                document.querySelectorAll(
                    ".gallery-card"
                )
            )
            .filter(
                function (card) {

                    return (
                        card.style.display !==
                        "none"
                    );

                }
            );

    }


    function openGallery(card) {

        if (!galleryModal) {

            return;

        }


        refreshVisibleGalleryCards();


        currentGalleryIndex =
            visibleGalleryCards.indexOf(
                card
            );


        if (
            currentGalleryIndex < 0
        ) {

            currentGalleryIndex = 0;

        }


        updateGallery();


        galleryModal.classList.add(
            "open"
        );


        document.body.classList.add(
            "modal-open"
        );

    }


    function closeGallery() {

        if (!galleryModal) {

            return;

        }


        galleryModal.classList.remove(
            "open"
        );


        document.body.classList.remove(
            "modal-open"
        );

    }


    document.querySelectorAll(
        ".gallery-image-button"
    )
    .forEach(
        function (button) {

            button.addEventListener(
                "click",
                function () {

                    const card =
                        button.closest(
                            ".gallery-card"
                        );


                    if (card) {

                        openGallery(card);

                    }

                }
            );

        }
    );


    if (galleryClose) {

        galleryClose.addEventListener(
            "click",
            closeGallery
        );

    }


    if (galleryPrev) {

        galleryPrev.addEventListener(
            "click",
            function () {

                refreshVisibleGalleryCards();


                if (
                    visibleGalleryCards.length ===
                    0
                ) {

                    return;

                }


                currentGalleryIndex =
                    (
                        currentGalleryIndex -
                        1 +
                        visibleGalleryCards.length
                    )
                    %
                    visibleGalleryCards.length;


                updateGallery();

            }
        );

    }


    if (galleryNext) {

        galleryNext.addEventListener(
            "click",
            function () {

                refreshVisibleGalleryCards();


                if (
                    visibleGalleryCards.length ===
                    0
                ) {

                    return;

                }


                currentGalleryIndex =
                    (
                        currentGalleryIndex +
                        1
                    )
                    %
                    visibleGalleryCards.length;


                updateGallery();

            }
        );

    }


    if (galleryModal) {

        galleryModal.addEventListener(
            "click",
            function (event) {

                if (
                    event.target ===
                    galleryModal
                ) {

                    closeGallery();

                }

            }
        );

    }



    /* =====================================================
       ALUMNI
    ===================================================== */

    const alumniList =
        document.getElementById(
            "alumniList"
        );


    const alumniEmpty =
        document.getElementById(
            "alumniEmpty"
        );


    const alumniForm =
        document.getElementById(
            "alumniForm"
        );


    const defaultAlumni = [

        {
            nama: "Muhammad Rizky",
            tahun: "2022",
            pekerjaan: "Mahasiswa",
            rating: 5,
            tanggal: "12 Agustus 2025",
            pesan:
                "SMP Al Ahmad menjadi tempat yang sangat berkesan bagi saya. Guru gurunya baik dan selalu memotivasi saya untuk berprestasi."
        },

        {
            nama: "Aisyah Nur Fadilah",
            tahun: "2021",
            pekerjaan: "Mahasiswi",
            rating: 5,
            tanggal: "10 Agustus 2025",
            pesan:
                "Sekolah ini memberikan banyak pengalaman dan pelajaran yang bermanfaat untuk masa depan."
        },

        {
            nama: "Ahmad Fauzi",
            tahun: "2020",
            pekerjaan: "Karyawan",
            rating: 4,
            tanggal: "8 Agustus 2025",
            pesan:
                "Banyak pengalaman berharga yang saya dapatkan di SMP Al Ahmad, mulai dari kegiatan sekolah hingga persahabatan."
        },

        {
            nama: "Siti Nurhaliza",
            tahun: "2019",
            pekerjaan: "Guru",
            rating: 5,
            tanggal: "5 Agustus 2025",
            pesan:
                "Terima kasih SMP Al Ahmad yang telah memberikan banyak pengalaman dan membantu saya berkembang menjadi pribadi yang lebih baik."
        },

        {
            nama: "Dimas Prasetyo",
            tahun: "2018",
            pekerjaan: "Karyawan",
            rating: 5,
            tanggal: "3 Agustus 2025",
            pesan:
                "Lingkungan sekolah yang nyaman membuat saya memiliki banyak kenangan yang sampai sekarang masih saya ingat."
        },

        {
            nama: "Fadila Rahma",
            tahun: "2023",
            pekerjaan: "Mahasiswi",
            rating: 5,
            tanggal: "1 Agustus 2025",
            pesan:
                "Kenangan selama di SMP Al Ahmad akan selalu menjadi bagian penting dalam perjalanan pendidikan saya."
        }

    ];


    function getAlumniData() {

        const saved =
            localStorage.getItem(
                "alumniSmpAlAhmadList"
            );


        if (saved) {

            try {

                const parsed =
                    JSON.parse(saved);


                if (
                    Array.isArray(parsed)
                ) {

                    return parsed;

                }

            } catch (error) {

                console.log(
                    "Data alumni tidak dapat dibaca."
                );

            }

        }


        return defaultAlumni;

    }


    function saveAlumniData(
        data
    ) {

        localStorage.setItem(
            "alumniSmpAlAhmadList",
            JSON.stringify(data)
        );

    }


    function getInitials(name) {

        const words =
            String(name)
                .trim()
                .split(/\s+/)
                .filter(Boolean);


        if (
            words.length === 0
        ) {

            return "?";

        }


        if (
            words.length === 1
        ) {

            return words[0]
                .substring(0, 2)
                .toUpperCase();

        }


        return (
            words[0].charAt(0) +
            words[1].charAt(0)
        )
            .toUpperCase();

    }


    function createStars(rating) {

        const total =
            Number(rating) || 0;


        let stars = "";


        for (
            let i = 1;
            i <= 5;
            i++
        ) {

            stars +=
                i <= total
                    ? "â˜…"
                    : "â˜†";

        }


        return stars;

    }


    function renderAlumni() {

        if (!alumniList) {

            return;

        }


        const data =
            getAlumniData();


        alumniList.innerHTML = "";


        if (
            data.length === 0
        ) {

            if (alumniEmpty) {

                alumniEmpty.classList.add(
                    "show"
                );

            }

            return;

        }


        if (alumniEmpty) {

            alumniEmpty.classList.remove(
                "show"
            );

        }


        data.forEach(
            function (alumni) {

                const card =
                    document.createElement(
                        "article"
                    );


                card.className =
                    "alumni-card";


                card.innerHTML = `

                    <div class="alumni-card-top">

                        <div class="alumni-person">

                            <div class="alumni-avatar">
                                ${getInitials(
                                    alumni.nama
                                )}
                            </div>


                            <div class="alumni-person-info">

                                <h3>
                                    ${escapeHTML(
                                        alumni.nama
                                    )}
                                </h3>

                                <p>
                                    Lulus
                                    ${escapeHTML(
                                        alumni.tahun
                                    )}
                                    â€¢
                                    ${escapeHTML(
                                        alumni.pekerjaan
                                    )}
                                </p>

                            </div>

                        </div>


                        <div class="alumni-date">
                            ${escapeHTML(
                                alumni.tanggal
                            )}
                        </div>

                    </div>


                    <div class="alumni-rating">

                        <div class="alumni-stars">
                            ${createStars(
                                alumni.rating
                            )}
                        </div>

                    </div>


                    <p class="alumni-message">
                        ${escapeHTML(
                            alumni.pesan
                        )}
                    </p>

                `;


                alumniList.appendChild(
                    card
                );

            }
        );

    }


    // [Alumni form handled by Laravel backend in alumni.blade.php]



    renderAlumni();



    // [PPDB form handled by Laravel backend in ppdb.blade.php]




    /* =====================================================
       TOAST
    ===================================================== */

    const toast =
        document.getElementById(
            "toast"
        );


    function showToast(message) {

        if (!toast) {

            return;

        }


        toast.textContent =
            message;


        toast.classList.add(
            "show"
        );


        clearTimeout(
            window.alumniToastTimer
        );


        window.alumniToastTimer =
            setTimeout(
                function () {

                    toast.classList.remove(
                        "show"
                    );

                },
                3000
            );

    }



    /* =====================================================
       REVEAL ANIMATION
    ===================================================== */

    const revealElements =
        document.querySelectorAll(
            ".reveal"
        );


    if (
        "IntersectionObserver"
        in window
    ) {

        const revealObserver =
            new IntersectionObserver(
                function (entries) {

                    entries.forEach(
                        function (entry) {

                            if (
                                entry.isIntersecting
                            ) {

                                entry.target.classList.add(
                                    "visible"
                                );


                                revealObserver.unobserve(
                                    entry.target
                                );

                            }

                        }
                    );

                },
                {
                    threshold: 0.12
                }
            );


        revealElements.forEach(
            function (element) {

                revealObserver.observe(
                    element
                );

            }
        );

    } else {

        revealElements.forEach(
            function (element) {

                element.classList.add(
                    "visible"
                );

            }
        );

    }



    /* =====================================================
       STAGGER ANIMATION
    ===================================================== */

    const animatedGroups = [

        ".quick-card",
        ".teacher-card",
        ".facility-card",
        ".activity-card",
        ".achievement-card",
        ".extra-card",
        ".gallery-card",
        ".vision-card",
        ".organization-card",
        ".contact-box",
        ".alumni-card"

    ];


    animatedGroups.forEach(
        function (selector) {

            const items =
                document.querySelectorAll(
                    selector
                );


            items.forEach(
                function (
                    item,
                    index
                ) {

                    item.style.transitionDelay =
                        (
                            index * 0.06
                        ) + "s";

                }
            );

        }
    );

/* =====================================================
   SLIDER GURU
===================================================== */

const teacherSlider =
    document.querySelector(".teacher-slider");

const teacherWindow =
    document.querySelector(".teacher-slider-window");

const teacherTrack =
    document.querySelector(".teacher-slider-track");

const teacherPrev =
    document.querySelector(".teacher-prev");

const teacherNext =
    document.querySelector(".teacher-next");


if (
    teacherSlider &&
    teacherWindow &&
    teacherTrack
) {

    let teacherPosition = 0;


    function getTeacherStep() {

        const card =
            teacherTrack.querySelector(
                ".teacher-card"
            );

        if (!card) {

            return 0;

        }


        const gap =
            parseFloat(
                getComputedStyle(
                    teacherTrack
                ).gap
            ) || 18;


        return (
            card.offsetWidth +
            gap
        );

    }


    function getTeacherMaxPosition() {

        const maxScroll =
            teacherTrack.scrollWidth -
            teacherWindow.clientWidth;


        return Math.max(
            0,
            maxScroll
        );

    }


    function updateTeacherSlider() {

        if (
            window.innerWidth <= 800
        ) {

            teacherTrack.style.transform =
                "none";

            if (teacherPrev) {

                teacherPrev.style.display =
                    "flex";

            }

            if (teacherNext) {

                teacherNext.style.display =
                    "flex";

            }

            return;

        }


        const max =
            getTeacherMaxPosition();


        if (
            teacherPosition < 0
        ) {

            teacherPosition = 0;

        }


        if (
            teacherPosition > max
        ) {

            teacherPosition = max;

        }


        teacherTrack.style.transform =
            "translateX(-" +
            teacherPosition +
            "px)";


        if (teacherPrev) {

            teacherPrev.disabled =
                teacherPosition <= 0;

        }


        if (teacherNext) {

            teacherNext.disabled =
                teacherPosition >= max;

        }

    }


    if (teacherNext) {

        teacherNext.addEventListener(
            "click",
            function () {

                const step =
                    getTeacherStep();


                teacherPosition += step;


                updateTeacherSlider();

            }
        );

    }


    if (teacherPrev) {

        teacherPrev.addEventListener(
            "click",
            function () {

                const step =
                    getTeacherStep();


                teacherPosition -= step;


                updateTeacherSlider();

            }
        );

    }


    window.addEventListener(
        "resize",
        function () {

            updateTeacherSlider();

        }
    );


    updateTeacherSlider();

}

    /* =====================================================
       KEYBOARD ESCAPE
    ===================================================== */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape"
            ) {

                closeMobileSidebar();

                closeSearch();

                closeGallery();


                dropdowns.forEach(
                    function (dropdown) {

                        dropdown.classList.remove(
                            "open"
                        );

                    }
                );

            }

        }
    );

/* =====================================================
   FASILITAS
   4 CARD AWAL + LIHAT SEMUA
===================================================== */

const facilityGrid =
    document.querySelector(".facility-grid");

const facilityExtras =
    document.querySelectorAll(
        ".facility-grid .facility-extra"
    );

const facilityMoreButton =
    document.getElementById(
        "facilityMoreButton"
    );

const facilityMoreWrapper =
    document.getElementById(
        "facilityMoreWrapper"
    );


if (
    facilityGrid &&
    facilityMoreButton &&
    facilityMoreWrapper
) {

    /* Tidak ada fasilitas tambahan */

    if (
        facilityExtras.length === 0
    ) {

        facilityMoreWrapper.classList.add(
            "hidden"
        );

    }


    /* Tombol lihat semua */

    facilityMoreButton.addEventListener(
        "click",
        function () {

            facilityGrid.classList.add(
                "show-all"
            );


            facilityMoreWrapper.classList.add(
                "hidden"
            );

        }
    );

}

/* =====================================================
   DETAIL KEGIATAN
===================================================== */

const activityDetailTitle =
    document.getElementById(
        "activityDetailTitle"
    );

const activityDetailDate =
    document.getElementById(
        "activityDetailDate"
    );

const activityDetailDescription =
    document.getElementById(
        "activityDetailDescription"
    );

const activityDetailImage =
    document.getElementById(
        "activityDetailImage"
    );

const activityDetailImageButton =
    document.getElementById(
        "detailImageButton"
    );

const activityDetailPrev =
    document.getElementById(
        "detailGalleryPrev"
    );

const activityDetailNext =
    document.getElementById(
        "detailGalleryNext"
    );

const activityDetailModal =
    document.getElementById(
        "detailImageModal"
    );

const activityDetailModalImage =
    document.getElementById(
        "detailModalImage"
    );

const activityDetailModalClose =
    document.getElementById(
        "detailImageClose"
    );


const activityData = {

    "1": {

        title:
            "Kegiatan Siswa 1",

        date:
            "20 Agustus 2026",

        description:
            "Kegiatan ini merupakan salah satu aktivitas siswa SMP Al Ahmad Krian. Kegiatan dilaksanakan sebagai bagian dari program sekolah untuk mendukung perkembangan siswa melalui pengalaman belajar dan aktivitas bersama.",

        images: [
            "kegiatan1.jpg",
            "kegiatan1-2.jpg",
            "kegiatan1-3.jpg"
        ]

    },


    "2": {

        title:
            "Kegiatan Siswa 2",

        date:
            "18 Agustus 2026",

        description:
            "Kegiatan siswa dilaksanakan dengan melibatkan peserta didik dalam aktivitas sekolah. Kegiatan ini menjadi bagian dari program sekolah dan memberikan pengalaman bagi siswa.",

        images: [
            "kegiatan2.jpg",
            "kegiatan2-2.jpg"
        ]

    },


    "3": {

        title:
            "Kegiatan Siswa 3",

        date:
            "15 Agustus 2026",

        description:
            "Kegiatan ini menjadi salah satu aktivitas siswa SMP Al Ahmad yang dilaksanakan untuk mendukung keterlibatan siswa dalam lingkungan sekolah.",

        images: [
            "kegiatan3.jpg"
        ]

    },


    "4": {

        title:
            "Kegiatan Siswa 4",

        date:
            "12 Agustus 2026",

        description:
            "Kegiatan sekolah yang melibatkan siswa dalam aktivitas bersama dan menjadi bagian dari program kegiatan SMP Al Ahmad Krian.",

        images: [
            "kegiatan4.jpg"
        ]

    }

};


let currentActivityImages = [];

let currentActivityImageIndex = 0;


function loadActivityDetail() {

    if (
        !activityDetailTitle ||
        !activityDetailImage
    ) {
        return;
    }


    const urlParams =
        new URLSearchParams(
            window.location.search
        );


    const activityId =
        urlParams.get("id");


    const activity =
        activityData[activityId];


    if (!activity) {

        activityDetailTitle.textContent =
            "Kegiatan tidak ditemukan";

        activityDetailDate.textContent =
            "";

        activityDetailDescription.textContent =
            "Informasi kegiatan tidak tersedia.";

        return;

    }


    activityDetailTitle.textContent =
        activity.title;


    activityDetailDate.textContent =
        activity.date;


    activityDetailDescription.textContent =
        activity.description;


    currentActivityImages =
        activity.images;


    currentActivityImageIndex =
        0;


    showActivityImage();

}


function showActivityImage() {

    if (
        !activityDetailImage ||
        currentActivityImages.length === 0
    ) {
        return;
    }


    const image =
        currentActivityImages[
            currentActivityImageIndex
        ];


    activityDetailImage.src =
        image;


    activityDetailImage.alt =
        activityDetailTitle
            ? activityDetailTitle.textContent
            : "Kegiatan SMP Al Ahmad";


    if (
        activityDetailModalImage
    ) {

        activityDetailModalImage.src =
            image;

    }


    if (
        activityDetailPrev
    ) {

        activityDetailPrev.classList.toggle(
            "hidden",
            currentActivityImages.length <= 1
        );

    }


    if (
        activityDetailNext
    ) {

        activityDetailNext.classList.toggle(
            "hidden",
            currentActivityImages.length <= 1
        );

    }

}


if (
    activityDetailTitle
) {

    loadActivityDetail();

}


if (
    activityDetailPrev
) {

    activityDetailPrev.addEventListener(
        "click",
        function () {

            if (
                currentActivityImages.length === 0
            ) {
                return;
            }


            currentActivityImageIndex =
                (
                    currentActivityImageIndex -
                    1 +
                    currentActivityImages.length
                )
                %
                currentActivityImages.length;


            showActivityImage();

        }
    );

}


if (
    activityDetailNext
) {

    activityDetailNext.addEventListener(
        "click",
        function () {

            if (
                currentActivityImages.length === 0
            ) {
                return;
            }


            currentActivityImageIndex =
                (
                    currentActivityImageIndex +
                    1
                )
                %
                currentActivityImages.length;


            showActivityImage();

        }
    );

}


/* FOTO DIPERBESAR */

if (
    activityDetailImageButton &&
    activityDetailModal
) {

    activityDetailImageButton.addEventListener(
        "click",
        function () {

            activityDetailModal.classList.add(
                "open"
            );

            document.body.classList.add(
                "modal-open"
            );

        }
    );

}


if (
    activityDetailModalClose &&
    activityDetailModal
) {

    activityDetailModalClose.addEventListener(
        "click",
        function () {

            activityDetailModal.classList.remove(
                "open"
            );

            document.body.classList.remove(
                "modal-open"
            );

        }
    );

}


if (
    activityDetailModal
) {

    activityDetailModal.addEventListener(
        "click",
        function (event) {

            if (
                event.target ===
                activityDetailModal
            ) {

                activityDetailModal.classList.remove(
                    "open"
                );

                document.body.classList.remove(
                    "modal-open"
                );

            }

        }
    );

}

/* =====================================================
   EKSTRAKURIKULER
   4 CARD AWAL + LIHAT SEMUA
===================================================== */

const extraGrid =
    document.querySelector(".extra-grid");

const extraHiddenCards =
    document.querySelectorAll(
        ".extra-grid .extra-card-hidden"
    );

const extraMoreButton =
    document.getElementById(
        "extraMoreButton"
    );

const extraMoreWrapper =
    document.getElementById(
        "extraMoreWrapper"
    );


if (
    extraGrid &&
    extraMoreButton &&
    extraMoreWrapper
) {

    /* Kalau tidak ada card tambahan,
       tombol tidak perlu ditampilkan */

    if (
        extraHiddenCards.length === 0
    ) {

        extraMoreWrapper.classList.add(
            "hidden"
        );

    }


    extraMoreButton.addEventListener(
        "click",
        function () {

            extraGrid.classList.add(
                "show-all"
            );


            extraMoreWrapper.classList.add(
                "hidden"
            );

        }
    );

}

/* =====================================================
   DETAIL BERITA
===================================================== */

const newsDetailTitle =
    document.getElementById(
        "newsDetailTitle"
    );

const newsDetailDate =
    document.getElementById(
        "newsDetailDate"
    );

const newsDetailDescription =
    document.getElementById(
        "newsDetailDescription"
    );

const newsDetailImage =
    document.getElementById(
        "newsDetailImage"
    );

const newsDetailImageButton =
    document.getElementById(
        "newsDetailImageButton"
    );

const newsDetailPrev =
    document.getElementById(
        "newsDetailPrev"
    );

const newsDetailNext =
    document.getElementById(
        "newsDetailNext"
    );

const newsImageModal =
    document.getElementById(
        "newsImageModal"
    );

const newsModalImage =
    document.getElementById(
        "newsModalImage"
    );

const newsImageClose =
    document.getElementById(
        "newsImageClose"
    );


const newsData = {

    "1": {

        title:
            "Informasi Terbaru SMP Al Ahmad Krian",

        date:
            "3 September 2026",

        description:
            "Berita ini berisi informasi terbaru mengenai SMP Al Ahmad Krian. Bagian ini dapat diisi dengan penjelasan lengkap mengenai informasi sekolah, program sekolah, pengumuman, kegiatan resmi sekolah, atau perkembangan terbaru yang ingin disampaikan kepada masyarakat.",

        images: [
            "berita1.jpg",
            "berita1-2.jpg",
            "berita1-3.jpg"
        ]

    },


    "2": {

        title:
            "Informasi Sekolah 2",

        date:
            "28 Agustus 2026",

        description:
            "Tuliskan informasi lengkap mengenai berita sekolah pada bagian ini.",

        images: [
            "berita2.jpg",
            "berita2-2.jpg"
        ]

    },


    "3": {

        title:
            "Informasi Sekolah 3",

        date:
            "20 Agustus 2026",

        description:
            "Tuliskan informasi lengkap mengenai berita sekolah pada bagian ini.",

        images: [
            "berita3.jpg"
        ]

    }

};


let currentNewsImages = [];

let currentNewsImageIndex = 0;


function loadNewsDetail() {

    if (
        !newsDetailTitle ||
        !newsDetailImage
    ) {
        return;
    }


    const params =
        new URLSearchParams(
            window.location.search
        );


    const newsId =
        params.get("id");


    const news =
        newsData[newsId];


    if (!news) {

        newsDetailTitle.textContent =
            "Berita tidak ditemukan";

        newsDetailDate.textContent =
            "";

        newsDetailDescription.textContent =
            "Informasi berita tidak tersedia.";

        return;

    }


    newsDetailTitle.textContent =
        news.title;


    newsDetailDate.textContent =
        news.date;


    newsDetailDescription.textContent =
        news.description;


    currentNewsImages =
        news.images;


    currentNewsImageIndex =
        0;


    showNewsImage();

}


function showNewsImage() {

    if (
        !newsDetailImage ||
        currentNewsImages.length === 0
    ) {
        return;
    }


    const image =
        currentNewsImages[
            currentNewsImageIndex
        ];


    newsDetailImage.src =
        image;


    newsDetailImage.alt =
        newsDetailTitle
            ? newsDetailTitle.textContent
            : "Berita SMP Al Ahmad";


    if (
        newsModalImage
    ) {

        newsModalImage.src =
            image;

    }


    if (
        newsDetailPrev
    ) {

        newsDetailPrev.classList.toggle(
            "hidden",
            currentNewsImages.length <= 1
        );

    }


    if (
        newsDetailNext
    ) {

        newsDetailNext.classList.toggle(
            "hidden",
            currentNewsImages.length <= 1
        );

    }

}


if (
    newsDetailTitle
) {

    loadNewsDetail();

}


if (
    newsDetailPrev
) {

    newsDetailPrev.addEventListener(
        "click",
        function () {

            if (
                currentNewsImages.length === 0
            ) {
                return;
            }


            currentNewsImageIndex =
                (
                    currentNewsImageIndex -
                    1 +
                    currentNewsImages.length
                )
                %
                currentNewsImages.length;


            showNewsImage();

        }
    );

}


if (
    newsDetailNext
) {

    newsDetailNext.addEventListener(
        "click",
        function () {

            if (
                currentNewsImages.length === 0
            ) {
                return;
            }


            currentNewsImageIndex =
                (
                    currentNewsImageIndex +
                    1
                )
                %
                currentNewsImages.length;


            showNewsImage();

        }
    );

}


/* FOTO DIPERBESAR */

if (
    newsDetailImageButton &&
    newsImageModal
) {

    newsDetailImageButton.addEventListener(
        "click",
        function () {

            newsImageModal.classList.add(
                "open"
            );

            document.body.classList.add(
                "modal-open"
            );

        }
    );

}


if (
    newsImageClose &&
    newsImageModal
) {

    newsImageClose.addEventListener(
        "click",
        function () {

            newsImageModal.classList.remove(
                "open"
            );

            document.body.classList.remove(
                "modal-open"
            );

        }
    );

}


if (
    newsImageModal
) {

    newsImageModal.addEventListener(
        "click",
        function (event) {

            if (
                event.target ===
                newsImageModal
            ) {

                newsImageModal.classList.remove(
                    "open"
                );

                document.body.classList.remove(
                    "modal-open"
                );

            }

        }
    );

}

});