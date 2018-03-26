# fury-http

A magic-agnostic framework for web applications

## Usage

Add fury-http to `composer.json`. As long as the repository is not publicly
available, you will have to add a reference to it:

```
"require": {
    "kartenmacherei/fury-http": "^1.2"
},
 "repositories": [
    {
        "type": "vcs",
        "url": "git@bitbucket.org:kartenmacherei/fury-http.git"
    }
]
``` 

Create an `Application` class which extends from `Fury\Application\Application`. 
You will need to implement three methods; the defined return types will tell
you what you need to do.  
