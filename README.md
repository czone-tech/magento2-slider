## Image Slider module for Magento2
This module allows you to create image sliders or content sliders for Magento2.

The module has been tested with Magento 2.0.x and 2.1.x, however, it should work fine for other Magento 2.x versions as well.

If you have any issues using this module, you may contact us at support@czonetechnologies.com

###Why Slider?
Image sliders (or custom content sliders) enables you to grab the attention of your users in an easy way. Moving images are bound to grab attention compared to stationary content.
Also, it allows you to maximize the usage of available screen space. So you are able to display more content to the user within the limitations of the available screen estate.

####1 - Installation
##### Manual Installation

 * Download the extension
 * Unzip the file
 * Create a folder {Magento root}/app/code/CzoneTech
 * Extract the contents of the zipped folder inside it.


#####Using Composer

```
composer config repositories.czone-tech composer https://repo.czonetechnologies.com
composer require czone-tech/slider
```

####2 -  Enabling the module
Using command line access to your server, run the following commands -
```
 $ php -f bin/magento module:enable --clear-static-content CzoneTech_Slider
 $ php -f bin/magento setup:upgrade
```


## Screenshot
