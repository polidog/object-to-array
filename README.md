# object-to-array
[![Build Status](https://travis-ci.org/polidog/object-to-array.svg?branch=master)](https://travis-ci.org/polidog/object-to-array)  
object-to-array is simple convert PHP object to array.


## Installation

```
$ composer require polidog/object-to-array
```

## Usage

```
<?php

$date = new \DateTime();
$dateArray = object_to_array($data);

var_dump($dataArray);
```


### Trait

```
<?php

use Polidog\ObjectToArray\ToArrayTrait;

class User
{
    use ToArrayTrait;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = new \DateTime();
    }
    
}

$user = new User(1, 'polidog');
var_dump($user->__toArray());
```



