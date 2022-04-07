# 飲食店予約アプリ「Rese」

<img width="1336" alt="home" src="https://user-images.githubusercontent.com/91045911/162101849-976a286f-7674-43b0-abf0-5aaf221eb850.png">

## 1. アプリ概要

**飲食店の検索・お気に入り・予約等ができる飲食店予約アプリケーション**です。一般ユーザーの他に店舗オーナーや、管理者のアカウントも用意されていて、それぞれの機能が備わっております。

URL ▶︎ https://shuns-app.com/rese/home

-   レスポンシブ対応しているため、PC・タブレット・スマホでもご覧いただけます。
-   ユーザ・店舗オーナー・管理者それぞれ、ゲストログインボタンより試用できます。

## 2. 機能一覧

#### ユーザー

-   会員登録（メール認証有り）
-   店舗の検索（エリア・ジャンル・店舗名でリアルタイム検索）

    <img width="300" src="https://user-images.githubusercontent.com/91045911/162102173-87338899-6638-4e21-b157-d819adf303c4.gif">

-   店舗のお気に入り登録

    <img width="300" src="https://user-images.githubusercontent.com/91045911/162103899-0de23ea7-c380-4905-befb-214a9b502016.gif">

-   店舗の予約（追加・変更・キャンセル）

    <img width="300" src="https://user-images.githubusercontent.com/91045911/162103969-ce014a16-6fd6-481d-824b-12e739fc6341.gif">
    <img width="300" src="https://user-images.githubusercontent.com/91045911/162104039-e64b25da-8165-4b3d-bb53-08a4947e5cac.gif">
    <img width="300" src="https://user-images.githubusercontent.com/91045911/162104098-32f4cecd-fc10-46a5-9dde-af8d878ce7f2.gif">

-   店舗の評価・口コミ投稿

    <img width="300" src="https://user-images.githubusercontent.com/91045911/162104173-3ad5cda8-85b1-4d05-86c9-ad9a530e9580.gif">

-   Stripe を利用した事前決済機能

    <img width="300" src="https://user-images.githubusercontent.com/91045911/162103084-67e6770c-0fac-4649-9b0c-29e41c7ca358.gif">

-   スマホ・タブレット画面での予約情報の QR コード表示

#### 店舗オーナー

-   ユーザーの予約一覧確認
-   店舗情報の確認・変更
-   店舗画像のアップロード

    <img width="300" src="https://user-images.githubusercontent.com/91045911/162104268-85fa7845-a639-4b89-8528-6fc513e550ab.gif">

#### 管理者

-   ユーザーの一覧確認
-   店舗の一覧確認
-   店舗オーナーの一覧確認
-   店舗オーナーの新規登録
-   ユーザーとオーナーに対してのメール送信（※現在 mailtrap を利用テストモード）

    <img width="300" src="https://user-images.githubusercontent.com/91045911/162104355-052615ac-e880-498b-8b27-a6c21298d6de.gif">

#### その他

-   リアルタイムフォームバリデーション
-   予約当日に自動リマインドメール通知（※現状オフの設定）

## 3. 使用技術

#### フロントエンド

-   HTML/CSS
-   JavaScript
-   Vue.js 2.6.14

#### バックエンド

-   PHP 8.0.14
-   Laravel 8.78.0
-   MySQL 5.7.34

#### インフラ

-   Docker / docker-compose 3.8 （開発環境）
-   AWS ( EC2, ALB, ACM, S3, RDS, Route53, VPC, EIP, IAM )
-   nginx 1.18
-   CircleCI 2.1

## 4. インフラ構成図＆自動デプロイの流れ

![infra](https://user-images.githubusercontent.com/91045911/162102013-fd66552a-892b-4b8f-8a88-8812e3c77bf9.png)

## 5. ER 図

![er-figure](https://user-images.githubusercontent.com/91045911/162102111-d3e7490f-9841-4d5b-a8b4-ad1eead48158.png)

## 6. 開発環境構築について

Docker を用いて開発環境を構築する場合は下記リポジトリを参照ください

    https://github.com/shun0315/rese-app-docker

## 7. インストール方法

#### 任意のディレクトリに移動

```
$ cd [任意のディレクトリ]
```

#### Github から Clone

```
$ git clone https://github.com/shun0315/rese-app.git
```

#### 作成したプロジェクトのディレクトリに移動

```
$ cd [プロジェクトディレクトリ]
```

#### Composer インストール

```
$ composer install
```

#### .env の作成

※詳細な設定については、ご自身の環境に合わせて設定してください

```
$ cp .env.example .env
```

#### APP_KEY を発行

```
$ php artisan key:generate
```

#### データベースの準備

```
$ php artisan migrate:fresh --seed
```

#### フロントエンドに必要なパッケージをインストール

```
$ npm install
```

#### コンパイル&ビルド

```
$ npm run dev
```

## 8. 今後の追加実装項目

下記項目については今後実装予定のため、ボタンについては非活性状態にしております。

#### 店舗オーナー画面

-   予約詳細表示

#### 管理者画面

-   ユーザー詳細表示
-   店舗オーナー詳細表示

#### メール送信機能関連

-   ※現状 mailtrap を利用したテストモードになっております。
