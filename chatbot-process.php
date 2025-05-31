<?php
// Thêm ngay đây
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_log("Starting chatbot script");

// Database connection
require_once __DIR__ . '/admin/inc/config.php'; // Adjust this to your database connection file

// Start session if not already started (mới thêm)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Process the message
if (isset($_POST['message'])) {
    $userMessage = trim($_POST['message']);
    $response = processChatbotMessage($userMessage);
    
    // Log the conversation
    logMessageToDB($userMessage, $response);
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => $response
    ]);
    exit;
}

/**
 * Ghi lại tin nhắn của người dùng và phản hồi của bot vào cơ sở dữ liệu.
 * @param string $userMessage Tin nhắn của người dùng.
 * @param string $botReply Phản hồi của bot.
 */
function logMessageToDB($userMessage, $botReply) {
    global $pdo;
    try {
        // Sử dụng bảng mới 'table_chatbot_messages' như đã thêm
        $stmt = $pdo->prepare("INSERT INTO table_chatbot_messages (user_message, bot_reply, created_at, cust_id) VALUES (:msg, :reply, NOW(), :cust_id)");
        
        // Hoặc nếu bạn muốn sử dụng bảng 'table_customer_message' đã có và thêm cột:
        // $stmt = $pdo->prepare("INSERT INTO table_customer_message (subject, message, user_message, bot_reply, created_at, cust_id) VALUES ('Chatbot', '', :msg, :reply, NOW(), :cust_id)");
        
        $custId = null;
        if (isset($_SESSION['customer']) && !empty($_SESSION['customer'])) {
            $custId = $_SESSION['customer']['cust_id'];
        }
        
        $stmt->execute([
            ':msg' => $userMessage,
            ':reply' => $botReply,
            ':cust_id' => $custId
        ]);
    } catch (PDOException $e) {
        error_log("Log message failed: " . $e->getMessage());
    }
}

/**
 * Xử lý tin nhắn của người dùng và tạo phản hồi của chatbot.
 * @param string $message Tin nhắn từ người dùng.
 * @return string Phản hồi của chatbot.
 */
function processChatbotMessage($message) {
    global $pdo;

    error_log("Received message: " . $message);

    if (!$pdo) {
        error_log("Database connection failed in chatbot");
        return "Xin lỗi, hiện tại hệ thống đang gặp sự cố. Vui lòng thử lại sau.";
    }

    $lowerMessage = mb_strtolower($message, 'UTF-8');

    // --- LOGIC MỚI/CẢI THIỆN: XỬ LÝ Ý ĐỊNH MUA QUẦN ÁO (TÁCH QUẦN VÀ ÁO, CHỈ TÌM TRONG P_NAME) ---
    if ((strpos($lowerMessage, 'mua quần áo') !== false) ||
        (preg_match('/muốn\s+mua\s+quần\s+áo/iu', $lowerMessage))) {

        // Tìm sản phẩm quần và áo có rating cao, CHỈ TÌM TRONG P_NAME (tham số `true` ở cuối)
        // Lấy tối đa 3 sản phẩm cho mỗi loại
        $pantsProducts = searchCategoryProducts('quần', 3, true); 
        $shirtProducts = searchCategoryProducts('áo', 3, true);   

        $responseParts = [];
        $foundAnyProduct = false; // Cờ để đảm bảo lời giới thiệu chung chỉ xuất hiện một lần

        // Hiển thị phần "Quần"
        if (count($pantsProducts) > 0) {
            if (!$foundAnyProduct) { // Chỉ thêm lời giới thiệu chung nếu đây là lần đầu tìm thấy sản phẩm
                $responseParts[] = "Dưới đây là những sản phẩm quần áo được đánh giá cao trong cửa hàng của chúng tôi:\n\n";
            }
            $responseParts[] = "## Quần:\n"; // Tiêu đề riêng biệt
            foreach ($pantsProducts as $product) {
                $formattedPrice = number_format($product['p_current_price'], 0, ',', '.');
                $ratingInfo = isset($product['avg_rating']) ?
                    number_format($product['avg_rating'], 1) . "⭐ (" . $product['rating_count'] . " đánh giá)" : "";

                $responseParts[] = "- <a href='product.php?id={$product['p_id']}'>{$product['p_name']}</a> - {$formattedPrice} VND";
                if (!empty($ratingInfo)) {
                    $responseParts[] = " - {$ratingInfo}";
                }
                $responseParts[] = "\n"; // Xuống dòng cho mỗi sản phẩm
            }
            $foundAnyProduct = true;
        }

        // Hiển thị phần "Áo"
        if (count($shirtProducts) > 0) {
            if (!$foundAnyProduct) { // Nếu chưa tìm thấy sản phẩm nào trước đó (trường hợp chỉ có áo)
                $responseParts[] = "Dưới đây là những sản phẩm quần áo được đánh giá cao trong cửa hàng của chúng tôi:\n\n";
            } else if (count($pantsProducts) > 0) { // Nếu đã có phần quần, thêm dòng trống ngăn cách
                $responseParts[] = "\n";
            }
            $responseParts[] = "## Áo:\n"; // Tiêu đề riêng biệt
            foreach ($shirtProducts as $product) {
                $formattedPrice = number_format($product['p_current_price'], 0, ',', '.');
                $ratingInfo = isset($product['avg_rating']) ?
                    number_format($product['avg_rating'], 1) . "⭐ (" . $product['rating_count'] . " đánh giá)" : "";

                $responseParts[] = "- <a href='product.php?id={$product['p_id']}'>{$product['p_name']}</a> - {$formattedPrice} VND";
                if (!empty($ratingInfo)) {
                    $responseParts[] = " - {$ratingInfo}";
                }
                $responseParts[] = "\n"; // Xuống dòng cho mỗi sản phẩm
            }
            $foundAnyProduct = true;
        }

        // Nếu tìm thấy bất kỳ sản phẩm nào (quần hoặc áo)
        if ($foundAnyProduct) {
            $responseParts[] = "\nBạn có thể nhấn vào tên sản phẩm để xem chi tiết. Bạn quan tâm đến sản phẩm nào?";
            return implode("", $responseParts); // Nối các phần lại thành chuỗi hoàn chỉnh
        } else {
            // Nếu không tìm thấy sản phẩm quần hoặc áo nào
            return "Xin lỗi, tôi không tìm thấy sản phẩm quần hoặc áo nào phù hợp với yêu cầu của bạn hiện tại.";
        }
    }
        
    // --- LOGIC HIỆN TẠI: XỬ LÝ Ý ĐỊNH MUA HÀNG CHUNG (BAO GỒM "MÁY TÍNH") ---
    // Regex tìm kiếm các cụm từ như "mua [sản phẩm]", "muốn mua [sản phẩm]"
    $buyRegex = '/(?:muốn\s+)?mua\s+(.*?)(?:\s+(?:được\s+không|không|nhé|ạ|à))?$/iu';

    if (preg_match($buyRegex, $lowerMessage, $match)) {
        $searchString = trim($match[1]);
    
        // Loại bỏ các từ phổ biến ở cuối không phải là tên sản phẩm
        $searchString = preg_replace('/(được không|không|nhé|ạ|à)$/i', '', $searchString);
        $searchString = trim($searchString);
    
        if ($searchString && $searchString != "đồ") { // Nếu người dùng chỉ rõ sản phẩm (không phải chỉ "đồ")
            // Tách chuỗi tìm kiếm thành các sản phẩm riêng lẻ (nếu có)
            $productNames = explode(' ', $searchString);
            $filteredProducts = [];
        
            // Lọc bỏ các từ nối và từ điển thông dụng
            $stopWords = ['và', 'với', 'cùng', 'hoặc', 'hay', 'những', 'các', 'một', 'hai', 'ba', 'bốn', 'năm', 'cái', 'chiếc'];
            foreach ($productNames as $word) {
                if (!in_array(mb_strtolower($word, 'UTF-8'), $stopWords) && mb_strlen($word, 'UTF-8') > 1) {
                    $filteredProducts[] = $word;
                }
            }
        
            // Nếu không có sản phẩm nào sau khi lọc, sử dụng chuỗi ban đầu
            if (empty($filteredProducts)) {
                $filteredProducts = [$searchString]; 
            }
        
            $allResults = [];
            $response = "";
        
            // Tìm kiếm từng sản phẩm (ví dụ: nếu người dùng nói "mua áo và quần")
            foreach ($filteredProducts as $productName) {
                // Ưu tiên tìm sản phẩm chính xác theo tên trước
                $exactProduct = searchExactProduct($productName);
            
                if ($exactProduct) {
                    $formattedPrice = number_format($exactProduct['p_current_price'], 0, ',', '.');
                    $productResult = [
                        'type' => 'exact',
                        'data' => $exactProduct,
                       'formatted_price' => $formattedPrice
                    ];
                    $allResults[$productName] = $productResult;
                } else {
                    // Nếu không tìm thấy chính xác, tìm các sản phẩm tương tự bằng từ khóa
                    $keywords = extractKeywords($productName);
                    // searchProducts đã được thiết kế để ưu tiên các kết quả có tên sản phẩm trong p_name
                    $products = searchProducts($keywords); 
                
                    if (count($products) > 0) {
                        $productResult = [
                            'type' => 'similar',
                            'data' => $products
                        ];
                        $allResults[$productName] = $productResult;
                    } else {
                        $allResults[$productName] = [
                            'type' => 'not_found'
                        ];
                    }
                }
            }
        
            // Xây dựng phản hồi dựa trên kết quả tìm kiếm
            if (count($allResults) > 0) {
                $response = "Tôi đã tìm thấy thông tin về các sản phẩm bạn quan tâm:\n\n";
            
                foreach ($allResults as $productName => $result) {
                    $response .= "## " . ucfirst($productName) . ":\n"; // Tiêu đề cho mỗi sản phẩm được tìm kiếm
                
                    if ($result['type'] == 'exact') {
                        $product = $result['data'];
                        $formattedPrice = $result['formatted_price'];
                    
                        $response .= "Sản phẩm \"{$product['p_name']}\" hiện có giá {$formattedPrice} VND.\n";
                    
                        if (!empty($product['p_short_description'])) {
                            $shortDesc = $product['p_short_description'];
                            if (mb_strlen($shortDesc, 'UTF-8') > 150) {
                                $shortDesc = mb_substr($shortDesc, 0, 150, 'UTF-8') . '...';
                            }
                            $response .= "Mô tả: {$shortDesc}\n";
                        }
                    
                        if (isset($product['p_qty'])) {
                            if ($product['p_qty'] > 0) {
                                $response .= "Tình trạng: Còn hàng ({$product['p_qty']} sản phẩm)\n";
                            } else {
                                $response .= "Tình trạng: Hết hàng\n";
                            }
                        }
                    
                        $rating = getProductRating($product['p_id']);
                        if ($rating['count'] > 0) {
                            $response .= "Đánh giá: " . number_format($rating['avg'], 1) . "⭐ (" . $rating['count'] . " lượt đánh giá)\n";
                        }
                    
                        $response .= "Xem chi tiết sản phẩm tại: <a href='product.php?id={$product['p_id']}'>Nhấn vào đây</a>\n";
                    } 
                    else if ($result['type'] == 'similar') {
                        $products = $result['data'];
                        $response .= "Tìm thấy " . count($products) . " sản phẩm liên quan. Dưới đây là top 3:\n"; // Báo số lượng và chỉ hiển thị top 3
                    
                        // Hiển thị tối đa 3 sản phẩm liên quan
                        for ($i = 0; $i < min(count($products), 3); $i++) {
                            $product = $products[$i];
                            $formattedPrice = number_format($product['p_current_price'], 0, ',', '.');
                        
                            $rating = isset($product['avg_rating']) ? $product : getProductRating($product['p_id']);
                            $ratingInfo = (isset($rating['avg_rating']) && $rating['rating_count'] > 0) ? 
                                " - " . number_format($rating['avg_rating'], 1) . "⭐ (" . $rating['rating_count'] . " đánh giá)" : 
                                (($rating['count'] > 0) ? " - " . number_format($rating['avg'], 1) . "⭐ (" . $rating['count'] . " đánh giá)" : "");
                        
                            $response .= "- <a href='product.php?id={$product['p_id']}'>{$product['p_name']}</a> - {$formattedPrice} VND{$ratingInfo}\n";
                        }
                    
                        if (count($products) > 3) {
                            $response .= "... và " . (count($products) - 3) . " sản phẩm khác.\n";
                        }
                    } 
                    else {
                        $response .= "Xin lỗi, tôi không tìm thấy sản phẩm này trong cửa hàng của chúng tôi.\n";
                    }
                
                    $response .= "\n";
                }
            
                $response .= "Bạn có muốn thêm sản phẩm nào vào giỏ hàng không?";
            
                return $response;
            }
        }
        // Nếu người dùng chỉ nói "Muốn mua đồ" hoặc tương tự mà không chỉ rõ sản phẩm
        // Đề xuất các sản phẩm có rating cao
        $topRatedProducts = getTopRatedProducts(5); // Lấy top 5 sản phẩm
        
        if (count($topRatedProducts) > 0) {
            $response = "Dưới đây là một số sản phẩm được đánh giá cao trong cửa hàng của chúng tôi:\n\n";
            
            foreach ($topRatedProducts as $product) {
                $formattedPrice = number_format($product['p_current_price'], 0, ',', '.');
                $ratingInfo = number_format($product['avg_rating'], 1) . "⭐ (" . $product['rating_count'] . " đánh giá)";
                
                $response .= "- <a href='product.php?id={$product['p_id']}'>{$product['p_name']}</a> - {$formattedPrice} VND - {$ratingInfo}\n";
            }
            
            $response .= "\nBạn có thể nhấn vào tên sản phẩm để xem chi tiết. Bạn quan tâm đến sản phẩm nào?";
            return $response;
        } else {
            // Nếu không có sản phẩm nào có rating, đề xuất sản phẩm nổi bật
            $featuredProducts = getFeaturedProducts(5);
            
            if (count($featuredProducts) > 0) {
                $response = "Dưới đây là một số sản phẩm nổi bật trong cửa hàng của chúng tôi:\n\n";
                
                foreach ($featuredProducts as $product) {
                    $formattedPrice = number_format($product['p_current_price'], 0, ',', '.');
                    $response .= "- <a href='product.php?id={$product['p_id']}'>{$product['p_name']}</a> - {$formattedPrice} VND\n";
                }
                
                $response .= "\nBạn có thể nhấn vào tên sản phẩm để xem chi tiết. Bạn quan tâm đến sản phẩm nào?";
                return $response;
            }
        }
    }
    
    // Kiểm tra câu hỏi về sản phẩm (nếu không khớp regex "mua")
    if (strpos($lowerMessage, 'sản phẩm') !== false || 
        strpos($lowerMessage, 'mua hàng') !== false || 
        strpos($lowerMessage, 'giá') !== false) {
        
        // Trích xuất từ khóa tiềm năng
        $keywords = extractKeywords($lowerMessage);
        
        if (count($keywords) > 0) {
            // Tìm kiếm sản phẩm phù hợp với các từ khóa (hàm này đã ưu tiên p_name)
            $products = searchProducts($keywords);
            
            if (count($products) > 0) {
                $response = "Tôi tìm thấy một số sản phẩm có thể phù hợp với bạn:\n";
                
                // Hiển thị tối đa 3 sản phẩm
                for ($i = 0; $i < min(count($products), 3); $i++) {
                    $product = $products[$i];
                    $formattedPrice = number_format($product['p_current_price'], 0, ',', '.');
                    
                    $rating = getProductRating($product['p_id']);
                    $ratingInfo = ($rating['count'] > 0) ? " - " . number_format($rating['avg'], 1) . "⭐ (" . $rating['count'] . " đánh giá)" : "";
                    
                    $response .= "- <a href='product.php?id={$product['p_id']}'>{$product['p_name']}</a> - {$formattedPrice} VND{$ratingInfo}\n";
                }
                
                if (count($products) > 3) {
                    $response .= "... và " . (count($products) - 3) . " sản phẩm khác.";
                }
                
                return $response;
            }
        }
        
        return "Bạn có thể cho tôi biết thêm chi tiết về sản phẩm bạn đang tìm kiếm không?";
    }
    
    // Kiểm tra câu hỏi về vận chuyển
    if (strpos($lowerMessage, 'vận chuyển') !== false || 
        strpos($lowerMessage, 'giao hàng') !== false || 
        strpos($lowerMessage, 'ship') !== false) {
        
        return "Chúng tôi hỗ trợ giao hàng toàn quốc. Phí vận chuyển phụ thuộc vào địa điểm và khối lượng đơn hàng. Bạn có thể xem chi tiết phí vận chuyển khi thanh toán.";
    }
    
    // Kiểm tra câu hỏi về tình trạng đơn hàng
    if (strpos($lowerMessage, 'đơn hàng') !== false || 
        strpos($lowerMessage, 'tình trạng') !== false || 
        strpos($lowerMessage, 'theo dõi') !== false) {
        
        // Kiểm tra xem người dùng đã đăng nhập chưa 
        $isLoggedIn = checkIfUserIsLoggedIn();
        
        if ($isLoggedIn) {
            return "Bạn có thể kiểm tra tình trạng đơn hàng trong phần 'Đơn hàng của tôi' trong tài khoản của bạn.";
        } else {
            return "Bạn cần đăng nhập để kiểm tra tình trạng đơn hàng. Nếu bạn đã có tài khoản, vui lòng <a href='login-customer.php'>đăng nhập</a> để xem chi tiết.";
        }
    }
    
    // Kiểm tra câu hỏi về liên hệ/hỗ trợ
    if (strpos($lowerMessage, 'liên hệ') !== false || 
        strpos($lowerMessage, 'hỗ trợ') !== false || 
        strpos($lowerMessage, 'giúp đỡ') !== false) {
        
        return "Bạn có thể liên hệ với chúng tôi qua email support@example.com hoặc số điện thoại 1900-xxxx. Hoặc truy cập trang <a href='contact.php'>Liên hệ</a> để biết thêm chi tiết.";
    }
    
    // Kiểm tra lời chào
    if (strpos($lowerMessage, 'xin chào') !== false || 
        strpos($lowerMessage, 'chào') !== false || 
        strpos($lowerMessage, 'hi') !== false || 
        strpos($lowerMessage, 'hello') !== false) {
        
        return "Xin chào! Tôi là trợ lý ảo của cửa hàng. Tôi có thể giúp gì cho bạn?";
    }
    
    // Phản hồi mặc định cho các truy vấn không nhận dạng được
    return "Cảm ơn bạn đã liên hệ. Tôi chưa hiểu rõ yêu cầu của bạn. Bạn có thể hỏi về sản phẩm, vận chuyển, đơn hàng hoặc cách liên hệ với chúng tôi.";
}

/**
 * Tìm kiếm sản phẩm chính xác theo tên.
 * @param string $productName Tên sản phẩm cần tìm.
 * @return array|null Thông tin sản phẩm nếu tìm thấy, ngược lại null.
 */
function searchExactProduct($productName) {
    global $pdo;
    
    $productName = mb_strtolower($productName, 'UTF-8');
    
    try {
        // Tìm kiếm chính xác
        $stmt = $pdo->prepare("SELECT * FROM table_product WHERE LOWER(p_name) = :name AND p_is_active = 1 LIMIT 1");
        $stmt->bindParam(':name', $productName, PDO::PARAM_STR);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($product) {
            return $product;
        }
        
        // Tìm kiếm tương đối nếu không có kết quả chính xác
        $stmt = $pdo->prepare("SELECT * FROM table_product WHERE LOWER(p_name) LIKE :name AND p_is_active = 1 LIMIT 1");
        $searchName = '%' . $productName . '%';
        $stmt->bindParam(':name', $searchName, PDO::PARAM_STR);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $product;
    } catch (PDOException $e) {
        error_log("Database error in searchExactProduct: " . $e->getMessage());
        return null;
    }
}

/**
 * Tìm kiếm sản phẩm theo danh mục (quần, áo) hoặc từ khóa trong tên sản phẩm.
 * @param string $category Từ khóa danh mục (ví dụ: 'quần', 'áo').
 * @param int $limit Số lượng sản phẩm tối đa trả về.
 * @param bool $searchInNameOnly Nếu true, chỉ tìm trong `p_name`. Ngược lại, tìm trong `p_name`, `p_short_description`, `p_description`.
 * @return array Mảng các sản phẩm tìm được.
 */
function searchCategoryProducts($category, $limit = 5, $searchInNameOnly = false) {
    global $pdo;

    try {
        $searchCategory = '%' . mb_strtolower($category, 'UTF-8') . '%';
        $whereClause = "";

        // Điều chỉnh mệnh đề WHERE dựa trên tham số $searchInNameOnly
        if ($searchInNameOnly) {
            $whereClause = "LOWER(p.p_name) LIKE :category1";
        } else {
            $whereClause = "LOWER(p.p_name) LIKE :category1 OR " .
                           "LOWER(p.p_short_description) LIKE :category2 OR " .
                           "LOWER(p.p_description) LIKE :category3";
        }

        $query = "SELECT p.*,
                 IFNULL(AVG(r.rating), 0) as avg_rating,
                 COUNT(r.rt_id) as rating_count
                 FROM table_product p
                 LEFT JOIN table_rating r ON p.p_id = r.p_id
                 WHERE p.p_is_active = 1 AND ({$whereClause})
                 GROUP BY p.p_id
                 ORDER BY rating_count DESC, avg_rating DESC, p.p_is_featured DESC, p.p_total_order DESC
                 LIMIT :limit";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':category1', $searchCategory, PDO::PARAM_STR);
        // Chỉ bind category2 và category3 nếu không phải là searchInNameOnly
        if (!$searchInNameOnly) {
            $stmt->bindParam(':category2', $searchCategory, PDO::PARAM_STR);
            $stmt->bindParam(':category3', $searchCategory, PDO::PARAM_STR);
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log("Category products error: " . $e->getMessage());
        return [];
    }
}

/**
 * Trích xuất từ khóa có liên quan từ tin nhắn của người dùng.
 * @param string $message Tin nhắn người dùng.
 * @return array Mảng các từ khóa.
 */
function extractKeywords($message) {
    // Loại bỏ ký tự đặc biệt và khoảng trắng thừa
    $message = preg_replace('/[^\w\s]/u', ' ', $message);
    $message = preg_replace('/\s+/', ' ', $message);
    $message = trim($message);
    
    // Các từ thông dụng cần bỏ qua (tiếng Việt)
    $stopWords = [
        'và', 'hoặc', 'nhưng', 'vì', 'của', 'từ', 'với', 'các', 'những', 'để',
        'cho', 'trên', 'dưới', 'trong', 'ngoài', 'đã', 'sẽ', 'đang', 'bởi', 'về',
        'tôi', 'bạn', 'anh', 'chị', 'họ', 'chúng', 'là', 'có', 'thể', 'sản',
        'phẩm', 'mua', 'hàng', 'giá', 'muốn', 'cần', 'làm', 'thế', 'nào', 'như',
        'đồ'
    ];
    
    $words = explode(' ', mb_strtolower($message, 'UTF-8'));
    $keywords = [];
    
    foreach ($words as $word) {
        $trimmedWord = trim($word);
        if (mb_strlen($trimmedWord, 'UTF-8') > 2 && !in_array($trimmedWord, $stopWords)) {
            $keywords[] = $trimmedWord;
        }
    }
    
    return $keywords;
}

/**
 * Tìm kiếm sản phẩm dựa trên danh sách từ khóa. Ưu tiên tìm trong p_name.
 * @param array $keywords Mảng các từ khóa tìm kiếm.
 * @return array Mảng các sản phẩm phù hợp.
 */
function searchProducts($keywords) {
    global $pdo;
    
    if (empty($keywords)) {
        return [];
    }
    
    try {
        $conditions = [];
        $params = [];
        
        foreach ($keywords as $index => $keyword) {
            $keyParam = ':keyword' . $index;
            $conditions[] = "LOWER(p_name) LIKE {$keyParam} OR LOWER(p_description) LIKE {$keyParam} OR LOWER(p_short_description) LIKE {$keyParam}";
            $params[$keyParam] = '%' . mb_strtolower($keyword, 'UTF-8') . '%';
        }
        
        $whereClause = implode(' OR ', $conditions);
        
        // Tính toán điểm liên quan: Ưu tiên khớp trong p_name
        $query = "SELECT p.*, 
                 (CASE 
                   WHEN LOWER(p_name) LIKE :exactName THEN 10 -- Khớp chính xác p_name
                   ELSE 0
                 END) +
                 (CASE 
                   WHEN LOWER(p_name) LIKE :partialName THEN 5 -- Khớp một phần p_name
                   ELSE 0
                 END) +
                 (CASE 
                   WHEN LOWER(p_short_description) LIKE :partialName THEN 3 -- Khớp trong mô tả ngắn
                   ELSE 0
                 END) +
                 (CASE 
                   WHEN LOWER(p_description) LIKE :partialName THEN 1 -- Khớp trong mô tả dài
                   ELSE 0
                 END) AS relevance_score,
                 IFNULL((SELECT AVG(rating) FROM table_rating WHERE p_id = p.p_id), 0) AS avg_rating,
                 IFNULL((SELECT COUNT(*) FROM table_rating WHERE p_id = p.p_id), 0) AS rating_count
                 FROM table_product p
                 WHERE p.p_is_active = 1 AND ({$whereClause})
                 ORDER BY relevance_score DESC, avg_rating DESC, p_is_featured DESC, p_total_order DESC
                 LIMIT 10"; // Giới hạn 10 sản phẩm để xử lý

        // Chuỗi từ khóa kết hợp cho việc tính điểm chính xác/một phần trong tên
        $combinedKeyword = implode(' ', $keywords);
        $exactName = mb_strtolower($combinedKeyword, 'UTF-8');
        $partialName = '%' . $exactName . '%';
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':exactName', $exactName, PDO::PARAM_STR);
        $stmt->bindParam(':partialName', $partialName, PDO::PARAM_STR);
        
        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value, PDO::PARAM_STR);
        }
        
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        error_log("Search results: " . count($results) . " products found for keywords: " . implode(', ', $keywords));
        
        return $results;
        
    } catch (PDOException $e) {
        error_log("Database error in searchProducts: " . $e->getMessage());
        return [];
    }
}

/**
 * Lấy rating trung bình và số lượng đánh giá của một sản phẩm cụ thể.
 * @param int $productId ID của sản phẩm.
 * @return array Mảng chứa 'avg' (rating trung bình) và 'count' (số lượng đánh giá).
 */
function getProductRating($productId) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT AVG(rating) as avg_rating, COUNT(*) as count FROM table_rating WHERE p_id = :pid");
        $stmt->bindParam(':pid', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return [
            'avg' => $result['avg_rating'] ? (float)$result['avg_rating'] : 0,
            'count' => (int)$result['count']
        ];
    } catch (PDOException $e) {
        error_log("Rating error: " . $e->getMessage());
        return ['avg' => 0, 'count' => 0];
    }
}

/**
 * Lấy các sản phẩm có rating cao nhất.
 * @param int $limit Số lượng sản phẩm tối đa.
 * @return array Mảng các sản phẩm.
 */
function getTopRatedProducts($limit = 5) {
    global $pdo;
    
    try {
        $query = "SELECT p.*, 
                  IFNULL(AVG(r.rating), 0) as avg_rating, 
                  COUNT(r.rt_id) as rating_count
                  FROM table_product p
                  LEFT JOIN table_rating r ON p.p_id = r.p_id
                  WHERE p.p_is_active = 1
                  GROUP BY p.p_id
                  HAVING rating_count > 0
                  ORDER BY avg_rating DESC, rating_count DESC, p.p_total_order DESC
                  LIMIT :limit";
                  
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Top rated products error: " . $e->getMessage());
        return [];
    }
}

/**
 * Lấy các sản phẩm được đánh dấu là "nổi bật".
 * @param int $limit Số lượng sản phẩm tối đa.
 * @return array Mảng các sản phẩm.
 */
function getFeaturedProducts($limit = 5) {
    global $pdo;
    
    try {
        $query = "SELECT p.* FROM table_product p
                  WHERE p.p_is_active = 1 AND p.p_is_featured = 1
                  ORDER BY p.p_total_order DESC
                  LIMIT :limit";
                  
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Featured products error: " . $e->getMessage());
        return [];
    }
}

/**
 * Kiểm tra xem người dùng đã đăng nhập chưa.
 * @return bool True nếu người dùng đã đăng nhập, ngược lại false.
 */
function checkIfUserIsLoggedIn() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['customer']) && !empty($_SESSION['customer']);
}
?>