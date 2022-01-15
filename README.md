# Coding Challenge


### Questions for Zach
1. ~~couldn't I do get/post/put/delete on one route for the db/api? I'd still use two routes, but the other would be the front end.~~ nevermind, i misunderstood and think i have a more solid idea.
2. what exactly are the purposes/use cases of the given extensions? i could, and probably should research, but hearing an explanation of each would probably be easier and faster.
3. should i be using any sort of security for the api? should probably be using tokens or passwords but unsure if neseccary.
**note to add**: could take me give or take a few hours, across maybe the next day or two. Might take longer given my limited knowledge of php.
- hahaha good one ethan

-----

### Two Routes (now three!)

- /add
    - GET /add returns html form with inputs for name and email
        - on submit, sends POST to /add
    - POST /add checks if data is valid
        - if valid, continue
        - if not valid, return to page with error message
    - if user with same name exists, add email to user's list of emails
    - if user with same name doesn't exist, create new user with name and email
    - write data to database and return success message
- /{id}
    - modify data for user with given id
    - ~~i can use get/post/put/delete on this route to modify any data~~
        - didn't bother to do this, but i could
- /users?foo=bar
    - return list of users with names that match query
    - can use "first" or "last" as parameters
    - i.e: /users?first=zach
    
### SQL db table

```SQL
CREATE TABLE users (
    user_id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    PRIMARY KEY (user_id)
);

CREATE TABLE emails (
    user_id INT NOT NULL,
    email VARCHAR(320) NOT NULL,
    PRIMARY KEY (email)
);
```

### Other Details

- minimal front end
- show TDD processes
    - Test Driven Development, i.e show your creation process
- clean code
- test code (obviously)
- secure, well-built and thought out functions

### Front End

use [twig](https://github.com/slimphp/Twig-View)/[slim](https://www.slimframework.com/docs/v4/) for anything front-end related<br/>
i dont know how it works so check docs
already explained most in the [/add](#two-routes) route

## TODO
- [x] install dependencies
- [x] setup Slim Skeleton
- [x] create MariaDB database
- [x] setup table with data outlined above
- [x] setup POST and GET routes for API
- [x] setup routes for front end
- [x] create front end to interact with API
- [x] css, so its not ugly
- [x] test for bugs
- [x] put routes in separate files and import them



## Development Logs / Notes

- having issues with `Fatal error: Uncaught Error: Class 'Slim\Factory\AppFactory' not found`, turns out slim ^3.* does not have "appfactory" unlike ^4.*.
- i think rather than using slim skeleton, ill start from scratch. hopefully not a big deal, should be easier for me to understand anyways. \
- this has proved to be harder than i thought it would be. i'm not sure how to get the routes to work.
- fast forward a bunch because i didnt write notes
- routes work perfectly, just having trouble moving to seperate files
- the problem ended up being that i included "$app" as a parameter in the function, but it wasnt needed at all. removing it fixed all of my issues.
- project is done!? will upload to github.