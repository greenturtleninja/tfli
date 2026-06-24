## Code Structure

 - app - Point the root web root to this folder.
  - index.php - The access file, this handles the root and processing of api calls
  - router.php - Handles the crud opperations of the routes
  - db.php - Creates a db object to be used by the router class. Makes it easier to change db if needed (if SQL is compatible) 

## Done Differently

## Other Software

I've mainly used nginx/apache/caddy and PHP in previous work so used this setup
for this project. However with Golang I can directly launch a server and routing application, may have made it a bit easier to setup. Well would need to install Golang as well though. I personally think installing golang and setting up up be slightly easier, but not by much.

Maybe for the UI I would use vue, only because that's what I'm used to.

Use a linux or Mac to make the install and setup easier and crtl + arrow right/left jumps to end/start of line

Fix/Add the missing PHP extensions

## Improvements

### Security

Implement JWT token and user login screens for access to the url CRUD application or implement API token for directly editing via api requests

### Unit testing

Add some unit phpunit testing for the router class by mocking the db or creating a temporary one database and checking returns from function calls

Add a cypress/playwright test for test the ui end to end and checking the URLS redirect

### Cloud platform

Move the code to a cloud platform, I'm familar with AWS but think GCP and Azure are similar