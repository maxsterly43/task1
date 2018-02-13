SERVER API
============
Easy work with books table

###### Books have this fields
  ````
    +codeBook
    +name
    +author
    +price
    +genre
  ````
#### You can change, add, delete and get all records from the table of books.

  API contains methods:
  -----------------------------------

  ### <li>Method GET /api.php
    Returns table of books in JSON.
  ##### For Example:
  
  ````
    host2.ru GET /api.php?action=read
  ````
  ##### Request have this fields
  ````
    +action (action for the server)
  ````
  ##### Returns:
  ````
    array data which contains all records from table of book
  ````
  
### <li>Method POST /api.php
Contains methods to add, change and delete records in table of books
#### 1. add
  Add record in table of books.

  ###### Request have this fields
  ````
    +action (action for the server)
    +name (name of book)
    +author (name author of book)
    +price (book price)
    +genre (book genre)

  ````
  ##### For example:
  ````
  host2.ru POST /api.php
  {
    action:"add",
    name:"UnexpectedMeeting",
    author:"Maksello",
    price:"1488",
    genre:"Porn"
  }

  ````
  ##### Returns:
  ````
    array data which contains status of operation and added record
  ````

#### 2.update
  Change selected record in table of books
  ````
  host2.ru POST /api.php
  ````
  ###### Request have this fields
  ````
  +action (action for the server)
  +codeBook (id of selected book)
  +name (name of book)
  +author (name author of book)
  +price (book price)
  +genre (book genre)
  ````
  ##### For example:
  ````
  host2.ru POST /api.php
  {
    action:"update",
    codeBook:"12",
    name:"UnexpectedMeeting",
    author:"Maksello",
    price:"1",
    genre:"Porn"
  }
  ````
##### Returns:
  ````
    array data which contains status of operation
  ````

#### 3.delete
  Delete row in table of books
  ````
    host2.ru POST /api.php
  ````
  ###### Request have this fields
  ````
    +action (action for the server)
    +codeBook (id of deleting book)
  ````
   ##### For example:
  ````
    host2.ru POST /api.php
    {
      action:"update",
      codeBook:"12"
    }
  ````
##### Returns:
  ````
    array data which contains status of operation and id of deleted book
  ````
  
  
