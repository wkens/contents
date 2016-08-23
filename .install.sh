#!/bin/bash

APP_NAME=contents
CUR_DIR=`pwd`
PRIORITY_NO=003

mkdir storage/log
touch storage/log/laravel.log
chmod g+rwx storage/log/laravel.log
for d in `find storage -type d`; do
    chmod g+rwx $d
done

echo "##### APP_NAME=${APP_NAME}"
echo "##### CUR_DIR=${CUR_DIR}"
echo "##### PRIORITY_NO=${PRIORITY_NO}"

if [ ! -e ${APP_NAME}.apache.conf ] ; then
    echo
    echo "##### Setting Apache2..."
    echo
    cp .apache.conf.base ${APP_NAME}.apache.conf
    sed -i "s|{{APP_NAME}}|${APP_NAME}|g" ${APP_NAME}.apache.conf
    sed -i "s|{{CUR_DIR}}|${CUR_DIR}|g" ${APP_NAME}.apache.conf
    sudo ln -s ${CUR_DIR}/${APP_NAME}.apache.conf /etc/apache2/sites-available/${PRIORITY_NO}-${APP_NAME}.apache.conf
    sudo a2ensite ${PRIORITY_NO}-${APP_NAME}.apache.conf
    sudo service apache2 restart
fi

if [ ! -e public/.htaccess ] ; then
    echo
    echo "##### Creating .htaccess file..."
    echo
    cp public/.htaccess.base public/.htaccess
    sed -i "s|{{APP_NAME}}|${APP_NAME}|g" public/.htaccess
fi

if [ ! -e composer.lock ] ; then
    echo
    echo "##### composer install..."
    echo
    composer install
else
    echo
    echo "##### composer update..."
    echo
    composer update
fi

if [ ! -e node_modules ] ; then
    echo
    echo "##### npm install..."
    echo
    npm install
else
    echo
    echo "##### npm update..."
    echo
    npm update
fi

if [ ! -e .env ] ; then
    echo
    echo "##### Create environment file..."
    echo
    cp .env.example .env
    php ./artisan key:generate
fi

echo
echo "##### Create CSS..."
echo
node_modules/gulp/bin/gulp.js
