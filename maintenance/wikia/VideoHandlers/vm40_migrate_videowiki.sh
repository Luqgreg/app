#!/bin/bash

sudo -u www-data SERVER_ID=298117 php videoMigrateData.php --conf /usr/wikia/docroot/wiki.factory/LocalSettings.php | tee -a logs/298117.migratedata.log