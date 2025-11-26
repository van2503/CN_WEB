<?php

$file_name = 'Quiz.txt';
$questions = [];


if (file_exists($file_name)) {
    $content = file_get_contents($file_name);
   
    $question_blocks = preg_split('/\n\s*\n/', trim($content));

    foreach ($question_blocks as $block) {
        $block = trim($block);
        if (empty($block)) continue;

        $lines = explode("\n", $block);
        $current_question = [
            'question_text' => '',
            'options' => [],
            'answer' => ''
        ];
        
        $is_question_line = true;

        foreach ($lines as $line) {
            $line = trim($line);
            
            // 1. Lấy Đáp án
            if (preg_match('/^ANSWER:\s*(.*)/i', $line, $matches)) {
                $current_question['answer'] = trim($matches[1]);
                $is_question_line = false; // Ngừng thu thập lựa chọn sau khi thấy ANSWER
            } 
            
            // 2. Lấy Câu hỏi/Lựa chọn
            else {
                // Nếu đây là dòng đầu tiên, đó là nội dung câu hỏi
                if ($is_question_line && !preg_match('/^[A-D]\.\s/i', $line)) {
                    $current_question['question_text'] .= $line . "\n";
                } 
                // Nếu dòng bắt đầu bằng A., B., C., D., đó là một lựa chọn
                else if (preg_match('/^([A-D])\.\s(.*)/i', $line, $matches_option)) {
                    $current_question['options'][$matches_option[1]] = $matches_option[2];
                    $is_question_line = false; // Bắt đầu thu thập lựa chọn
                }
            }
        }
        $questions[] = $current_question;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài Thi Trắc Nghiệm - CSE485</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; max-width: 800px; margin: 0 auto; padding: 20px;}
        .question-block { margin-bottom: 20px; }
        h2 { font-size: 1.5em; margin: 0 0 10px 0; }
        .answer-display { font-weight: bold; color: #000000; margin-top: 10px; }
        /* Dùng pre để giữ định dạng xuống dòng của câu hỏi và lựa chọn */
        pre { font-family: Arial, sans-serif; white-space: pre-wrap; font-size: 1em; padding: 0; margin: 0; }
        hr { border: 0; border-top: 1px solid #ccc; margin: 20px 0; }
    </style>
</head>
<body>

    <div class="quiz-container">
        <h1>Bài Thi Trắc Nghiệm</h1>
        <hr>
        
        <?php
        if (empty($questions)) {
            echo '<p style="color: red;">❌ Lỗi: Không thể tải hoặc phân tích nội dung tệp tin **' . htmlspecialchars($file_name) . '**.</p>';
        } else {
            
            foreach ($questions as $index => $q) {
                $question_number = $index + 1;
                
                // --- BẮT ĐẦU HIỂN THỊ KHỐI CÂU HỎI ---
                echo '<div class="question-block">';
                
                // 1. Hiển thị Tiêu đề Câu hỏi (Câu 1, Câu 2, ...)
                echo '<h2>Câu ' . $question_number . '</h2>';
                
                // Chuẩn bị nội dung để hiển thị: Gộp Câu hỏi và Lựa chọn
                $display_content = trim($q['question_text']);
                
                // Thêm các lựa chọn (A., B., C., D.) vào nội dung hiển thị
                foreach ($q['options'] as $key => $value) {
                    $display_content .= "\n" . htmlspecialchars($key) . ". " . htmlspecialchars($value);
                }
                
                // 2. Hiển thị Nội dung Câu hỏi và Lựa chọn
                echo '<pre>' . $display_content . '</pre>';
                
                // 3. Hiển thị Đáp án (Giống như trong ảnh: "Đáp án: C")
                echo '<p class="answer-display">Đáp án: ' . htmlspecialchars($q['answer']) . '</p>';
                
                echo '</div>'; // Kết thúc khối câu hỏi
                
                // 4. Đường kẻ phân cách giữa các câu hỏi
                echo '<hr>';
            }
        }
        ?>
    </div>

</body>
</html>