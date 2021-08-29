# Users PHP 😉

> This is a simple API RestFull in PHP


## To run this API, you need... 👍
<table>
    <tbody>
        <tr>
            <td>GIT</td>
            <td>^2.24.x</td>
        </tr>
        <tr>
            <td>PHP</td>
            <td>^7.4</td>
        </tr>
        <tr>
            <td>Composer</td>
            <td>^2.1.x</td>
        </tr>
        <tr>
            <td>MySQL Database</td>
            <td>^8.0.x</td>
        </tr>
    </tbody>
</table>

## All Right? Now, follow the instructions below... 👌

> Clone this project in your computer... Use the command below to this!
> 
> ```
> git clone https://github.com/menezedouglas/users-php.git
> ```

> Go to folder the project...
> 
> ```
> cd users-php
> ```

> With the project cloned in your computer, duplicate and rename the file .env.example
> 
> ```
> cp .env.example .env  
> ```

> Configure your database in .env file
> 
> ``` 
> DB_DRIVER=mysql
> DB_HOST=localhost
> DB_PORT=3306
> DB_NAME=users_php
> DB_USER=root
> DB_PASSWORD=
> ```
> 
> If you like, adjust the name of API and Base URL 
> 
> ```
> APP_NAME=users_php 
> APP_URL=http://localhost
> ```

## Good! Now, we are to go create tables and views in your database

> Open your app for database management (DataGrid, PhpMyAdmin, etc...), and run files in
> 
> ```
> ~/database
> ```
> 
> ### Await and pay attention this!
> 
> Run files in this order
> 
> First: run the tables.sql
> 
> After: run the views.sql
>
> #### If you are not unable to create the tables or views, search the internet by "How to run .sql files in < you app to database management >".

## Fine! Now, we are to go install all dependencies of project
> In the base path of project, run this:
> 
> ```
> composer install
> ```

## Finally! We are go start the API...
> Go to public folder
> 
> ```
> cd public
> ```
> 
> And start PHP server using this:
> 
> ```
> php -S localhost:80
> ```

## Success!!
> Now you can follow the API documentation in the [POSTMAN](https://documenter.getpostman.com/view/9336516/U16bvTxC)!
> 
> I see you later, Dev!

