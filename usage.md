# Usage

## Collection creation

### GeneralCollection

Collection provided for any data types, you can create as below.

```php
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;
use RedRat\Cuddly\Collection\GeneralCollection;

// Create collection by construct
$collectionSlice = new GeneralCollection(
    new ArraySlice()
);
$collectionFixed = new GeneralCollection(
    new ArrayFixed(2)
);
```

```php
use RedRat\Cuddly\Collection\GeneralCollection;

// Create collection by create
$collectionSlice = GeneralCollection::create();
$collectionFixed = GeneralCollection::create(2);
```

### StringCollection

Collection provided for string data, you can create as below.

```php
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;
use RedRat\Cuddly\Collection\Type\Scalar\StringCollection;

// Create collection by construct
$collectionSlice = new StringCollection(
    new ArraySlice()
);
$collectionFixed = new StringCollection(
    new ArrayFixed(2)
);
```

```php
use RedRat\Cuddly\Collection\Type\Scalar\StringCollection;

// Create collection by create
$collectionSlice = StringCollection::create();
$collectionFixed = StringCollection::create(2);
```

### IntegerCollection

Collection provided for integer data, you can create as below.

```php
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;
use RedRat\Cuddly\Collection\Type\Scalar\IntegerCollection;

// Create collection by construct
$collectionSlice = new IntegerCollection(
    new ArraySlice()
);
$collectionFixed = new IntegerCollection(
    new ArrayFixed(2)
);
```

```php
use RedRat\Cuddly\Collection\Type\Scalar\IntegerCollection;

// Create collection by create
$collectionSlice = IntegerCollection::create();
$collectionFixed = IntegerCollection::create(2);
```

### FloatCollection

Collection provided for float data, you can create as below.

```php
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;
use RedRat\Cuddly\Collection\Type\Scalar\FloatCollection;

// Create collection by construct
$collectionSlice = new FloatCollection(
    new ArraySlice()
);
$collectionFixed = new FloatCollection(
    new ArrayFixed(2)
);
```

```php
use RedRat\Cuddly\Collection\Type\Scalar\FloatCollection;

// Create collection by create
$collectionSlice = FloatCollection::create();
$collectionFixed = FloatCollection::create(2);
```

### ObjectCollection

Collection provided for any object types, you can create as below.

```php
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;
use RedRat\Cuddly\Collection\Type\Object\ObjectCollection;

// Create collection by construct
$collectionSlice = new ObjectCollection(
    new ArraySlice()
);
$collectionFixed = new ObjectCollection(
    new ArrayFixed(2)
);
```

```php
use RedRat\Cuddly\Collection\Type\Object\ObjectCollection;

// Create collection by create
$collectionSlice = ObjectCollection::create();
$collectionFixed = ObjectCollection::create(2);
```

### ObjectHintedCollection

Collection provided for user defined object types, you can create as below.

```php
use Project\TheNamespace\OtherNamespace\OhMoreOneNamespace\YourCuteClass;
use RedRat\Cuddly\ArrayStore\ArrayFixed;
use RedRat\Cuddly\ArrayStore\ArraySlice;
use RedRat\Cuddly\Collection\Type\Object\ObjectHintedCollection;

// Create collection by construct
$collectionSlice = new ObjectHintedCollection(
    new ArraySlice(),
    YourCuteClass::class
);
$collectionFixed = new ObjectHintedCollection(
    new ArrayFixed(2),
    '\Project\TheNamespace\OtherNamespace\OhMoreOneNamespace\YourCuteClass'
);
```

```php
use Project\TheNamespace\OtherNamespace\OhMoreOneNamespace\YourCuteClass;
use RedRat\Cuddly\Collection\Type\Object\ObjectHintedCollection;

// Create collection by create
$collectionSlice = ObjectHintedCollection::create(
    YourCuteClass::class
);
$collectionFixed = ObjectHintedCollection::create(
    '\Project\TheNamespace\OtherNamespace\OhMoreOneNamespace\YourCuteClass',
    2
);
```

## Collection usage

For the collection usage we have operations below.

### add()

Operation to add new data in collection. By default, collections doesn't support duplicated data,
but in operation itself you can add duplicated data as you can.

```php
$result = $collection->add('foo'); // returns TRUE
$result = $collection->add('bar'); // returns TRUE
$result = $collection->add('foo'); // returns FALSE
$result = $collection->add('foo', true); // returns TRUE
```

### has()

Operation to check if data is present into collection.

```php
$result = $collection->has('foo'); // returns FALSE
$collection->add('foo');
$result = $collection->has('foo'); // returns TRUE
$collection->remove('foo');
$result = $collection->has('foo'); // returns FALSE
```

### remove()

Operation to remove data from collection if present.

```php
$collection->add('foo');
$result = $collection->remove('foo'); // returns TRUE
$result = $collection->remove('foo'); // returns FALSE
```

### count()

Operation to count elements into collection. Implements `\Countable`,
then you can use in PHP functions that support this interface.

```php
$collection->add('foo');
$collection->add('bar');
$collection->add('bar', true);
$result = $collection->count(); // returns 3
$result = \count($collection); // returns 3
$result = \is_countable($collection); // returns TRUE
```

### getList()

Operation to get array with data from collection.

```php
$collection->add('foo');
$collection->add('bar');
$collection->add('bar', true);
$result = $collection->getList(); // return ['foo', 'bar', 'bar']
```
