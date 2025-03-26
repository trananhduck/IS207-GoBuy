<?php
session_start();
require_once '../../admin/inc/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['cart_p_id']) || empty($_SESSION['cart_p_id'])) {
        die("⚠ Không có sản phẩm nào trong giỏ hàng!");
    }

    $payment_id = uniqid("PAY_"); // Tạo mã payment_id duy nhất

    // Duyệt từng sản phẩm trong giỏ hàng và lưu vào table_order
    foreach ($_SESSION['cart_p_id'] as $key => $product_id) {
        $product_name = $_SESSION['cart_p_name'][$key] ?? "";
        $size = $_SESSION['cart_size_name'][$key] ?? "";
        $color = $_SESSION['cart_color_name'][$key] ?? "";
        $quantity = $_SESSION['cart_p_qty'][$key] ?? 1;
        $unit_price = $_SESSION['cart_p_current_price'][$key] ?? 0;

        $stmt = $pdo->prepare("
                INSERT INTO table_order (product_id, product_name, size, color, quantity, unit_price, payment_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
        $stmt->execute([$product_id, $product_name, $size, $color, $quantity, $unit_price, $payment_id]);
    }

    // Nếu thanh toán được gửi đi
    if (isset($_POST['action']) && $_POST['action'] === 'save_payment') {
        $final_total = floatval($_POST['final_total']);
        $lastContent = $_POST['lastContent'] ?? '';
        $order_code = $_POST['order_code'] ?? '';

        $txnid = uniqid("TXN");
        $card_number = 'UNKNOWN';
        $card_name = 'UNKNOWN';

        if (preg_match('/\.(\d+)\.Thanh toan.*?(\w+)\.CT tu (\d+)\s(.+?)\stoi/i', $lastContent, $matches)) {
            $txnid = $matches[1];
            $card_number = $matches[3];
            $card_name = trim($matches[4]);
        }

        $customer_id = $_SESSION['customer']['cust_id'] ?? 0;
        $customer_name = $_SESSION['customer']['cust_name'] ?? 'Khách';
        $customer_email = $_SESSION['customer']['cust_email'] ?? 'unknown@email.com';

        $stmt = $pdo->prepare("INSERT INTO table_payment (
                customer_id, customer_name, customer_email, payment_date, txnid,
                paid_amount, card_number, card_cvv, card_month, card_year,
                bank_transaction_info, payment_method, payment_status, shipping_status, payment_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $customer_id,
            $customer_name,
            $customer_email,
            date('Y-m-d H:i:s'),
            $txnid,
            $final_total,
            $card_number,
            '***',
            date('m'),
            date('Y'),
            $lastContent,
            'Bank Transfer',
            'Completed',
            'Pending',
            $payment_id
        ]);

        echo "success";
        exit;
    }
}
if (!isset($_POST['final_total'])) {
    die("Lỗi: Dữ liệu không hợp lệ!");
}

$final_total = floatval($_POST['final_total']);

function generateOrderCode($length = 6)
{
    return strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length));
}

$order_code = generateOrderCode();
$transfer_content = "Thanh toán đơn hàng " . $order_code;

$bank_id = "MB";
$account_no = "0946403788";
$qr_data = "https://img.vietqr.io/image/$bank_id-{$account_no}-compact.png?amount=$final_total&addInfo=" . urlencode($transfer_content);
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    echo "🔄 Đang vào vòng lặp...<br>";
    foreach ($_SESSION['cart_p_id'] as $key => $product_id) {
        echo "🛒 Sản phẩm {$product_id} đang được xử lý...<br>";
    }
    die("⏹ Kết thúc debug.");
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quét mã QR để thanh toán</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f8f9fa;
            padding: 20px;
        }

        .container {
            background: #fff;
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        img {
            max-width: 300px;
            border: 3px solid #007bff;
            border-radius: 10px;
        }

        .btn {
            display: inline-block;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            text-decoration: none;
            font-weight: bold;
        }

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
</head>

<body>
    <div class="container">
        <h2>Quét mã QR để thanh toán</h2>
        <p><strong>Số tiền:</strong> <?php echo number_format($final_total, 0, ',', '.'); ?> VND</p>
        <p><strong>Nội dung chuyển khoản:</strong><br><?php echo $transfer_content; ?></p>
        <img src="<?php echo $qr_data; ?>" alt="QR Code">
        <p><strong>Thời gian còn lại: <span id="countdown">05:00</span></strong></p>
        <p>Vui lòng quét mã bằng app ngân hàng và không sửa nội dung chuyển khoản.</p>
        <a href="../../index.php" class="btn">Quay lại trang chủ</a>
    </div>

    <div id="toast"></div>

    <script>
        let timeLeft = 300;
        const price = <?php echo $final_total; ?>;
        const transferContent = "<?php echo addslashes($transfer_content); ?>";
        const orderCode = "<?php echo $order_code; ?>";

        function showToast(message, bg = "#333") {
            const toast = document.getElementById("toast");
            toast.innerText = message;
            toast.style.backgroundColor = bg;
            toast.classList.add("show");
            setTimeout(() => toast.classList.remove("show"), 4000);
        }

        function updateCountdown() {
            const min = Math.floor(timeLeft / 60);
            const sec = timeLeft % 60;
            document.getElementById("countdown").innerText = `${min}:${sec < 10 ? '0' : ''}${sec}`;
            if (timeLeft > 0) {
                timeLeft--;
                setTimeout(updateCountdown, 1000);
            } else {
                showToast("⏳ Hết thời gian thanh toán!", "#dc3545");
                setTimeout(() => window.location.href = "../../checkout.php", 4000);
            }
        }

        function removeVietnameseTones(str) {
            return str.normalize("NFD")
                .replace(/[\u0300-\u036f]/g, "")
                .replace(/đ/g, "d").replace(/Đ/g, "D");
        }

        const normalize = text =>
            removeVietnameseTones(text)
            .toLowerCase()
            .replace(/\s+/g, " ")
            .trim();

        async function checkPaymentStatus() {
            try {
                const res = await fetch(
                    "https://script.google.com/macros/s/AKfycbzhTO68TGTqstqE1VnXenBEzFqA7cHs_SLiB2TSLZvNyAUce8UgH9_yIy9HbmiIhiAnTw/exec"
                );
                const json = await res.json();

                if (!json.data || json.data.length === 0) return;

                const last = json.data.at(-1);
                let amount = last["Giá trị"];
                let content = last["Mô tả"];

                if (typeof amount === "string") {
                    amount = parseFloat(amount.replace(/[^0-9.]/g, ""));
                }

                const mainContent = content.match(/thanh toan.*?(?=\s?ct tu|\s?ng chuyen|$)/i)?.[0] || content;
                const normalizedMainContent = normalize(mainContent);
                const normalizedTransferContent = normalize(transferContent);

                console.log("➡ Nội dung đã chuẩn hóa:", normalizedMainContent);
                console.log("➡ Nội dung mong đợi:", normalizedTransferContent);

                if (amount >= price && normalizedMainContent.includes(normalizedTransferContent)) {
                    const res2 = await fetch(window.location.href, {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            action: "save_payment",
                            final_total: price,
                            lastContent: content,
                            order_code: orderCode
                        })
                    });

                    const result = await res2.text();
                    if (result.trim() === "success") {
                        showToast("✅ Thanh toán thành công!", "#28a745");
                        setTimeout(() => {
                            fetch("../../checkout.php?clear_cart=true") // Gửi request xóa giỏ hàng
                                .then(() => window.location.href = "../../index.php"); // Chuyển về trang chủ
                        }, 3000);
                    } else {
                        showToast("❌ Lỗi khi lưu thanh toán", "#dc3545");
                    }
                }
            } catch (e) {
                console.error("Lỗi khi kiểm tra thanh toán:", e);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            updateCountdown();
            setInterval(checkPaymentStatus, 10000);
        });
    </script>
</body>

</html>