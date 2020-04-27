<h1>Hello All!</h1>

![Alt Text](https://media.giphy.com/media/pxwlYSM8PfY5y/giphy.gif)

My name is Oliver, I am a senior web developer with 9 years experience.   
You can find out more about me:   
My website: https://www.olivervoros.com    
My LinkedIN profile: https://www.linkedin.com/in/olivervoros 

I have created this Github Account to demonstrate my skills of using various intermediate and advanced concepts of the Laravel framework.
My Setup: 
PHP 7.4.2, Laravel version 7.4.0, Composer, MySQL, Ubuntu, Apache
  
Initial Project Setup:    
Run composer install  
Run npm install  
CREATE DATABASE {database_name}  
Edit your .env file to have a database connection using the newly created DB  

Then select the required branch by typing: git checkout {branch}   
After you checked out the branch, run: composer dump-autoload   
Then run: php artisan migrate::fresh --seed   
And finally, run the server by: php artisan serve   

<u><b>And now let's see the examples:</b></u>   

 1, <a href="#sc">Service Container</a>  
 2, <a href="#fac">Facades</a>  
 3, <a href="#eloq-rel">Eloquent Relationships</a>  
 4, <a href="#coll">Collections</a>  
 5, <a href="#wc">View Composers</a>  
 6, <a href="#repo">Using the Repository Pattern</a>  
 7, <a href="#mw">Middlewares</a>  
 8, <a href="#sd">Soft Delete</a>  
 9, <a href="#aam">Accessors and Mutators</a>  
10, <a href="#pipe">Pipelines</a>  
11, <a href="#noty">Notifications</a>  
12, <a href="#macros">Macros</a>  
13, <a href="#eaq">Events, Listeners and Queues</a>  
14, <a href="#lat">Localization and Translation</a>  
15, <a href="#lel">Lazy or Eager Loading and the N+1 problem</a>  
16, <a href="#cbd">Custom Blade Directive</a>  
17, <a href="#siro">Signed Routes</a>  
18, <a href="#auth">Authorization</a>      
19, <a href="#bc">Broadcasting</a>  

1, <a name="sc">Service Container and Route-Model-Binding</a> -> git checkout "service-container"         
As the Laravel documentation says, the Laravel service container is a powerful tool for managing class dependencies and performing dependency injection.    
Dependency injection is a fancy phrase that essentially means this: class dependencies are "injected" into the class via the constructor or, in some cases, "setter" methods.   
This branch shows the way to add a service to the container, and also demonstrates various ways of route model bindings.
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/service-container        

2, <a name="fac">Facades </a> -> git checkout "facades"    
The Facade design pattern hides the complexities of the system and provides an interface to the client using which the client can access the system.    
I have developed a custom Facade called WeatherForecast, which demonstrates how Facades work in Laravel.
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/facades       

3, <a name="eloq-rel">Eloquent Relationships</a> -> git checkout "eloquent-relationships"       
This branch demonstrates nine possible Eloquent relationships.     
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/eloquent-relationships       

4, <a name="coll">Collections git checkout collections</a> -> git checkout "collections"   
Collections in Laravel are wrappers around arrays of data, with numerous predefined methods, which helps you to work with the data.       
Under the "Collections branch", I try a number of these predefined methods to represent their use case.     
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/collections      

5, <a name="wc">View Composers</a> -> git checkout "view-composers"     
View Composers are a great way to share data between various views.      
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/view-composers      

6, <a name="repo">Repository Pattern</a> -> git checkout "repository-pattern"    
Repository pattern is a kind of container where data access logic is stored. 
It hides the details of data access logic from business logic. 
In other words, we allow business logic to access the data object without having knowledge of underlying data access architecture.     
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/repository-pattern      

7, <a name="mw">Middlewares</a> -> git checkout "middlewares"    
By using middlewares you can modify or filter the incoming HTTP Request.    
In our implementation we apply an IP address checking middleware.     
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/middlewares     

8, <a name="sd">Soft Delete</a> -> git checkout "soft-delete"   
As the Laravel documentation says, when models are soft deleted, they are not actually removed from your database. 
Instead, a deleted_at attribute is set on the model and inserted into the database. 
If a model has a non-null deleted_at value, the model has been soft deleted.      
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/soft-delete     

9, <a name="aam">Accessors and Mutators</a> -> git checkout "mutators"       
Accessors and mutators allow you to format Eloquent attribute values when you retrieve or set them on model instances.    
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/mutators     

10, <a name="pipe">Pipelines</a> -> git checkout "pipelines"       
Basically, using laravel pipelines you can pass an object between several classes in a fluid way 
to perform any type of task and finally return the resulting value once all the “tasks” have been executed.     
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/pipelines    

11, <a name="noty">Notifications</a> -> git checkout "notifications"     
Laravel provides support for sending notifications across a variety of delivery channels, including mail, SMS (via Nexmo), and Slack. 
Notifications may also be stored in a database so they may be displayed in your web interface.     
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/notifications 

12, <a name="macros">Macros</a> -> git checkout "macros"   
Laravel Macro is a way to add some missing functionality to Laravel's internal component with a piece of code which doesn't exist in the Laravel class. 
To implement a Laravel Macro, Laravel provides a PHP trait called Macroable.     
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/macros

13, <a name="eaq">Events, Listeners and Queues</a> -> git checkout "events-and-queues"     
A simple example of Events, Listeners and Queues.   
The implementation: Within the RegisterController we register a user, and if the user wins we trigger 
the RegisteredUserWonEvent. In the EventServiceProvider class we add two listeners to the RegisteredUserWonEvent.
Both listener's handle method is triggered, and as the listener classes implement ShouldQueue, 
the listener tasks are added to the database driven queue. (see: .ENV QUEUE_CONNECTION=database)         
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/events-and-queues 

14, <a name="lat">Localization and Translation</a> -> git checkout "localization-translation"     
A simple implementation of using multiple languages within a Laravel application.
For the implementation check: the lang directory and the welcome.blade.php view file.      
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/localization-translation

15, <a name="lel">Lazy or Eager Loading and the N+1 Problem</a> -> git checkout "lazy-or-eager-loading"      
This branch explains the N+1 problem, and shows a way to optimise the given database queries.
I suggest, that you set up telescope in order to see the list of SQL queries.
More here: https://laravel.com/docs/7.x/telescope       
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/lazy-or-eager-loading

16, <a name="cbd">Custom Blade Directive</a> -> git checkout "custom-blade-directive"    
A very simple example of creating a custom blade directive...     
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/custom-blade-directive

17, <a name="siro">Signed Routes</a> -> git checkout "signed-routes"    
A straightforward example of using signed routes. This is mostly used for account activations, or when you want to protect a route from users who do not know the URL signature.       
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/signed-routes

18, <a name="auth">Authorization</a> -> git checkout "authorization"     
Example code which includes various implementations of Laravel Authorization, such as Gates and Policies.      
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/authorization

19, <a name="bc">Broadcasting</a> -> git checkout "broadcasting"    
An example implementation of using Laravel's broadcasting feature.       
Implementation: https://github.com/olivervoros/laravel-demo-project/compare/broadcasting

Steps to set up broadcasting:
 1, I have used Redis as a broadcaster, so you will need to install predis: composer require predis/predis    
2, Change your .env file: BROADCAST_DRIVER=redis    
3, Install socket.io: npm install --save socket.io-client    
4, Add the CSRF token to the html template: <meta name="csrf-token" content="{{ csrf_token() }}">    
5, Install Laravel Echo Server: npm install -g laravel-echo-server    
6, Run Laravel Ecco Server: laravel-echo-server init    
7, Run npm: npm install, npm install laravel-echo, npm install socket.io-client     
8, npm run dev
