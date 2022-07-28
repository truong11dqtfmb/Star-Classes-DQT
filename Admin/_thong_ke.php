<h1 class="text-center"><strong>THỐNG KÊ THEO BẢNG</strong></h1>
<table class="table table-hover " style="width: 900px; margin: auto;" border="3px">
    <tr>
        <th>STT</th>
        <th>Danh Mục</th>
        <th>Số Lượng</th>
        <th>Giá Thấp Nhất</th>
        <th>Giá Cao Nhất</th>
        <th>Giá Trung Bình</th>
    </tr>
    <?php
    $sql = "SELECT cartegory.name as Danh_Muc,COUNT(product.product_id) AS So_Luong,
    MIN(product.price) as Gia_Thap_Nhat,MAX(product.price) as Gia_Cao_Nhat,
    ROUND( AVG(product.price),0) as Gia_Trung_Binh FROM cartegory 
    join product on cartegory.cartegory_id=product.cartegory_id GROUP BY cartegory.cartegory_id ORDER BY cartegory.cartegory_id";
    $result = $con->query($sql);
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $i++;
    ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $row['Danh_Muc'] ?></td>
            <td><?= $row['So_Luong'] ?></td>
            <td><?= $row['Gia_Thap_Nhat'] ?></td>
            <td><?= $row['Gia_Cao_Nhat'] ?></td>
            <td><?= $row['Gia_Trung_Binh'] ?></td>
        </tr>

    <?php
    }
    ?>
</table>
<hr>

<h1 class="text-center mt-5"><strong>THỐNG KÊ THEO BIỂU ĐỒ</strong></h1>

<div id="piechart" class="text-center"></div>

<?php
$sql_thong_ke = "SELECT cartegory.name as Danh_Muc,COUNT(product.product_id) AS So_Luong FROM cartegory 
        join product on cartegory.cartegory_id=product.cartegory_id GROUP BY cartegory.cartegory_id ORDER BY cartegory.cartegory_id";
$result = $con->query($sql_thong_ke);

$data = [];
while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
}
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Danh_Muc', 'So_Luong'],
            <?php
            foreach ($data as $key) {
                echo "['" . $key['Danh_Muc'] . "'," . $key['So_Luong'] . "],";
            }
            ?>
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {
            // 'title': 'THỐNG KÊ THEO BIỂU ĐỒ',
            'width': 1500,
            'height': 400
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>