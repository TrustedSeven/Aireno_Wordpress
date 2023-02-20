=== Paid Memberships Pro - Kissmetrics Add On ===
Contributors: strangerstudios
Tags: pmpro, paid memberships pro, kissmetrics, analytics, tracking, metrics, user data, users, signup
Requires at least: 3.8
Tested up to: 5.4.1
Stable tag: .3.1

Integrates your WordPress site with Kissmetrics to track meaningful user data, with or without Paid Memberships Pro.

== Description ==
The Kissmetrics Add On for Paid Memberships Pro allows you to track meaningful data not only about users, but about how they are interacting with the Memberships sections of your website.

[Read the full documentation for the Kissmetrics Add On](https://www.paidmembershipspro.com/add-ons/pmpro-kissmetrics/)

= Official Paid Memberships Pro Add On =

This is an official Add On for [Paid Memberships Pro](https://www.paidmembershipspro.com), the most complete member management and membership subscriptions plugin for WordPress.

= Default WordPress Tracking =
Kissmetrics allows you to track meaningful data on per user level, giving you a clear picture of what your visitors are really doing on your website - this plugin works with or without [Paid Memberships Pro](https://www.paidmembershipspro.com). Events and properties tracked by default include:

* Events: user registration, user login
* Properties: username, email address, display name, user ID

= Paid Memberships Pro Tracking =
The Kissmetrics Add On for Paid Memberships Pro takes this a step further, allowing you to identify users by their WordPress username, email address, or display name, and track specific events and properties, including:

= Tracked Events in Paid Memberships Pro =
* user visits any front end PMPro page (Levels, Account, Billing, Checkout, etc.). When a user visits the Checkout page, the selected level will be included as well.
* user changes membership level
* user checks out for any level
* user cancels level
* user starts trial – this occurs when there is a trial set for the level on the Edit Membership Level page

= Tracked Properties in Paid Memberships Pro =
* membership level
* last order ID
* last checkout total

Kissmetrics attaches these properties to Customers, giving you all sorts of meaningful data to create different metrics and reports, giving you exactly the information you need to make important decisions and increase your business.

Each event can be enabled or disabled on the PMPro Kissmetrics Settings page under Settings > PMPro Kissmetrics.

== Installation ==

1. Upload the `pmpro-kissmetrics` directory to the `/wp-content/plugins/` directory of your site.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Add your custom API key and JavaScript Tracking Code and configure which events you want tracked on the PMPro Kissmetrics settings page.

== Frequently Asked Questions ==

= I found a bug in the plugin. =

Please post it in the issues section of GitHub and we'll fix it as soon as we can. Thanks for helping. https://github.com/strangerstudios/pmpro-kissmetrics/issues

== Screenshots ==

1. General Settings for Kissmetrics API Key and JavaScript tracking code.
1. Set tracking activity for WordPress Users.
1. Set tracking activity for Paid Memberships Pro members.

== Changelog ==
= .3.1 =
* Readme updates
* Localization support

= .3 =
* Tested up to WP 4.8
* Added filter call to determine if a level is a trial or not.

= .2.1 =
* Added option to track discount code usage.

= .2 =
* BUG: Fixed bug with idenfity option.
* ENHANCEMENT: Moved identify code into a separate function and calling it before all record events now.

= .1.1 =
* Added option to add the total cost as a property on checkout.
* Added select menu to choose how to identify users in Kissmetrics. Options are username, email, and display name.

= .1 =
* This is the initial version of the plugin.
