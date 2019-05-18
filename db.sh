if [ -f ./database/database.sqlite ] 
then
    rm ./database/database.sqlite
fi
touch ./database/database.sqlite

php artisan migrate
php artisan db:seed