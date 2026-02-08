# UI TODOs / Final tasks

This file lists the remaining UI changes and polish tasks before finalizing the app UI.

- Replace hard-coded URLs with Blade `route()` / `asset()` helpers (improve portability)
- Extract `header` / `navbar` into a Blade partial for reuse across templates
- Improve mobile accessibility:
  - add `aria-expanded` toggle state to the mobile menu button
  - implement focus trap inside the mobile sidebar while open
  - keyboard support for opening/closing (Esc to close)
- Tweak spacing and header height across breakpoints (fine-tune under 950px)
- Make active-nav detection use `request()->routeIs(...)` with named routes
- Convert inline CSS block to a dedicated stylesheet (or extract to Sass/SCSS)
- Replace inline SVGs with an icon component or sprite for consistency
- Cross-browser QA & responsive QA (Chrome, Firefox, mobile devices)
- Finalize logo assets and standardize filenames in `public/images`
- Add accessibility attributes (`role="dialog"`, `aria-modal`, etc.) for sidebar
- Consider converting to Bootstrap's built-in collapse for navbar on mobile
- Optional: add visual regression tests (Percy / Chromatic) for UI stability

---

Commit log to push now:
- chore(ui): add `TODO_UI.md` (this file)
- fix(nav): dynamic active class for navbar and mobile sidebar links

If you'd like different wording in the commit message or more items added, tell me and I'll update then push.
