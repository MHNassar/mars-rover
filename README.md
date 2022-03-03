# mars-rover
Solving Mars-rover problem. 

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Technical Requirements](#technical_requirements)
* [Setup](#setup)
* [Test](#test)
* [Usage](#usage)


## General info
A squad of robotic rovers is to be landed by NASA on a plateau on Mars.
This plateau, which is curiously rectangular, must be navigated by the rovers so that their on
board cameras can get a complete view of the surrounding terrain to send back to Earth.
A rover's position is represented by a combination of an x and y co-ordinates and a letter
representing one of the four cardinal compass points. The plateau is divided up into a grid to
simplify navigation. An example position might be 0, 0, N, which means the rover is in the
bottom left corner and facing North.
In order to control a rover, NASA sends a simple string of letters. The possible letters are 'L', 'R'
and 'M'. 'L' and 'R' makes the rover spin 90 degrees left or right respectively, without moving
from its current spot.
'M' means move forward one grid point, and maintain the same heading.
Assume that the square directly North from (x, y) is (x, y+1).

## Technologies
Project is created with:
* php version: 8.0
* Symfony framework
* Docker 
* Docker Compose 

## Technical Requirements
Before you install project you only need to install
[Docker](https://docs.docker.com/get-docker/) | [docker-compose](https://docs.docker.com/compose/install/)

## Setup
```
 git clone git@github.com:MHNassar/mars-rover.git
 cd /mars-rover
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

## Usage: 

To run the Rover Just use this command 
```bash
docker exec -it php8_mars_rover php  bin/console rover:control
```
#### To Add new Rover 
* Go to **public/input.txt**
* Add the rover location and commands 
* run the command again
