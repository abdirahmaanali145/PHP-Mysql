# PHP Arrays -- Lesson 2

This lesson demonstrates the basics of **arrays in PHP**, including
numeric arrays, array initialization, associative arrays, displaying
array data, `for` loops, `<pre>` formatting, and `var_dump()`.

## Learning Objectives

By the end of this lesson, you should understand how to:

-   Create a numeric array in PHP.
-   Add values to an array using indexes.
-   Work with associative arrays using named keys.
-   Access values stored inside an array.
-   Loop through an array using a `for` loop.
-   Display arrays clearly using `<pre>`.
-   Inspect the structure and data types of an array using `var_dump()`.

------------------------------------------------------------------------

## 1. Creating an Array

### Screenshot

![Creating an Array example](screenshots/Creating-Array-example.png)

### Explanation

The screenshot shows the first way to create a numeric array:

``` php
<?php
// Creating Array - numeric array
// First way to create array
$names = array();
?>
```

`array()` creates an empty array and stores it in the variable `$names`.

At this point, `$names` does not contain any values. Values can be added
later by using numeric indexes such as `$names[0]`, `$names[1]`, and so
on.

------------------------------------------------------------------------

## 2. Initializing an Array with Indexes

### Screenshot

![Initialize array example](screenshots/initialize-array-example.png)

### Explanation

The screenshot demonstrates adding values to the `$names` array
manually:

``` php
$names[0] = "CA233 is the best class";
$names[1] = 123;
$names[3] = 15.4;

echo $names[3] . "<br>";
echo $names[1] . "<br>";
echo $names[5] . "<br>";
```

Each value is stored at a specific index.

-   `$names[0]` stores a string.
-   `$names[1]` stores an integer.
-   `$names[3]` stores a decimal number (`float`).
-   `$names[5]` has not been assigned a value in the screenshot.

### Important Note

PHP arrays do not have to use consecutive indexes. In this example,
indexes `2` and `5` are not initialized.

Trying to display `$names[5]` when it does not exist can produce an
**Undefined array key** warning in modern PHP versions.

A safer approach is:

``` php
if (isset($names[5])) {
    echo $names[5];
}
```

------------------------------------------------------------------------

## 3. Associative Array

### Screenshot

![Associative array example](screenshots/Associative-array-example.png)

### Explanation

An associative array uses **named keys** instead of numeric indexes.

The screenshot creates an `$info` array containing information about a
person:

``` php
$info = array(
    "id" => "101",
    "name" => "Abdirahman ali hasan",
    // "age" => "20",
    "address" => "Hodan district",
    // "status" => "single",
    "weight" => 178.5
);
```

Examples of keys and values:

  Key         Value
  ----------- ------------------------
  `id`        `101`
  `name`      `Abdirahman ali hasan`
  `address`   `Hodan district`
  `weight`    `178.5`

The `=>` operator connects a key with its value.

The `age` and `status` lines are commented out, so PHP does not add them
to the array.

------------------------------------------------------------------------

## 4. Displaying Information Stored in an Associative Array

### Screenshot

![Displaying information stored in Associative array
example](screenshots/Displaying-information-stored-in-Associative-array-example.png)

### Explanation

The screenshot demonstrates how to inspect the complete associative
array:

``` php
echo "<pre>";
echo "information about the person: <br>";
print_r($info);
var_dump($info);
echo "</pre>";
```

### `print_r()`

`print_r()` displays an array in a human-readable format. It is useful
when you want to quickly see the keys and values.

### `var_dump()`

`var_dump()` provides more detailed information. It shows:

-   The data type of each value.
-   The length of strings.
-   The numeric values.
-   The array structure.

Using both functions is useful while learning and debugging PHP arrays.

------------------------------------------------------------------------

## 5. Using a `for` Loop with an Array

### Screenshot

![Array using For loop](screenshots/Array-using-For-loop.png)

### Explanation

The screenshot shows how a `for` loop can be used to display values from
an array:

``` php
$keys = array_keys($info);

for ($i = 0; $i < count($keys); $i++) {
    $key = $keys[$i];
    echo $key . ": " . $info[$key] . "<br>";
}
```

### How it works

1.  `array_keys($info)` gets all keys from the associative array.
2.  The keys are stored in `$keys`.
3.  `count($keys)` determines how many keys exist.
4.  The `for` loop starts at index `0`.
5.  `$key = $keys[$i]` gets the current key.
6.  `$info[$key]` gets the value associated with that key.
7.  `echo` displays the key and value.

For example, the output can look like:

``` text
id: 101
name: Abdirahman ali hasan
address: Hodan district
weight: 178.5
```

------------------------------------------------------------------------

## 6. Displaying an Array with the `<pre>` Tag

### Screenshot

![Pre tag Example](screenshots/Pre-tag-Example.png)

### Explanation

The screenshot uses the HTML `<pre>` tag:

``` php
echo "<pre>";
print_r($names);
echo "</pre>";

echo "<pre>";
var_dump($names);
echo "</pre>";
```

The `<pre>` tag preserves spaces, line breaks, and formatting. This
makes PHP array output easier to read in a web browser.

Without `<pre>`, array output can appear crowded or difficult to
understand.

------------------------------------------------------------------------

## 7. Using `var_dump()`

### Screenshot

![Var dump example](screenshots/Var-dump-example.png)

### Explanation

The screenshot shows:

``` php
var_dump($names);
```

`var_dump()` is one of the most useful PHP debugging functions.

It displays the variable's:

-   Data type.
-   Size or length where applicable.
-   Value.
-   Array indexes.
-   Nested array structure.

For example, if an array contains a string, integer, and float,
`var_dump()` helps you see the difference between those data types.

------------------------------------------------------------------------

## `print_r()` vs `var_dump()`

  Function       Main purpose                              Detail level
  -------------- ----------------------------------------- --------------
  `print_r()`    Read an array in a simple format          Medium
  `var_dump()`   Debug and inspect data types and values   High

### Example

``` php
$names = array();

$names[0] = "CA233 is the best class";
$names[1] = 123;
$names[3] = 15.4;

echo "<pre>";
print_r($names);
echo "</pre>";

echo "<pre>";
var_dump($names);
echo "</pre>";
```

------------------------------------------------------------------------

## Key Concepts Summary

### Numeric Array

A numeric array normally uses numeric indexes:

``` php
$names[0] = "Ali";
$names[1] = "Ahmed";
$names[2] = "Hassan";
```

### Associative Array

An associative array uses named keys:

``` php
$info = array(
    "id" => 101,
    "name" => "Ali",
    "address" => "Hodan"
);
```

### Accessing an Array Value

``` php
echo $info["name"];
```

### Getting Array Keys

``` php
$keys = array_keys($info);
```

### Counting Array Elements

``` php
count($info);
```

### Looping Through an Array

``` php
foreach ($info as $key => $value) {
    echo $key . ": " . $value . "<br>";
}
```

For associative arrays, `foreach` is often simpler than manually using
`array_keys()` with a `for` loop.

------------------------------------------------------------------------

## Conclusion

This lesson introduces the fundamental concepts of PHP arrays. The
screenshots demonstrate how to create arrays, add values using indexes,
create associative arrays, access stored information, loop through
arrays, and inspect array contents using `print_r()` and `var_dump()`.

These concepts are important for working with PHP because arrays are
commonly used to store and process multiple related values.
