teampass_api
============

Light API for Teampass

What's that ?
=============

This app will help all people who wants to read their Teampass (http://www.teampass.net) database through a REST API.
I make it simple with old php rules but it did the job ... If you want to review my code, you're welcome dude ! ;-)

Requirements
============

- Web server
- PHP 5.X
- Teampass Instance near
- Little cup of tea

Installation
============

- Modify config.php file with your values :
```
$teampass_path = "/space/www/teampass"; // Path to Teampass instance
$teampass_config_file = $teampass_path."/includes/settings.php"; // Path to Teampass config file for db settings
$teampass_sk_file = "/space/private/teampass/sk.php"; // Path to private file which contain SALT variable
$apikey_pool = Array("aefoongap6iT4bieGhai1quahzeiwah8","aefoongap6iT4bieGhai1quahDEKf93"); // Array of apikeys
$ip_whitelist = Array('127.0.0.1','8.8.8.8'); // Array of ip address allowed to use api (open world if empty)
```

How to use
==========

- Read a category
```
GET http://url/to/api/index.php/read/category/<category name>?apikey=<api key> # For top level category
GET http://url/to/api/index.php/read/category/<category name>;<sub-category name?apikey=<api key> # For sub category
```

```
{
    "1": {
        "label": "item 1",
        "login": "foo",
        "pw": "bar"
    },
    "2": {
        "label": "item 2",
        "login": "foo",
        "pw": "bar"
    },
    "3": {
        "label": "item 3",
        "login": "foo",
        "pw": "bar"
    }
}
```

- Read an item
```
GET http://url/to/api/index.php/read/item/<category name>/<item name>?apikey=<api key> # For item in top level category
GET http://url/to/api/index.php/read/item/<category name>;<sub-category name/<item name>?apikey=<api key> # For item in sub category
```

```
{
    "1": {
        "label": "item 1",
        "login": "foo",
        "pw": "bar"
    },
}
```