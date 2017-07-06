<?php
    // Insert values to variables in order to access MySQL server
    $username = 'root'; //ターミナルからのmysql -u rootとコマンドをPHPから操作するためのコマンド
    $password = '';
    //Create PDO instance and access MySQL
    $database = new PDO('mysql:host=localhost;dbname=booklist;charset=UTF8;', $username, $password);
  if ($_POST['book_title']) {
        // 実行するSQLを作成
        $sql = 'INSERT INTO books (book_title) VALUES(:book_title)';
        // ユーザ入力に依存するSQLを実行するので、セキュリティ対策をする
        $statement = $database->prepare($sql);
        // ユーザ入力データ($_POST['book_title'])をVALUES(?)の?の部分に代入する
        $statement->bindParam(':book_title', $_POST['book_title']);
        // SQL文を実行する
        $statement->execute();
        // ステートメントを破棄する
        $statement = null;
    }


    //Create SQL
    $sql = 'select * from books order by created_at DESC';
    $statement = $database->query($sql);
    $records = $statement->fetchAll();
    //Dispose statement
    $statement = null;
    //Stop access after the command by mySQL
    $database = null;
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Booklist</title>
    </head>
    <body>
<?php
    //Code for checking form data send/receipt (to be deleted)
    print '<div style="background-color: skyblue;">';
    print '<p>動作確認用:</p>';
    print_r($_POST);
    print '</div>';
?>
        <a href="booklist.php"><h1>Booklist</h1></a>
        <h2>書籍の登録フォーム</h2>
        <form action="booklist.php" method="POST">
            <input type="text" name="book_title" placeholder="書籍タイトルを入力" required>
            <input type="submit" name="submit_add_book" value="登録">
        </form>
        <h2>登録された書籍一覧</h2>
        <ul>
            <?php
                if($records){                                // $recordsの存在を確認、なければループに入らない
                    foreach($records as $record) {           // $recordsのレコードを1つずつ取り出して$recordに代入する
                        $book_title = $record['book_title']; // $recordからbook_titleのカラムを取得して$book_titleに代入する
            ?>
            <li><?php print htmlspecialchars($book_title, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php
                    }
                }
?>
        </ul>
    </body>
</html>