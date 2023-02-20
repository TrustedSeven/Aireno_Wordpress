=== WP phpMyAdmin ===

Tags			 : phpmyadmin,phpminiadmin,mysql,sql,database,manager,management,browser
Stable tag		 : 5.2.1
WordPress URI	 : https://wordpress.org/plugins/wp-phpmyadmin-extension/
Plugin URI		 : https://puvox.software/software/wordpress-plugins/?plugin=wp-phpmyadmin-extension
Contributors	 : puvoxsoftware,ttodua
Author			 : Puvox.software
Author URI		 : https://puvox.software/
Donate link		 : https://paypal.me/puvox
License			 : GPL-3.0
License URI		 : https://www.gnu.org/licenses/gpl-3.0.html
Requires at least: 5.5
Tested up to	 : 6.0.1

[ ✅ 𝐒𝐄𝐂𝐔𝐑𝐄 𝐏𝐋𝐔𝐆𝐈𝐍𝐒 b𝓎 𝒫𝓊𝓋𝑜𝓍 ]
phpMyAdmin -  Database Browser & Manager (for MySQL & MariaDB)

== Description ==
= [ ✅ 𝐒𝐄𝐂𝐔𝐑𝐄 𝐏𝐋𝐔𝐆𝐈𝐍𝐒 b𝓎 𝒫𝓊𝓋𝑜𝓍 ] : =
> • Revised for security to be reliable and free of vulnerability holes.
> • Efficient, not to add any extra load/slowness to site.
> • Don't collect private data.
= Plugin Description =
The famous database browser & manager (for MySQL & MariaDB) - use it inside WordPress Dashboard without an extra hassle.

== NOTES ==
* PHP >= 7.2.5 is required to for <strong>phpMyAdmin</strong> latest version (otherwise you will have option to use older version of PMA, which is not encouraged to be used).
* This plugin has been started from 2018 year, and we have no connections to the old age's vulnerable <b>wp-phpMyAdmin</b> plugin (published elsewhere by 3rd party scammers) . So, this current plugin is just a wrapper for official phpMyAdmin release and depends itself on the realiability & security of the `phpMyAdmin` itself. Also, initially we wanted to put PhpMyAdmin released `.zip` file untouched (to ensure the checksums are same) and unpack that `.zip` directly upon plugin's installation, but unfortunately WordPress Plugin Team didn't allow to put `.zip` file in the package (saying that SVN doesn't like working with `.zip` files). Thus, we had to submit extracted PMA (but still original & untouched) to the repository.
* For the reason to make it compact, some extra or unnecessary files (language files,GIS map, etc) are removed.
* It's recommended, that you enable the plugin only while you need to use PhpMyAdmin. Otherwise, for longer periods, you can deactivate plugin.

= Liability =
We are not developers of PhpMyAdmin itself, neither affiliated with them. We just made this plugin as a wrapper (container) of PhpMyAdmin, so, people could use it in WP. This plugin uses official, unmodified (only whatever mentioned above) PhpMyAdmin package. However, we don't control, check or revise the PhpMyAdmin package's source code ot behavior itself, and thus, in overall, we take no responsibility about this plugin. Use it at your own responsibility (However, not more than 1% of users complained about having issues after using the plugin).

= Available Options =
See all available options and their description on plugin's settings page.


== Screenshots ==
1. screenshot


== Installation ==
A) Enter your website "Admin Dashboard > Plugins > Add New" and enter the plugin name
or
B) Download plugin from WordPress.org , Extract the zip file and upload the container folder to "wp-content/plugins/"


== Frequently Asked Questions ==
- More at <a href="https://puvox.software/software/wordpress-plugins/">our WP plugins</a> page.


== Changelog ==

= 5.2.0.x =
* PMA 5.2.0


= 5.1.3 =
* PMA 5.1.3
* added language files
* >= PHP 7.1.3 requirement

= 5.10 =
* PMA 5.1.0

= 3.02 =
* PMA 5.0.2 

= 3.0 =
* Added latest PMA: version 5.XX (supported on PHP >= 7.1.3) and version 4.XX (supported on PHP >= 5.6 )

= 1.01 - 2.99 =
* Numerous updates and changes

= 1.0 =
* First release.