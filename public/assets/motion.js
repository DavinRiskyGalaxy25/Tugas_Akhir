/**
 * motion.js — SMP Al Ahmad Krian
 * Scroll-reveal animations via IntersectionObserver.
 * No external library. Respects prefers-reduced-motion.
 * Does NOT touch any existing JS selectors, event listeners, or form logic.
 */

(function () {
  'use strict';

  /* ───── 1. Respect prefers-reduced-motion ───── */
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ───── 2. Add reveal classes to target sections ───── */
  function tagRevealTargets() {
    // Individual elements that should fade-in on scroll
    const revealSelectors = [
      '.section-kicker',
      '.editorial-heading',
      '.explore-title',
      '.explore-subtitle',
      '.about-main-title',
      '.about-lead-text',
      '.about-body-text',
      '.about-action-wrap',
      '.editorial-quote-box',
      '.editorial-narrative',
      '.editorial-signature',
    ];

    revealSelectors.forEach(sel => {
      document.querySelectorAll(sel).forEach(el => {
        if (!el.classList.contains('reveal') && !el.classList.contains('reveal-left') && !el.classList.contains('reveal-right')) {
          el.classList.add('reveal');
        }
      });
    });

    // Editorial photo side — slide from left
    document.querySelectorAll('.editorial-photo-side').forEach(el => {
      el.classList.add('reveal-left');
    });

    // About image — slide from right
    document.querySelectorAll('.about-image-column').forEach(el => {
      el.classList.add('reveal-right');
    });

    // Grid containers — stagger children
    document.querySelectorAll('.stat-island-container, .value-pillars-grid, .explore-cards-grid').forEach(el => {
      el.classList.add('stagger');
    });

    // Individual cards
    document.querySelectorAll(
      '.hub-card, .pillar-card, .stat-item-block, .alumni-card, ' +
      '.channel-card, .extra-card, .news-card, .article-card, .prestasi-card, .kegiatan-card'
    ).forEach(el => {
      // Only if not inside a stagger parent (to avoid double animation)
      if (!el.closest('.stagger')) {
        el.classList.add('reveal');
      }
    });
  }

  /* ───── 3. IntersectionObserver ───── */
  function initReveal() {
    if (prefersReduced) {
      // Make everything visible immediately
      document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
        el.classList.add('is-visible');
      });
      document.querySelectorAll('.stagger').forEach(el => {
        el.classList.add('is-visible');
      });
      return;
    }

    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target); // fire once
        }
      });
    }, {
      threshold: 0.12,
      rootMargin: '0px 0px -48px 0px'
    });

    document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .stagger').forEach(el => {
      io.observe(el);
    });
  }

  /* ───── 4. Sticky header scroll behaviour ───── */
  function initStickyHeader() {
    const header = document.getElementById('siteHeader');
    if (!header) return;

    // Add 'scrolled' class after 60px scroll
    function onScroll() {
      if (window.scrollY > 60) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // run once on load
  }

  /* ───── 5. Hover parallax tilt on hub cards (subtle) ───── */
  function initCardTilt() {
    if (prefersReduced) return;

    document.querySelectorAll('.hub-card').forEach(card => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        card.style.transform = `translateY(-5px) rotateX(${-y * 4}deg) rotateY(${x * 4}deg)`;
      });

      card.addEventListener('mouseleave', () => {
        card.style.transform = '';
      });
    });
  }

  /* ───── 6. Smooth scroll for anchor links ───── */
  function initSmoothAnchorLinks() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', (e) => {
        const id = anchor.getAttribute('href').slice(1);
        if (!id) return;
        const target = document.getElementById(id);
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: prefersReduced ? 'auto' : 'smooth', block: 'start' });
        }
      });
    });
  }

  /* ───── 7. Nav active state on scroll (IntersectionObserver on sections) ───── */
  function initNavActiveScroll() {
    const sections = document.querySelectorAll('section[id]');
    if (!sections.length) return;

    const navLinks = document.querySelectorAll('.nav-link[href*="#"]');
    if (!navLinks.length) return;

    const sectionObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const id = entry.target.id;
          navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && href.includes('#' + id)) {
              link.classList.add('active');
            } else {
              link.classList.remove('active');
            }
          });
        }
      });
    }, { threshold: 0.4 });

    sections.forEach(sec => sectionObserver.observe(sec));
  }

  /* ───── 8. Number counter animation for stat items ───── */
  function initCounterAnimation() {
    if (prefersReduced) return;

    // Only animate pure numeric values
    const statNumbers = document.querySelectorAll('.stat-number-display');
    if (!statNumbers.length) return;

    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const original = el.textContent.trim();
        const num = parseFloat(original.replace(/[^0-9.]/g, ''));

        if (isNaN(num) || original.length > 12) {
          counterObserver.unobserve(el);
          return;
        }

        const isInt = Number.isInteger(num);
        const duration = 1200;
        const start = performance.now();

        function tick(now) {
          const elapsed = now - start;
          const progress = Math.min(elapsed / duration, 1);
          const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
          const current = num * eased;
          el.textContent = isInt ? Math.round(current).toLocaleString('id-ID') : current.toFixed(1);

          if (progress < 1) {
            requestAnimationFrame(tick);
          } else {
            el.textContent = original; // restore original text exactly
          }
        }

        requestAnimationFrame(tick);
        counterObserver.unobserve(el);
      });
    }, { threshold: 0.5 });

    statNumbers.forEach(el => counterObserver.observe(el));
  }

  /* ───── Bootstrap ───── */
  function init() {
    tagRevealTargets();
    initReveal();
    initStickyHeader();
    initCardTilt();
    initSmoothAnchorLinks();
    initNavActiveScroll();
    initCounterAnimation();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
