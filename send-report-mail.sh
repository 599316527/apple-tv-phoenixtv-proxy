#!/bin/sh

php -f statistics-mail.php \
    type=2 page=1 \
    smtp_host=smtp.163.com \
    smtp_auth=true \
    smtp_username=123456@163.com \
    smtp_password=123456 \
    mail_from=123456@163.com \
    mail_from_name=PodcastStatisticsRobot \
    mail_receiver=78910112@163.com \
    mail_receiver_name=Kyle \
        >> mail-report.log

