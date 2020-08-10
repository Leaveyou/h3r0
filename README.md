# h3r0

## Running

~~~ 
php demo.php
~~~

## Design choices

This application has been developed with a few ideas at its core:

#### Testability 
 - The application is fully testable, including random events

#### SOLID

- Classes adhere to the single responsibility principle **in principle** :) There are still some classes with multiple responsibilities such as Warrior 
but even in that case, It is used throughout the application through implemented  Defender and WarriorStats interfaces, allowing further separation if need arises.
- There should be a way to add domain behavior (skills / new sort rules) without changing existing code.
- I used many smaller interfaces for specific tasks
- Used abstractions to decouple higher layers from lower layers

#### Tell, don't ask

Avoid the use of private property accessors. Everything that has a setter function is either optional, or as is the case with the WarriorBuilder class, 
has validations in place to ensure consistency.

#### Low coupling

- No content coupling
- No common coupling
- No stamp coupling
- No external coupling
- No temporal coupling
- No control coupling - in fact there are no control parameters used anywhere

The application avoids using events for interaction between classes though. 
This is an intentional design decision meant to reflect real-life interaction 
for maintainability in the event of business-driven changes. True, events might 
have been used in certain fire-and-forget areas such as application monitoring.

## Q&A

~~~
Q: What is a H3r0?
A: It's the kind of hero that doesn't appear in certain search results but is still for everyone to see. 
   It's the hero 3magia deserves, but not the one it needs right now.
~~~

~~~
Q: Where is the [Interfaces/Services] folder
A: I prefer to use a semantic hierarchy that most closely resembles class interactions and business domain.
~~~

~~~
Q: Isn't this over-designed?
A: Perhaps. Willing to talk about a specific area you're having issues with.
~~~

~~~
Q: Why so many generators?
A: They are awesome. They move complexity in the lower levels and allow a clearer high level self-documenting code 
~~~

~~~
Q: Why are there phpdoc blocks missing?
A: I used php 7.4 which supports annotations. phpdocs are included where adding relevant information.
~~~
