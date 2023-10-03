# Laravel Fruit Project

This Laravel project focuses on managing a hierarchical list of fruits. It includes functionalities to display, edit, and delete fruits, and it periodically updates the fruit list from an external JSON source.

I didn't have time to add any styling, and there's a bit of a logical error in how it displays edit/delete buttons for fruit with child fruit.

I also wasn't able to implement code to prevent the JSON update from re-adding in fruit that had already been edited. Since the fruit doesn't come with unique IDs I wasn't able to naturally add in a check for this. Maybe with enough time this could have been done with, say, the keys for each fruit.

## Files

### Controllers

#### FruitController.php

The `FruitController` handles the CRUD operations for fruits. It includes methods for displaying the index, editing, updating, and deleting fruits. Additionally, it features a method to update fruits from an external JSON source.

### Models

#### Fruit.php

The `Fruit` model defines the structure of the `fruits` table and establishes the relationship between parent and child fruits.

### Commands

#### UpdateFruits.php

The `UpdateFruits` Artisan command triggers the `updateFruitFromJson` method in the `FruitController`, updating the fruits in the database from an external JSON source.

### Routes

#### web.php

The `web.php` file contains routes for displaying, editing, updating, and deleting fruits.

### Views

#### Index View

The `index.blade.php` file displays a sorted list of fruits. If no fruits exist, it triggers the update from the external JSON source.


#### Edit View

The `edit.blade.php` file provides a form for editing a specific fruit.


#### Fruit Partial View

The `fruit.blade.php` file is a partial view for rendering individual fruits in the nested list. It includes buttons for editing and deleting fruits.


### Database Migration

#### create_fruits_table.php

The migration file defines the structure of the `fruits` table.


## How to Use

1. Run migrations to create the `fruits` table:

   ```bash
   php artisan migrate
   ```

2. Access the fruits index page:

   ```
   http://localhost/fruits
   ```

3. Explore, edit, and manage the hierarchical list of fruits.

## Scheduled Update

The project includes a scheduled task that updates the fruits from the external JSON source every hour. This is achieved through the `UpdateFruits` command scheduled in the Laravel scheduler.

To manually run the update command:

```bash
php artisan update:fruits
```
