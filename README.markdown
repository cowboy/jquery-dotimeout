Added Bower support: `bower install ba-dotimeout`

# jQuery doTimeout: Like setTimeout, but better! #
[http://benalman.com/projects/jquery-dotimeout-plugin/](http://benalman.com/projects/jquery-dotimeout-plugin/)

Version: 1.0, Last updated: 3/3/2010

jQuery doTimeout takes the work out of delayed code execution, including interval and timeout management, polling loops and debouncing. In addition, it's fully jQuery chainable, with a very simple, yet powerful API.

Visit the [project page](http://benalman.com/projects/jquery-dotimeout-plugin/) for more information and usage examples!


## Documentation ##
[http://benalman.com/code/projects/jquery-dotimeout/docs/](http://benalman.com/code/projects/jquery-dotimeout/docs/)


## Examples ##
These working examples, complete with fully commented code, illustrate a few
ways in which this plugin can be used.

[http://benalman.com/code/projects/jquery-dotimeout/examples/debouncing/](http://benalman.com/code/projects/jquery-dotimeout/examples/debouncing/)  
[http://benalman.com/code/projects/jquery-dotimeout/examples/delay-poll/](http://benalman.com/code/projects/jquery-dotimeout/examples/delay-poll/)  
[http://benalman.com/code/projects/jquery-dotimeout/examples/hoverintent/](http://benalman.com/code/projects/jquery-dotimeout/examples/hoverintent/)


## Support and Testing ##
Information about what version or versions of jQuery this plugin has been
tested with, what browsers it has been tested in, and where the unit tests
reside (so you can test it yourself).

### jQuery Versions ###
1.3.2, 1.4.2

### Browsers Tested ###
Internet Explorer 6-8, Firefox 2-3.6, Safari 3-4, Chrome 4-5, Opera 9.6-10.1.

### Unit Tests ###
[http://benalman.com/code/projects/jquery-dotimeout/unit/](http://benalman.com/code/projects/jquery-dotimeout/unit/)


## Release History ##

1.0 - (3/3/2010) Callback can now be a string, in which case it will call the appropriate `$.method` or `$.fn.method`, depending on where `.doTimeout` was called. Callback must now return `true` (not just a truthy value) to poll.  
0.4 - (7/15/2009) Made the "id" argument optional, some other minor tweaks  
0.3 - (6/25/2009) Initial release


## License ##
Copyright (c) 2010 "Cowboy" Ben Alman  
Dual licensed under the MIT and GPL licenses.  
[http://benalman.com/about/license/](http://benalman.com/about/license/)
