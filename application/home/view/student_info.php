<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 align="center">学生信息表</h2>
    <table border="1" cellpadding="5" cellspacing="0" align="center" width="60%">
        <tr align="center" bgcolor="#87ceeb">
            <th>字段</th>
            <th>值</th>
        </tr>
        <tr align="center">
            <td>id</td>
            <td><?php echo $data['id']; ?></td>
        </tr>
        <tr align="center">
            <td>名字</td>
            <td><?php echo $data['name']; ?></td>
        </tr>
        <tr align="center">
            <td>email</td>
            <td><?php echo $data['email']; ?></td>
        </tr>
        <tr align="center">
            <td>course</td>
            <td><?php echo $data['course']; ?></td>
        </tr>
        <tr align="center">
            <td>grade</td>
            <td
                <?php
                    if ($data['grade'] < 60) {
                        echo 'style="color:red"';
                    }
                ?>
            ><?php echo $data['grade']; ?></td>
        </tr>
    </table>
    <p align="center"
        <?php
            if ($data['grade'] < 60) {
                echo 'style="color:red"';
            }
        ?>
    >
        <?php
        if ($data['grade'] < 60) {
            echo '不及格，需要补考~~';
        } else {
            echo '恭喜，毕业了。';
        }
        ?>
    </p>
</body>
</html>