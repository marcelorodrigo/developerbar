### About

Developer Bar displays useful debug information about your Kohana application.
This module is originally based on "Kohana Debug Toolbar" <http://pifantastic.com/kohana-debug-toolbar/> for Kohana v2.3 (by Aaron Forsander).

### Usage

* Checkout or download project and put into a folder called debugbar under modules
* Enable Module - see <http://kohanaframework.org/3.1/guide/kohana/modules#enabling-modules>

~~~
    Kohana::modules(array(
        ...
        'developerbar'    => MODPATH.'developerbar',   // Developer Bar
        ...
    ));
~~~

No more changes on bootstrap or index to run a simple toolbar with debug information :)