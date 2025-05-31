<div class="chatbot-toggle" id="chatbot-toggle">
    <i class="fa fa-comments"></i>
</div>

<div class="chatbot-container hidden" id="chatbot-container">
    <div class="chatbot-header">
        <span>Trợ giúp trực tuyến</span>
        <!-- NÚT MỚI ĐƯỢC THÊM VÀO ĐÂY -->
        <button class="chatbot-refresh" id="chatbot-refresh" title="Xóa lịch sử trò chuyện">
            <i class="fa fa-redo"></i>
        </button>
        <button class="chatbot-close" id="chatbot-close">×</button>
    </div>
    <div class="chatbot-messages" id="chatbot-messages">
        <!-- Chat messages will be loaded here -->
    </div>
    <div class="chatbot-input">
        <input type="text" id="chat-input" placeholder="Nhập tin nhắn của bạn...">
        <button id="chat-submit">
            <i class="fa fa-paper-plane"></i>
        </button>
    </div>
</div>

<style>
    /* CSS HIỆN CÓ */
    .chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 350px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 40px rgba(0, 0, 0, 0.16);
        background-color: #fff;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .chatbot-header {
        background-color: rgb(244, 117, 14);
        color: #fff;
        padding: 15px;
        font-weight: bold;
        display: flex;
        /* Điều chỉnh để căn chỉnh các mục trong header */
        justify-content: flex-start; 
        align-items: center;
    }

    .chatbot-header span {
        flex-grow: 1; /* Cho phép tiêu đề chiếm không gian còn lại, đẩy các nút về phía phải */
        margin-right: auto; /* Đảm bảo tiêu đề đẩy các nút ra xa nhất có thể */
    }
    
    .chatbot-close {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
    }

    /* CSS MỚI CHO NÚT REFRESH */
    .chatbot-refresh {
        background: none;
        border: none;
        color: white;
        font-size: 18px; /* Kích thước icon */
        cursor: pointer;
        margin-right: 10px; /* Khoảng cách với nút đóng */
    }
    /* KẾT THÚC CSS MỚI */
    
    .chatbot-messages {
        height: 300px;
        overflow-y: auto;
        padding: 15px;
        display: flex;
        flex-direction: column;
    }
    
    .message {
        max-width: 80%;
        padding: 10px 15px;
        margin-bottom: 10px;
        border-radius: 20px;
        line-height: 1.4;
    }
    
    .user-message {
        align-self: flex-end;
        background-color: rgb(244, 117, 14);
        color: white;
    }
    
    .bot-message {
        align-self: flex-start;
        background-color: #f1f0f0;
        color: #333;
    }
    
    .bot-message a {
        color: rgb(244, 117, 14);
        text-decoration: none;
    }
    
    .bot-message a:hover {
        text-decoration: underline;
    }
    
    .chatbot-input {
        display: flex;
        padding: 10px;
        border-top: 1px solid #e0e0e0;
    }
    
    #chat-input {
        flex-grow: 1;
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        padding: 10px 15px;
        font-size: 14px;
        outline: none;
        background-color: #fff;
        color: #000;
        pointer-events: auto;
        z-index: 1001;
        position: relative;
    }
    
    #chat-submit {
        background-color:rgb(244, 117, 14);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-left: 10px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .chatbot-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: rgb(244, 117, 14);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        font-size: 24px;
    }
    
    .hidden {
        display: none;
    }
    
    .typing-indicator {
        display: flex;
        padding: 10px 15px;
        background-color: #f1f0f0;
        border-radius: 20px;
        margin-bottom: 10px;
        align-self: flex-start;
        width: fit-content;
    }
    
    .typing-indicator span {
        height: 8px;
        width: 8px;
        background-color: #999;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
        animation: typing 1.4s infinite both;
    }
    
    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    @keyframes typing {
        0% {
            transform: translateY(0px);
        }
        28% {
            transform: translateY(-5px);
        }
        44% {
            transform: translateY(0px);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load Font Awesome nếu chưa được tải
    // (Đã loại bỏ khối script Font Awesome bị trùng lặp ở cuối file HTML)
    if (!document.querySelector('link[href*="font-awesome"]')) {
        const fontAwesome = document.createElement('link');
        fontAwesome.rel = 'stylesheet';
        fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
        document.head.appendChild(fontAwesome);
    }
    
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotContainer = document.getElementById('chatbot-container');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatbotRefresh = document.getElementById('chatbot-refresh'); // THÊM MỚI: Lấy nút refresh
    const chatMessages = document.getElementById('chatbot-messages');
    const chatInput = document.getElementById('chat-input');
    const chatSubmit = document.getElementById('chat-submit');
    
    // Tạo session ID duy nhất cho phiên chat
    const generateSessionId = () => {
        return 'chat_' + Math.random().toString(36).substring(2, 15) + 
               Math.random().toString(36).substring(2, 15);
    };
    
    // Kiểm tra xem đã có session ID chưa, nếu chưa thì tạo mới
    let chatSessionId = localStorage.getItem('chatSessionId');
    if (!chatSessionId) {
        chatSessionId = generateSessionId();
        localStorage.setItem('chatSessionId', chatSessionId);
    }
    
    // Lưu trạng thái chatbot (hiển thị hoặc ẩn)
    const saveChatbotState = (isVisible) => {
        localStorage.setItem('chatbotVisible', isVisible);
    };
    
    // Lấy trạng thái chatbot đã lưu
    const getChatbotState = () => {
        return localStorage.getItem('chatbotVisible') === 'true';
    };
    
    // Lưu lịch sử chat vào localStorage
    const saveChatHistory = (history) => {
        localStorage.setItem('chatHistory', JSON.stringify(history));
    };
    
    // Lấy lịch sử chat từ localStorage
    const getChatHistory = () => {
        const history = localStorage.getItem('chatHistory');
        return history ? JSON.parse(history) : [];
    };

    // Hàm thêm tin nhắn vào khung chat
    function appendMessage(content, sender) {
        const messageElement = document.createElement('div');
        messageElement.className = `message ${sender}-message`;
        
        // Convert line breaks to <br> and handle links
        content = content.replace(/\n/g, '<br>');
        
        messageElement.innerHTML = content;
        chatMessages.appendChild(messageElement);
        
        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Khởi tạo chatbot
    const initChatbot = () => {
        // Tải lịch sử chat
        const chatHistory = getChatHistory();
        
        // Nếu không có lịch sử, hiển thị tin nhắn chào mừng
        if (chatHistory.length === 0) {
            appendMessage('Xin chào! Tôi là trợ lý ảo của cửa hàng. Tôi có thể giúp gì cho bạn?', 'bot');
        } else {
            // Hiển thị lịch sử chat đã lưu
            chatMessages.innerHTML = ''; // Xóa tin nhắn hiện có trước khi hiển thị lại
            chatHistory.forEach(item => {
                appendMessage(item.content, item.sender);
            });
        }
        
        // Khôi phục trạng thái hiển thị của chatbot
        if (getChatbotState()) {
            chatbotContainer.classList.remove('hidden');
            chatbotToggle.classList.add('hidden');
        }
        
        // Cuộn xuống cuối cuộc trò chuyện
        chatMessages.scrollTop = chatMessages.scrollHeight;
    };
    
    // Toggle chatbot visibility
    chatbotToggle.addEventListener('click', function() {
        chatbotContainer.classList.remove('hidden');
        chatbotToggle.classList.add('hidden');
        chatInput.focus();
        saveChatbotState(true);
    });
    
    chatbotClose.addEventListener('click', function() {
        chatbotContainer.classList.add('hidden');
        chatbotToggle.classList.remove('hidden');
        saveChatbotState(false);
    });

    // THÊM MỚI: Xử lý sự kiện click nút refresh
    chatbotRefresh.addEventListener('click', function() {
        if (confirm('Bạn có chắc chắn muốn xóa toàn bộ lịch sử trò chuyện?')) {
            clearChatHistory();
        }
    });

    // THÊM MỚI: Hàm để xóa lịch sử trò chuyện
    function clearChatHistory() {
        const sessionIdToClear = chatSessionId; // Lưu session ID hiện tại để gửi lên server

        // Xóa dữ liệu lịch sử chat trong localStorage
        localStorage.removeItem('chatHistory');
        localStorage.removeItem('chatSessionId'); // Xóa cả session ID để tạo session mới
        localStorage.removeItem('chatSessionExpiration');

        // Tạo một session ID mới cho phiên chat mới
        chatSessionId = generateSessionId();
        localStorage.setItem('chatSessionId', chatSessionId);
        setSessionTimeout(); // Đặt lại thời gian hết hạn cho session mới

        // Xóa tất cả tin nhắn đang hiển thị trên giao diện người dùng
        chatMessages.innerHTML = '';

        // Hiển thị tin nhắn chào mừng để bắt đầu cuộc trò chuyện mới
        appendMessage('Xin chào! Tôi là trợ lý ảo của cửa hàng. Tôi có thể giúp gì cho bạn?', 'bot');

        // Gửi yêu cầu đến backend để xóa lịch sử trò chuyện trên máy chủ
        // Chúng ta sử dụng sessionIdToClear để nhắm mục tiêu lịch sử của phiên cũ
        fetch('clear_chat_history.php', { // Đảm bảo bạn tạo file PHP này
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `session_id=${encodeURIComponent(sessionIdToClear)}`
        })
        .then(response => response.json())
        .then(data => {
            console.log('Phản hồi từ server về xóa lịch sử:', data);
            if (data.status === 'error') {
                appendMessage('Đã xảy ra lỗi khi xóa lịch sử trò chuyện trên máy chủ: ' + data.message, 'bot');
            }
        })
        .catch(error => {
            console.error('Lỗi khi gửi yêu cầu xóa lịch sử trò chuyện đến máy chủ:', error);
            appendMessage('Không thể kết nối với máy chủ để xóa lịch sử. Vui lòng kiểm tra kết nối mạng.', 'bot');
        });
    }
    
    // Send message on button click or Enter key
    chatSubmit.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
    
    function sendMessage() {
        const message = chatInput.value.trim();
        
        if (message === '') return;
        
        // Add user message to chat
        appendMessage(message, 'user');
        
        // Save to chat history
        const chatHistory = getChatHistory();
        chatHistory.push({
            content: message,
            sender: 'user',
            timestamp: new Date().toISOString()
        });
        saveChatHistory(chatHistory);
        
        // Clear input
        chatInput.value = '';
        
        // Show typing indicator
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'typing-indicator';
        typingIndicator.innerHTML = '<span></span><span></span><span></span>';
        chatMessages.appendChild(typingIndicator);
        
        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Send message to server for processing
        sendToBackend(message)
            .then(response => {
                // Remove typing indicator
                if (typingIndicator.parentNode) {
                    chatMessages.removeChild(typingIndicator);
                }
                
                // Add bot response
                appendMessage(response.message, 'bot');
                
                // Save bot response to history
                const chatHistory = getChatHistory();
                chatHistory.push({
                    content: response.message,
                    sender: 'bot',
                    timestamp: new Date().toISOString()
                });
                saveChatHistory(chatHistory);
                
                // Scroll to bottom again after adding response
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(error => {
                console.error('Lỗi khi gửi tin nhắn:', error);
                if (typingIndicator.parentNode) {
                    chatMessages.removeChild(typingIndicator);
                }
                appendMessage('Không thể kết nối với máy chủ. Vui lòng kiểm tra kết nối mạng của bạn.', 'bot');
            });
    }
    
    // Make API call to the backend
    function sendToBackend(message) {
        return fetch('chatbot-process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `message=${encodeURIComponent(message)}&session_id=${encodeURIComponent(chatSessionId)}`
        })
        .then(response => {
            if (!response.ok) { // Check for HTTP errors
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        });
    }
    
    // Lấy lịch sử chat từ server nếu có
    function fetchChatHistoryFromServer() {
        const localHistory = getChatHistory();
        if (localHistory.length === 0) { // Chỉ tải từ server nếu không có lịch sử cục bộ
            fetch('chathistory.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `session_id=${encodeURIComponent(chatSessionId)}`
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success' && data.history.length > 0) {
                    // Xây dựng lại lịch sử với các tin nhắn user và bot xen kẽ
                    const serverHistory = [];
                    data.history.forEach(item => {
                        serverHistory.push({
                            content: item.user_message,
                            sender: 'user',
                            timestamp: item.created_at
                        });
                        serverHistory.push({
                            content: item.bot_reply,
                            sender: 'bot',
                            timestamp: item.created_at
                        });
                    });
                    
                    saveChatHistory(serverHistory);
                    
                    // Xóa tin nhắn hiện có và hiển thị lại từ lịch sử server
                    chatMessages.innerHTML = '';
                    serverHistory.forEach(item => {
                        appendMessage(item.content, item.sender);
                    });
                    chatMessages.scrollTop = chatMessages.scrollHeight; // Cuộn xuống cuối
                }
            })
            .catch(error => {
                console.error('Lỗi khi tải lịch sử trò chuyện từ máy chủ:', error);
            });
        }
    }
    
    // Handle page visibility changes
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'hidden') {
            saveChatbotState(chatbotContainer.classList.contains('hidden') === false);
        }
    });
    
    // Thiết lập thời hạn cho phiên chat (30 phút)
    const setSessionTimeout = () => {
        const expirationTime = new Date().getTime() + (30 * 60 * 1000); // 30 phút từ bây giờ
        localStorage.setItem('chatSessionExpiration', expirationTime);
    };
    
    // Kiểm tra xem phiên chat đã hết hạn chưa
    const checkSessionExpiration = () => {
        const expirationTime = localStorage.getItem('chatSessionExpiration');
        if (!expirationTime || new Date().getTime() > parseInt(expirationTime)) {
            // Đã hết hạn, xóa lịch sử và session ID cũ
            localStorage.removeItem('chatHistory');
            localStorage.removeItem('chatSessionId');
            localStorage.removeItem('chatSessionExpiration');
            return true; // Session expired
        }
        return false; // Session is still valid
    };
    
    // Khởi tạo và quản lý phiên
    if (checkSessionExpiration()) {
        // Tạo phiên mới nếu đã hết hạn hoặc không tồn tại
        chatSessionId = generateSessionId();
        localStorage.setItem('chatSessionId', chatSessionId);
        setSessionTimeout();
    } else {
        // Cập nhật thời hạn cho phiên hiện tại
        setSessionTimeout();
    }
    
    initChatbot(); // Gọi initChatbot sau khi quản lý phiên

    // Tải lịch sử từ server nếu cần
    fetchChatHistoryFromServer();
});
</script>