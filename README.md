# Tabaix Guide FAQ Schema

A WordPress plugin that adds FAQPage JSON-LD schema to the `/tools/` guide pages, built from the FAQ questions and answers the guides already show on the page in their details/summary sections. Nothing is displayed or edited; deactivating the plugin removes the schema again.

Built for [tabaix.com](https://tabaix.com/). Free to use and share (GPL-2.0-or-later).

## Features

- **FAQPage schema** — adds `FAQPage` JSON-LD (Schema.org) to guide pages, so search engines can show the questions and answers as rich results.
- **Built from the page itself** — the questions and answers come from the FAQ details/summary sections the guide already shows. The plugin adds nothing to the visible page.
- **Reversible** — deactivating the plugin removes the schema from every page instantly. No content is edited or stored.

## Requirements

- WordPress. No extra libraries — the plugin only uses core WordPress functions.

## Installation

1. Download the [latest release](https://github.com/Tabaix/tabaix-guide-faq-schema/releases) (or clone this repo).
2. Upload the `tabaix-guide-faq-schema` folder to `/wp-content/plugins/`, **or** in WP Admin go to **Plugins > Add New > Upload Plugin** and install the ZIP.
3. Activate **Tabaix Guide FAQ Schema**. There is no settings page — it works as soon as it is active.

## Usage

Open a `/tools/` guide page and view the page source: the FAQPage JSON-LD block is in the head. The questions and answers in it match the FAQ sections already visible on the page.

## FAQ

**The schema shows questions my page does not have. Why?**
It should not — the schema is built from the FAQ details/summary sections on the page. If a question appears in the schema but not on the page, the page is cached: purge the site cache and check again.

**Does this work on pages outside `/tools/`?**
No. The plugin targets the guide pages under `/tools/`, whose FAQ sections use details/summary markup.

## Links

- [tabaix.com](https://tabaix.com/)
- [Tabaix agency portfolio](https://agency.tabaix.com/portfolio/)

## Changelog

### 1.0.0

- Initial public release: FAQPage JSON-LD from the guide pages' own FAQ sections.

## License

GPL-2.0-or-later — see https://www.gnu.org/licenses/gpl-2.0.html
