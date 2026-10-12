# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Stack

Laravel 13 with Blade, Vite, and Tailwind CSS 4. The repository already contains product data, catalog filtering, and storefront routes.

## Users

Indonesian homeowners, builders, or property operators who need to browse building materials and begin an order online.

## Product Purpose

Make building-material discovery and ordering faster and clearer than visiting or contacting suppliers manually. Success means a visitor can understand the offer, browse a useful catalog experience, filter products by category and price, and proceed toward an order.

## Positioning

The product is a building-material storefront, currently focused on the UI/UX and front-end layout for an online shopping experience. Its durable commercial differentiator is still an open decision and must not be invented in the interface.

## Operating Context

The product is a web storefront with a home page, catalog page, category and price filtering, and an order route. Current work is front-end focused and may use dummy product data while the layout, navigation, merchandising hierarchy, and ordering flow are designed. Existing copy is partly Indonesian and partly placeholder English, so language and merchandising terminology should be normalized deliberately in future surface work.

## Capabilities and Constraints

- The current prototype includes product records with at least a name, price, and category, but these may be represented with dummy data during UI/UX work.
- The prototype includes catalog filtering concepts for category, minimum price, and maximum price.
- Named routes currently include `home`, `catalog`, and `order`.
- Front-end layout and interaction design take priority over real backend logic and real product-catalog integration for now.
- Preserve the existing Laravel/Blade structure where practical, but do not block visual work on backend implementation.
- Delivery, warranty, payment, service-area, and fulfillment behavior are not confirmed; use neutral placeholder content rather than inventing claims.
- The product is an existing Laravel application, so future work should follow its current framework and Blade-based structure unless explicitly changed.

## Brand Commitments

The current working name and promise are not formally established. Existing home-page copy includes “Belanja Atap Online”; treat this as provisional product language rather than a confirmed brand commitment.

## Evidence on Hand

- `resources/views/index.blade.php` contains the current Indonesian storefront headline and links to the catalog and order routes.
- `resources/views/catalog.blade.php` renders product cards and includes the catalog filter component.
- `app/Http/Controllers/CatalogController.php` implements category and price filtering.
- `database/migrations/2026_09_21_143215_create_product_table.php` and `database/seeders/ProductSeeder.php` contain the current prototype product data structure and seed data.
- Product imagery is currently placeholder content; dummy data is approved for current UI/UX and front-end layout work.
- No approved brand, product, customer, logistics, or proof assets were found.

## Product Principles

1. Help visitors evaluate roofing products quickly and confidently.
2. Make the front-end experience useful even while data and backend behavior are provisional.
3. Make the path from discovery to ordering obvious.
4. Use Indonesian language intentionally and consistently where customer-facing copy is presented.
5. Never imply logistics, warranty, payment, pricing, or service promises that the product has not confirmed.

## Accessibility & Inclusion

No product-specific accessibility standard has been confirmed. Future interface work should preserve accessible web fundamentals, including meaningful image alternatives, keyboard access, readable contrast, clear form labels, and responsive behavior.
