<?php
// Конфиденциальные данные
$token = "8481523746:AAHvVhFJ5yTQgAg-mNb0egCbux9oawCC2JA";
$chat_ids = [
    "5378837277",   // chat_id 1
    "5378837277"    // chat_id 2
];

// Получаем и обрабатываем JSON из запроса
$data = json_decode(file_get_contents("php://input"), true);

$name = htmlspecialchars($data["name"]);
$email = htmlspecialchars($data["email"]);
$phone = htmlspecialchars($data["phone"]);
$message = htmlspecialchars($data["message"]);

// Текст сообщения
$text = "<b>📥 Новая заявка с сайта</b>\n";
$text .= "👤 <b>Имя:</b> $name\n";
$text .= "📧 <b>Email:</b> $email\n";
$text .= "📞 <b>Телефон:</b> $phone\n";
$text .= "📝 <b>Сообщение:</b> $message";

// Отправляем всем chat_id
foreach ($chat_ids as $chat_id) {
    $url = "https://api.telegram.org/bot$token/sendMessage?" . http_build_query([
        "chat_id" => $chat_id,
        "text" => $text,
        "parse_mode" => "HTML"
    ]);
    file_get_contents($url);
}

// Ответ клиенту
echo json_encode(["status" => "ok"]);
?>
