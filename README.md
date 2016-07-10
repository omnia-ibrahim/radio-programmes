# Radio Programmes
Programmes A-Z

## Introduction

- Search for programmes and episodes names from the radio programmes.
- Three scenarios:
 -- Found a match
 -- Found no result
 -- Found a match and episodes as well

## Technologies used

- PHP
- Javascript/ Ajax
- Bootstrap
- CSS

## Pre-requistes:

-- CURL need to be installed: you can use: sudo apt-get install php5-curl

## Installation 

- Clone the repo
- Open in any modern browser (index.php)

## How to use the program

1- Open the index.php

2- Enter search keyword:

    - You can either press enter to search
    - Or you can wait for 5 sec and it will search dynamically

## Validations

- Validation is done to make sure user didn't enter empty string
- The search keyword is trimmed for empty spaces at the beginning and end of the string
- Any special characters will be omitted (To avoud sql injection)

## Notes

- Pager is not implemented because I'm using current.json, which doesn't return pager data.

- I found three types of programmes: brand, episode and series. I only get the episodes if from type brand.

- As an enhancement: the episodes could be retrieved when clicking on episodes not pre-loaded with all the programmes, but i couldn't make sure that all the programmes of type 'Brand' have episodes so i would have to do the call twice one to get if it has episodes and one to get the episodes itself. So based on the info i have this is much better performance wise because the call is done one time.

- For the last scenario to get the results dynamically, I added a timer to search for results after 5 sec if the user stopped typing.
