# Lebowski - Facebook Initiatives Hub

Lebowski is a Wordpress VIP Go project for the Facebook Initiatives Hub.

Core Technologies:

- Wordpress, hosted on Wordpress VIP Go
- JavaScript, SASS

# Get a local development environment setup

This is condensed version of the [WP guidelines](https://vip.wordpress.com/documentation/vip-go/local-vip-go-development-environment/).

Install the prerequisites:

- [Vagrant](https://www.vagrantup.com/)
- [Virtualbox](https://www.virtualbox.org/wiki/Downloads)

Install the plugins:

- `vagrant plugin install vagrant-hostsupdater`
- `vagrant plugin install vagrant-triggers`
- `vagrant plugin install vagrant-vbguest`

cd into `~/`

Install VVV into a directory (the below assumes `~/Vagrants`), and run Vagrant Up for initial setup:

_Warning: This process can take several minutes and appear to hang for minutes at a time – be very patient!_

- `git clone -b master git://github.com/Varying-Vagrant-Vagrants/VVV.git Vagrants`


In vvv-config.yml add the following lines ( above  #example-site: )

```yml
  lebowski-initiatives:
    repo: https://github.com/Varying-Vagrant-Vagrants/custom-site-template.git
    hosts:
       - lebowski-initiatives.test
    custom:
      wp_type: subdomain
```

Then in command line, type.

- `cd Vagrants`
- `vagrant up`


Once complete, find and remove the entire wp-content folder at:
- `~/Vagrants/www/lebowski-initiatives/public_html/wp-content`

Replace this with the code in this repo:

- `git clone --recurse-submodules git@github.com:wpcomvip/fb-initiatives-hub.git ~/Vagrants/www/lebowski-initiatives/public_html/wp-content`

*Note the `--recurse-submodules` flag will make sure the fieldmanager [git submodule](https://git-scm.com/book/en/v2/Git-Tools-Submodules) is also cloned into the plugins directory*

Add the Wordpress VIP plugins:

- `git clone git@github.com:Automattic/vip-go-mu-plugins.git --recursive ~/Vagrants/www/lebowski-initiatives/public_html/wp-content/mu-plugins/`

Then copy object cache in wp-content directory.

- `cp ~/Vagrants/www/lebowski-initiatives/public_html/wp-content/mu-plugins/drop-ins/object-cache/object-cache.php ~/Vagrants/www/lebowski-initiatives/public_html/wp-content/object-cache.php`

From within the `~/Vagrants` directory, run `vagrant up`.

Go to `http://lebowski-initiatives.test/` in the browser.

### Reading the VIP GO config file
Edit wp-config.php and add

`require_once ABSPATH . 'wp-content/vip-config/vip-config.php';`

Right above the wp-settings.php include.

### Frontend

The frontend should live in `wp-content/private/2018_facebook_initiatives` and `wp-content/private/2018_startup_garage`.

To build the frontend to the Themes folder: `npm run build` in either project folder.

# Day to day

Pull the latest mu-plugins to ensure we're working off the latest:

`cd ~/Vagrants/www/lebowski-initiatives/public_html/wp-content/mu-plugins/`

`git pull origin master`

`git submodule update --init --recursive`

All database, Wordpress credentials are [here](https://varyingvagrantvagrants.org/docs/en-US/default-credentials/).

Full VVV documentation is [here](https://varyingvagrantvagrants.org/).

To learn more about the VIP Go codebase, please see the [Wordpress VIP Go documentation](https://vip.wordpress.com/documentation/vip-go/understanding-your-vip-go-codebase/).

## Updating plugins / dependencies

All third party code (plugins and dependencies) are managed by [composer](https://getcomposer.org/). Composer is not run in the build process, so when plugins need to updated, composer needs to be run locally by a developer and the changes checked into the project.

To run composer, you must first [install composer locally](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

Then to update plugins, run the following steps.

0. cd `wp-content/private/dev`
0. Run `composer update --no-dev --optimize-autoloader --no-interaction --prefer-dist`
0. Check what has changed and review updatted.
0. When happy with changes, Run `git add -A`. Making sure that `composer.lock` is checked in.
0. Git commit and push changes.


## n.b.

All the directories here are required and will be available on production web servers. Any extra directories will not be available in production.
