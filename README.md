
<div id="top"></div>

<div align="center">


<img src="https://svg-rewriter.sachinraja.workers.dev/?url=https%3A%2F%2Fcdn.jsdelivr.net%2Fnpm%2F%40mdi%2Fsvg%406.7.96%2Fsvg%2Fcalendar-month.svg&fill=%232563EB&width=200px&height=200px" style="width:200px;"/>

<h3 align="center">Google Calendar Sync</h3>

<p align="center">
    Synchronise google calendar events with a selected post type.
</p>    
</div>

##  1. <a name='TableofContents'></a>Table of Contents


* 1. [Table of Contents](#TableofContents)
* 2. [About The Project](#AboutTheProject)
	* 2.1. [Built With / Dependencies](#BuiltWithDependencies)
	* 2.2. [Installation](#Installation)
* 3. [Usage](#Usage)
	* 3.1. [Authorise.](#Authorise.)
	* 3.2. [Calendar](#Calendar)
	* 3.3. [Posts](#Posts)
	* 3.4. [Extra Fields](#ExtraFields)
	* 3.5. [Regex Replace](#RegexReplace)
	* 3.6. [Scheduler](#Scheduler)
	* 3.7. [Trash](#Trash)
	* 3.8. [Update](#Update)
* 4. [Customising](#Customising)
* 5. [Contributing](#Contributing)
* 6. [License](#License)
* 7. [Contact](#Contact)
* 8. [Changelog](#Changelog)


##  2. <a name='AboutTheProject'></a>About The Project

This project was built as a way to generate event posts based on the contents of a google calendar. Used on LondonParkour.com/classes to generate the daily classes.

<p align="right">(<a href="#top">back to top</a>)</p>


###  2.1. <a name='BuiltWithDependencies'></a>Built With / Dependencies

The sister plugin [https://github.com/IORoot/wp-plugin__oauth--gCAL](https://github.com/IORoot/wp-plugin__oauth--gCAL) is required to login to your google calendar.

This must be installed to work. You also need ACFPro to work also.

This project was built with the following frameworks, technologies and software.

* [oauth--gCAL](https://github.com/IORoot/wp-plugin__oauth--gCAL)
* [ACF Pro](https://advancedcustomfields.com/)
* [Composer](https://getcomposer.org/)
* [PHP](https://php.net/)
* [Wordpress](https://wordpress.org/)

<p align="right">(<a href="#top">back to top</a>)</p>



###  2.2. <a name='Installation'></a>Installation

These are the steps to get up and running with this plugin.

1. Clone the repo into your wordpress plugin folder
```bash
git clone https://github.com/IORoot/wp-plugin__gcal-sync ./wp-content/plugins/gcal-sync
```
1. Clone the oauth repo into your wordpress plugin folder
```bash
git clone https://github.com/IORoot/wp-plugin__oauth--gCAL ./wp-content/plugins/gcal-oauth
```
1. Use Google API Console and create a new project. The project must include the "Google Calendar API".

1. Generate an "OAuth 2.0 Client ID".
    1. Authorised JavaScript origins = https://londonparkour.com
    1. Authorised redirect URIs = https://londonparkour.com/wp-admin/admin-ajax.php

    (replace for you own domains)

1. Download a credentials JSON file for the generated project.

1. Place the `client_secret.json` file into the root of the `./wp-content/plugins/gcal-oauth` folder. Make sure it's called `client_secret.json`.

1. Run `composer install` in the `./wp-content/plugins/gcal-oauth` folder to install dependencies.

1. Copy the same credentials JSON file into the `./wp-content/plugins/gcal-sync` folder and name it `credentials.json`.

1. Run `composer install` in the `./wp-content/plugins/gcal-sync` folder to install dependencies.

1. Activate the plugins.

The `gcal-oauth` plugin is used to add a new ACF component that is a button to connect to the Google OAUTH servers.


<p align="right">(<a href="#top">back to top</a>)</p>

##  3. <a name='Usage'></a>Usage

Once the plugin is activated, you'll have a new menu option at the top called "ANDYP" that contains the "gCAL Importer". Click on that.

###  3.1. <a name='Authorise.'></a>Authorise.

Click on the "Log in" button. This will navigate you through the google OAuth process to allow your Google API Project access to the user that has the google calendar. You may get a warning that the project is unsafe, this is because it's a private one and not something you put into production.

Once the process has completed, the button will turn red and say `Logged In`. There will also be a "bin" button to log you out.

###  3.2. <a name='Calendar'></a>Calendar

1. Calendar ID. This will be the ID of the google calendar you wish to retrieve results from. The user's default calendar ID is their email address. E.g. `andy@testme.com`

1. Max Results. The number of results on each sync.

1. Skip Private Events. By default, all events are pulled in. You can stop any "Private" ones (marked on google calendar under visibility) from being pulled in.

###  3.3. <a name='Posts'></a>Posts

The `slug` of the target Post type (or custom post type). This is where all the posts will be generated once the sync is run. There will be one post per calendar event.

###  3.4. <a name='ExtraFields'></a>Extra Fields

When an event is pulled in you can automatically attach extra data into meta fields. 

Match the title of the event in google calendar and it will dynamically inject images and meta fields.

The "Field Key" is the name of the meta field. The "Field Value" is the value.

You can have as many Matches entries as you like.

###  3.5. <a name='RegexReplace'></a>Regex Replace 

You can also run the PHP `preg_replace()` function on the description field of the calendar event. This means you can restyle and markup the content however you wish.

1. Label. Purely for organisation and labelling.

1. Regex Pattern. What to match.
e.g.
```php
/<h1>/
```
1. Replacement
e.g.
```php
<p class="text-xl md:text-3xl mb-10">
```
This would replace all `<h1>` tags with the `<p class="text-xl md:text-3xl mb-10">` tag.

###  3.6. <a name='Scheduler'></a>Scheduler

The GCal Sync has it's own scheduler that means you can automatically run a sync whenever you wish. It will rescan the google calendar and pull in any new events.

1. Enabled. Enable / Disable current schedule.

1. Schedule Label. Required field to reference the defined schedule. 

1. Schedule repeats. How often the sync should work.

1. Schedule Start. Pick specific time/date to start the scheduler.

###  3.7. <a name='Trash'></a>Trash

Once the event has passed, how long should the plugin wait (in seconds) until it puts the event into the trash.

###  3.8. <a name='Update'></a>Update

Not the the "update" button will run the sync process as well as save any changes.

##  4. <a name='Customising'></a>Customising

None.

<p align="right">(<a href="#top">back to top</a>)</p>


##  5. <a name='Contributing'></a>Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue.
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



##  6. <a name='License'></a>License

Distributed under the MIT License.

MIT License

Copyright (c) 2022 Andy Pearson

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

<p align="right">(<a href="#top">back to top</a>)</p>



##  7. <a name='Contact'></a>Contact

Author Link: [https://github.com/IORoot](https://github.com/IORoot)

<p align="right">(<a href="#top">back to top</a>)</p>


##  8. <a name='Changelog'></a>Changelog

v1.0.0 - Initial.
