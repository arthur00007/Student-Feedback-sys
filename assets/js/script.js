/**
 * Student Feedback System - Core JavaScript
 * Handles Theme Toggling (Light / Dark / Auto) and Dynamic Role Forms
 */

(() => {
  'use strict';

  // Theme Management
  const getStoredTheme = () => localStorage.getItem('sfs-theme');
  const setStoredTheme = theme => localStorage.setItem('sfs-theme', theme);

  const getPreferredTheme = () => {
    const storedTheme = getStoredTheme();
    if (storedTheme) {
      return storedTheme;
    }
    // Auto system detection: if browser/OS dark mode is active, use dark; otherwise default to light
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      return 'dark';
    }
    return 'light';
  };

  const setTheme = theme => {
    if (theme === 'auto') {
      const isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
      document.documentElement.setAttribute('data-bs-theme', isDark ? 'dark' : 'light');
    } else {
      document.documentElement.setAttribute('data-bs-theme', theme);
    }
  };

  // Run immediately to avoid page flicker
  setTheme(getPreferredTheme());

  // Listen for system theme changes if on auto
  if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
      const storedTheme = getStoredTheme();
      if (!storedTheme || storedTheme === 'auto') {
        setTheme(getPreferredTheme());
      }
    });
  }

  window.addEventListener('DOMContentLoaded', () => {
    const updateActiveThemeUI = (theme) => {
      document.querySelectorAll('[data-bs-theme-value]').forEach(btn => {
        const isMatch = btn.getAttribute('data-bs-theme-value') === theme;
        btn.classList.toggle('active', isMatch);
        btn.setAttribute('aria-pressed', isMatch ? 'true' : 'false');
      });

      // Update button icon to match active theme's SVG
      const activeIconContainer = document.querySelector('.theme-icon-active');
      const targetBtn = document.querySelector(`[data-bs-theme-value="${theme}"]`);
      if (activeIconContainer && targetBtn) {
        const svg = targetBtn.querySelector('svg');
        if (svg) {
          activeIconContainer.innerHTML = svg.outerHTML;
        }
      }

      const label = document.getElementById('theme-label');
      if (label) {
        if (theme === 'dark') label.textContent = 'Dark';
        else if (theme === 'light') label.textContent = 'Light';
        else label.textContent = 'Auto';
      }
    };

    const currentTheme = getStoredTheme() || 'auto';
    updateActiveThemeUI(currentTheme);

    document.querySelectorAll('[data-bs-theme-value]').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const chosen = btn.getAttribute('data-bs-theme-value');
        setStoredTheme(chosen);
        setTheme(chosen);
        updateActiveThemeUI(chosen);
      });
    });

    // Registration Role Toggle
    const roleRadios = document.querySelectorAll('input[name="role"]');
    const studentFields = document.getElementById('student-fields');
    const teacherFields = document.getElementById('teacher-fields');

    if (roleRadios.length > 0 && studentFields && teacherFields) {
      const studentInputs = studentFields.querySelectorAll('input, select');
      const teacherInputs = teacherFields.querySelectorAll('input, select');

      const toggleRoleFields = (role) => {
        if (role === 'teacher') {
          studentFields.classList.add('d-none');
          studentInputs.forEach(el => {
            el.disabled = true;
            el.required = false;
          });

          teacherFields.classList.remove('d-none');
          teacherInputs.forEach(el => {
            el.disabled = false;
            if (el.dataset.required === 'true') el.required = true;
          });
        } else {
          teacherFields.classList.add('d-none');
          teacherInputs.forEach(el => {
            el.disabled = true;
            el.required = false;
          });

          studentFields.classList.remove('d-none');
          studentInputs.forEach(el => {
            el.disabled = false;
            if (el.dataset.required === 'true') el.required = true;
          });
        }
      };

      roleRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
          toggleRoleFields(e.target.value);
        });
      });

      const checked = document.querySelector('input[name="role"]:checked');
      if (checked) {
        toggleRoleFields(checked.value);
      }
    }
  });
})();
