# PHP Examples

This README contains simple PHP examples covering conditions, loops,
switch statements, constants, and the ternary operator.

## 1. Example Condition

![Example condition](Example%20condition.png)

This example uses `if` and `else` to check a person's age. If
`$Age >= 18`, it displays `Adult`; otherwise, it displays `Child`.

## 2. Constant Variable

![Constant variable](Example%20constant%20variable%20name.png)

`define("Age", 10)` creates a constant named `Age`. A constant stores a
value that normally should not be changed during the program.

## 3. For Loop

![For loop](For%20loop%20example.png)

A `for` loop repeats a block of code while a condition is true. In this
example, the loop starts at 1 and continues until 12.

## 4. While Loop

![While loop](while%20loop%20example.png)

A `while` loop continues running as long as its condition is true. Here,
`$counter` is increased after each iteration.

## 5. Do While Loop

![Do while loop](Do%20while%20loop%20example.png)

A `do...while` loop executes the code first and checks the condition
afterward. This means the code runs at least once.

## 6. Nested Loop

![Nested loop](Nested%20loop.png)

A **nested loop** is a loop inside another loop. The outer loop uses
`$i`, while the inner loop uses `$j`. For every value of `$i`, the inner
loop runs from 1 to 3.

## 7. If Else Example

![If else](IF%20else%20example.png)

This example uses `if...else` to check the amount of fuel. If the fuel
is below 10, it displays a message telling the user to fill the tank;
otherwise, it shows that the fuel is enough.

## 8. Switch Example

![Switch](Switch%20example.png)

A `switch` statement is useful when you need to compare one value with
multiple possible values. In this example, `$marks` is checked to
determine the appropriate grade.

## 9. Ternary Operator

![Ternary operator](Ternary%20operaator.png)

The **ternary operator** is a shorter way to write a simple `if...else`
statement.

``` php
echo ($Age >= 18) ? "Adult" : "Child";
```

If the condition is true, it displays `Adult`; otherwise, it displays
`Child`.

------------------------------------------------------------------------

## Summary

  -----------------------------------------------------------------------
  PHP Concept                         Purpose
  ----------------------------------- -----------------------------------
  `if / else`                         Makes decisions based on a
                                      condition

  `switch`                            Checks one value against multiple
                                      cases

  `for`                               Repeats code a specific number of
                                      times

  `while`                             Repeats code while a condition is
                                      true

  `do...while`                        Runs the code at least once before
                                      checking the condition

  Nested loop                         Places one loop inside another loop

  Ternary operator                    A short form of `if...else`

  Constant                            Stores a value that normally does
                                      not change
  -----------------------------------------------------------------------
