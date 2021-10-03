<?php
require('stripe/init.php');

$publishableKey="pk_test_51JWFHASCAKEV732YxR0Zhagt9mVlFMgvpqf9zlDwAi94U6VvfATE0zkTp4NSj9kxklSmYuyyDLY0ovzqrDL0hbns00OG1mXtJo";

$secretKey="sk_test_51JWFHASCAKEV732YQTGRarmkwrNYBETyqhVOCYwgNJyO7TfONhs47e3qu60cmgAHJt5jBRLA7zxTUU8JTZJIXBM600bNrDe5k9";

\Stripe\Stripe::setApiKey($secretKey);
?>