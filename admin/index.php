<?php require_once('header.php'); ?>
<?php
// Tạo mảng dữ liệu biểu đồ

// 1. Doanh thu 7 ngày gần nhất
$revenue_data = [];
$date_labels = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $stmt = $pdo->prepare("SELECT SUM(paid_amount) AS total FROM table_payment WHERE payment_date LIKE ?");
    $stmt->execute(["$date%"]);
    $row = $stmt->fetch();
    $revenue_data[] = $row['total'] ?? 0;
    $date_labels[] = $date;
}

// 2. Trạng thái đơn hàng
$stmt = $pdo->query("SELECT shipping_status, COUNT(*) AS total FROM table_payment GROUP BY shipping_status");
$order_statuses = [];
$order_counts = [];
while ($row = $stmt->fetch()) {
    $order_statuses[] = $row['shipping_status'];
    $order_counts[] = $row['total'];
}

$age_groups = [
    'Dưới 18' => 0,
    '18-25' => 0,
    '26-35' => 0,
    '36-50' => 0,
    'Trên 50' => 0
];

$sql = "
    SELECT 
        YEAR(CURDATE()) - c.cust_birthyear AS age
    FROM table_customer c
    JOIN table_payment p ON c.cust_id = p.customer_id
    WHERE c.cust_birthyear IS NOT NULL
";
$stmt = $pdo->query($sql);
while ($row = $stmt->fetch()) {
    $age = (int)$row['age'];

    if ($age < 18) {
        $age_groups['Dưới 18']++;
    } elseif ($age <= 25) {
        $age_groups['18-25']++;
    } elseif ($age <= 35) {
        $age_groups['26-35']++;
    } elseif ($age <= 50) {
        $age_groups['36-50']++;
    } else {
        $age_groups['Trên 50']++;
    }
}

$age_labels = array_keys($age_groups);
$age_counts = array_values($age_groups);

$top_categories = [];
$category_orders = [];

$sql = "
    SELECT 
        t.tcat_name, 
        COALESCE(SUM(o.quantity), 0) AS total_order
    FROM table_top_category t
    LEFT JOIN table_mid_category m ON t.tcat_id = m.tcat_id
    LEFT JOIN table_end_category e ON m.mcat_id = e.mcat_id
    LEFT JOIN table_product p ON e.ecat_id = p.ecat_id
    LEFT JOIN table_order o ON p.p_id = o.product_id
    GROUP BY t.tcat_id, t.tcat_name
    ORDER BY total_order DESC
";
$stmt = $pdo->query($sql);
while ($row = $stmt->fetch()) {
    $top_categories[] = $row['tcat_name'];
    $category_orders[] = (int)$row['total_order'];
}
?>
<section class="content-header">
    <h1>Thông tin</h1>
</section>

<?php
$query = $pdo->prepare("SELECT * FROM table_top_category");
$query->execute();
$total_top_category = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_mid_category");
$query->execute();
$total_mid_category = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_end_category");
$query->execute();
$total_end_category = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_product");
$query->execute();
$total_product = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_status='1'");
$query->execute();
$total_customers = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_shipping_cost");
$query->execute();
$available_shipping = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=?");
$query->execute(array('Completed'));
$total_order_completed = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_payment WHERE shipping_status=?");
$query->execute(array('Completed'));
$total_shipping_completed = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=?");
$query->execute(array('Pending'));
$total_order_pending = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=? AND shipping_status=?");
$query->execute(array('Completed', 'Pending'));
$total_order_complete_shipping_pending = $query->rowCount();
$query = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=? AND shipping_status=?");
$query->execute(array('Completed', 'Completed'));
$total_order_complete_complete = $query->rowCount();
?>

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?php echo $total_product; ?></h3>

                    <p>Các sản phẩm</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-android-cart"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3><?php echo $total_order_pending; ?></h3>

                    <p>Đơn hàng chờ xử lý</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-clipboard"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $total_order_complete_complete; ?></h3>

                    <p>Đơn hàng đã hoàn thành</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-android-checkbox-outline"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $total_shipping_completed; ?></h3>

                    <p>Hàng đã giao</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-checkmark-circled"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?php echo $total_order_complete_shipping_pending; ?></h3>

                    <p>Đơn hàng đang giao</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-load-a"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo $total_customers; ?></h3>

                    <p>Khách hàng đang hoạt động</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-person-stalker"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3><?php echo $total_order_completed; ?></h3>

                    <p>Đơn hàng đã thanh toán</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-location"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-olive">
                <div class="inner">
                    <h3><?php echo $total_top_category; ?></h3>

                    <p>Danh mục lớn</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-arrow-up-b"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3><?php echo $total_mid_category; ?></h3>

                    <p>Danh mục trung bình</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-android-menu"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3><?php echo $total_end_category; ?></h3>

                    <p>Danh mục nhỏ</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-arrow-down-b"></i>
                </div>

            </div>
        </div>

    </div>
    <div class="chart-row">
        <div class="chart-box">
            <h4>Biểu đồ doanh thu 7 ngày</h4>
            <canvas id="revenueChart"></canvas>
        </div>
        <div class="chart-box">
            <h4>Tình trạng giao hàng</h4>
            <canvas id="orderChart"></canvas>
        </div>
    </div>
    <div class="chart-row">
        <div class="chart-box">
            <h4>Phân bố độ tuổi khách hàng</h4>
            <canvas id="ageChart"></canvas>
        </div>
        <div class="chart-box">
            <h4>Danh mục lớn bán chạy</h4>
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</section>
<!-- Toast Container -->
<div id="toast"></div>
<style>
    #toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #333;
        color: #fff;
        padding: 15px 25px;
        border-radius: 8px;
        opacity: 0;
        transition: opacity 0.5s ease, transform 0.5s ease;
        z-index: 9999;
        transform: translateY(-20px);
    }

    #toast.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    function showToast(message, bg = "#27ae60") {
        const toast = document.getElementById("toast");
        toast.innerText = message;
        toast.style.backgroundColor = bg;
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 4000);
    }
    document.addEventListener('DOMContentLoaded', function() {
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const orderCtx = document.getElementById('orderChart').getContext('2d');

        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($date_labels) ?>,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: <?= json_encode($revenue_data) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                }]
            }
        });

        new Chart(orderCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($order_statuses) ?>,
                datasets: [{
                    label: 'Số đơn hàng',
                    data: <?= json_encode($order_counts) ?>,
                    backgroundColor: ['#00a65a', '#f39c12', '#00c0ef']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right', // 👈 CHÚ THÍCH BÊN PHẢI
                        labels: {
                            boxWidth: 20,
                            padding: 15
                        }
                    }
                }
            }
        });
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');

        new Chart(ageCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($age_labels) ?>,
                datasets: [{
                    label: 'Tỷ lệ khách hàng theo độ tuổi',
                    data: <?= json_encode($age_counts) ?>,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 20,
                            padding: 15
                        }
                    }
                }
            }
        });

        new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($top_categories) ?>,
                datasets: [{
                    label: 'Tổng số đơn hàng theo danh mục',
                    data: <?= json_encode($category_orders) ?>,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 20,
                            padding: 15
                        }
                    }
                }
            }
        });
    });
</script>

<?php
if (isset($_SESSION['success_message'])) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showToast(" . json_encode($_SESSION['success_message']) . ", '#27ae60');
        });</script>";
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
            showToast(" . json_encode($_SESSION['error_message']) . ", '#e74c3c');
            });</script>";
    unset($_SESSION['error_message']);
}
?>