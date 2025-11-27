# Creating a Model in Laravel Using Eloquent ORM

## Objective

This document outlines the step-by-step procedure for creating, configuring, and customizing a
model in Laravel using the Eloquent ORM. The model enables seamless interaction with the
database through Laravel’s object-relational mapping features.

## Scope

Applicable to Laravel developers or technical team members who need to build and manage data
models for applications integrated with a relational database.

## Prerequisites

- Laravel project already set up.
- Access to the project directory.
- Basic understanding of PHP and Laravel framework.
- Installed Composer and PHP environment.

---

## Step 1: Generate a Model Using Artisan

1. Open the terminal and navigate to your Laravel project’s root directory:

```bash
cd /path/to/your/laravel/project
```

2. Run the Artisan command to create a model, replacing with the desired name (use singular and
PascalCase naming conventions):

```bash
php artisan make:model <ModelName>
```

Example:

```bash
php artisan make:model Post
```

3. Verify the generated file: The new model file is located in the `app/Models` directory (e.g.,
`app/Models/Post.php`). This command creates only the model structure; a database migration file is
not automatically generated unless you include the `-m` flag.

---

## Step 2: Define Model Properties

1. Open the generated model file (e.g., `Post.php`) in your preferred IDE.
2. Locate the `$fillable` property within the model class. This property defines which database
columns can be mass-assigned, improving data security.
3. Add the database column names to the `$fillable` array as shown below:

```php
protected $fillable = [
    'title',
    'content',
    'author_id',
];
```

---

## Step 3: Create a Database Migration

A migration file defines the database table structure associated with the model. You can create it
using Artisan or manually.

### Option 1: Create Model and Migration Together

Use the `-m` flag with the Artisan command to generate both the model and migration:

```bash
php artisan make:model Post -m
```

### Option 2: Create Migration Manually

1. Manually create a new migration file following Laravel’s naming convention:

`YYYY_MM_DD_HH_MM_SS_create_<table>_table.php`

2. Open the migration file and define the table structure within the `up()` method using Laravel’s
Schema Builder:

```php
public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->text('content');
        $table->timestamps();
    });
}
```

---

## Step 4: Customize the Model (Optional)

### 4.1 Define Relationships

```php
class Post extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
```

### 4.2 Add Custom Methods

```php
class Post extends Model
{
    public function getExcerpt()
    {
        return Str::limit($this->content, 100);
    }
}
```

### 4.3 Set Validation Rules (Informational)

Laravel's models don't enforce validation by default. You can keep rule arrays on the model for
reference or use Form Requests / controller validation. Example (informational only):

```php
class Post extends Model
{
    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];
}
```

---

## Step 5: Verify and Test

1. Run database migrations to apply changes:

```bash
php artisan migrate
```

2. Test model functionality by creating and retrieving records through Laravel’s Tinker or controllers:

```bash
php artisan tinker
>>> Post::create(['title' => 'Hello', 'content' => 'World', 'author_id' => 1]);
>>> Post::all();
```

3. Verify that all relationships and methods work as intended.

---

## Conclusion

By following this procedure, you can successfully:

- Create a new model using Laravel Artisan.
- Define mass-assignable properties and configure database structure.
- Customize model behavior through relationships, methods, and validation rules.

This process ensures a clean, maintainable, and secure data layer within your Laravel application.

---

## Quick Reference Commands

```bash
# Create model only
php artisan make:model Post

# Create model with migration
php artisan make:model Post -m

# Run migrations
php artisan migrate

# Open tinker
php artisan tinker
```
