<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        input[type=date] {
            width: 160px;
            font-size: 16px;
            background-color: lightgray;
            border: 2px solid #212738;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 2px solid lightslategray;
        }

        #search {
            background-color: #8E9CB2;
            font-size: 16px;
        }
    </style>
</head>
<form method="post">
    From: <input type="date" name="from" placeholder="yyyy-mm-dd"/>
    To: <input type="date" name="to" placeholder="yyyy-mm-dd"/>
    <input type="submit" value="Search" id="search"/>
</form>
<body>
<table border="0">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php
    $customer_list = [
        "1" => ["name" => "Đặng Hoa",
            "birthday" => "1997/02/22",
            "address" => "Hà Nội",
            "image" => "hoa1.jpg"
        ],
        "2" => ["name" => "Hà Hoa",
            "birthday" => "1996/03/29",
            "address" => "Hải Dương",
            "image" => "hahoa.jpg"
        ],
        "3" => ["name" => "Cúc Xì",
            "birthday" => "1996/09/29",
            "address" => "Thái Bình",
            "image" => "cuc.jpg"
        ]
    ];

    if ($_SERVER["REQUEST_METHOD"] = "POST") {
        $from_date = $_POST["from"];
        $to_date = $_POST["to"];
    }

    function searchOfDate($customers, $from_date, $to_date)
    {
        $filtered_customers = [];
        if (empty($from_date) && empty($to_date)) {
            return $filtered_customers = $customers;
        }

        foreach ($customers as $customer) {
            if (!empty($from_date) && (strtotime($customer["birthday"]) < (strtotime($from_date)))) {
                continue;
            }
            if (!empty($to_date) && (strtotime($customer["birthday"]) > (strtotime($to_date)))) {
                continue;
            }

            $filtered_customers[] = $customer;
        }
        return $filtered_customers;
    }

    $filtered_customers = searchOfDate($customer_list, $from_date, $to_date);

    foreach ($filtered_customers as $key => $values) {
        echo "<tr>";
        echo "<td>" . $key . "</td>";
        echo "<td>" . $values['name'] . "</td>";
        echo "<td>" . $values['address'] . "</td>";
        echo "<td>" . $values['birthday'] . "</td>";
        echo "<td><image src ='" . $values["image"] . "' width = '95px' height ='100px'/></td>";
        echo "</tr>";
    }

    ?>
    <?php if (count($filtered_customers) === 0): ?>
        <tr>
            <td colspan="5" class="message">Không tìm thấy khách hàng nào</td>
        </tr>
    <?php endif; ?>

</table>
</body>
</html>