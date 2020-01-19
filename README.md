# Distance calculator

This distance calculator uses PHP 7.4 and Symfony 5.0

## How to run locally

1. Make sure PHP 7.4 is installed.
1. Make sure the Symfony CLI is installed (https://symfony.com/download)
1. Checkout this project from Github
1. Install dependencies using `composer install`
1. Start the local server using `symfony server:start`

You can now do a POST request to `http://localhost:8000`

## Example request

    {
        "distances": [
            {
                "amount": 5,
                "unit": "meter"
            },
            {
                "amount": 3,
                "unit": "yard"
            }
        ],
        "output": "meter"
    }

## Example response

    {
        "amount": 7.743208273516153,
        "unit": "meter"
    }

## Next steps

Improve the handling of the incoming data in the controller. Error checking is not present now,
so things will fail hard when incorrect data is provided. Also handling of JSON in general
could be improved, probably by installing another package.
