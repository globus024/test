1. Написать скрипт преобразования десятичного числа в двоичное и наоборот, без использования штатных функций. Десятичное число может быть с плавающей точкой.

2. Спроектировать структуру БД для скрипта комментариев. 
Должны храниться:
   1. Владельцы топика (что именно комментируется);
   2. Авторы;
   3. Сообщения;
   4. Оценки.

3. Используя фреймворк Yii2
   1. создать миграции и модели:
   -автор (имя, логин, почта, пароль);
   -статья (дата публикации, заголовок, текст статьи);
   -комментарий (текст комментария, дата).
   2. создать запросы ActiveQuery:
   -Выбирающий список владельцев топиков для заданных авторов, участвовавших в обсуждениях;
   -ТОП 10 лучших комментариев для заданного владельца;
   -Выбирающий N последних лучших комментариев для заданного автора и заданного владельца.

Результат выложить на github.
