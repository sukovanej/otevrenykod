#!/bin/bash
cd /var/www/html/otevrenykod
git pull origin master
php bin/console cache:clear --env=prod --no-warmup
php bin/console doctrine:schema:update --force
