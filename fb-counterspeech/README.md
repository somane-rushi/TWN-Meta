## Installation

We will be running our local environments from Vagrant boxes as per the Wordpress VIP Docs

*Please follow this README rather than the VIP/VVV docs as the instructions will differ slightly*

__IF YOU HAVE ALREADY CONFIGURED YOUR VVV SET UP FOR THE OTHER FB SITE YOU SHOULD SKIP TO STEP NUMBER 6__

1. Install [VirtualBox](https://www.virtualbox.org/) if you don't already have it

2. Install [Vagrant](https://www.vagrantup.com/) if you don't already have it.
    * 2a. Install [vagrant-hostsupdate](https://github.com/cogitatio/vagrant-hostsupdater) plugin with `vagrant plugin install vagrant-hostsupdater` 
    * 2b. Install [vagrant-triggers](https://github.com/emyl/vagrant-triggers) plugin with `vagrant plugin install vagrant-triggers`

3. Create a directory called 'fb-sites' and clone the [VVV repo](https://github.com/Varying-Vagrant-Vagrants/VVV) into it. I used `git clone -b master https://github.com/Varying-Vagrant-Vagrants/VVV.git ./fb-sites/`. Make sure that you are cloning the master branch as the default branch for the repo is develop.

4. In the root of your fb-sites directory, create a file called `vvv-custom.yml` and copy in the following code: 
```yml
---
sites:
  # The wordpress-default configuration provides a default installation of the
  # latest version of WordPress.
  internetdotorg:
    repo: https://github.com/Varying-Vagrant-Vagrants/custom-site-template.git
    hosts:
      - iorg.dev
    custom:
      wp_type: subdirectory

  counterspeech:
    repo: https://github.com/Varying-Vagrant-Vagrants/custom-site-template.git
    hosts:
      - counterspeech.dev
    custom:
      wp_type: subdirectory

  # The following commented out site configuration will create a environment useful
  # for contributions to the WordPress meta team:
  
  #wordpress-meta-environment:
  #  repo: https://github.com/WordPress/meta-environment.git

utilities:
  core:
    - memcached-admin
    - opcache-status
    - phpmyadmin
    - webgrind
```

5. From inside fb-sites, you can now run `vagrant up`. The provisioning of these sites will take several minutes so go get a coffee or something - but hang around for a few minutes at least first as you may be prompted for your administrator password.

6. Once your initial `vagrant up` has finished. Navigate to fb-sites/www/counterspeech/public_html and remove the contents of the wp-content directory

7. Clone the contents of this repo into the, now empty, wp-content directory
    * *I ran from inside the wp-content directory*
    ```
    git clone https://github.com/wpcomvip/fb-counterspeech.git . 
    ``` 
    
8. Add the [VIP Go MU Plugins](https://github.com/Automattic/vip-mu-plugins-public/) to a directory called "mu-plugins" within wp-content/
    * *I ran ' git clone https://github.com/Automattic/vip-mu-plugins-public.git --recursive ./mu-plugins/ ' from inside the wp-content directory*
    * Note: the [VIP Go Dev Docs](https://vip.wordpress.com/documentation/vip-go/local-vip-go-development-environment/) say that you should clone from [this repo](https://github.com/Automattic/vip-go-mu-plugins) but doing so causes a number of access errors. The "vip-mu-plugins-public" repo that we're using appears to be the public build of the aforementioned repo - but maybe this is worth looking into further if we hit any problems that seem to stem from "mu-plugins"

9. Finally, navigate to the parent directory of wp-content: `public_html`. Edit the file `wp-config.php` by placing the following lines just above the line "/* That's all, stop editing! Happy blogging. */":
```php
if ( file_exists( __DIR__ . '/wp-content/vip-config/vip-config.php' ) ) {
    require_once( __DIR__ . '/wp-content/vip-config/vip-config.php' );
}
```

10. That should be it! Visit counterspeech.dev/wp-admin in your browser (uname: admin pw: password) and make sure that you have a "VIP" menu in the admin sidebar.
