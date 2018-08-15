# Magento 2 Product Visibility Grid

**Did you every wonder why your product is not showing up in a category in Magento?**

Magento has a complex way of building a product collection. Due to several conditions, indexes, plugins and other complexity, determining whether a product should show is not that straightforward. 

This grid is making your life easier. It shows the different "visibility conditions" in columns. And. Whether a product is or isn't showing up in your category (collection).
<img align="center" src="./docs/img/grid.png" height="400">

* Determine whether a product is showing in category (yes/no)
* Columns per index/condition
* Reindex per product
* Mass reindex selection

<strong>Table of Contents</strong>
* [Magento 1 Version](https://github.com/Itonomy/magento1-product-visibillitygrid)
* [Requirements](#-requirements)
* [Installation](#-installation)
* [Usage](#️-usage)
* [Version](#️-version)
* [Credits](#️-credits)
* [License](#-license)

# Requirements

- magento 2 community
- php: ~7.1
- magento/magento-composer-installer

# Installation

- Add the module to composer:

        composer require itonomy/productvisibilitygrid

- Add the new entry in `app/etc/config.php`, under the 'modules' section:

        'Itonomy_ProductVisibilityGrid' => 1,

- Clear cache
       
        'php bin/magento c:f'

# Usage

        http://[yourstore.net]/[adminslug]/productvisibility/index/grid
        
Or throught the menu:

<img align="center" src="./docs/img/menu.png" height="400">

Feel free to contribute, and contact me for any issues.

You can also drop us a comment at ben.vansteenbergen@itonomy.nl

# Version

- Updated to version 1.0.0 to achieve a first version

## Credits

* Jerrol Etheredge (former co-worker who created the M1 version)

## License

[MIT](http://webpro.mit-license.org/)
