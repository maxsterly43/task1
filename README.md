SERVER API
============
Easy work with books table
#### <li>Method GET /api.php?action=read
  Returns table of books in JSON.
````
  host1 GET /api.php?action=read
````
  ###### Books have this fields
  ````
  +codeBook
  +name
  +author
  +price
  +genre
  ````
#### <li>Method POST /api.php
  Contains methods to add, change and delete rows in table of books
  1. Add
  ````
  host1 POST /api.php, action=add
  ````
  Add new book in table of books
