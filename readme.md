# Edit Ticket

## Objective

As a demonstration of your skills, we ask that you complete the following code review. Please create a web page to run on a server with PHP 5.6, MySQL 5.7, and jQuery. You need to create a single page web application, re-creating the attached screenshot as follows:

- Add all fields as demonstrated in the attached screenshot.
- Follow the alignment and styling based on the screenshot.
- Create a database table for Staff and Equipment that will be used to populate the Labour and Truck sections of the page.
- As the Staff, Position, and Unit of Measure are selected, populate rates from the database tables.
- As the hours, quantity, or price are populated for Labour, Truck, and Miscellaneous, the Totals and Sub-Totals should be calculated from those numbers.
- Clicking the + for each row should add an additional row in that section.
- Clicking the X for each row should remove that row, and ensure that there is still at least one row in that section.
- All of these should be done dynamically, without reloading the entire page.
- Clicking the Finish button should pop up an alert such as "Ticket Submitted", and then reload the page.
- Please ensure that your code follows best practices, and provide the necessary source code to run your code, along with an export of the database to generate the necessary tables. Let us know if you have any questions!

## Requirements

- PHP 5.6
- MySQL 5.7
- JQuery
- TinyMce

## How to run

1. Clone the repository: `git clone https://github.com/[]`
2. Create a new database as utilizing `mysql_db_init.sql` script
3. Utilizing the ".env.example" populate fields with your database information.
4. Run the following command in the project directory:

```bash
php -S localhost:4000 -t public
```

5. Open your browser and navigate to [http://localhost:9000](http://localhost:9000) to view the pages.
