#SBERHEALTHTZ
<br/>
Тестовое задание на должность PHP Developer в компанию СберЗдоровье

#Разворачиваемся
<br/>
composer install
<br/>
php artisan migrate
<br/>

#Запускаем работу очередей
<br/>
php artisan queue:work

#Описание
<br/>
Отправка писем реализована через систему очередей для экономии времени ответа от сервера.
Получения курса валют вынесено в отдельный компонент это упрощает отладку ошибок в приложении и дает возможность легко заменить один компонент на другой.
в ENV было добавлен параметр MAIL_TEST_ADDRESS именно на адрес, указанный в нем будут приходить письма после сохранения текста статьи.
<br/>

#Ответ от сервера
<br/>
в тз не было стандарта ответа от сервера по этой причине я не добавлял ничего сверх того что было указано в ТЗ но обычно использую следующий формат ответа
<br/>
{
    "status": 200,
    <br/>
    "message": "Сообщение",
    <br/>
    "data": {...}
    <br/>
}
