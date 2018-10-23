HW1
==
#####Composition over Inheritance

This means that inheritance is not always the best solution because we inherit all the functionalities of the 'parent' class
even those we do not need. The implementation of 'children' classes depends on the base class, and changes in the base class often force changes in subclasses.
Inheritance is not flexible enough to give us the opportunity to use only the methods that we really need. The composition allows it. 
Composition is a method that allows you to reuse the code. We create classes that implement specific interfaces. We can use the methods of these interfaces. 

HW2
==

# Object Oriented Programming
## Object Oriented Design

* Definition of Abstraction 
 
**Abstraction** in the context of OOP is a simplification, limitation, generalization, reducing the features of objects.
It involves skipping, hiding irrelevant information, and finding those that are common.
Abstraction has the task of facilitating the solution of the problem and generalizing it.
In order to process different sets of objects, we need to find the features that connect them.
Abstraction is a model that does not actually define any existing object.
An abstract concept can be, for example, a mammal or a means of transport.  

** Explanation how Composition works  
You only choose functionalities that you really need.


** When to inherit and when to use interface  
You have to decide if you want to inherit all the functionalities of the parent class or you only need a few of them.
Remember that implementations of 'children' classes often depends on the 'parent' class. 


* Definition of polymorphism  
**Polymorphism** is one of the pillars of OOP. 
Thanks to polymorphism, we can treat different data in the same way. 
Objects of the child class can be treated as objects of the parent class.
  
** Definition of class and type  
**Class** defines object, its behaviour and state.
Types represents nouns and class represents an implementation of these nouns.

* OOD Best Practises  
** Definition of Dependency Injection  
It is a design pattern that separates the creation of customer dependency on customer behavior
It is an alternative to the approach where objects form an instance of objects.

** Definition of KISS and what it means  
*KISS (Keep It Simple Stupid)* means that you have to generate as simple code as possible. 
It is important because it simplify code so other programmers are able to understand application logic.
This rule not only applies logic but also naming of classes, variables etc.

** Definition of DRY and what it means  
*DRY (Don't Repeat Yourself)* means that you should write reusable code. 
Do not repeat something if it is not necessary. 
It makes no sense to create many methods/functions that have the same functionality.
Code should be written in such a way as to avoid repetition.

 
## Composition over Inheritance
* Based on learnt UML notation and keeping in mind composition over inheritance design classes that will fulfil the functionality:
- The system should log every change of Item's status.
- The data can be stored in a database or a text file.
- in Item class I should run the following code to trigger logging:
$this->logger->log('Item completed');

The design of the classes should look like in the sample for UML class diagram


|Item
|---
|- id : int
|- name : string
|- logger : Logger
|<br>
|+ setState($state : ItemStateInterface) : void
|+ markCompleted()
|+ markOverdue()
|+ getId() : int
|+ setId(int $id)
|+ getName() : string
|+ setName(string $name)
|+ getLogger() : Logger
|+ setLogger(Logger $logger)

|ItemStateInterface
|---
|+ complete(\ToDo\ItemInterface $item) : ItemStateInterface
|+ overdue(\ToDo\ItemInterface $item)

|OpenedState
|---
|+ complete(\ToDo\ItemInterface $item)
|+ overdue(\ToDo\ItemInterface $item)

|CompletedState
|---
|+ complete(\ToDo\ItemInterface $item)
|+ overdue(\ToDo\ItemInterface $item)

|OverdueState
|---
|+ complete(\ToDo\ItemInterface $item)
|+ overdue(\ToDo\ItemInterface $item)

|Logger
|---
|+ log(string $message)
|

|LoggerInterface
|---
|+ log(string $message)
|



