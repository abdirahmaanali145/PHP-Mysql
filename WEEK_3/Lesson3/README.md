# PHP Arrays and HTML Table Demonstration

## Overview
This PHP example demonstrates several array concepts and how PHP can display array data in an HTML page with a light-blue background.

## 1. HTML Page Structure and Background Color
The HTML document defines the page structure, character encoding, responsive viewport, and title. The CSS rule `background-color: lightblue;` sets the page background to light blue.

## 2. Multidimensional Array
The `$info` variable is first declared as a two-dimensional array. Each inner array contains four values, such as a number, a name or course code, and a decimal value.

```php
$info = array(
    array(10, 20, "CA233", 90.12),
    array(123, "Abdirahmaan Ali Hassan", "CA233", 90.12)
);
```

A `foreach` loop visits each inner array. The statements `$list[0]` and `$list[1]` access its first and second elements. The code prints those two values for each row. Because no HTML spacing or line break is added, the values may appear joined together in the browser.

## 3. Two-Dimensional Numerically Indexed Array
The `$student` array stores three student records. Each record is itself an indexed array containing:
- Name
- Year of birth
- Address
- Phone number

PHP uses zero-based indexes, so `$s[0]` is the name, `$s[1]` is the birth year, `$s[2]` is the address, and `$s[3]` is the phone number.

## 4. Displaying Array Data in an HTML Table
The code creates a table using HTML table tags:
- `<table>` starts the table; `border='1'` adds a border and `cellpadding='10'` adds space inside cells.
- `<tr>` creates a table row.
- `<th>` creates a heading cell.
- `<td>` creates a regular data cell.

The loop `foreach ($student as $index => $s)` iterates through each student record. `$index` is the record's array index (0, 1, 2), while `$s` contains that student's information. The values are inserted into table cells to create one row per student.

## 5. Checking Whether a Variable Is an Array: `is_array()`
The example assigns values to `$info` and calls `is_array($info)`. The function returns `true` if the variable is an array and `false` otherwise. The `if...else` statement prints `waa soo helay` when it is an array, or `masoo helin` if it is not.

## 6. Searching an Inner Array with `in_array()`
The `$multi` variable contains nested arrays. The expression `in_array(90, $multi[1])` checks whether the value `90` exists in the second inner array (`$multi[1]`). If found, the code prints the number of elements in `$info` using `count($info)`.

In this example, `$info` contains four top-level elements, so `count($info)` returns `4`. Note that `count($info)` counts only the top-level elements by default, not every value inside nested arrays.

## Important Notes
- The variable `$info` is assigned more than once. Each new assignment replaces its previous value.
- `foreach` is useful for reading each item in an array without manually accessing every index.
- `in_array()` here searches only the selected inner array, not all levels of the multidimensional array.
- For clearer browser output, add `<br>` or wrap the first loop's output in HTML elements.
- If displaying user-provided values in a real application, escape them with `htmlspecialchars()` before inserting them into HTML.

## Expected Output (conceptual)
The page has a light-blue background. It prints the selected values from the first multidimensional array, shows a student table with three data rows, prints `waa soo helay`, and then prints `The size of array $info is 4` (the exact spacing depends on the browser output).

## Concepts Covered
1. HTML page structure and CSS background color
2. Multidimensional arrays in PHP
3. `foreach` loops and array indexes
4. Creating HTML tables with PHP
5. `is_array()` for type checking
6. `in_array()` for searching an array
7. `count()` for counting top-level array elements
