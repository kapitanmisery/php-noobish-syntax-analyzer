```php
<?php

echo 'hello!' ;
echo 1 + 1 ;
```



Here's the parse analysis:

**Syntax evaluation: Valid PHP code.**

**Displaying Analysis**

```php
Array
(
    [0] => Array
        (
            [0] => ECHO STMT
            [1] => STRING <'hello!'>
            [2] => TERMINATOR
        )

    [1] => Array
        (
            [0] => ECHO STMT
            [1] => NUMBER <1>
            [2] => OPERATOR <+>
            [3] => NUMBER <1>
            [4] => TERMINATOR
        )

)
```
