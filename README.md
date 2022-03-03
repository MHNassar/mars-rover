# mars-rover
Solving Mars-rover problem. 

## Technical Requirements
Before you install project you only need to install
[Docker](https://docs.docker.com/get-docker/) | [docker-compose](https://docs.docker.com/compose/install/)

I use Symfony and Php 8  

## Installation 
```bash
 git clone git@github.com:MHNassar/mars-rover.git
```
To Build the project Run
```bash
 docker-compose up --build -d
```
To check status 
```bash
 docker-compose up --build -d
```
To install the project  

```bash
docker exec -it php8_mars_rover composer install
```
## Test 

To run the tests

```bash
docker exec -it php8_mars_rover php bin/phpunit
```