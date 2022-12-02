# BcGoogleLogin（Googleログインプラグイン）

管理画面へのログインをGoogleアカウントで認証してログインすることができるプラグインです。

※ Google API Client Library for PHP を利用しています。

## Installation

1. 圧縮ファイルを解凍後、BASERCMS/app/Plugin/BcGoogleLogin に配置します。
2. 管理システムのプラグイン管理に入って、表示されている BcGoogleLogin プラグイン を有効化して下さい。
3. 設定画面( /admin/bc_google_login/bc_google_logins/config ) にて APIキーなどを設定してください。
4. 管理画面のログイン画面にGoogleでログインボタンが追加されます
5. baserCMS管理画面よりログインしたいユーザーを作成します。その時、メールアドレスをGoogleアカウントと同じメールアドレスで登録しておいてください。

## Caution

* ローカル環境でテストするときはngrokなどを使うと便利です♪
* 現状は認証後、メールアドレス一致にしているのでユーザー識別子とか使うなどもう少し工夫が必要かも？

## TODO

* ログインボタンのデザインをそれっぽくなんとかしたい

## Thanks

- [http://basercms.net/](http://basercms.net/)
- [http://wiki.basercms.net/](http://wiki.basercms.net/)
- [http://cakephp.jp](http://cakephp.jp)
- [Semantic Versioning 2.0.0](http://semver.org/lang/ja/)
