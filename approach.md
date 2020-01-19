# Approach for the Distance Calculator

1. A distance is an amount and a unit, let's group them together in a value object
1. We need to be able to convert this to another unit, that could be done in the value
object but it probably adds a lot of complexity so we might be better of to create another
class for that. Let's leave that choice open for now.
1. To add distances we first need to convert them to the required output format, then simply
add the amounts.
1. Now make that accessible using a REST api, not just the unit tests.

This looks like a good opportunity to test the latest features of PHP 7.4 and Symfony 5.0
