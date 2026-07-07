/**
 * main.js
 * -------------------------------------------------------------------------
 * Vanilla JavaScript powering all interactions & animations.
 * No dependencies. Organized into small, focused modules that each
 * initialize themselves on DOMContentLoaded.
 * -------------------------------------------------------------------------
 */
(() => {
  'use strict';

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ===================================================================
     1. PRELOADER
     =================================================================== */
  function initPreloader() {
    const preloader = document.getElementById('preloader');
    if (!preloader) return;
    const hide = () => preloader.classList.add('done');
    window.addEventListener('load', () => setTimeout(hide, 500));
    // Safety net in case 'load' never fires quickly (slow assets)
    setTimeout(hide, 3000);
  }

  /* ===================================================================
     2. SCROLL PROGRESS BAR
     =================================================================== */
  function initScrollProgress() {
    const bar = document.getElementById('scroll-progress');
    if (!bar) return;
    const update = () => {
      const scrollTop = window.scrollY;
      const height = document.documentElement.scrollHeight - window.innerHeight;
      const pct = height > 0 ? (scrollTop / height) * 100 : 0;
      bar.style.width = pct + '%';
    };
    window.addEventListener('scroll', update, { passive: true });
    update();
  }

  /* ===================================================================
     3. PILL NAVBAR — scroll state, sliding indicator, mobile menu
     =================================================================== */
  function initNavbar() {
    const nav = document.getElementById('pillNav');
    const links = document.getElementById('pillLinks');
    const indicator = document.getElementById('pillIndicator');
    const burger = document.getElementById('pillBurger');
    const mobileMenu = document.getElementById('mobileMenu');
    if (!nav) return;

    // Scrolled state
    const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 20);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Sliding active indicator
    function moveIndicator() {
      const active = links.querySelector('.pill-link.active') || links.querySelector('.pill-link');
      if (!active || !indicator) return;
      indicator.style.width = active.offsetWidth + 'px';
      indicator.style.transform = `translateX(${active.offsetLeft - 4}px)`;
    }
    moveIndicator();
    window.addEventListener('resize', moveIndicator);

    links?.querySelectorAll('.pill-link').forEach((link) => {
      link.addEventListener('mouseenter', () => {
        indicator.style.width = link.offsetWidth + 'px';
        indicator.style.transform = `translateX(${link.offsetLeft - 4}px)`;
      });
    });
    links?.addEventListener('mouseleave', moveIndicator);

    // Mobile burger toggle
    burger?.addEventListener('click', () => {
      const isOpen = burger.classList.toggle('open');
      mobileMenu.classList.toggle('open', isOpen);
      burger.setAttribute('aria-expanded', String(isOpen));
    });
    mobileMenu?.querySelectorAll('a').forEach((a) => {
      a.addEventListener('click', () => {
        burger.classList.remove('open');
        mobileMenu.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false');
      });
    });
  }

  /* ===================================================================
     4. SCROLL REVEAL (Intersection Observer)
     =================================================================== */
  function initScrollReveal() {
    const targets = document.querySelectorAll('.reveal, .reveal-scale');
    if (!targets.length) return;

    if (reducedMotion) {
      targets.forEach((t) => t.classList.add('visible'));
      return;
    }

    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            io.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15, rootMargin: '0px 0px -60px 0px' }
    );
    targets.forEach((t) => io.observe(t));
  }

  /* ===================================================================
     5. TYPING ANIMATION (hero role rotator)
     =================================================================== */
  function initTypingAnimation() {
    const el = document.getElementById('typedText');
    if (!el) return;
    const words = JSON.parse(el.dataset.words || '[]');
    if (!words.length) return;

    let wordIndex = 0, charIndex = 0, deleting = false;

    function tick() {
      const current = words[wordIndex];
      if (!deleting) {
        charIndex++;
        el.textContent = current.slice(0, charIndex);
        if (charIndex === current.length) {
          deleting = true;
          return setTimeout(tick, 1600);
        }
      } else {
        charIndex--;
        el.textContent = current.slice(0, charIndex);
        if (charIndex === 0) {
          deleting = false;
          wordIndex = (wordIndex + 1) % words.length;
        }
      }
      setTimeout(tick, deleting ? 40 : 85);
    }
    tick();
  }

  /* ===================================================================
     6. MOUSE PARALLAX (hero floating chips + mesh blobs)
     =================================================================== */
  function initParallax() {
    if (reducedMotion) return;
    const layer = document.querySelector('.hero');
    const chips = document.querySelectorAll('.float-chip');
    const blobs = document.querySelectorAll('.mesh-blob');
    if (!layer) return;

    let rafId = null;
    layer.addEventListener('mousemove', (e) => {
      const { innerWidth: w, innerHeight: h } = window;
      const x = (e.clientX / w - 0.5) * 2;
      const y = (e.clientY / h - 0.5) * 2;

      if (rafId) cancelAnimationFrame(rafId);
      rafId = requestAnimationFrame(() => {
        chips.forEach((chip, i) => {
          const depth = (i + 1) * 6;
          chip.style.transform = `translate(${x * depth}px, ${y * depth}px)`;
        });
        blobs.forEach((blob, i) => {
          const depth = (i + 1) * 10;
          blob.style.marginLeft = `${x * depth}px`;
          blob.style.marginTop = `${y * depth}px`;
        });
      });
    });
  }

  /* ===================================================================
     7. RIPPLE BUTTON EFFECT
     =================================================================== */
  function initRipple() {
    document.querySelectorAll('.ripple, .btn-primary, .btn-ghost, .filter-btn').forEach((btn) => {
      btn.addEventListener('click', function (e) {
        const rect = this.getBoundingClientRect();
        const circle = document.createElement('span');
        const size = Math.max(rect.width, rect.height);
        circle.className = 'ripple-circle';
        circle.style.width = circle.style.height = size + 'px';
        circle.style.left = (e.clientX - rect.left - size / 2) + 'px';
        circle.style.top = (e.clientY - rect.top - size / 2) + 'px';
        this.appendChild(circle);
        circle.addEventListener('animationend', () => circle.remove());
      });
    });
  }

  /* ===================================================================
     8. ANIMATED COUNTERS
     =================================================================== */
  function initCounters() {
    const counters = document.querySelectorAll('.counter-num[data-target]');
    if (!counters.length) return;

    const animate = (el) => {
      const target = parseFloat(el.dataset.target);
      const suffix = el.dataset.suffix || '';
      const duration = 1600;
      const start = performance.now();

      function step(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
        const value = Math.floor(eased * target);
        el.textContent = value + suffix;
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target + suffix;
      }
      requestAnimationFrame(step);
    };

    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animate(entry.target);
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach((c) => io.observe(c));
  }

  /* ===================================================================
     9. SKILL PROGRESS BARS + CIRCULAR INDICATORS
     =================================================================== */
  function initSkillBars() {
    const bars = document.querySelectorAll('.skill-bar-fill[data-pct]');
    const circles = document.querySelectorAll('.circular-svg .fill[data-pct]');
    if (!bars.length && !circles.length) return;

    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const pct = parseFloat(el.dataset.pct);
        if (el.classList.contains('skill-bar-fill')) {
          el.style.width = pct + '%';
        } else {
          const circumference = 301; // 2 * PI * r(48)
          const offset = circumference - (pct / 100) * circumference;
          el.style.strokeDashoffset = offset;
        }
        io.unobserve(el);
      });
    }, { threshold: 0.4 });

    bars.forEach((b) => io.observe(b));
    circles.forEach((c) => io.observe(c));
  }

  /* ===================================================================
     10. PROJECT FILTER
     =================================================================== */
  function initProjectFilter() {
    const buttons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.project-card');
    if (!buttons.length) return;

    buttons.forEach((btn) => {
      btn.addEventListener('click', () => {
        buttons.forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;

        cards.forEach((card) => {
          const match = filter === 'all' || card.dataset.category === filter;
          card.classList.toggle('hidden-item', !match);
        });
      });
    });
  }

  /* ===================================================================
     11. BACK TO TOP
     =================================================================== */
  function initBackToTop() {
    const btn = document.getElementById('backToTop');
    if (!btn) return;
    window.addEventListener('scroll', () => {
      btn.classList.toggle('visible', window.scrollY > 500);
    }, { passive: true });

    btn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: reducedMotion ? 'auto' : 'smooth' });
    });
  }

  /* ===================================================================
     12. SMOOTH SCROLL FOR ANCHOR LINKS
     =================================================================== */
  function initSmoothAnchors() {
    document.querySelectorAll('a[href^="#"]').forEach((a) => {
      a.addEventListener('click', (e) => {
        const id = a.getAttribute('href');
        if (id.length < 2) return;
        const target = document.querySelector(id);
        if (!target) return;
        e.preventDefault();
        target.scrollIntoView({ behavior: reducedMotion ? 'auto' : 'smooth', block: 'start' });
      });
    });
  }

  /* ===================================================================
     13. TOAST NOTIFICATIONS
     =================================================================== */
  function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    const icon = type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';
    toast.innerHTML = `<i class="fa-solid ${icon}"></i><span>${message}</span>`;
    container.appendChild(toast);
    setTimeout(() => {
      toast.classList.add('leaving');
      toast.addEventListener('animationend', () => toast.remove());
    }, 4200);
  }
  window.showToast = showToast; // exposed for contact form handler

  /* ===================================================================
     14. CONTACT FORM — validation + AJAX submit to api/contact.php
     =================================================================== */
  function initContactForm() {
    const form = document.getElementById('contactForm');
    if (!form) return;

    const fields = {
      name: { el: form.querySelector('#name'), rule: (v) => v.trim().length >= 2, msg: 'Please enter your name (min. 2 characters).' },
      email: { el: form.querySelector('#email'), rule: (v) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v), msg: 'Please enter a valid email address.' },
      subject: { el: form.querySelector('#subject'), rule: (v) => v.trim().length >= 3, msg: 'Please enter a subject.' },
      message: { el: form.querySelector('#message'), rule: (v) => v.trim().length >= 10, msg: 'Message should be at least 10 characters.' },
    };

    function validateField(key) {
      const { el, rule } = fields[key];
      if (!el) return true;
      const group = el.closest('.form-group');
      const valid = rule(el.value);
      group.classList.toggle('error', !valid);
      return valid;
    }

    Object.keys(fields).forEach((key) => {
      fields[key].el?.addEventListener('blur', () => validateField(key));
      fields[key].el?.addEventListener('input', () => {
        if (fields[key].el.closest('.form-group').classList.contains('error')) validateField(key);
      });
    });

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const allValid = Object.keys(fields).map(validateField).every(Boolean);
      if (!allValid) {
        showToast('Please fix the highlighted fields.', 'error');
        return;
      }

      const submitBtn = form.querySelector('[type="submit"]');
      const originalLabel = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>Sending…</span>';

      try {
        const formData = new FormData(form);
        const res = await fetch('api/contact.php', {
          method: 'POST',
          body: formData,
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        const data = await res.json();

        if (data.success) {
          showToast(data.message || 'Message sent successfully!', 'success');
          form.reset();
        } else {
          showToast(data.message || 'Something went wrong. Please try again.', 'error');
        }
      } catch (err) {
        showToast('Network error. Please try again later.', 'error');
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalLabel;
      }
    });
  }

  /* ===================================================================
     INIT ALL MODULES
     =================================================================== */
  document.addEventListener('DOMContentLoaded', () => {
    initPreloader();
    initScrollProgress();
    initNavbar();
    initScrollReveal();
    initTypingAnimation();
    initParallax();
    initRipple();
    initCounters();
    initSkillBars();
    initProjectFilter();
    initBackToTop();
    initSmoothAnchors();
    initContactForm();
  });
})();
