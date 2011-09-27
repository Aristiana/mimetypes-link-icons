=== MimeTypes Link Icons ===
Contributors: eagerterrier
Donate link: http://blog.eagerterrier.co.uk/2010/10/holy-cow-ive-gone-and-made-a-mime-type-wordpress-plugin/
Tags: mime-type, icons, PDF, xls, xlsx, doc, docx, mime, type, mimetype, zip, csv, ppt, skp, dwg, dwf, jpg, pptx, 508 compliance, jpg, tar, txt, gif, png, tgz, psd, ai, indd, iso, gz, dmg, bib, tex
Requires at least: 1.5.1.3
Tested up to: 3.2.1
Stable tag: trunk

Adds icons automatically to any uploads inserted into your blog posts.

== Description ==

MimeTypes Link Icons is a plugin that looks for uploads in your blogs posts and adds a nice icon next to it. Option to add file size next to 

Supported Extensions:

* .csv
* .doc
* .docx
* .pdf
* .xls
* .xlsx
* .zip
* .ppt
* .pptx
* .dwg
* .dwf
* .skp
* .jpg
* .tar
* .txt
* .jpg
* .tar
* .gif
* .png
* .tgz
* .psd
* .ai
* .indd
* .iso
* .gz
* .dmg
* .bib
* .tex

Each icon is configurable. You can choose to display a PNG with transparent background or GIF with white matte. Each icon is available in the following sizes:

* 16x16px
* 24x24px
* 48x48px
* 64x64px
* 128x128px

== Installation ==


1. Upload the whole `mime_type_link_images` folder to your `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. By default the PDF icon will be the only one being searched for. It will display the 48x48 gif next to your pdf links. Any other 

== Frequently Asked Questions ==

= Does `MimeTypes Link Icons` just convert uploaded document links? =

No. It searches your post for any links containing the mimetype extensions you have activated. This will be triggered by any link.


== Screenshots ==

1. Screenshot of the administration screen
2. Screenshot of plugin in action.
3. MimeTypes Link Icons adds icons automatically to your inline attachments.
4. Now you can get mime type link images to add the file size of your attachment, too.

== Changelog ==


= 2.0.7 =
* Adding 14 more icon types - jpg, tar, txt, gif, png, tgz, psd, ai, indd, iso, gz, dmg, bib, & tex

= 2.0.6 =
* 2.0.5 is not showing in the repository. 2.0.6 is a *bump* for 2.0.5

= 2.0.5 =
* Fixing an issue that effect asyncronous users only. http://wordpress.org/support/topic/plugin-mimetypes-link-icons-plugin-conflict-or-bug?replies=12#post-2349689

= 2.0.4 =
* Shifting the CSS to the head to stop CSS code being truncated and displaying on search results etc in the_excerpt

= 2.0.3 =
* Fixing bug that picked up .xlsx files when only .xls files were selected
* Fixing bug that caused problems if the user modified the plugin to run off the extract
* Adding optional field that will skip adding the icon in a parent div of the site owner's choosing

= 2.0.2 =
* Adding smaller 16x16 images at request of user

= 2.0.1 =
* Fixing bug with asynchronous mode

= 2.0.0 =
* Adding option for displaying filesize. Uses :after pseudo element with CSS. Therefore, will not work on IE6.

= 1.1.0 =
* Enhancements

= 1.0.9 =
* Minor Bug fix. Preparing for 2.0

= 1.0.8 =
* Adding pptx format

= 1.0.7 =
* Adding ability for users to use anchor tags in the PDF URL - ie http://example.com/wp-content/uploads/myfile.pdf#page9

= 1.0.6 =
* Turns out some themes don't use get_header OR get_footer. Had to put the hook into the_content instead.

= 1.0.5 =
* Adding optional asynchronous method for users with conflicting plugins (for example the infocus theme's fancy_box)

= 1.0.4 =
* Bug fix on the preg_replace replace syntax

= 1.0.3 =
* Added new file type icons at request of benlikespizza - ppt, skp, dwg, dwf, jpg

= 1.0.2 =
* Fixed Bug that caused icons not to appear when some conflicting plugins were installed

= 1.0.1 =
* Typo in CSS caused some images not to show

== Upgrade Notice ==

= 2.0.7 =
* Adding 14 more icon types - jpg, tar, txt, gif, png, tgz, psd, ai, indd, iso, gz, dmg, bib, & tex

= 2.0.6 =
* 2.0.5 is not showing in the repository. 2.0.6 is a *bump* for 2.0.5

= 2.0.5 =
* Fixing an issue that effect asyncronous users only. http://wordpress.org/support/topic/plugin-mimetypes-link-icons-plugin-conflict-or-bug?replies=12#post-2349689

= 2.0.4 =
* Shifting the CSS to the head to stop CSS code being truncated and displaying on search results etc in the_excerpt

= 2.0.3 =
* Fixing bug that picked up .xlsx files when only .xls files were selected
* Fixing bug that caused problems if the user modified the plugin to run off the extract
* Adding optional field that will skip adding the icon in a parent div of the site owner's choosing

= 2.0.2 =
* Adding smaller 16x16 images at request of user

= 2.0.1 =
* Fixing bug with asynchronous mode

= 2.0.0 =
* Adding option for displaying filesize. Uses :after pseudo element with CSS. Therefore, will not work on IE6.

= 1.1.0 =
* Enhancements

= 1.0.9 =
* Minor Bug fix. Preparing for 2.0

= 1.0.8 =
* Adding pptx format

= 1.0.7 =
* Adding ability for users to use anchor tags in the PDF URL - ie http://example.com/wp-content/uploads/myfile.pdf#page9

= 1.0.6 =
* Bug fix

= 1.0.5 =
* Adding optional asynchronous method for users with conflicting plugins (for example the infocus theme's fancy_box)

= 1.0.4 =
* Bug fix

= 1.0.3 =
* Added new file type icons - ppt, skp, dwg, dwf, jpg

= 1.0.2 =
* Bug fix

= 1.0.1 =
Typo in CSS caused some images not to show. Recommended for all users