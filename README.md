# IS2
# Форум с комментариями
## Текст задания
Разработать и реализовать клиент-серверную информационную систему, реализующую механизм CRUD.
## Ход работы
- Спроектировать пользовательский интерфейс
- Описать пользовательские сценарии работы
- Описать API сервера и хореографию
- Описать структуру базы данных
- Описать алгоритмы
## 1. [Пользовательский интерфейс](https://www.figma.com/file/oE40lBqMSsZjYhiTW3NWfZ/Untitled?node-id=0%3A1&t=5Kg6lyrI5kxvpTrl-1)
## 2. Пользовательские сценарии работы
Пользователь попадает на главную страницу index.php. Млжно ввести любое текстовое сообщение и добавить картинку (при создании поста нажать на кнопку выбрать файл). В случае корректного ввода данных, его сообщение появится в ленте в обратном хронологическом порядке, сначала новые, затем старые публикации. Пользователи могут ставить лайки на понравившиеся записи или убирать их в противном случае. Есть возможность удалять записи. Для этого пользователь нажимает на кнопку удалить, и соответствующая запись удаляется. Пользователь может увидеть время каждого поста и добавить к ним комментарии. Есть пагинация, на странице выводится не более 4 постов.
## 3. [API сервера и хореография](https://imgur.com/a/OjTmby5)
## 4. Структура базы данных
Таблица *posts*
| Название | Тип | Длина | По умолчанию | Описание |
| :------: | :------: | :------: | :------: | :------: |
| **id** | INT  |  | NO | Автоматический идентификатор поста |
| **text** | TEXT |  | NO | Текст поста |
| **dtime** | TEXT|  | NULL | Дата создания поста |
| **likes** | INT |  | 0 | Количество лайков |
| **image** | VARCHAR | 255 | NO | Путь к файлу |

Таблица *likes*
| Название | Тип | Длина | NULL | Описание |
| :------: | :------: | :------: | :------: | :------: |
| **id** | INT  |  | NO | Автоматический идентификатор лайка |
| **userid** | INT |  | NO | ID пользователя |
| **postid** | INT |  | NO | ID поста |

Таблица *comments*
| Название | Тип | Длина | NULL | Описание |
| :------: | :------: | :------: | :------: | :------: |
| **id** | INT  |  | NO | Автоматический идентификатор лайка |
| **userid** | INT |  | NO | ID пользователя |
| **postid** | INT |  | NO | ID поста |
## 5. Алгоритмы
1. [Добавление записи](https://imgur.com/a/SH2D4QU)
2. [Удаление записи](https://imgur.com/a/w8ARjPW)
3. [Реакция](https://imgur.com/a/Kk5NxFf)
4. [Комментарии](https://imgur.com/a/pj8oiLB)
## 6. Примеры HTTP запросов/ответов
<br>GET /web2.2/index.php HTTP/1.1
<br>Host: localhost
<br>Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
<br>sec-ch-ua: "Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"
<br>sec-ch-ua-mobile: ?0
<br>sec-ch-ua-platform: "Windows"
<br>Upgrade-Insecure-Requests: 1
<br>User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36

<br>HTTP/1.1 200 OK
<br>Connection: Keep-Alive
<br>Content-Type: text/html; charset=UTF-8
<br>Date: Sat, 24 Dec 2022 07:13:25 GMT
<br>Keep-Alive: timeout=5, max=100
<br>Server: Apache/2.4.54 (Win64) PHP/8.1.10
<br>Transfer-Encoding: chunked
<br>X-Powered-By: PHP/8.1.10

<br>POST /web2.2/comments.php HTTP/1.1
<br>Host: localhost
<br>Accept: */*
<br>Content-Type: application/x-www-form-urlencoded; charset=UTF-8
<br>sec-ch-ua: "Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"
<br>sec-ch-ua-mobile: ?0
<br>sec-ch-ua-platform: "Windows"
<br>User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36
<br>X-Requested-With: XMLHttpRequest

<br>HTTP/1.1 200 OK
<br>Connection: Keep-Alive
<br>Content-Length: 1
<br>Content-Type: text/html; charset=UTF-8
<br>Date: Sat, 24 Dec 2022 07:15:05 GMT
<br>Keep-Alive: timeout=5, max=100
<br>Server: Apache/2.4.54 (Win64) PHP/8.1.10
<br>X-Powered-By: PHP/8.1.10

<br>POST /web2.2/add.php HTTP/1.1
<br>Host: localhost
<br>Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
<br>Content-Type: multipart/form-data; boundary=----WebKitFormBoundary0sXWcyVIfQpnRuKk
<br>sec-ch-ua: "Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"
<br>sec-ch-ua-mobile: ?0
<br>sec-ch-ua-platform: "Windows"
<br>Upgrade-Insecure-Requests: 1
<br>User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36

<br>HTTP/1.1 302 Found
<br>Connection: Keep-Alive
<br>Content-Length: 40
<br>Content-Type: text/html; charset=UTF-8
<br>Date: Sat, 24 Dec 2022 07:16:13 GMT
<br>Keep-Alive: timeout=5, max=100
<br>Location: index.php
<br>Server: Apache/2.4.54 (Win64) PHP/8.1.10
<br>X-Powered-By: PHP/8.1.10

## 7. Важные части кода
1.Функция добавления комментария с помощью AJAX
```js
$(document).ready(function() {
        $(".btn-danger").click(function(){
            var postid1 = $(this).data('id');// При нажатии на кнопку
            var author = $("#author" + postid1).val(); // Получаем имя автора комментария
            var message = $("#message"+ postid1).val();// Получаем само сообщение
            $.ajax({ // Аякс
                type: "POST", // Тип отправки "POST"
                url: "./comments.php", // Куда отправляем(в какой файл)
                data: {"author": author, "message": message, "postid1":postid1}, // Что передаем и под каким значением
                cache: false, // Убираем кеширование
                success: function(response){ // Если все прошло успешно
                    var messageResp = ['Ваше сообщение отправлено','Сообщение не отправлено Ошибка базы данных','Нельзя отправлять пустые сообщения'];
                    var resultStat = messageResp[Number(response)];
                    if(response == 0){
                        $("#author").val("");
                        $("#message").val("");
                        $("#commentBlock").append("<div class='comment'>Автор: <strong>"+author+"</strong><br>"+message+"</div>");}
                    $("#resp").text(resultStat).show().delay(1500).fadeOut(800);}});return false;});});
```
2. Добавление данных
```php
<?php

$result = $_POST['list'];


$uploaddir = './img/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);

move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);

if(!move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)){
    echo "Ошибка загрузки файла";
}
if (($result =='') or ($_FILES['file']['name']=='')) {
    header('Location: index.php');
}
require 'db.php';
date_default_timezone_set('Europe/Moscow');
$time = date("Y-d-m H:i:s");

$resultall = mysqli_query($db, "INSERT INTO posts (text,likes,dtime,image) VALUES('$result','0','$time','$uploadfile')");

header('Location: index.php');
```
3. Функция проставления лайков с помощью AJAX
```js
  $(document).ready(function(){
        // when the user clicks on like
        $('.like').on('click', function(){
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'index.php',
                type: 'post',
                data: {
                    'liked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });

        // when the user clicks on unlike
        $('.unlike').on('click', function(){
            var postid = $(this).data('id');
            $post = $(this);

            $.ajax({
                url: 'index.php',
                type: 'post',
                data: {
                    'unliked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes_count').text(response + " likes");
                    $post.addClass('hide');
                    $post.siblings().removeClass('hide');
                }
            });
        });
    });
```
