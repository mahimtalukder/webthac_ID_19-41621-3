<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Quiz App</title>
	<link href="css/modern.css" rel="stylesheet">
	<script src="js/settings.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/script.js"></script>
	<link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" />
	<script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div class="start_btn" id="start_btn"><button>Start Quiz</button></div>
    
    <div class="info_box" id="info_box">
        <div class="info-title"><span>Some Rules of this Quiz</span></div>
        <div class="info-list">
            <div class="info">1. You will have only <span>15 seconds</span> per each question.</div>
            <div class="info">2. Once you select your answer, it can't be undone.</div>
            <div class="info">3. You can't select any option once time goes off.</div>
            <div class="info">4. You can't exit from the Quiz while you're playing.</div>
            <div class="info">5. You'll get points on the basis of your correct answers.</div>
        </div>
        <div class="buttons">
            <button class="quit" id="quit">Exit Quiz</button>
            <button class="restart" id="continue">Continue</button>
        </div>
    </div>

    <div class="quiz_box" id="quiz_box">
        <header>
            <div class="title">Web Tec Quiz</div>
            <div class="timer">
                <div class="time_left_txt">Time Left</div>
                <div class="timer_sec">15</div>
            </div>
            <div class="time_line"></div>
        </header>
        <section>
            <div class="que_text">
            </div>
            <div class="option_list">
            </div>
        </section>

        <footer>
            <div class="total_que">
            </div>
            <button class="next_btn" id="next_btn">Next Que</button>
        </footer>
    </div>

    <div class="result_box" id="result_box">
        <div class="complete_text">You've completed the Quiz!</div>
        <div class="score_text">
        </div>
        <div class="buttons">
            <button class="quit" id="main_manu">Main Manu</button>
        </div>
    </div>

</body>
</html>