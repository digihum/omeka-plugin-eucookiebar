# omeka-plugin-eucookiebar

Version 2 of the EUCookieBar plugin for Omeka Classic is a rewrite by Steve 
Ranford of the first version authored by Tim Hollies. This module is sponsored
by  Research Computing at the University of Warwick.

The plugin is now a wrapper for the GDPR/CCPA compliant 
[cookie consent plugin](https://github.com/orestbida/cookieconsent) 
written in plain javascript by [Orest Bida](https://ko-fi.com/orestbida).

It is built for bundling with Google Analytics and at this stage isn't 
configurable for other options.

## Installation

Clone or download and extract a zip of the repository into it in the Omeka 
`plugins` directory and rename the directory from `omeka-plugin-eucookiebar`
 to `EUCookieBar`.

Enable the plugin in the Omeka plugins interface. There are a number of 
configuration options to set. 

## Customisation

Alternatively the `cookieconsent-init.js` and `cookieconsent.css` can be 
overridden by the theme to further integrate with look and feel of a site. 

## Dependencies

Version 2 no longer depends on jQuery.