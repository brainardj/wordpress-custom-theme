# Wireframe Theme for WordPress
An extendable base theme for [WordPress](https://wordpress.org) >= 5.2

### This ReadMe is written using [Markdown](https://daringfireball.net/projects/markdown/syntax#precode)
- For more info see [this GitHub article](https://help.github.com/en/articles/creating-and-highlighting-code-blocks).

## Authors
- [Trevor Uehlin](https://link.to.github.org)
- [Jack Brainard](https://link.to.github.org)
- [José Bernal](https://github.com/ocdladefense/wireframe)

## Template parts
* Global Header
* Banner Image
* Menu Section
* Posts
* Sidebars?
* Footer

## Widgets



## Plugins
- WordPress Import

## Features
### Automatic Widget Installation
    Changes to sidebar.id should not affect CSS used to style widgets.
    --> What side-effects *can it have then?
    WP_Widget::update( array $new_instance, array $old_instance )
    
See [this thread](https://wordpress.stackexchange.com/questions/26557/programmatically-add-widgets-to-sidebars) for some rudimentary examples of how to include programmatically create Widgets and persist Widget instances to actual Sidebars.
