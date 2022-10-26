## How to Install the Project

- Clone the project
```
git clone https://github.com/devsahm/ultrainfinity-test.git
```

- Enter into the project Directory

```
cd ultainfinity
```

- Install composer to add all Dependencies

```
composer install
```

- Copy the content of env.examples to .env

```
cp .env.example .env
```

- Make sure the database is setup. Generate new key

```
php artisan key:generate

```

- Run Migration and Seed the data

```
php artisan migrate --seed
```

Thank you and I really look forward to hearing from you






