<?php

// 言語設定
mb_language("Japanese");
// 内部エンコーディング
mb_internal_encoding("UTF-8");

Class Mail {

    var $to = '';
    var $cc = '';
    var $title = '';
    var $body = '';
    var $from = '';
    var $fromName = '';
    var $header = '';

    /**
     * 入力チェック
     */
    public function validation() {
        $ret = array('status' => 0, 'messages' => array());

        // トリムする
        $this->title = trim($this->title);
        $this->body = trim($this->body);
        $this->from = trim($this->from);
        $this->fromName = trim($this->fromName);
        $this->header = trim($this->header);

        if (!is_array($this->to)) {
            $this->to = trim($this->to);
        }
        if (!is_array($this->cc)) {
            $this->cc = trim($this->cc);
        }

        // 宛先
        if (empty($this->to)) {
            $ret['status'] = 2;
            array_push($ret['messages'], '宛先が指定されていません。');
            return $ret;
        }

        // タイトル
        if (empty($this->title)) {
            $ret['status'] = 2;
            array_push($ret['messages'], '件名が設定されていません。');
            return $ret;
        }

        // 本文
        if (empty($this->body)) {
            $ret['status'] = 2;
            array_push($ret['messages'], '本文が設定されていません。');
            return $ret;
        }

        // From
        if (empty($this->from)) {
            $ret['status'] = 2;
            array_push($ret['messages'], '送信元が設定されていません。');
            return $ret;
        }
    }

    /**
     * メール送信処理
     */
    public function send() {
        // 先ずはチェック
        $ret = $this->validation();

        // エラーがある場合は終了
        if ($ret['status']) {
            return $ret;
        }

        // 宛先作成
        $to = $this->createMailToString($this->to);

        // FROM作成
        if (empty($this->fromName)) {
            $this->header .= "From: {$this->from}\n";
        } else {
            $from_name = mb_encode_mimeheader(mb_convert_encoding($this->fromName, "JIS", "UTF-8"));
            $this->header .= "From: {$from_name} <{$this->from}>\n";
        }

        // CC作成
        $cc = $this->createMailToString($this->cc);
        if ($cc) {
            $this->header .= "Cc: {$cc}\n";
        }

        // メール送信処理
        if (mb_send_mail($to, $this->title, $this->body, $this->header)) {
            return $ret;
        }

        // メール送信失敗した場合の処理
        else {
            $ret['status'] = 1;
            @array_push($ret['messages'], '送信処理に失敗しました。');
            return false;
        }
    }

    /**
     * 引数が配列だった場合はカンマで接続し返却する。
     * それ以外だった場合は、そのまま返却する。
     * @param $mixed 配列、もしくは文字列
     */
    private function createMailToString($mixed) {
        // 配列の場合はカンマで区切って返却
        if (is_array($mixed)) {
            return implode(', ', $mixed);
        }
        // その他の場合はそのまま返却
        else if ($mixed) {
            return $mixed;
        }
    }

}

/*
使用例

$mail = new Mail();
$mail->to = 'ookawa@snowrobin.jp';
$mail->title = 'タイトル';
$mail->body = 'ほんぶん';
$mail->from = 'ookawa@snowrobin.jp';
$mail->fromName = '大川';

$result = $mail->send();
if ($result['status']) {
    // 送信失敗
}
else {
    // 送信成功！
}
 *  */