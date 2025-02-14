=== MB Yoast SEO Integration ===
Contributors: metabox, rilwis, elightup, thaoha
Donate link: https://metabox.io/pricing/
Tags: meta box, custom fields, yoast, seo
Requires at least: 5.0
Tested up to: 6.6.2
Stable tag: 1.3.10
License: GPL-2.0

Add content of Meta Box custom fields to Yoast SEO Content Analysis.

== Description ==

**MB Yoast SEO Integration** is a free extension for [Meta Box](https://metabox.io) plugin which allows developers to add content of custom fields to Yoast SEO Content Analysis to have better SEO score.

> **Meta Box Lite**
> We recommend using [Meta Box Lite](https://metabox.io/lite/), a feature-rich free UI version of Meta Box that provides UI and all free features for managing custom fields and dynamic content on WordPress, including post types, taxonomies, custom fields, and relationships.

There are situations when we create custom fields to store real content for the posts. They are actually displayed in the frontend. Search engines such as Google or Bing see them and analyze them. But by default, Yoast SEO plugin takes only post content to analyze for SEO score and gives us feedback based on the post content. The plugin doesn't analyze the all the content that appears to the search engine, which is a big missing part and that sometimes confuses us in SEO term.

So, the plugin *MB Yoast SEO Integration* fixes that problem by allowing us to add custom fields to the content analyzed by Yoast SEO plugin. This way, the Yoast SEO plugin and search engine will see the same content and we will have a correct advice for SEO content as well as correct SEO score.

### Plugin Links

- [Homepage](https://metabox.io/plugins/meta-box-yoast-seo/)
- [Github repo](https://github.com/rilwis/mb-yoast-seo)
- [View other premium extensions](https://metabox.io/plugins/)

== Installation ==

You need to install [**Meta Box**](https://metabox.io) first

1. Go to **Plugins | Add New** and search for **Meta Box**
1. Click **Install** to install the plugin

Install **Meta Box Yoast SEO extension**

1. Go to **Plugins | Add New** and search for **Meta Box Yoast SEO**
1. Click **Install** to install the plugin

To start using text limiter, just add the following parameters to fields:

`'add_to_wpseo_analysis' => true,`

== Frequently Asked Questions ==

== Screenshots ==

1. Plugin in action

== Changelog ==

= 1.3.10 - 2024-10-14 =
Fix Plugin Check

= 1.3.9 - 2021-08-25 =
Fix the plugin not working due to change in Yoast SEO API.

= 1.3.8 - 2021-07-27 =
Fix undefined get_current_screen function on the frontend.

= 1.3.7 - 2021-07-21 =
Fix Yoast SEO not counting text, due to change in the Yoast SEO's API.

= 1.3.6 =
Fixed: Make the plugin works when activate individually and in AIO

= 1.3.5 =
Fixed: Fix fatal error when enqueuing scripts on the front end when use with MB Frontend Submission or MB User Profile.

= 1.3.4 =

* Added check to see if element exists before it's targeted.
* Fixed JS error when use group fields

= 1.3.3 =
Use helper function to get correct URL to current folder, which can be used in plugins and themes

= 1.3.2 =
Fix: Make sure JavaScript file is enqueued only for posts. No conflicts with MB Settings Page or other extensions.

= 1.3.1 =
Improvement: Make the Yoast SEO analyzer works for existing content when page loads.

= 1.3 =
Improvement: Works with wysiwyg (editor) field, including cloned fields.

= 1.2 =
Improvement: Now the plugin works with cloned fields.

= 1.1.2 =
Fix: Update to compatible with Yoast SEO 3.x

= 1.1.1 =

* Fix: Uncaught TypeError: Cannot set property 'textContent' of null
* Fix: Now works with Group extension

= 1.1.0 =
Update to work with Yoast SEO 3.0 which allows you to live preview the result with Javascript.

= 1.0 =
First release

== Upgrade Notice ==
