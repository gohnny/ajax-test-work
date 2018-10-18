<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 25.09.18
 * Time: 0:11
 */


require_once("connect.php");

if (isset($_POST)) {
    if ($_POST["functionName"] == "GetQuery1") {
        GetQuery::GetQuery1($pdo);
    } elseif ($_POST["functionName"] == "GetQuery2") {
        GetQuery::GetQuery2($pdo);
    }
}

class GetQuery

{
public static function GetQuery1($pdo)
{
//Запрос к базе
$sql = "SELECT requests.id,offers.name as 'Наименование',price as 'Цена' , count as 'К-во',operators.fio as 'ФИО' 
FROM requests
INNER JOIN offers ON offer_id=offers.id
INNER JOIN operators ON operator_id=operators.id
WHERE count >2 and (operator_id=10 or operator_id=12)";

$query = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

try {
echo "<div class='jumbotron'>"; ?>
<table>
    <thead>
        <tr>
            <th><?php echo implode('</th><th>', array_keys(current($query))); ?></th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($query as $row): array_map('htmlentities', $row); ?>

        <tr>
            <td><?php echo implode('</td><td>', $row); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo "</div>";
}
catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}

}
public static function GetQuery2($pdo)
{
//Запрос к базе: Имя товара, количество товара, и сумма (price) по каждому товару (сгруппировать)
$sql = "SELECT offers.name,count,count*price  as 'сумма' from requests
INNER JOIN offers ON offer_id=offers.id
group by offers.name";

$query = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

try {
echo "<div class='jumbotron'>"; ?>
<table>
<thead>
<tr>
<th><?php echo implode('</th><th>', array_keys(current($query))); ?></th>
</tr>
</thead>
<tbody>

    <?php foreach ($query as $row): array_map('htmlentities', $row); ?>

    <tr>
        <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php echo "</div>";
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}

}
}