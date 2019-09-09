<?php
require 'vendor/autoload.php';

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/PiDialog-6ea82d20be81.json');

function detect_intent_texts($projectId, $texts, $sessionId = null, $languageCode = 'en-US')
{
    // new session
    $sessionsClient = new \Google\Cloud\Dialogflow\V2\SessionsClient();
    $session = $sessionsClient->sessionName($projectId, $sessionId ?: uniqid());
    printf('Session path: %s' . PHP_EOL, $session);

    // query for each string in array
    foreach ($texts as $text) {
        // create text input
        $textInput = new \Google\Cloud\Dialogflow\V2\TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);

        // create query input
        $queryInput = new \Google\Cloud\Dialogflow\V2\QueryInput();
        $queryInput->setText($textInput);

        // get response and relevant info
        $response = $sessionsClient->detectIntent($session, $queryInput);

        $queryResult = $response->getQueryResult();
        $queryText = $queryResult->getQueryText();
        $intent = $queryResult->getIntent();
        $displayName = $intent->getDisplayName();
        $confidence = $queryResult->getIntentDetectionConfidence();
        $fulfilmentText = $queryResult->getFulfillmentText();

        // output relevant info
        print(str_repeat("=", 20) . PHP_EOL);
        printf('Query text: %s' . PHP_EOL, $queryText);
        printf('Detected intent: %s (confidence: %f)' . PHP_EOL, $displayName,
            $confidence);
        print(PHP_EOL);
        printf('Fulfilment text: %s' . PHP_EOL, $fulfilmentText);
    }

    $sessionsClient->close();
}

$texts = [
    '你叫什么'
];
detect_intent_texts('pidialog', $texts, null, 'zh-CN');
