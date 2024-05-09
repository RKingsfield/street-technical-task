## Description

An application for processing a CSV file and converting the data into normalised objects. This uses the PHP Slim MVC framework as a base.

## Running the app

This project is dockerised, so simple run Docker and use the command `docker-compose up` to launch the application. The default URL for accessing this locally is `localhost:8080`. You should then find a very simple web form for uploading a CSV file for processing.

## Tests

You can run the unit test with the following command once the docker container is running: `docker exec street-technical-test ./vendor/bin/phpunit test`

## Next Steps

The application is now in a working state. To improve and build upon this, I would do the following:

- Improve test coverage, 
  - Include a simple end-to-end test to verify the application can launch and is accessible
- Add persistence in the form of a database layer. This data is both simple and relational so I'd stick with something simple like MySQL.
  - Would perhaps need to create some method of uniquely identifying a person. This could be challenging with the data we have as it's possible to have more than one Mr John Smith.
- Create a much prettier front-end
- Add a MAKE file and some convenience commands to it, such as a pre-commit check to automatically check PSR-12 compliance and run tests
- Add a more complete error handling mechanism rather than relying on the framework