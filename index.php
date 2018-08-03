<?php

// Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
// LINE Messaging APIがリクエストに付与した署名を取得
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

// 署名が正当かチェック。正当であればリクエストをパースし配列へ
// 不正であれば例外の内容を出力
try {
  $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
} catch(\LINE\LINEBot\Exception\InvalidSignatureException $e) {
  error_log('parseEventRequest failed. InvalidSignatureException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownEventTypeException $e) {
  error_log('parseEventRequest failed. UnknownEventTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownMessageTypeException $e) {
  error_log('parseEventRequest failed. UnknownMessageTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\InvalidEventRequestException $e) {
  error_log('parseEventRequest failed. InvalidEventRequestException => '.var_export($e, true));
}

// 配列に格納された各イベントをループで処理
foreach ($events as $event) {
  //ユーザIDを表示
  error_log($event->getUserID());

  // MessageEventクラスのインスタンスでなければ処理をスキップ
  if (!($event instanceof \LINE\LINEBot\Event\MessageEvent)) {
    error_log('Non message event has come');
    continue;
  }

  // オウム返し
  //$bot->replyText($event->getReplyToken(), $event->getText());

  if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
    //入力されたテキストを取得
    $SectionName = $event->getText();
  }

  if ($SectionName == '住民票'){
    //リッチメニューから「住民票」
    $messageStr = '住民票の各種請求方法をご案内します。';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇窓口請求：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/g01-001.html';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇郵便請求：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/yubinseikyu.html';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇土日祝日（自動交付機）：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/j01-001.html';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇土日祝日（コンビニ交付）：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/konbinikouhu.html';
    $bot->replyText($event->getReplyToken(), $messageStr);

  } elseif($SectionName == '戸籍証明書') {
    //リッチメニューから「戸籍証明書」
    $messageStr = '戸籍関係証明書の各種請求方法をご案内します。';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇窓口請求：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/g01-001.html';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇郵便請求：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/yubinseikyu.html';
    $bot->replyText($event->getReplyToken(), $messageStr);

  } elseif($SectionName == '印鑑証明') {
    //リッチメニューから「印鑑証明」
    $messageStr = '印鑑証明書の各種請求方法をご案内します。';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇窓口請求：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/h01-005.html';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇土日祝日（自動交付機）：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/j01-001.html';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇土日祝日（コンビニ交付）：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/konbinikouhu.html';
    $bot->replyText($event->getReplyToken(), $messageStr);

  } elseif($SectionName == '税関係証明書') {
    //リッチメニューから「税関係証明書」
    $messageStr = '税証明書の各種請求方法をご案内します。';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇窓口請求：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/zeishoumei.html';
    $messageStr = $messageStr . "\r\n";
    $messageStr = $messageStr . "\r\n" . '〇土日祝日（コンビニ交付）：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/g03-002/konbinikouhu.html';
    $bot->replyText($event->getReplyToken(), $messageStr);

  } elseif($SectionName == '休日当番医') {
    //リッチメニューから「休日当番医」
    $messageStr = '休日当番医：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/99/index.html';
    $bot->replyText($event->getReplyToken(), $messageStr);

  } elseif($SectionName == '子育て') {
    //リッチメニューから「子育て」
    $messageStr = '子育て：';
    $messageStr = $messageStr . "\r\n" . 'https://www.city.yaizu.lg.jp/kosodate/index.html';
    $bot->replyText($event->getReplyToken(), $messageStr);

  } elseif($SectionName == 'ごみの日') {
    //リッチメニューから「ごみの日」
    $messageStr = 'ごみの日：';
    $messageStr = $messageStr . "\r\n" . 'http://www.city.yaizu.lg.jp/5374/jp/';
    $bot->replyText($event->getReplyToken(), $messageStr);

  } else {
    //リッチメニューから「手続き・申請」
    /*
    //$suggestArray = array('住民票','戸籍証明書','印鑑証明','税関係証明書','その他手続き・申請');
    $suggestArray = array('住民票','戸籍証明書','印鑑証明','税関係証明書');
    $actionArray = array();
    //候補を全てアクションにして追加
    foreach($suggestArray as $secname) {
      array_push($actionArray, new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder ($secname, $secname));
    }
    // Buttonsテンプレートを返信
    $builder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder(
      '証明書選択',
      new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder ('手続き・申請', '証明書を選択してください。', null, $actionArray));
      $bot->replyMessage($event->getReplyToken(), $builder);
    */

    // Carouselテンプレートメッセージを返信
    // ダイアログの配列
    $columnArray = array();
    // CarouselColumnTemplateBuilderの引数はタイトル、本文、
    // 画像URL、アクションの配列
    $column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder (
      '手続き・申請', '証明書を選択してください。', null,
      '住民票','戸籍証明書','印鑑証明'
    );
    // 配列に追加
    array_push($columnArray, $column);

    // 画像URL、アクションの配列
    $column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder (
      '手続き・申請', '証明書を選択してください。', null,
      '税関係証明書','その他手続き・申請','その他'
    );
    // 配列に追加
    array_push($columnArray, $column);

    replyCarouselTemplate($bot, $event->getReplyToken(),'手続き・申請', $columnArray);

  }
}

// テキストを返信。引数はLINEBot、返信先、テキスト
function replyTextMessage($bot, $replyToken, $text) {
  // 返信を行いレスポンスを取得
  // TextMessageBuilderの引数はテキスト
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text));
  // レスポンスが異常な場合
  if (!$response->isSucceeded()) {
    // エラー内容を出力
    error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// 画像を返信。引数はLINEBot、返信先、画像URL、サムネイルURL
function replyImageMessage($bot, $replyToken, $originalImageUrl, $previewImageUrl) {
  // ImageMessageBuilderの引数は画像URL、サムネイルURL
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($originalImageUrl, $previewImageUrl));
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// 位置情報を返信。引数はLINEBot、返信先、タイトル、住所、
// 緯度、経度
function replyLocationMessage($bot, $replyToken, $title, $address, $lat, $lon) {
  // LocationMessageBuilderの引数はダイアログのタイトル、住所、緯度、経度
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\LocationMessageBuilder($title, $address, $lat, $lon));
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// スタンプを返信。引数はLINEBot、返信先、
// スタンプのパッケージID、スタンプID
function replyStickerMessage($bot, $replyToken, $packageId, $stickerId) {
  // StickerMessageBuilderの引数はスタンプのパッケージID、スタンプID
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder($packageId, $stickerId));
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// 動画を返信。引数はLINEBot、返信先、動画URL、サムネイルURL
function replyVideoMessage($bot, $replyToken, $originalContentUrl, $previewImageUrl) {
  // VideoMessageBuilderの引数は動画URL、サムネイルURL
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\VideoMessageBuilder($originalContentUrl, $previewImageUrl));
  if (!$response->isSucceeded()) {
    error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// オーディオファイルを返信。引数はLINEBot、返信先、
// ファイルのURL、ファイルの再生時間
function replyAudioMessage($bot, $replyToken, $originalContentUrl, $audioLength) {
  // AudioMessageBuilderの引数はファイルのURL、ファイルの再生時間
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\AudioMessageBuilder($originalContentUrl, $audioLength));
  if (!$response->isSucceeded()) {
    error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// 複数のメッセージをまとめて返信。引数はLINEBot、
// 返信先、メッセージ(可変長引数)
function replyMultiMessage($bot, $replyToken, ...$msgs) {
  // MultiMessageBuilderをインスタンス化
  $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
  // ビルダーにメッセージを全て追加
  foreach($msgs as $value) {
    $builder->add($value);
  }
  $response = $bot->replyMessage($replyToken, $builder);
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// Buttonsテンプレートを返信。引数はLINEBot、返信先、代替テキスト、
// 画像URL、タイトル、本文、アクション(可変長引数)
function replyButtonsTemplate($bot, $replyToken, $alternativeText, $imageUrl, $title, $text, ...$actions) {
  // アクションを格納する配列
  $actionArray = array();
  // アクションを全て追加
  foreach($actions as $value) {
    array_push($actionArray, $value);
  }
  // TemplateMessageBuilderの引数は代替テキスト、ButtonTemplateBuilder
  $builder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder(
    $alternativeText,
    // ButtonTemplateBuilderの引数はタイトル、本文、
    // 画像URL、アクションの配列
    new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder ($title, $text, $imageUrl, $actionArray)
  );
  $response = $bot->replyMessage($replyToken, $builder);
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// Confirmテンプレートを返信。引数はLINEBot、返信先、代替テキスト、
// 本文、アクション(可変長引数)
function replyConfirmTemplate($bot, $replyToken, $alternativeText, $text, ...$actions) {
  $actionArray = array();
  foreach($actions as $value) {
    array_push($actionArray, $value);
  }
  $builder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder(
    $alternativeText,
    // Confirmテンプレートの引数はテキスト、アクションの配列
    new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder ($text, $actionArray)
  );
  $response = $bot->replyMessage($replyToken, $builder);
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// Carouselテンプレートを返信。引数はLINEBot、返信先、代替テキスト、
// ダイアログの配列
function replyCarouselTemplate($bot, $replyToken, $alternativeText, $columnArray) {
  $builder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder(
  $alternativeText,
  // Carouselテンプレートの引数はダイアログの配列
  new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder (
   $columnArray)
  );
  $response = $bot->replyMessage($replyToken, $builder);
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

?>
