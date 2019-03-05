###  Object Orientated Programming Challenge for 3SC

I have created an application to create and modify ‘Cat Gifs’ with an objected orientated approach.

My approach to this challenge was to use the Interfaces as start by creating the classes to implement each of the corresponding interfaces. From this I created the classes to modify the objects and the file system. SOLID principles has been implemented for this Junior programming challenge. 

Some elements of this challenge I had not worked with before, down to Laravel wrapping the functions in friendly API and working with models, however I have used online resources to further my knowledge. 

I have not implemented fully creating a root directory, as my assumption of this was a directory within the `3sc` folder, and giving full access to delete directories within this from the application would not have been suitable. Access is limited within the `images` folder.

I have extended the namespace to suit better as the application grew. I have followed camel case naming convention. 

I have implemented limited validation using Symfonys Console, and have not at this stage included additional validation. 

I have created limited tests (functional / unit) within the Tests directory which can be ran via the following command: 

### Getting Started

* Clone this repository
* Run `composer install` from the project directory
* Tested on PHP Version 7.2.12



### Usage
```
Php cat – Show Console 
```

```
Php cat image 

php cat image cat_1.gif 
php cat image cat_4.gif --create
php cat image cat_4.gif --update
php cat image cat_4.gif --delete
```

```
php cat directory images
/usr/local/bin/php php cat directory images/test --create
/usr/local/bin/php cat directory images/test --delete
/usr/local/bin/php cat images --rename=new_folder
```

### Tests

```
composer install
./vendor/bin/phpunit
```

