# Serwis ProExpert Project
I received an order for a simple website for a friend. After my first commercial experience as a programmer, I wanted to write a project again without any PHP framework. I wanted to create a new simple project, already showing more experience than in the first project. I thought a simple order from a friend would be the perfect time.

## Topic of the Project
Projekt is a website for a service offering repair of household appliances. The site contains the main page and three sub-pages (about the scope of the service, about the area of performing services, contact information). The site has an administrator panel, the ability to manage user accounts, as well as content management. The project will be expanded depending on the next needs of the client.

## About the Project
Like I said, I wanted to write something again without any framework. I wanted to create a project with more experience. At this stage in my development journey, I am mainly focused on the backend. Nevertheless, I tried to create a simple, though very aesthetic appearance of the site. I created a responsive website using Bootstrap. I used ready-made JavaScript scripts for editing content (CKEditor) or slider on the home page. I made sure the admin panel was transparent.

In a project focused on the backend, I created a project from scratch based on the MVC architectural pattern and object-oriented paradigm. Every language is separate. The Frontend is not mixed with the backend. I created something like my own mini-framework. In the project, In the project I tried to pay a lot of attention to the best quality of written code and narrow specialization of classes. 

## Structure and features
There is an index file in the root and three folders. The public folder is responsible for storing photos, CSS and JavaScript files. The src folder contains PHP files with controllers, models, etc. The template folder contains the page template. I focused here on the description of the src folder. Whenever possible, I tried to use abstract classes and interfaces.

* Builder – it contains a static class that uses the data extracted from the database and prepares a list of them to be displayed later in the view.
* Config – the Folder with the configuration file for the database connection (used in Model/AbstractModel.php).
* Controller – controllers responsible for handling customer queries to the model and view. 
* Helper – auxiliary functions, for example, for validation.
* Libraries – scripts written by others, so far only PHPMailer. PHPMailer supports forms on the page, which later go to the administrator's mailbox.
* Model – responsible for database maintenance. The UserModel supports a table of user data, and the ContentModel supports different content on each subpage.
* Router.php – the Router displays the appropriate view depending on the client URI. Always loads the layout.html (navigation and footer), and then the content of the URI-dependent page.

Technologies
* PHP 8
* SQL
* JavaScript
* JQuery
* Bootstrap 4
* HTML
* CSS
