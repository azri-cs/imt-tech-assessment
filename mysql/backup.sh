#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
docker exec db mysqldump -u root -p${MYSQL_ROOT_PASSWORD} ${MYSQL_DATABASE} > ./docker/mysql/backups/backup_${DATE}.sql
