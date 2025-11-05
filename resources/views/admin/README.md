# Admin Views Guide

This directory houses the CMS admin experience. The view layer is built on a small set of reusable Blade components to keep layout and behaviour consistent.

## Layout

- Always extend `layouts.admin` for admin screens. The layout now renders the navbar, sidebar, footer, styles, and scripts through Blade components (`<x-admin.* />`).
- Avoid calling the legacy partials directly (`layouts/partials/*`). They proxy to the same components but only exist for backward compatibility.

## Reusable Components

| Component | Purpose | Key Props |
| --- | --- | --- |
| `<x-admin.form-card>` | Primary content card wrapper for forms/views | `title`, `bodyClass`, `my` |
| `<x-admin.sidebar-card>` | Narrow sidebar cards (publish panels, meta cards). Includes `pb-1` padding by default. | `title`, `mt`, `bodyClass` (override) |
| `<x-admin.form-fieldset>` | Group related form inputs with a legend | `legend`, `mb` |
| `<x-admin.text-input>` / `<x-admin.textarea-input>` / `<x-admin.checkbox-input>` | Standardised form controls with Material styling | Common HTML attributes |
| `<x-admin.form-actions>` | Submit/cancel button set aligned to the right | `cancelRoute`, `submitText`, `cancelText` |
| `<x-page-header>` | Page title + subtitle block with icon support | `icon`, `title`, `subtitle`, `backRoute` |

### Usage Notes

- Prefer component props over hard-coded utility classes. For example, `<x-admin.sidebar-card title="Publish" mt="mt-4" />` already has compact padding; only pass `bodyClass` when you need to deviate.
- Place module-specific UI fragments (e.g., menu builder items) under that module's `partials/` folder and keep them self-contained. They should render inside the shared layout/components above.
- When introducing a new reusable pattern, add it under `resources/views/components/admin` and document the expected props here.

## Styling & Scripts

Global admin CSS/JS lives in `<x-admin.styles />` and `<x-admin.scripts />`. They include Material Dashboard assets, Select2, and shared JS utilities. Only inject additional assets with `@push('styles')` / `@push('scripts')` from individual views when the dependency is truly per-page.

## Adding New Views

1. Create your Blade file inside the relevant module directory (e.g., `resources/views/admin/programs`).
2. Extend `layouts.admin` and compose the page using the components above.
3. Keep sidebar content in `<x-admin.sidebar-card>` blocks so spacing stays consistent across modules.
4. Update this README if you introduce a new pattern other developers should know about.

Maintaining these conventions keeps the admin UI predictable and makes future cleanups easier.
