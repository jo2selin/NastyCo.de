# NastyCo.de

  ![Logo](http://jeromepogeant.com/img/Nastycodelogo.png "Nastycode Logo")


## Description
**[NastyCo.de](http://nastyco.de)** allows you to share the dirtiest codes that you see through your various web project. Whether a trainee, a team at the other side of the planet or your Lead Dev, share their nastyCodes on the site, suggest their a correction and share your opinions !

## Installation

Clone NastyCo.de repo:

```console
$ git clone git://github.com/jo2selin/NastyCo.de.git
```

<br/>
Download and install **Node.js**:

>Download the latest version of Node here [Nodejs.org](https://nodejs.org/download/)
<br/>


**If you are on Windows**, install **Ruby**:
>Download the latest version of Ruby here: [Ruby](http://rubyinstaller.org/downloads/)

<br/>
Install Composer (**MacOS and Linux**):

```console
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```
Install Composer (**Windows**):

>Download and run [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe)
>Don't forget to set up your PATH so that you can just call composer from any directory in your command line

<br/>
Install Gulp:

```console
$ sudo npm install --global gulp
```

Update NPM (**If needed**)

```console
$ sudo npm install -g npm
```
<br/>
After installing all this stuff, you will need to download Symphony and Gulp dependencies.

To do that run this two commands inside of your cloned repo.

```console
$ sudo npm install --save-dev
```

```console
$ sudo php composer.phar update
```
>Don't forget to setting up your parameters at the end of Symphony dependencies installation !

**You're almost there !**

Create your database and update it:

```console
$ sudo php app/console doctrine:database:create
$ sudo php app/console doctrine:schema:update --force
```

>If you have errors check your Parameters.yml file to reconfigure it.
>**NastyCo.de\app\config\Parameters.yml**

<br/>

There is some Gulp commands:

```console
$ gulp Sass   // Complile your Sass
$ gulp script   // Minimize all your js script
$ gulp image   // Optimize your images
$ gulp font   // Copie all your font file into the right folder

$ gulp build   // Execute the fourth commands below at the same time

$ gulp watch   // Watch any modification of your Sass files and auto-complie it
```

**You're done ! Let's code**

<br/>
### Known Issues

If you discover any bugs, feel free to create an issue on GitHub fork and
send us a pull request.

## Authors

* Jérôme (https://github.com/Jerome1337)
* Josselin (https://github.com/jo2selin)
* Zac (https://github.com/ZacJoestar)

![Nastyco](http://jeromepogeant.com/img/lastyco.png "Enjoy Coding")
