### About

Developer Bar displays useful debug information about your Kohana 3.2 Application for us (developers!).
This module is originally based on "Kohana Debug Toolbar" <http://pifantastic.com/kohana-debug-toolbar/> for Kohana v2.3 (by Aaron Forsander).

### Usage

* Checkout or download project and put into a folder called 'developerbar' under modules
* Enable Module - see <http://kohanaframework.org/3.2/guide/kohana/modules#enabling-modules>
* IMPORTANT: This module is not loaded automatically whey your project are in a production environment - see <http://kohanaframework.org/3.2/guide/kohana/security/deploying>

~~~
    Kohana::modules(array(
        ...
        'developerbar'    => MODPATH.'developerbar',   // Developer Bar
        ...
    ));
~~~

No more changes on *bootstrap.php* or *index.php* to run a simple toolbar with debug information :)

Feel free to submit improvements or bug fixes.