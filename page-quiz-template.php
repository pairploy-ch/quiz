<?php
/*
Template Name: Chakra Quiz
*/
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบทดสอบจักระ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div id="chakra-quiz-container">
    <div class="mobile-container">
        <div class="header">
            <button class="back-btn" onclick="goBack()">←</button>
            <div style="display: flex; align-items: center">
                <img style="height: 30px; width: auto" src="https://soulgoodhealing.com/wp-content/uploads/2022/08/LOGO-SGH-FB.png" alt="Logo" loading="lazy"> 
                <div class="logo" style="margin-left: 5px;">แบบทดสอบจักระ</div>
            </div>
            <!-- <button class="close-btn">×</button> -->
        </div>
        
        <div class="progress-bar">
            <div class="progress-fill" id="progress-fill"></div>
        </div>
        
        <!-- Question Page -->
        <div id="question-page" class="content">
            <div class="question-counter">
                <span id="current-question">1</span> จาก <span id="total-questions">7</span>
            </div>
            
            <h2 class="question-title" id="question-title"></h2>
            
            <div class="options" id="options-container">
                <!-- Options will be populated by JavaScript -->
            </div>
        </div>

        <!-- Result Page -->
        <div id="result-page" class="result-container" style="display: none;">
            <!-- Results will be populated by JavaScript -->
        </div>

        <!-- Navigation Buttons -->
        <div class="navigation-buttons" id="navigation-buttons">
            <!-- <button type="button" class="nav-btn back" id="back-btn" onclick="goBack()">
                <i class="fas fa-arrow-left"></i> ย้อนกลับ
            </button> -->
            
            <button type="button" class="nav-btn" id="next-btn" onclick="goNext()" disabled>
                ถัดไป <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

#chakra-quiz-container {
    font-family: 'Mitr', sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px;
}

.mobile-container {
    max-width: 400px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    min-height: 95vh;
    display: flex;
    flex-direction: column;
}

.header {
    background: #ffffff;
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.back-btn, .close-btn {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #6b7280;
    position: absolute;
    left: 20px;
}

.logo {
    font-size: 24px;
    font-weight: 500;
    color: #28496F;
}

.progress-bar {
    height: 4px;
    background: #ECECEC;
    position: relative;
}

.progress-fill {
    height: 100%;
    background: #FFD966;
    transition: width 0.3s ease;
    width: 14.28%;
}

.content {
    padding: 40px 20px 20px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.question-title {
    font-size: 20px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 40px;
    line-height: 1.3;
}

.options {
    display: flex;
    flex-direction: column;
    gap: 15px;
    flex: 1;
}

.option {
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 15px;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 15px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    color: inherit;
    position: relative;
    margin: 10px 0px;
}

.option:hover {
    background: #f3f4f6;
    border-color: #28496F;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.option.selected {
    /* background: #28496F; */
    border-color: #28496F;
    color: #28496F;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 73, 111, 0.3);
}

.option-text {
    font-size: 16px;
    font-weight: 400;
    color: inherit;
}

.navigation-buttons {
    padding: 20px;
    border-top: 1px solid #e5e7eb;
    background: white;
    display: flex;
    gap: 15px;
    justify-content: space-between;
}

.nav-btn {
    flex: 1;
    background: #28496F;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 400;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Mitr', sans-serif;
}

.nav-btn:hover {
    background: #1e3a5f;
    transform: translateY(-2px);
}

.nav-btn:disabled {
    background: #d1d5db;
    color: #9ca3af;
    cursor: not-allowed;
    transform: none;
}

.nav-btn.back {
    background: #6b7280;
}

.nav-btn.back:hover {
    background: #4b5563;
}

.result-container {
    text-align: center;
    padding: 20px;
}

.result-emoji {
    font-size: 80px;
    margin-bottom: 20px;
}

.result-title {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 15px;
}

.result-message {
    font-size: 18px;
    color: #6b7280;
    margin-bottom: 40px;
    line-height: 1.5;
}

.restart-btn {
    background: #28496F;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 15px 30px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    font-family: 'Mitr', sans-serif !important;
    margin-bottom: 10px;
}

.sendemail-btn {
    background: #28496F;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 15px 30px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    font-family: 'Mitr', sans-serif !important;
    margin-bottom: 10px;
}
.full-btn {
    background: #fff;
    border: 1px solid #28496F;
    color: #28496F;
    /* border: none; */
    border-radius: 12px;
    padding: 12px 72px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease;
    font-family: 'Mitr', sans-serif !important;
}

.question-counter {
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 20px;
}

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-modal {
            background: #f5f5f5;
            padding: 40px 60px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            max-width: 300px;
            width: 90%;
        }

        .loading-text {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        /* Spinner Animation */
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e0e0e0;
            border-top: 4px solid #28496F;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .msg {
            margin-top: 15px;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            display: none;
        }

        .msg.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .msg.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
// Quiz data organized by sections (3 questions per section)
const quizData = [
    // Section 1: จักระที่ 1 – มูลาธาร (Muladhara)
    {
        id: 1,
        section: 1,
        sectionName: 'มูลาธาร (Muladhara)',
        question: 'คุณรู้สึกอย่างไรกับความมั่นคง ความอยู่รอด และพื้นฐานชีวิตของคุณตอนนี้?',
        options: [
            { text: '😣 ฉันรู้สึกไม่มั่นคง มีความกลัวอยู่ลึก ๆ เกี่ยวกับเรื่องเงิน สุขภาพ หรืออนาคต', value: 1 },
            { text: '😓 ฉันยังรู้สึกเปราะบางกับชีวิตพื้นฐาน แต่กำลังพยายามสร้างความมั่นคงขึ้นเรื่อย ๆ', value: 2 },
            { text: '🙂 ฉันรู้สึกว่าชีวิตมีความมั่นคงในระดับหนึ่ง และสามารถวางใจในเส้นทางของตัวเอง', value: 3 },
            { text: '🤗 ฉันรู้สึกมั่นคงทั้งในด้านกายภาพและภายใน มีฐานชีวิตที่พอใจ', value: 4 },
            { text: '🤔 ฉันให้ความสำคัญกับความมั่นคงมาก อาจพึ่งความแน่นอนเพื่อให้รู้สึกปลอดภัย', value: 5 }
        ]
    },
    {
        id: 2,
        section: 1,
        sectionName: 'มูลาธาร (Muladhara)',
        question: 'คุณจัดการกับเรื่องพื้นฐาน เช่น เงิน สุขภาพ หรือที่อยู่อาศัยอย่างไร?',
        options: [
            { text: '😣 ฉันรู้สึกไม่พร้อมจะรับมือกับเรื่องเหล่านี้ และบางครั้งเลี่ยงที่จะคิดถึงมัน', value: 1 },
            { text: '😓 ฉันพยายามดูแลสิ่งพื้นฐาน แต่ยังมีจุดที่ไม่สม่ำเสมอ หรือขาดวินัยบ้าง', value: 2 },
            { text: '🙂 ฉันเริ่มจัดการชีวิตพื้นฐานได้ดีขึ้น และรู้ว่าการดูแลสิ่งเหล่านี้คือการดูแลตัวเอง', value: 3 },
            { text: '🤗 ฉันดูแลเรื่องพื้นฐานด้วยความตั้งใจ สม่ำเสมอ และไม่ปล่อยให้หลุดมือ', value: 4 },
            { text: '🤔 ฉันใส่ใจเรื่องเหล่านี้มาก และบางครั้งอาจรู้สึกไม่สบายใจหากควบคุมไม่ได้', value: 5 }
        ]
    },
    {
        id: 3,
        section: 1,
        sectionName: 'มูลาธาร (Muladhara)',
        question: 'คุณรู้สึกอย่างไรกับร่างกายของตนเอง และการอยู่ในร่างกายนี้ในชีวิตประจำวัน?',
        options: [
            { text: '😣 ฉันรู้สึกห่างเหินจากร่างกาย ไม่ค่อยรับรู้ หรือไม่รู้จะดูแลมันอย่างไร', value: 1 },
            { text: '😓 ฉันกำลังเรียนรู้ที่จะเชื่อมโยงกับร่างกาย แม้บางครั้งยังไม่เข้าใจมันนัก', value: 2 },
            { text: '🙂 ฉันเริ่มรับฟังร่างกายมากขึ้น และเห็นว่าร่างกายคือส่วนหนึ่งของการดูแลจิตใจ', value: 3 },
            { text: '🤗 ฉันอยู่กับร่างกายได้อย่างสบาย และรู้สึกเป็นหนึ่งเดียวกับโลกทางกายภาพ', value: 4 },
            { text: '🤔 ฉันดูแลร่างกายอย่างเคร่งครัด และบางครั้งอาจกังวลกับรูปลักษณ์หรือความเปลี่ยนแปลง', value: 5 }
        ]
    },
 
    
    // Section 2: จักระที่ 2 - สวาธิษฐาน (Svadhisthana)
    {
        id: 4,
        section: 2,
        sectionName: 'สวาธิษฐาน (Svadhisthana)',
        question: 'คุณรู้สึกอย่างไรกับอารมณ์ ความรู้สึก และความสัมพันธ์ในชีวิตตอนนี้?',
        options: [
            { text: '😣 ฉันรู้สึกห่างเหินจากความรู้สึก หรือไม่แน่ใจว่าอารมณ์ของฉันคืออะไร', value: 1 },
            { text: '😓 ฉันเริ่มสังเกตอารมณ์ได้มากขึ้น แม้จะยังมีความสับสนหรือเปราะบาง', value: 2 },
            { text: '🙂 ฉันรู้จักความรู้สึกของตน และเริ่มสร้างความสุขจากสิ่งเล็ก ๆ ในชีวิต', value: 3 },
            { text: '🤗 ฉันเปิดใจรับอารมณ์อย่างเป็นธรรมชาติ และรู้สึกเชื่อมโยงกับผู้อื่นได้ดี', value: 4 },
            { text: '🤔 ฉันรับรู้อารมณ์ได้ชัดเจน แต่บางครั้งก็อ่อนไหวหรือตอบสนองเร็วกว่าที่ตั้งใจ', value: 5 }
        ]
    },
    {
        id: 5,
        section: 2,
        sectionName: 'สวาธิษฐาน (Svadhisthana)',
        question: 'คุณแสดงอารมณ์ของคุณออกมาอย่างไรกับผู้อื่นหรือในชีวิตประจำวัน?',
        options: [
            { text: '😣 ฉันมักเก็บอารมณ์ไว้ ไม่แน่ใจว่าจะสื่อสารความรู้สึกออกมายังไง', value: 1 },
            { text: '😓 ฉันเริ่มกล้าสื่อสารมากขึ้น แม้ยังรู้สึกลังเลหรือกลัวจะกระทบใจผู้อื่น', value: 2 },
            { text: '🙂 ฉันแสดงอารมณ์ด้วยความเคารพต่อตนเองและคนรอบข้าง', value: 3 },
            { text: '🤗 ฉันสื่อสารอารมณ์อย่างสร้างสรรค์ และใช้มันเป็นสะพานเชื่อมสัมพันธ์', value: 4 },
            { text: '🤔 ฉันแสดงออกตรงไปตรงมาเสมอ แม้อาจมีบางครั้งที่รุนแรงหรือเร็วเกินเจตนา', value: 5 }
        ]
    },
    {
        id: 6,
        section: 2,
        sectionName: 'สวาธิษฐาน (Svadhisthana)',
        question: 'คุณรู้สึกว่าชีวิตคุณมีความสุข ความสร้างสรรค์ และความไหลลื่นมากเพียงใด?',
        options: [
            { text: '😣 ฉันรู้สึกขาดแรงบันดาลใจ หรือไม่แน่ใจว่าตัวเองเคยสนุกกับชีวิตตอนไหน', value: 1 },
            { text: '😓 ฉันพยายามเปิดรับความสุข แต่ยังรู้สึกติดขัดกับเรื่องเดิม ๆ', value: 2 },
            { text: '🙂 ฉันเริ่มกลับมาเชื่อมกับสิ่งที่ทำให้ใจฉันไหลลื่น แม้ยังมีความไม่แน่นอน', value: 3 },
            { text: '🤗 ฉันรู้สึกเบิกบานกับสิ่งที่ทำ และมีความคิดสร้างสรรค์ไหลลื่นในชีวิตประจำวัน', value: 4 },
            { text: '🤔 ฉันเต็มไปด้วยพลังสร้างสรรค์ แต่บางครั้งอาจใช้ความสุขเพื่อกลบความรู้สึกภายใน', value: 5 }
        ]
    },


    
    // Section 3: จักระที่ 3 - มณีปุระ (Manipura)
    {
        id: 7,
        section: 3,
        sectionName: 'มณีปุระ (Manipura)',
        question: 'คุณรู้สึกอย่างไรกับพลัง ความมั่นใจ และการควบคุมชีวิตของคุณ?',
        options: [
            { text: '😣 ฉันรู้สึกไม่มั่นใจในพลังของตนเอง และบางครั้งกลัวการตัดสินใจ', value: 1 },
            { text: '😓 ฉันพยายามเรียนรู้ที่จะยืนหยัด แม้ยังรู้สึกลังเลบ้าง', value: 2 },
            { text: '🙂 ฉันเริ่มใช้พลังของตัวเองได้ดีขึ้น และเชื่อในความสามารถของตน', value: 3 },
            { text: '🤗 ฉันมั่นใจในพลังภายในของตัวเอง และสามารถแสดงออกได้อย่างกลมกลืน', value: 4 },
            { text: '🤔 ฉันมีพลังและความมั่นใจสูง แต่บางครั้งอาจเน้นควบคุมมากกว่าร่วมมือ', value: 5 }
        ]
    },
    {
        id: 8,
        section: 3,
        sectionName: 'มณีปุระ (Manipura)',
        question: 'เมื่อคุณต้องตัดสินใจหรือแสดงภาวะผู้นำ คุณตอบสนองอย่างไร?',
        options: [
            { text: '😣 ฉันมักหลีกเลี่ยงการตัดสินใจ และปล่อยให้คนอื่นเป็นผู้นำ', value: 1 },
            { text: '😓 ฉันพยายามกล้าขึ้น แม้ยังกลัวการผิดพลาด', value: 2 },
            { text: '🙂 ฉันเริ่มตัดสินใจจากความรู้สึกภายใน พร้อมรับผลของมัน', value: 3 },
            { text: '🤗 ฉันยืนหยัดในจุดยืนของตัวเอง และเปิดใจเรียนรู้จากผลลัพธ์', value: 4 },
            { text: '🤔 ฉันชัดเจนในแนวทางของตน และบางครั้งอาจตัดสินใจเร็วโดยยังไม่ฟังรอบด้าน', value: 5 }
        ]
    },
    {
        id: 9,
        section: 3,
        sectionName: 'มณีปุระ (Manipura)',
        question: 'คุณรู้สึกอย่างไรกับความสามารถในการลงมือทำสิ่งที่คุณต้องการ?',
        options: [
            { text: '😣 ฉันรู้สึกไม่มีแรงจูงใจ หรือไม่รู้จะเริ่มตรงไหน', value: 1 },
            { text: '😓 ฉันมีแรงบันดาลใจ แต่ยังขาดวินัยหรือเป้าหมายที่ชัด', value: 2 },
            { text: '🙂 ฉันเริ่มลงมือทำในสิ่งที่สำคัญกับฉัน แม้จะยังมีความไม่แน่นอน', value: 3 },
            { text: '🤗 ฉันมีความตั้งใจและลงมือทำสิ่งต่าง ๆ อย่างต่อเนื่อง', value: 4 },
            { text: '🤔 ฉันมีพลังในการลงมือทำสูง แต่บางครั้งอาจเร่งเกินไปจนขาดความละเอียดอ่อน', value: 5 }
        ]
    },

        // Section 4: จักระที่ 4 - อนาหตะ (Anahata)
    {
    id: 10,
    section: 4,
    sectionName: 'อนาหตะ (Anahata)',
    imageOnly: true,
    image: "./img/Insert-afterQ09.png"
    },
    {
        id: 11,
        section: 4,
        sectionName: 'อนาหตะ (Anahata)',
        question: 'คุณรู้สึกอย่างไรเกี่ยวกับความรัก ความสัมพันธ์ และการเชื่อมโยงกับผู้อื่น?',
        options: [
            { text: '😣 ฉันยังรู้สึกกลัวความสัมพันธ์ หรือไม่แน่ใจว่าความรักที่แท้จริงมีอยู่จริงหรือไม่', value: 1 },
            { text: '😓 ฉันต้องการเชื่อมโยงกับผู้อื่น แต่บางครั้งก็กลัวจะเจ็บปวดหรือสูญเสีย', value: 2 },
            { text: '🙂 ฉันเริ่มเปิดใจรับความสัมพันธ์ที่ปลอดภัย และให้โอกาสหัวใจได้สัมผัสความรัก', value: 3 },
            { text: '🤗 ฉันรักและเมตตาทั้งต่อตัวเองและผู้อื่นอย่างเป็นธรรมชาติ', value: 4 },
            { text: '🤔 ฉันให้ความรักอย่างเต็มที่ แม้บางครั้งยังเรียนรู้เรื่องการรักษาขอบเขตตนเองอยู่', value: 5 }
        ]
    },

    {
        id: 12,
        section: 4,
        sectionName: 'อนาหตะ (Anahata)',
        question: 'คุณรู้สึกอย่างไรเมื่อต้องอยู่กับตัวเองโดยลำพัง?',
        options: [
            { text: '😣 ฉันรู้สึกโดดเดี่ยวหรือว่างเปล่าเมื่อต้องอยู่คนเดียว', value: 1 },
            { text: '😓 ฉันอยู่กับตัวเองได้ในระดับหนึ่ง แม้ยังมีความไม่สบายใจบางครั้ง', value: 2 },
            { text: '🙂 ฉันเริ่มรู้สึกปลอดภัยเมื่ออยู่กับตัวเอง และใช้เวลานั้นดูแลหัวใจ', value: 3 },
            { text: '🤗 ฉันมีความสุขกับความสงบภายใน และใช้เวลาอยู่คนเดียวอย่างมีคุณค่า', value: 4 },
            { text: '🤔 รู้สึกดีมากเมื่อลำพัง แต่กำลังเรียนรู้ที่จะเปิดใจให้ผู้อื่นเข้ามาโดยไม่ปิดตัว', value: 5 }
        ]
    },
    {
        id: 13,
        section: 4,
        sectionName: 'อนาหตะ (Anahata)',
        question: 'คุณสามารถให้อภัยตนเองและผู้อื่นได้มากเพียงใด?',
        options: [
            { text: '😣 ฉันยังรู้สึกติดอยู่กับเรื่องเก่า ๆ และยากที่จะปล่อยใจให้อภัย', value: 1 },
            { text: '😓 ฉันกำลังฝึกให้อภัย แม้ใจยังไม่เบาเสียทีเดียว', value: 2 },
            { text: '🙂 ฉันเริ่มเข้าใจว่าแต่ละคนมีความเจ็บปวด และฉันเองก็สมควรได้รับความเมตตา', value: 3 },
            { text: '🤗 ฉันให้อภัยได้จากใจจริง และมองสิ่งที่เกิดขึ้นเป็นบทเรียนของการเติบโต', value: 4 },
            { text: '🤔 ฉันให้อภัยง่ายมาก บางครั้งจนลืมดูแลขอบเขตของตัวเอง', value: 5 }
        ]
    },


        // Section 5: จักระที่ 5 - วิศุทธะ (Vishuddha)
    {
        id: 14,
        section: 5,
        sectionName: 'วิศุทธะ (Vishuddha)',
        question: 'คุณรู้สึกอย่างไรกับการพูด ความคิด และการแสดงออกของตนเอง?',
        options: [
            { text: '😣 ฉันไม่ค่อยกล้าแสดงออก หรือรู้สึกว่าคำพูดของตนไม่มีพลัง', value: 1 },
            { text: '😓 ฉันเริ่มพูดมากขึ้น แม้ยังลังเลกลัวการเข้าใจผิดหรือความขัดแย้ง', value: 2 },
            { text: '🙂 ฉันกล้าแสดงออกในแบบที่เป็นตัวเอง พร้อมฟังคนอื่นอย่างเคารพ', value: 3 },
            { text: '🤗 ฉันสื่อสารด้วยความจริงและเมตตา ทั้งกับตนเองและคนรอบข้าง', value: 4 },
            { text: '🤔 ฉันพูดอย่างตรงไปตรงมา แม้บางครั้งต้องกลับมาทบทวนว่าเร็วหรือแรงเกินไปหรือไม่', value: 5 }
        ]
    },
    {
        id: 15,
        section: 5,
        sectionName: 'วิศุทธะ (Vishuddha)',
        question: 'คุณเปิดใจรับฟังความคิดเห็นของผู้อื่นและความจริงที่อาจขัดกับตัวเองได้มากแค่ไหน?',
        options: [
            { text: '😣 ฉันยังรู้สึกตึงเมื่อได้ยินคำวิจารณ์ หรือความเห็นที่ไม่ตรงกับฉัน', value: 1 },
            { text: '😓 ฉันพยายามฟัง แม้จะยังมีอารมณ์เกิดขึ้นในบางสถานการณ์', value: 2 },
            { text: '🙂 ฉันเปิดใจฟังแม้ไม่เห็นด้วย และพยายามเข้าใจว่าทุกคนมีมุมของตัวเอง', value: 3 },
            { text: '🤗 ฉันฟังอย่างลึกซึ้ง และสามารถเปลี่ยนแปลงได้หากเห็นสิ่งที่ดีกว่า', value: 4 },
            { text: '🤔 ฉันฟังมากจนบางครั้งลืมกลับมาถามว่าเสียงของตัวเองคืออะไร', value: 5 }
        ]
    },
    {
        id: 16,
        section: 5,
        sectionName: 'วิศุทธะ (Vishuddha)',
        question: 'คุณกล้าพูดในสิ่งที่เป็นความจริงของตัวเองได้แค่ไหน?',
        options: [
            { text: '😣 ฉันมักเงียบ หรือกลัวว่าหากพูดออกไปจะถูกปฏิเสธ', value: 1 },
            { text: '😓 ฉันพยายามพูดสิ่งที่เป็นตัวเอง แต่บางครั้งยังรู้สึกเกรงใจหรือกลัวผลกระทบ', value: 2 },
            { text: '🙂 ฉันพูดความจริงในจังหวะที่เหมาะสม และพยายามสื่อสารอย่างตรงไปตรงมา', value: 3 },
            { text: '🤗 ฉันพูดอย่างอิสระ โดยไม่กดทับตนเอง และรับผิดชอบคำพูดได้', value: 4 },
            { text: '🤔 ฉันพูดชัดเจนและตรงมาก แม้บางครั้งต้องฝึกเลือกจังหวะให้กลมกลืนกับผู้อื่น', value: 5 }
        ]
    },

    // Section 6: จักระที่ 6 - วิศุทธะ (Vishuddha)
    {
        id: 17,
        section: 6,
        sectionName: 'อัชญา (Ajna)',
        question: 'คุณรู้สึกอย่างไรกับญาณทัศนะ ความเข้าใจ และการตัดสินใจจากภายใน?',
        options: [
            { text: '😣 ฉันยังไม่แน่ใจว่าความคิดไหนคือเสียงจากภายใน หรือมาจากความกลัว', value: 1 },
            { text: '😓 ฉันเริ่มฟังเสียงภายใน แม้ยังมีความลังเลและไม่แน่ใจว่าเชื่อได้แค่ไหน', value: 2 },
            { text: '🙂 ฉันใช้ทั้งญาณและเหตุผลประกอบกันในการตัดสินใจ', value: 3 },
            { text: '🤗 ฉันฟังเสียงภายในได้ชัดเจน และรู้ว่าควรเชื่อในจังหวะของจักรวาล', value: 4 },
            { text: '🤔 ฉันเชื่อในญาณมาก แต่บางครั้งอาจไม่ได้นำมาเชื่อมกับโลกแห่งความจริง', value: 5 }
        ]
    },
    {
        id: 18,
        section: 6,
        sectionName: 'อัชญา (Ajna)',
        question: 'คุณมองภาพอนาคตของตนเองได้ชัดเจนเพียงใด?',
        options: [
            { text: '😣 ฉันยังไม่เห็นภาพทิศทางในชีวิต และรู้สึกหลงอยู่กับความไม่แน่นอน', value: 1 },
            { text: '😓 ฉันเริ่มมีเป้าหมาย แต่ยังไม่ชัดว่าควรเริ่มที่ตรงไหน', value: 2 },
            { text: '🙂 ฉันเริ่มเห็นเส้นทางและวางแผนอย่างค่อยเป็นค่อยไป', value: 3 },
            { text: '🤗 ฉันมีวิสัยทัศน์ที่ชัดเจน และสามารถพาตัวเองก้าวไปอย่างมั่นคง', value: 4 },
            { text: '🤔 ฉันมีวิสัยทัศน์กว้าง แต่บางครั้งก็ละเลยปัจจุบันเพราะหมกมุ่นกับอนาคต', value: 5 }
        ]
    },
    {
        id: 19,
        section: 6,
        sectionName: 'อัชญา (Ajna)',
        question: 'เมื่อคุณมีความรู้สึกหรือภาพในใจเกี่ยวกับบางสิ่ง คุณมักตอบสนองอย่างไร?',
        options: [
            { text: '😣 ฉันมักละเลยความรู้สึกแบบนั้น เพราะกลัวว่าจะคิดไปเอง', value: 1 },
            { text: '😓 ฉันเริ่มให้ความสนใจกับลางสังหรณ์ แม้ยังไม่รู้ว่าจะเชื่อดีไหม', value: 2 },
            { text: '🙂 ฉันรับรู้สิ่งเหล่านี้ด้วยใจเปิด และใช้เป็นแนวทางร่วมกับเหตุผล', value: 3 },
            { text: '🤗 ฉันเคารพสัญชาตญาณและจินตภาพที่เกิดขึ้น และนำมาปรับใช้อย่างมีสติ', value: 4 },
            { text: '🤔 ฉันดื่มด่ำกับญาณภายในมาก จนบางครั้งลืมเช็กความเป็นจริงรอบตัว', value: 5 }
        ]
    },
    {
    id: 20,
    section: 4,
    sectionName: 'อนาหตะ (Anahata)',
    imageOnly: true,
    image: "/img/Insert-afterQ18.png"
    },


    // Section 7: จักระที่ 7 - วิศุทธะ (Vishuddha)
    {
        id: 21,
        section: 7,
        sectionName: 'สหัสราระ (Sahasrara)',
        question: 'คุณรู้สึกอย่างไรกับการเชื่อมต่อกับสิ่งที่สูงกว่าตัวตน — เช่น จักรวาล หรือสติรู้เหนืออัตตา?',
        options: [
            { text: '😣 ฉันยังรู้สึกแยกขาด ไม่แน่ใจว่าสิ่งศักดิ์สิทธิ์หรือพลังที่สูงกว่านั้นมีอยู่จริง', value: 1 },
            { text: '😓 ฉันอยากรู้สึกเชื่อมต่อกับสิ่งที่สูงกว่า แต่บางครั้งก็ยังสับสนระหว่างความเชื่อกับจินตนาการ', value: 2 },
            { text: '🙂 ฉันเริ่มสังเกตพลังบางอย่างที่นำทาง และเปิดใจรับสิ่งที่ลึกซึ้งกว่าเหตุผล', value: 3 },
            { text: '🤗 ฉันรู้สึกถึงการเชื่อมโยงกับจักรวาล และไว้วางใจในพลังแห่งการนำ', value: 4 },
            { text: '🤔 ฉันสัมผัสสภาวะนิ่งสงบลึกซึ้ง แม้ยังต้องฝึกอยู่กับโลกอย่างสมดุล', value: 5 }
        ]
    },
    {
        id: 22,
        section: 7,
        sectionName: 'สหัสราระ (Sahasrara)',
        question: 'คุณสามารถอยู่กับความเงียบ หรือสภาวะ ‘ไม่มีอะไร’ ได้มากเพียงใด?',
        options: [
            { text: '😣 ความเงียบทำให้ฉันรู้สึกไม่สบายใจ ต้องหาอะไรมาเบี่ยงเบนตลอด', value: 1 },
            { text: '😓 ฉันพยายามอยู่กับความเงียบ แม้ใจยังว้าวุ่นหรือคิดฟุ้ง', value: 2 },
            { text: '🙂 ฉันฝึกอยู่ในความสงบสั้น ๆ และเริ่มรู้สึกผ่อนคลาย', value: 3 },
            { text: '🤗 ฉันรู้สึกเบาสบายเมื่ออยู่ในความนิ่ง และรับรู้ความจริงจากภายใน', value: 4 },
            { text: '🤔 ฉันเพลิดเพลินกับความว่างลึก ๆ และอยู่กับมันได้อย่างเป็นธรรมชาติ แม้บางครั้งอาจต้องกลับมาเชื่อมกับภายนอกบ้าง', value: 5 }
        ]
    },
    {
        id: 23,
        section: 7,
        sectionName: 'สหัสราระ (Sahasrara)',
        question: 'คุณไว้วางใจการนำทางจากพลังที่สูงกว่าตนเองหรือไม่?',
        options: [
            { text: '😣 ฉันยังไม่แน่ใจว่าจะมีพลังใดที่นำทางได้ดีไปกว่าความคิดของฉันเอง', value: 1 },
            { text: '😓 ฉันเริ่มสังเกตบางเหตุการณ์ที่ดูเหมือนมีความหมายลึกซึ้ง แต่ยังไม่แน่ใจว่าควรศรัทธาแค่ไหน', value: 2 },
            { text: '🙂 ฉันเปิดใจรับสัญญาณและเรียนรู้ที่จะฟังด้วยความสงบ', value: 3 },
            { text: '🤗 ฉันศรัทธาและปล่อยให้พลังจากเบื้องบนชี้ทาง โดยไม่ต้องควบคุมทุกอย่าง', value: 4 },
            { text: '🤔 ฉันมักตามเสียงภายในที่ลึกมากจนลืมใช้สามัญสำนึกในบางครั้ง — ฉันกำลังเรียนรู้ที่จะสมดุลระหว่าง “นำทาง” กับ “การลงมือ”', value: 5 }
        ]
    },

    // Section 8: จักระที่ 8 - ดวงดาววิญญาณ (Soul Star Chakra)
    {
        id: 24,
        section: 8,
        sectionName: 'ดวงดาววิญญาณ (Soul Star Chakra)',
        question: 'คุณรู้สึกอย่างไรกับพันธะเก่า บทเรียนในอดีต และเส้นทางของวิญญาณ?',
        options: [
            { text: '😣 ฉันยังเจ็บปวดกับอดีต หรือรู้สึกติดอยู่กับความรู้สึกบางอย่างที่ปลดไม่ออก', value: 1 },
            { text: '😓 ฉันอยากเข้าใจสิ่งที่เคยเกิดขึ้น แต่ยังไม่เห็นภาพรวมของชีวิตที่ชัดเจน', value: 2 },
            { text: '🙂 ฉันเริ่มเข้าใจว่าเหตุการณ์ในอดีตมีบทเรียน และเปิดใจเรียนรู้มัน', value: 3 },
            { text: '🤗 ฉันเข้าใจว่าทุกเหตุการณ์มีจุดหมายลึกซึ้ง และใช้สิ่งเหล่านั้นเป็นพลังส่งต่อ', value: 4 },
            { text: '🤔 ฉันปล่อยวางเรื่องเก่า ๆ ได้ง่ายมาก แม้ยังระลึกถึงเพื่อนำมาสร้างปัจจุบันให้ดี', value: 5 }
        ]
    },
    {
        id: 25,
        section: 8,
        sectionName: 'ดวงดาววิญญาณ (Soul Star Chakra)',
        question: 'คุณรู้สึกว่าเข้าใจ ‘จุดประสงค์ของวิญญาณ’ ตัวเองมากน้อยเพียงใด?',
        options: [
            { text: '😣 ฉันยังไม่รู้เลยว่าฉันเกิดมาเพื่ออะไร หรือชีวิตนี้มีความหมายอย่างไร', value: 1 },
            { text: '😓 ฉันพยายามค้นหาความหมาย แม้ยังไม่ชัดเจนนัก', value: 2 },
            { text: '🙂 ฉันเริ่มรู้ว่ามีบางสิ่งภายในฉันที่เรียกร้องให้แสดงออก แม้ยังคลุมเครือ', value: 3 },
            { text: '🤗 ฉันรู้สึกว่าเส้นทางของฉันเชื่อมโยงกับจุดหมายลึกของจิตวิญญาณ', value: 4 },
            { text: '🤔 ฉันดำเนินตามเสียงข้างใน แม้ยังต้องเรียนรู้ที่จะไม่ลืมความเป็นจริงรอบตัว', value: 5 }
        ]
    },
    {
        id: 26,
        section: 8,
        sectionName: 'ดวงดาววิญญาณ (Soul Star Chakra)',
        question: 'คุณสามารถให้อภัย ปล่อยวาง และเรียนรู้จากอดีตได้มากเพียงใด?',
        options: [
            { text: '😣 ฉันยังรู้สึกติดค้าง โกรธ หรือเสียใจกับสิ่งที่เกิดขึ้นในอดีต', value: 1 },
            { text: '😓 ฉันอยากให้อภัย แต่ยังไม่รู้ว่าจะเริ่มจากตรงไหน', value: 2 },
            { text: '🙂 ฉันเริ่มให้อภัยและเข้าใจสิ่งที่เกิดขึ้น แม้ยังมีบางจุดต้องเยียวยา', value: 3 },
            { text: '🤗 ฉันปลดพันธะทางใจอย่างอิสระ และใช้ทุกบทเรียนเป็นพลังในการเปลี่ยนแปลง', value: 4 },
            { text: '🤔 ฉันให้อภัยง่าย แต่ต้องระวังไม่หลีกเลี่ยงการเผชิญหน้ากับความจริงที่ยังค้างคา”', value: 5 }
        ]
    },


    // Section 0: จักระที่ 0 - ดวงดาวพื้นพิภพ (Earth Star Chakra)
    {
        id: 27,
        section: 9,
        sectionName: 'ดวงดาวพื้นพิภพ (Earth Star Chakra)',
        question: 'คุณรู้สึกเชื่อมโยงกับโลก ผืนดิน และรากของชีวิตเพียงใด?',
        options: [
            { text: '😣 ฉันมักรู้สึกหลุดลอย วุ่นวาย หรือแปลกแยกจากโลกและร่างกาย', value: 1 },
            { text: '😓 ฉันเริ่มรู้ว่าต้องกลับสู่ธรรมชาติ แต่ยังไม่แน่ใจว่าจะเชื่อมอย่างไร', value: 2 },
            { text: '🙂 ฉันมีช่วงเวลาที่รู้สึกอยู่กับโลก รู้สึกสงบเมื่ออยู่กับธรรมชาติ', value: 3 },
            { text: '🤗 ฉันรู้สึกรากแน่น มั่นคง และมีพลังเมื่อเชื่อมกับธรรมชาติ', value: 4 },
            { text: '🤔 ฉันอยู่กับโลกได้ดี แต่บางครั้งอาจยึดติดกับความมั่นคงมากเกินไป จนไม่ยืดหยุ่น', value: 5 }
        ]
    },
    {
        id: 28,
        section: 9,
        sectionName: 'ดวงดาวพื้นพิภพ (Earth Star Chakra)',
        question: 'เมื่อรู้สึกสับสนหรือเหนื่อยล้า คุณใช้วิธีใดในการกลับมาสู่ความมั่นคง?',
        options: [
            { text: '😣 ฉันหลีกหนี หรือรู้สึกเหมือนไม่รู้จะจับอะไรไว้ได้เลย', value: 1 },
            { text: '😓 ฉันเริ่มมองหาวิธี แต่ยังหาที่ยึดได้ไม่แน่นอน', value: 2 },
            { text: '🙂 ฉันใช้ธรรมชาติหรือกิจกรรมเรียบง่ายช่วยให้ใจกลับมา', value: 3 },
            { text: '🤗 ฉันมีวิธีชัดเจน เช่น สมาธิ เดินเท้าเปล่า หรืออยู่กับธรรมชาติ ทำให้ใจสงบได้เร็ว', value: 4 },
            { text: '🤔 ฉันมีระบบที่แน่นอน แม้บางครั้งอาจติดกรอบจนไม่กล้าลองวิธีใหม่', value: 5 }
        ]
    },
    {
        id: 29,
        section: 9,
        sectionName: 'ดวงดาวพื้นพิภพ (Earth Star Chakra)',
        question: 'คุณรู้สึกว่าตนเองมีรากที่ลึกเชื่อมกับครอบครัว วิถีชีวิต หรือโลกใบนี้หรือไม่?',
        options: [
            { text: '😣 ฉันรู้สึกแยกขาดจากบ้าน ครอบครัว หรือรากเหง้าของตนเอง', value: 1 },
            { text: '😓 ฉันกำลังพยายามเชื่อมกับรากเก่า แม้ยังรู้สึกแปลกแยกในบางช่วง', value: 2 },
            { text: '🙂 ฉันเริ่มรับรู้และเคารพบรรพบุรุษหรือวัฒนธรรมที่ฉันเติบโตมา', value: 3 },
            { text: '🤗 ฉันเชื่อมโยงกับรากทางกายและพลังบรรพบุรุษอย่างลึกซึ้ง', value: 4 },
            { text: '🤔 ฉันรู้สึกผูกพันแน่นแฟ้นกับรากเหง้า แม้ยังเรียนรู้ที่จะไม่จำกัดตัวเองไว้ในอดีต”', value: 5 }
        ]
    },
        {
    id: 30,
    section: 4,
    sectionName: 'อนาหตะ (Anahata)',
    imageOnly: true,
    image: "/img/Insert-afterQ27.png"
    },




    
    


    
];

// Quiz state
let currentQuestionIndex = 0;
let answers = [];

// Initialize quiz
function initQuiz() {
    showQuestion();
    updateProgress();
    updateNavigationButtons();
}

// Show current question
function showQuestion() {
    const question = quizData[currentQuestionIndex];
    const questionCounter = document.querySelector('.question-counter');
    const questionPage = document.getElementById('question-page');
    
    // Check if this is an image-only slide (no question, no options)
    if (question.imageOnly) {
        // Set padding to 0 for image slides
        if (questionPage) {
            questionPage.style.padding = '0';
        }
        
        // Hide question counter for image slides
        if (questionCounter) {
            questionCounter.style.display = 'none';
        }
        
        // Show only image
        const questionTitle = document.getElementById('question-title');
        questionTitle.innerHTML = `<img src="${question.image}" alt="Slide Image" style="max-width: 100%; height: auto; border-radius: 8px; margin: 20px 0;">`;
        
        // Hide options container
        const optionsContainer = document.getElementById('options-container');
        optionsContainer.innerHTML = '';
        optionsContainer.style.display = 'none';
        
        return; // Exit function early
    }
    
    // Restore original padding for normal questions
    if (questionPage) {
        questionPage.style.padding = ''; // Reset to CSS default
    }
    
    // Show question counter for normal questions
    if (questionCounter) {
        questionCounter.style.display = 'block';
    }
    
    // Update question counter
    document.getElementById('current-question').textContent = currentQuestionIndex + 1;
    document.getElementById('total-questions').textContent = quizData.length;
    
    // Show options container for normal questions
    const optionsContainer = document.getElementById('options-container');
    optionsContainer.style.display = 'block';
    
    // Check if this question should show an image instead of text
    if (question.image) {
        // Hide question text and show image
        const questionTitle = document.getElementById('question-title');
        questionTitle.innerHTML = `<img src="${question.image}" alt="Question Image" style="max-width: 100%; height: auto; border-radius: 8px; margin: 10px 0;">`;
    } else {
        // Show normal question text
        document.getElementById('question-title').textContent = question.question;
    }
         
    optionsContainer.innerHTML = '';
         
    question.options.forEach((option, index) => {
        const optionDiv = document.createElement('div');
        optionDiv.className = 'option';
        optionDiv.innerHTML = `<div class="option-text">${option.text}</div>`;
        optionDiv.onclick = () => selectOption(option.value, optionDiv);
                 
        // Restore selection if exists
        if (answers[currentQuestionIndex] === option.value) {
            optionDiv.classList.add('selected');
        }
                 
        optionsContainer.appendChild(optionDiv);
    });
}

// ตัวอย่างการปรับ quizData สำหรับข้อที่ 8 ที่เป็นภาพอย่างเดียว
// ไม่มีคำถาม ไม่มีตัวเลือก แค่แสดงภาพ
/*
quizData[7] = { // index 7 = ข้อที่ 8
    imageOnly: true, // บอกว่าเป็นสไลด์ภาพอย่างเดียว
    image: "path/to/your/image.jpg" // URL หรือ path ของภาพ
    // ไม่ต้องมี options, question, หรือ correct
};

// ตัวอย่างคำถามปกติที่มีภาพ
quizData[8] = { // ข้อถัดไป
    question: "คำถามข้อที่ 9",
    options: [
        { text: "ตัวเลือก A", value: "a" },
        { text: "ตัวเลือก B", value: "b" },
        { text: "ตัวเลือก C", value: "c" },
        { text: "ตัวเลือก D", value: "d" }
    ],
    correct: "a"
};
*/

// ตัวอย่างการปรับ quizData สำหรับข้อที่ 8 ที่เป็นภาพอย่างเดียว
// ไม่มีคำถาม ไม่มีตัวเลือก แค่แสดงภาพ
/*
quizData[7] = { // index 7 = ข้อที่ 8
    imageOnly: true, // บอกว่าเป็นสไลด์ภาพอย่างเดียว
    image: "path/to/your/image.jpg" // URL หรือ path ของภาพ
    // ไม่ต้องมี options, question, หรือ correct
};

// ตัวอย่างคำถามปกติที่มีภาพ
quizData[8] = { // ข้อถัดไป
    question: "คำถามข้อที่ 9",
    options: [
        { text: "ตัวเลือก A", value: "a" },
        { text: "ตัวเลือก B", value: "b" },
        { text: "ตัวเลือก C", value: "c" },
        { text: "ตัวเลือก D", value: "d" }
    ],
    correct: "a"
};
*/
// ตัวอย่างการปรับ quizData สำหรับข้อที่ 8 ที่เป็นภาพอย่างเดียว
// ไม่มีคำถาม ไม่มีตัวเลือก แค่แสดงภาพ
/*
quizData[7] = { // index 7 = ข้อที่ 8
    imageOnly: true, // บอกว่าเป็นสไลด์ภาพอย่างเดียว
    image: "path/to/your/image.jpg" // URL หรือ path ของภาพ
    // ไม่ต้องมี options, question, หรือ correct
};

// ตัวอย่างคำถามปกติที่มีภาพ
quizData[8] = { // ข้อถัดไป
    question: "คำถามข้อที่ 9",
    options: [
        { text: "ตัวเลือก A", value: "a" },
        { text: "ตัวเลือก B", value: "b" },
        { text: "ตัวเลือก C", value: "c" },
        { text: "ตัวเลือก D", value: "d" }
    ],
    correct: "a"
};
*/

// Select option
function selectOption(value, element) {
    // Remove selected class from all options
    document.querySelectorAll('.option').forEach(opt => {
        opt.classList.remove('selected');
    });
    
    // Add selected class to clicked option
    element.classList.add('selected');
    
    // Save answer
    answers[currentQuestionIndex] = value;
    
    // Enable next button
    document.getElementById('next-btn').disabled = false;
}

// Go to next question
function goNext() {
    const currentQuestion = quizData[currentQuestionIndex];
    
    // ถ้าเป็นสไลด์ภาพ ให้ไปต่อได้เลย ไม่ต้องตรวจสอบคำตอบ
    if (currentQuestion.imageOnly) {
        // ไปข้อถัดไป
        if (currentQuestionIndex < quizData.length - 1) {
            currentQuestionIndex++;
            showQuestion();
            updateProgress();
            updateNavigationButtons();
        } else {
            showResult();
        }
        return;
    }
    
    // ถ้าเป็นคำถามปกติ ต้องตรวจสอบว่าตอบแล้วหรือยัง
    if (answers[currentQuestionIndex] === undefined) {
        return;
    }
         
    if (currentQuestionIndex < quizData.length - 1) {
        currentQuestionIndex++;
        showQuestion();
        updateProgress();
        updateNavigationButtons();
    } else {
        showResult();
    }
}

// ฟังก์ชันเสริม: อัพเดทสถานะปุ่ม Next
function updateNavigationButtons() {
    const nextButton = document.getElementById('next-button'); // หรือ ID ที่ใช้จริง
    const prevButton = document.getElementById('prev-button'); // หรือ ID ที่ใช้จริง
    const currentQuestion = quizData[currentQuestionIndex];
    
    // ปุ่ม Previous
    if (prevButton) {
        prevButton.disabled = currentQuestionIndex === 0;
    }
    
    // ปุ่ม Next
    if (nextButton) {
        if (currentQuestion.imageOnly) {
            // สไลด์ภาพ - เปิดใช้งานปุ่ม Next เสมอ
            nextButton.disabled = false;
            nextButton.textContent = currentQuestionIndex === quizData.length - 1 ? 'ดูผลลัพธ์' : 'ถัดไป';
        } else {
            // คำถามปกติ - ต้องตอบก่อน
            const hasAnswer = answers[currentQuestionIndex] !== undefined;
            nextButton.disabled = !hasAnswer;
            nextButton.textContent = currentQuestionIndex === quizData.length - 1 ? 'ดูผลลัพธ์' : 'ถัดไป';
        }
    }
}

// ฟังก์ชัน goPrevious ที่รองรับสไลด์ภาพ
function goPrevious() {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        showQuestion();
        updateProgress();
        updateNavigationButtons();
    }
}

// อัพเดท progress bar ให้รองรับสไลด์ภาพ
function updateProgress() {
    const progressBar = document.getElementById('progress-bar'); // หรือ ID ที่ใช้จริง
    
    if (progressBar) {
        const progress = ((currentQuestionIndex + 1) / quizData.length) * 100;
        progressBar.style.width = progress + '%';
    }
    
    // อัพเดทตัวเลขข้อ
    const currentQuestionDisplay = document.getElementById('current-question');
    if (currentQuestionDisplay) {
        currentQuestionDisplay.textContent = currentQuestionIndex + 1;
    }
}

// Go back
function goBack() {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        showQuestion();
        updateProgress();
        updateNavigationButtons();
    }
}

// Update progress bar
function updateProgress() {
    const progress = ((currentQuestionIndex + 1) / quizData.length) * 100;
    document.getElementById('progress-fill').style.width = progress + '%';
}

// Update navigation buttons
function updateNavigationButtons() {
    const backBtn = document.getElementById('back-btn');
    const nextBtn = document.getElementById('next-btn');
    
    backBtn.disabled = currentQuestionIndex === 0;
    nextBtn.disabled = answers[currentQuestionIndex] === undefined;
    
    if (currentQuestionIndex === quizData.length - 1) {
        nextBtn.innerHTML = 'เสร็จสิ้น <i class="fas fa-check"></i>';
    } else {
        nextBtn.innerHTML = 'ถัดไป <i class="fas fa-arrow-right"></i>';
    }
}

// Calculate and show result
function showResult() {
    // Group answers by sections (3 questions per section)
    const sections = [];
    const sectionsData = [];
    
    // Group quiz data by sections - เฉพาะคำถามที่มี options เท่านั้น
    const sectionMap = {};
    quizData.forEach(question => {
        // ข้ามสไลด์ภาพที่ไม่มี options
        if (question.imageOnly || !question.options) {
            return;
        }
        
        if (!sectionMap[question.section]) {
            sectionMap[question.section] = {
                name: question.sectionName,
                questions: []
            };
        }
        sectionMap[question.section].questions.push(question);
    });
    
    // Calculate for each section
    for (let sectionNum = 1; sectionNum <= Object.keys(sectionMap).length; sectionNum++) {
        const sectionQuestions = sectionMap[sectionNum].questions;
        const sectionAnswers = [];
        
        // Get answers for this section
        sectionQuestions.forEach(question => {
            const answerIndex = question.id - 1;
            if (answers[answerIndex] !== undefined) {
                sectionAnswers.push(answers[answerIndex]);
            }
        });
        
        // ตรวจสอบว่ามีคำตอบครบ 3 ข้อหรือไม่
        if (sectionAnswers.length === 3) {
            const Q1 = sectionAnswers[0];
            const Q2 = sectionAnswers[1];
            const Q3 = sectionAnswers[2];
            
            // Calculate AVG
            const AVG = (Q1 + Q2 + Q3) / 3;
            
            // Calculate VAR
            const VAR = ((Math.pow(Q1 - AVG, 2) + Math.pow(Q2 - AVG, 2) + Math.pow(Q3 - AVG, 2)) / 3);
            
            // Check if any score >= 5
            const hasHighScore = sectionAnswers.some(score => score >= 5);
            
            // Determine category
            const category = determineCategory(AVG, VAR, hasHighScore, sectionAnswers, sectionNum);
            
            sectionsData.push({
                section: sectionNum,
                name: sectionMap[sectionNum].name,
                scores: { Q1, Q2, Q3 },
                AVG: AVG,
                VAR: VAR,
                category: category
            });
        }
    }
    
    displayResults(sectionsData);
}

// วิธีการตั้งค่าข้อมูลที่แนะนำ:
/*
ตัวอย่างข้อมูลที่ถูกต้อง:

// คำถามข้อที่ 7 (คำถามจริง)
{
    id: 7,
    section: 3,
    sectionName: 'มณีปุระ (Manipura)',
    question: 'คำถามที่ 7...',
    options: [...]
},

// ข้อที่ 8 (สไลด์ภาพ) - ใช้ id ที่ไม่ซ้ำ
{
    id: 8,
    section: 3, // หรือ section ใหม่
    sectionName: 'อนาหตะ (Anahata)',
    imageOnly: true,
    image: "images/anahata.jpg"
    // ไม่มี options - จะถูกข้ามในการคำนวณ
},

// คำถามข้อที่ 9 (คำถามจริงต่อ)
{
    id: 9,
    section: 4,
    sectionName: 'อนาหตะ (Anahata)',
    question: 'คำถามที่ 9...',
    options: [...]
}
*/

// ฟังก์ชันเสริม: ตรวจสอบความสมบูรณ์ของข้อมูล
function validateQuizData() {
    const questionsBySections = {};
    
    quizData.forEach(item => {
        if (item.imageOnly) return; // ข้ามสไลด์ภาพ
        
        if (!questionsBySections[item.section]) {
            questionsBySections[item.section] = [];
        }
        questionsBySections[item.section].push(item);
    });
    
    // ตรวจสอบว่าแต่ละ section มี 3 คำถามหรือไม่
    Object.keys(questionsBySections).forEach(section => {
        const count = questionsBySections[section].length;
        if (count !== 3) {
            console.warn(`Section ${section} has ${count} questions, expected 3`);
        }
    });
    
    return questionsBySections;
}

// Determine category based on criteria for each specific section
function determineCategory(AVG, VAR, hasHighScore, scores, sectionNumber) {
    
    switch(sectionNumber) {
        case 1: 
            return getSection1(AVG, VAR, hasHighScore, scores);
        case 2: 
            return getSection2(AVG, VAR, hasHighScore, scores);
        case 3: 
            return getSection3(AVG, VAR, hasHighScore, scores);
        case 4: 
            return getSection4(AVG, VAR, hasHighScore, scores);
        case 5: 
            return getSection5(AVG, VAR, hasHighScore, scores);
        case 6:
            return getSection6(AVG, VAR, hasHighScore, scores);
        case 7: 
            return getSection7(AVG, VAR, hasHighScore, scores);
        case 8: 
            return getSection8(AVG, VAR, hasHighScore, scores);
        case 9: 
            return getSection9(AVG, VAR, hasHighScore, scores);
        default:
            return getDefaultCategory();
    }
}


function getSection1(AVG, VAR, hasHighScore, scores) {
    if (VAR >= 3.0) {
        return {
            code: 'F',
            name: 'ย้อนแย้งภายใน',
            description: 'มี “ความย้อนแย้งภายใน” อย่างลึก คุณอาจสลับไปมาระหว่างความกลัวสุดขั้ว กับความมั่นใจเต็มเปี่ยม บางวันมั่นใจจนกล้าออกจากงาน บางวันตื่นมานั่งร้องไห้เพราะรู้สึกไร้ค่า นี่คือการที่ “รากยังไม่มั่น” แม้ต้นไม้ดูใหญ่โตแล้ว',
            color: '#E53935',
            examples: `• มีทั้งวันที่ productive สูง และวันที่หมดแรงแบบหาสาเหตุไม่ได้<br>• เปลี่ยนใจเร็วมาก หรือลังเลกับทุกการตัดสินใจ<br>• ชีวิตเหมือนสวิงจาก “มั่นคงเกินไป” → “ไร้ราก” → กลับมา “เกาะแน่น” ใหม่`,
            mindsetShift: `• จาก “ฉันมีสองด้านขัดแย้งกัน” → “ทั้งสองด้านต้องการถูกรับฟังอย่างเมตตา”<br>• จาก “ฉันไม่เสถียร” → “ฉันคือกระแสของพลังที่กำลังหาสมดุล”`,
            healing: `•	เขียนจดหมายถึง “ตัวตนในวันที่มั่นคง” และ “ตัวตนในวันที่สั่นไหว”<br>• ฝึกโยคะที่เน้นสมดุล เช่น Tree Pose, Warrior III<br>• ปรึกษาโค้ชหรือผู้ฟังที่ปลอดภัย เพื่อพูดคุยความสับสนโดยไม่ถูกตัดสิน`
        };
    }
    
    if (AVG >= 4.3 && hasHighScore) {
        return {
            code: 'E',
            name: 'มั่นคงจนกลายเป็นกำแพง',
            description: 'คุณมีความมั่นคงสูงมาก จนพลังนั้นกลายเป็น “เกราะ” อาจกลัวการเปลี่ยนแปลง ยึดติดกับบ้าน ที่ดิน ทรัพย์สิน หรือบทบาทในสังคม เพราะมันให้ “ความรู้สึกปลอดภัย” มากกว่าความสุขแท้จริง',
            color: '#E53935',
            examples: `• ทำงานที่ไม่รักแต่ไม่กล้าออก เพราะ “มั่นคงดี”<br>• ควบคุมคนรอบตัวเพราะกลัวความเสี่ยง<br>• รู้สึกเครียดทันทีเมื่อมีเรื่องไม่แน่นอน`,
            mindsetShift: `• จาก “มั่นคงไว้ก่อน” → “มั่นคงที่แท้คือการไว้วางใจว่าเปลี่ยนแปลงได้”<br>• จาก “โลกต้องเป็นไปตามแผน” → “แผนของโลกอาจดีกว่าแผนของฉันก็ได้”`,
            healing: `•	ทดลอง “ละทิ้งความแน่นอน” สัปดาห์ละ 1 เรื่อง เช่น เปลี่ยนร้านอาหาร, ลางาน 1 วัน<br>• ฝึกหายใจแบบปล่อยลมหายใจออกยาว — เพื่อ “ฝึกปล่อย”<br>• ตั้งเป้า “ความยืดหยุ่น” แทน “ความมั่นคงแบบตายตัว”`
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR > 0.5 && VAR < 2.0) {
        return {
            code: 'D',
            name: 'มั่นคงภายนอก แต่อ่อนไหวภายใน',
            description: 'แม้ภาพรวมคุณอาจดูมั่นคง แต่มีด้านในที่ยังอ่อนไหวอาจเป็น “รากที่แข็งแรงแต่ยังมีรอยร้าว” หรือบางความมั่นคงที่สร้างจากความกลัวมากกว่าความศรัทธา',
            color: '#E53935',
            examples: `• เก่งเรื่องงาน เงิน และการดูแล แต่ไม่ไว้ใจใครง่าย ๆ<br>• ร่างกายแข็งแรง แต่หลับยากหรือฝันร้าย<br>• ชอบควบคุมแผนการชีวิตเพื่อไม่ให้หลุดกรอบ`,
            mindsetShift: `• จาก “ฉันต้องแน่ใจเสมอ” → “บางครั้งการไว้วางใจคือสิ่งที่แน่ใจที่สุด”<br>• จาก “ฉันมั่นคงพอแล้ว” → “ฉันอยากให้ภายในของฉันนิ่งพอ ๆ กับภายนอก”`,
            healing: `•	ฝึก “การไว้ใจแบบค่อยเป็นค่อยไป” กับคนใกล้ตัว<br>• ให้ร่างกายเคลื่อนไหวอย่างอิสระ เช่น 5 Rhythms Dance, Qigong<br>• สำรวจว่า “พื้นฐานชีวิต” ที่มั่นคงนี้ มีจุดใดที่ควรปล่อยให้เบาลง`,
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR <= 0) {
        return {
            code: 'C',
            name: 'มีรากที่มั่นคง',
            description: 'จักระมูลาธารของคุณมีพลังที่มั่นคงและกลมกลืน คุณสามารถอยู่กับโลกภายนอกได้โดยไม่หวาดกลัว และอยู่กับร่างกายได้อย่างมั่นใจ',
            color: '#E53935',
            examples: `• ใช้เงินด้วยความมั่นใจ ไม่ฟุ่มเฟือย ไม่ตระหนก<br>• มีสุขภาพที่ดีจากการดูแลตนเองอย่างต่อเนื่อง<br>• เมื่อล้ม ก็ลุกขึ้นได้ง่าย เพราะรู้ว่า “ฉันเอาตัวรอดได้”`,
            mindsetShift: `• จาก “ฉันต้องมั่นคงอยู่เสมอ” → “การมั่นคงที่แท้คือความยืดหยุ่นในใจ”<br>• จาก “ฉันโอเคแล้ว” → “ฉันสามารถใช้รากฐานนี้ช่วยผู้อื่นที่ยังหลงทาง”`,
            healing: `•	หมั่น Grounding ทุกวัน เช่น สัมผัสต้นไม้ หายใจรู้ท้อง<br>• สร้าง Ritual สั้น ๆ เช่น จุดเทียนให้ตัวเองตอนเย็น<br>• สอนสิ่งที่คุณมั่นคง ให้คนที่ยังไม่มั่นคง (จักระจะมั่นยิ่งขึ้นเมื่อเราแบ่งปัน)`,
        };
    }
    
    if (AVG >= 2.5 && AVG <= 3.4 && VAR <= 1) {
        return {
            code: 'B',
            name: 'กำลังปักรากให้ชีวิต',
            description: 'คุณกำลังอยู่ในช่วงของการ “กลับมาสร้างรากใหม่”แม้จะยังมีบางจุดสั่นไหว แต่คุณเริ่มเข้าใจว่า "ความมั่นคง" ไม่ใช่สิ่งที่คนอื่นมอบให้ แต่เป็นสิ่งที่เราสร้างได้',
            color: '#E53935',
            examples: `• เริ่มตั้งเป้าหมายทางการเงินอย่างจริงจัง<br>• เริ่มดูแลสุขภาพมากขึ้น แต่ยังหลุดบ้าง<br>• สังเกตความกลัวได้ชัดขึ้น และเริ่มกล้าเผชิญหน้า`,
            mindsetShift: `• จาก “ฉันยังเปราะบาง” → “ความเปราะบางของฉันคือรากที่กำลังงอก”<br>• จาก “ฉันควรจะมั่นคงกว่านี้” → “ฉันอยู่ระหว่างการสร้างรากใหม่ในแบบของตัวเอง”`,
            healing: `• ลิสต์ “3 พื้นฐานชีวิตที่ฉันอยากเสริม” เช่น เงิน สุขภาพ ความสัมพันธ์<br>• ทำ 1 อย่างทุกวันเพื่อเสริมมัน (กินดี, เดินออกกำลัง, ตั้งงบประมาณ)<br>• พูดกับตัวเองด้วยความอ่อนโยน ไม่เร่งผลลัพธ์`,
        };
    }

    if(AVG <= 2.4 && VAR <= 1) {
        return {
        code: 'A',
        name: 'ยังไม่มั่นคงในโลกนี้',
        description: 'คุณอาจรู้สึกว่าโลกไม่ปลอดภัย หรือร่างกายไม่ใช่ที่ที่คุณอยากอยู่จริง ๆ ความกลัวอาจไม่แสดงออกอย่างชัดเจน แต่อยู่ในรูปของความกังวลเรื้อรัง ความระแวง หรือความรู้สึกไร้จุดยืน',
        color: '#E53935',
        examples: `• วิตกกังวลเรื่องเงิน หรือหนี้สินแม้ไม่มีเหตุการณ์รุนแรง<br>• ทำงานแบบ "เอาตัวรอด" มากกว่า "สร้างชีวิต"<br>• ขี้ตกใจง่าย หรือรู้สึกหลุดลอยแม้สถานการณ์ไม่รุนแรง`,
        mindsetShift: `• จาก "โลกนี้ไม่น่าไว้วางใจ" → "ฉันค่อย ๆ สร้างความมั่นคงได้ในแบบของตัวเอง"<br>• จาก "ฉันไม่มีที่อยู่ของฉันในโลก" → "ฉันกำลังสร้างบ้านให้กับจิตวิญญาณของฉันผ่านร่างกายนี้"`,
        healing: `• เดินเท้าเปล่าบนดิน/หญ้า 5 นาทีทุกวัน<br>• ฝึกหายใจลึก พร้อมแตะข้อมือ/ขาเบา ๆ เพื่อเรียกสติกลับ<br>• เขียน "ขอบคุณสิ่งที่ฉันมี" วันละ 3 อย่าง — เพื่อเรียกพลังของการไว้วางใจในชีวิต<br>• ทำบัญชีรายรับ-รายจ่ายแบบเรียบง่าย (Grounding กับโลกวัตถุ)`,
      
    };
    }
    
  
}
function getSection2(AVG, VAR, hasHighScore, scores) {
    if (VAR >= 3.0) {
        return {
            code: 'F',
            name: 'ใจที่แหวกว่ายสุดขั้ว',
            description: 'คุณมีทั้งช่วงที่เปิดใจมาก และช่วงที่ปิดแน่น การแสดงอารมณ์อาจสลับไปมาระหว่าง “เปิดหมดใจ” กับ “หายตัว”',
            color: '#FB8C00',
            examples: `• เปิดใจกับใครเร็ว แล้วรู้สึกเปลือยเปล่าจนหดกลับ<br>• มีวันที่สนุกมากกับตัวเอง แล้วอีกวันรู้สึกว่างเปล่า<br>• บางครั้งแสดงออกแรงมาก บางครั้งเงียบไปเลย`,
            mindsetShift: `• จาก “ฉันไม่แน่ใจว่ารู้สึกอะไร” → “ทุกอารมณ์กำลังสื่อสารบางอย่างกับฉัน”<br>• จาก “ฉันควรมั่นคงกว่านี้” → “การยอมรับความแปรปรวนคือรากของความกลมกลืน”`,
            healing: `•	ฝึกบันทึกอารมณ์แบบรายวัน พร้อมถาม “ฉันต้องการอะไรจริง ๆ?”<br>• ฝึก Self-Regulation เช่น หายใจตามจังหวะ 4–6–8<br>• เชื่อมโยงกับร่างกายด้วย Movement Meditation`
        };
    }
    
    if (AVG >= 4.3 && hasHighScore) {
        return {
            code: 'E',
            name: 'อารมณ์ท่วมล้น จนกลบความนิ่ง',
            description: 'คุณมีพลังความรู้สึกมหาศาล แต่มักรู้สึกว่าถูกครอบงำโดยมัน ความสัมพันธ์อาจกลายเป็นเครื่องยึดเหนี่ยว หรือใช้ “ความสุข” เพื่อหลบสิ่งที่ยังไม่กล้าเผชิญ',
            color: '#FB8C00',
            examples: `• เสพติดความสัมพันธ์ โรแมนติก หรือความตื่นเต้น<br>• หาความสุขจากการช้อปปิ้ง กิน ดื่ม เพื่อหลบความว่างเปล่า<br>• ตอบสนองอารมณ์ทันที โดยไม่รอให้ตกตะกอน`,
            mindsetShift: `• จาก “ฉันต้องรู้สึกอะไรตลอดเวลา” → “ฉันสามารถอยู่กับความเงียบระหว่างอารมณ์ได้”<br>• จาก “ความสุขคือเป้าหมาย” → “ความสงบคือรากของความสุข”`,
            healing: `•	ฝึก Pause ก่อนตอบสนองอารมณ์ (หายใจ 3 รอบก่อนพูด/ทำ)<br>• ใช้เวลากับตัวเองอย่างลึก เช่น เดินป่า อาบน้ำเกลือ<br>• งดสิ่งกระตุ้น เช่น น้ำตาล โซเชียล หลัง 1 ทุ่ม`
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR > 0.5 && VAR < 2.0) {
        return {
            code: 'D',
            name: 'เปิดใจแล้ว แต่ยังกลัวจะเจ็บอีก',
            description: 'คุณมีความสามารถในการรับรู้อารมณ์ และเชื่อมโยงกับคนอื่น แต่บางสถานการณ์กระตุ้น “ปมเก่า” จนทำให้ใจคุณตึง หรือหดตัวกลับโดยไม่รู้ตัว',
            color: '#FB8C00',
            examples: `• มีช่วงที่สนิทกับใครเร็ว แต่ก็ตัดสัมพันธ์เร็วเช่นกัน<br>• รู้สึกผูกพันในความสัมพันธ์ แต่ก็ไม่กล้าไว้ใจเต็มที่<br>• อารมณ์ผันผวนขึ้นลงกับคนใกล้ตัว`,
            mindsetShift: `• จาก “ฉันรักใครไม่ได้” → “ฉันกำลังเรียนรู้การรักอย่างไม่เจ็บตัว”<br>• จาก “อารมณ์ของฉันไม่แน่นอน” → “อารมณ์คือคลื่น ฉันคือผืนน้ำที่โอบรับมันได้”`,
            healing: `•	ฝึกการอยู่กับอารมณ์โดยไม่ตัดสิน เช่น ผ่าน Mindful Listening<br>• ใช้การเขียนหรือศิลปะเป็นที่รับอารมณ์ก่อนปล่อยให้หลุดออกมาในความสัมพันธ์จริง<br>• สำรวจ “อารมณ์ที่ฉันไม่กล้าแสดง” และให้พื้นที่ปลอดภัยกับมัน`,
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR <= 0) {
        return {
            code: 'C',
            name: 'ใจเปิด อารมณ์ไหลลื่น',
            description: 'คุณสามารถรู้สึกในสิ่งที่คุณรู้สึก และแสดงออกอย่างเป็นธรรมชาติ ความสุขของคุณไม่ต้องมีเหตุผลเสมอ — แต่เป็นความเบิกบานที่เรียบง่าย',
            color: '#FB8C00',
            examples: `• อยู่กับอารมณ์ได้ทั้งสุขและเศร้า โดยไม่ตัดสิน<br>• สื่อสารความรู้สึกในความสัมพันธ์ได้โดยไม่พยายามควบคุมอีกฝ่าย<br>• ใช้ความคิดสร้างสรรค์ในการดูแลตัวเอง เช่น วาดรูป เต้น หรือเขียน`,
            mindsetShift: `• จาก “ฉันต้องรู้ว่ารู้สึกอะไรเสมอ” → “ฉันยินดีอยู่กับอารมณ์ แม้จะไม่เข้าใจมันตอนนี้”<br>• จาก “ฉันต้องจัดการอารมณ์” → “ฉันสามารถปล่อยให้มันเคลื่อนไหวผ่านฉัน”`,
            healing: `•	เต้นหรือโยคะในแบบที่รู้สึกดี ไม่ใช่แบบที่ถูกต้อง<br>• สร้างเวลา “ไร้เป้าหมาย” ให้ตนเอง เช่น ช่วงปล่อยใจ<br>• อยู่กับน้ำบ่อย ๆ (อาบน้ำ เดินริมน้ำ ฟังเสียงน้ำ)`,
        };
    }
    
    if (AVG >= 2.5 && AVG <= 3.4 && VAR <= 1) {
        return {
            code: 'B',
            name: 'กำแพงเริ่มละลาย',
            description: 'คุณเริ่มเปิดใจให้ความรู้สึก ความสัมพันธ์ และความสุขกลับมาเคลื่อนไหวอีกครั้ง แม้อาจยังมีความเปราะบางอยู่ แต่คุณกำลังก้าวเข้าสู่ “การยอมให้ความรู้สึกไหลผ่าน”',
            color: '#FB8C00',
            examples: `• เริ่มร้องไห้เมื่อดูหนังหรือฟังเพลง ทั้งที่เคยกลั้นไว้ตลอด<br>• กล้าบอกความต้องการกับคนสนิท แม้จะสั่นในใจ<br>• รู้สึกมีช่วงเบิกบานแบบไม่คาดคิด แม้ไม่ยั่งยืน`,
            mindsetShift: `• จาก “ฉันกลัวจะอ่อนไหวเกินไป” → “การอ่อนไหวคือพลังของการเชื่อมโยง”<br>• จาก “ฉันต้องเข้มแข็ง” → “การรู้สึกคือการเข้มแข็งแบบใหม่”`,
            healing: `•	ทดลองบอก “ความรู้สึกตอนนี้” แทน “เรื่องราว” กับคนที่ไว้ใจ<br>• วาดภาพจากอารมณ์โดยไม่ต้องตีความ<br>• สังเกตความสุขเล็ก ๆ ทุกวัน แล้วจดไว้`,
        };
    }

    if(AVG <= 2.4 && VAR <= 1) {
        return {
        code: 'A',
        name: 'ปิดกั้นความรู้สึกไว้ภายใน',
        description: 'คุณอาจรู้สึก “ไม่แน่ใจ” ว่าคุณรู้สึกอะไร หรือรู้สึกไม่ปลอดภัยพอที่จะปล่อยอารมณ์ ความสุขดูเหมือนเป็นสิ่งที่ต้องระวัง และความสัมพันธ์อาจดูน่ากลัวหรือล่อแหลมเกินไป',
        color: '#FB8C00',
        examples: `• ไม่รู้ว่าควรรู้สึกยังไงกับบางเหตุการณ์<br>• รู้สึกชา หรือเฉยเมยกับเรื่องที่ควรจะรู้สึก<br>• ไม่สามารถปล่อยตัวปล่อยใจได้ แม้อยู่กับคนที่ไว้ใจ`,
        mindsetShift: `• จาก “ฉันควบคุมอารมณ์ไม่ได้” → “อารมณ์คือกระแสที่ฉันสามารถเต้นไปกับมันได้”<br>• จาก “ถ้าฉันรู้สึก ฉันจะเจ็บ” → “ความรู้สึกที่ฉันกล้ารับรู้จะช่วยเยียวยาฉัน”`,
        healing: `•	ฟังเพลงและปล่อยให้ร่างกายเคลื่อนไหวโดยไม่คิด<br>• เขียนบันทึกอารมณ์วันละ 1 หน้าโดยไม่กรอง<br>• ฝึกบอกความรู้สึกง่าย ๆ เช่น “วันนี้ฉันรู้สึก...เพราะ...” โดยไม่ต้องวิเคราะห์`,
      
    };
    }
    
  
}
function getSection3(AVG, VAR, hasHighScore, scores) {
    if (VAR >= 3.0) {
        return {
            code: 'F',
            name: 'ฉันมีพลัง แต่บางทีก็หนีมัน',
            description: 'คุณมีศักยภาพสูง แต่รู้สึกว่าใช้ไม่สุด หรือใช้ไปแล้วก็ย้อนกลับมาเงียบอีก เหมือนสลับระหว่างความกล้าแสดงออก → กับการหลบมุมเพราะกลัวจะผิด',
            color: '#FDD835',
            examples: `• ตัดสินใจแน่วแน่ในบางวัน แล้วลังเลในวันต่อมา<br>• กล้าพูดบนเวที แต่ไม่กล้าพูดเรื่องในใจกับคนสนิท<br>• บางครั้งรู้สึกว่า “ฉันสร้างได้ทุกอย่าง” แล้วอีกวัน “ฉันทำไม่ได้เลย”`,
            mindsetShift: `• จาก “ฉันไม่เสถียร” → “ฉันกำลังสำรวจพลังของฉันอย่างลึก”<br>• จาก “ฉันใช้พลังไม่เป็น” → “ฉันกำลังเรียนรู้วิธีใช้พลังด้วยความสมดุล”`,
            healing: `•	ฝึกสังเกตจุด “ก่อน” ที่พลังจะตก แล้วเติมพลังผ่านธรรมชาติ<br>• สร้าง “Time Capsule” ความสำเร็จ — บันทึกเสียง/จดหมายถึงตัวเองในวันที่มั่นใจ<br>• ลองทำสิ่งเดิมซ้ำ ๆ เพื่อเสริม “เสถียรภาพของพลัง”`
        };
    }
    
    if (AVG >= 4.3 && hasHighScore) {
        return {
            code: 'E',
            name: 'พลังมาก แต่กดทับผู้อื่น (หรือกดตนเอง)',
            description: 'พลังของคุณชัดและแรง แต่บางครั้งมัน “ขับเคลื่อนด้วยความกลัวจะอ่อนแอ” มากกว่าความสงบจากแก่นแท้ คุณอาจควบคุมสถานการณ์ หรือพยายาม “เป็นผู้นำเสมอ” เพื่อไม่ให้ใครเห็นจุดเปราะ',
            color: '#FDD835',
            examples: `• ขับเคลื่อนชีวิตแบบ “ต้องชนะ” ทุกเรื่อง แม้เรื่องเล็ก<br>• บริหารคนเก่ง แต่ไม่เปิดพื้นที่ให้ความเห็นต่าง<br>• ไม่ยอมให้ตัวเอง “พัก” เพราะกลัวว่าหยุดคือพ่ายแพ้`,
            mindsetShift: `• จาก “ฉันต้องแกร่งเสมอ” → “พลังที่แท้จริงรวมถึงการพัก การฟัง และการถอยด้วย”<br>• จาก “ฉันต้องควบคุมสถานการณ์” → “ฉันควบคุมการตอบสนองของฉันได้ แม้สถานการณ์เปลี่ยน”`,
            healing: `•	ฝึก “ละการตัดสินใจ” 1 เรื่องต่อสัปดาห์ เช่น ปล่อยให้คนอื่นเลือกร้านอาหาร<br>• สะท้อนตัวเองในคำถาม: “ฉันพยายามควบคุมเพราะกลัวอะไร?”<br>• ทำ Shadow Work: เขียนถึง “ฉันในวันที่ล้มเหลว” แล้วโอบรับเขา`
        };
    }

    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR > 0.5 && VAR < 2.0) {
        return {
            code: 'D',
            name: 'มั่นใจเป็นช่วง ๆ สั่นไหวในบางคราว',
            description: 'คุณมีพลังส่วนตัวระดับหนึ่ง และใช้มันได้ในหลายด้าน แต่บางสถานการณ์จะกระตุ้น “เสียงแห่งความสงสัย” ขึ้นมา เช่น เสียงจากอดีต หรือความกลัวผิดพลาดที่ยังไม่คลาย',
            color: '#FDD835',
            examples: `• มั่นใจเรื่องงาน แต่ไม่กล้าตัดสินใจเรื่องความรัก <br> • เป็นผู้นำในบางบทบาท แต่รู้สึกเล็กในอีกบทบาทหนึ่ง<br>• แสดงออกได้ดีในที่สาธารณะ แต่รู้สึกอ่อนแอลึก ๆ ในใจ`,
            mindsetShift: `• จาก “ฉันยังไม่พร้อมทุกเรื่อง” → “ฉันกำลังขยายพลังไปสู่พื้นที่ใหม่ของชีวิต”<br>• จาก “ทำไมฉันยังสั่น” → “ความสั่นคือพลังที่รอจะเปลี่ยนเป็นแรงผลักดัน”`,
            healing: `•	ใช้ “การลงมือเล็ก ๆ” เป็นยาวิเศษทุกวัน เช่น ตอบข้อความที่กังวล<br>• เขียนจดหมายถึง “ตัวฉันที่มั่นใจที่สุด” แล้วอ่านในวันที่ลังเล<br>• ฝึกหายใจลึกในช่วงก่อนตัดสินใจ เพื่อเชื่อมโยงกับพลังแก่นใน`,
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR <= 0) {
        return {
            code: 'C',
            name: 'แสงแห่งพลังเปล่งออกอย่างกลมกลืน',
            description: 'คุณเชื่อมั่นในพลังภายในของตนเอง และใช้มันโดยไม่ต้องแย่งชิงหรือควบคุมใคร เมื่อคุณเลือก — คุณเลือกจากศูนย์กลางที่นิ่ง และไม่หวั่นแม้โลกจะเปลี่ยน',
            color: '#FDD835',
            examples: `• กล้าตัดสินใจในเวลาที่คนอื่นลังเล<br>• ลงมือทำสิ่งสำคัญแม้จะยาก โดยไม่ต้องบังคับตัวเอง<br>• เป็นแรงบันดาลใจให้คนรอบข้างด้วย “การเป็น” มากกว่า “การพูด”`,
            mindsetShift: `• จาก “ฉันต้องพิสูจน์ตัวเอง” → “ฉันคือพลัง โดยไม่ต้องพิสูจน์”<br>• จาก “ฉันต้องชนะ” → “พลังที่แท้คือการร่วมมือเพื่อชนะทั้งคู่”`,
            healing: `•	แชร์เป้าหมายกับเพื่อนที่ปลอดภัย แล้วลงมือทำอย่างมั่นคง<br>• เชื่อมโยงความมั่นใจภายในกับการรับใช้ผู้อื่น (ให้คำแนะนำ สอน แชร์แรงบันดาลใจ)<br>• สร้างพิธีกรรมเล็ก ๆ เช่น จุดเทียนก่อนเริ่มงานทุกวัน เพื่อย้ำพลังในตน`,
        };
    }
    
    if (AVG >= 2.5 && AVG <= 3.4 && VAR <= 1) {
        return {
            code: 'B',
            name: 'กล้าก้าว แม้จะยังกลัว',
            description: 'คุณกำลังอยู่ในกระบวนการเสริมพลังของตนเอง แม้จะมีความลังเลหรือเปราะบางในบางช่วง แต่ภายในเริ่มรู้ว่าตนมีสิทธิ์เลือก มีสิทธิ์แสดงออก และมีพลังมากกว่าที่เคยเชื่อ”',
            color: '#FDD835',
            examples: `• เริ่มกล้าพูดความคิดของตนในที่ประชุม แม้ยังไม่มั่นใจ<br>• กล้าตัดสินใจเรื่องสำคัญ แม้จะสั่นไหว<br>• มีจังหวะที่รู้สึก “แน่ใจ” แล้วก็ดับไป — แต่กลับมาใหม่ได้เสมอ`,
            mindsetShift: `• จาก “ฉันยังไม่มั่นใจพอ” → “ความมั่นใจคือกล้ามากกว่าความแน่ใจ”<br>• จาก “ฉันยังเล็กเกินไปจะเปลี่ยนแปลงอะไรได้” → “แค่หนึ่งก้าวเล็ก ๆ ก็เปลี่ยนแรงโมเมนตัมได้”`,
            healing: `•	ฝึกเขียน “คำพูดที่ฉันกลัวจะพูดออกไป” แล้วพูดออกมาเบา ๆ กับตัวเอง<br>• ทดลองลงมือทำก่อนวางแผนให้สมบูรณ์แบบ<br>• ทำ "Power Pose" วันละ 2 นาที — ยืนมั่น หายใจลึก นึกถึงชัยชนะที่ผ่านมา`,
        };
    }

    if(AVG <= 2.4 && VAR <= 1) {
        return {
        code: 'A',
        name: 'ไม่มั่นใจ พลังในชีวิตถูกดับลง',
        description: 'คุณอาจรู้สึกไร้พลัง รอให้ผู้อื่นบอกทาง หรือกลัวความล้มเหลวจนไม่กล้าตัดสินใจ จักระนี้อาจอ่อนแอจากความรู้สึกว่าตัวเอง “ไม่มีค่า” หรือ “ไม่มีสิทธิ์เลือกทางของตัวเอง”',
        color: '#FDD835',
        examples: `• ไม่กล้าปฏิเสธใคร แม้ตัวเองไม่อยากทำ<br>• มีไอเดียมาก แต่ไม่กล้าทำให้เกิดจริง<br>• รู้สึกแคลงใจในตัวเองตลอด แม้คนอื่นจะมองว่าเก่ง`,
        mindsetShift: `• จาก “ฉันไม่กล้าทำผิดพลาด” → “ทุกการลองผิดคือบันไดสู่ความมั่นใจ”<br>• จาก “ฉันไม่แน่ใจว่ามีพลังไหม” → “พลังเกิดขึ้นตอนที่ฉันกล้าก้าวแรก”`,
        healing: `•	ฝึกพูด “ไม่” กับเรื่องเล็ก ๆ อย่างมั่นใจ<br>• ตั้งเป้าหมายเล็กที่ทำได้ทันที เช่น เดินวันละ 10 นาที<br>• นั่งสมาธิแบบอาทิตย์ในท้อง (Solar Meditation): มือวางบนหน้าท้อง หายใจรู้พลังในกลางลำตัว`,
      
    };
    }
    
  
}
function getSection4(AVG, VAR, hasHighScore, scores) {
    if (VAR >= 3.0) {
        return {
            code: 'F',
            name: 'ใจรักแต่กลัว...เปิดก็เจ็บ ปิดก็ปวด',
            description: 'คุณรู้ว่าความรักคือสิ่งสำคัญ แต่ทุกครั้งที่พยายามเปิดใจ อดีตหรือความไม่มั่นใจจะย้อนมาบั่นทอน ชีวิตความสัมพันธ์จึงเป็นการสลับระหว่าง “รักจนหมดใจ” กับ “ถอยจนไม่มีใครเข้าถึง”',
            color: '#43A047',
            examples: `• มีช่วงเปิดใจมาก ๆ → แล้วปิดทันทีเมื่อตกใจอะไรเล็กน้อย<br>• เข้าใจคนอื่นลึกมาก แต่ไม่เข้าใจตัวเองเลย<br>• รู้ว่าควรรักตัวเอง แต่ขัดใจกับการลงมือทำจริง`,
            mindsetShift: `• จาก “ฉันสับสนเกินไปจะรัก” → “แม้หัวใจสับสน มันก็ยังพยายามจะรัก”<br>• จาก “ฉันไม่รู้ว่าเปิดใจดีไหม” → “ฉันสามารถค่อย ๆ เปิดโดยไม่ต้องเปิดทั้งหมด”`,
            healing: `•	เขียนบทสนทนา “ตัวฉันที่กล้ารัก” กับ “ตัวฉันที่กลัวเจ็บ”<br>• ฝึกสมาธิบนลมหายใจตรงกลางอก — เรียก “กลับสู่ศูนย์”<br>• รับฟังเรื่องราวของคนอื่นที่เปิดใจ — เพื่อเรียนรู้ว่าการเจ็บไม่ได้แปลว่าไม่ควรรัก`
        };
    }
    
    if (AVG >= 4.3 && hasHighScore) {
        return {
            code: 'E',
            name: 'รักมากจนหลอมรวมตัวเองกับคนอื่น',
            description: 'ความรักของคุณลึกและแท้จริง แต่บางครั้งกลายเป็นการพึ่งพาทางอารมณ์หรือการกลัวการสูญเสีย คุณอาจให้เกินขอบเขต หรือคาดหวังการยอมรับกลับคืนเพื่อรู้สึกว่ามีค่า',
            color: '#43A047',
            examples: `• กลัวคนรักจะจากไปแม้ไม่มีเหตุผล<br>• ไม่กล้าบอกความต้องการตัวเองเพราะกลัวอีกฝ่ายไม่รัก<br>• ปรับตัวตามคนอื่นจนสูญเสียความเป็นตัวเอง`,
            mindsetShift: `• จาก “ฉันต้องทำให้เขารัก” → “ความรักที่แท้คือการอยู่ได้แม้ไม่มีใคร”<br>• จาก “ฉันกลัวเขาจะไป” → “ฉันไม่เคยจากตัวเอง”`,
            healing: `•	ฝึกพูดกับตัวเองว่า “ฉันเพียงพอ แม้ลำพัง”<br>• กำหนดเวลาอยู่ลำพังเพื่อดูแลใจ เช่น Journaling หรือ Day Retreat<br>• ทำ Boundary Affirmation เช่น “ฉันสามารถรักโดยไม่ละเลยตัวเอง”`
        };
    }

    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR > 0.5 && VAR < 2.0) {
        return {
            code: 'D',
            name: 'รักอยู่...แต่ยังมีแผล',
            description: 'คุณอาจมีหัวใจที่เปิดแล้ว แต่ยังมี “ความเจ็บจากอดีต” ที่ส่งผลกับการเชื่อมโยงในปัจจุบัน บางครั้งคุณให้มากไปจนลืมดูแลตัวเอง หรือกลับกัน รู้สึกไม่สบายใจเมื่อคนอื่นเปิดใจให้',
            color: '#43A047',
            examples: `• รักคนอื่นมาก แต่ละเลยความต้องการของตนเอง<br>• กลัวความใกล้ชิดมากกว่าการอยู่ลำพัง<br>• เข้าใจความเมตตา แต่รู้สึกเหนื่อยเมื่อต้องให้ตลอดเวลา`,
            mindsetShift: `• จาก “ฉันควรให้โดยไม่มีเงื่อนไข” → “ฉันให้เมื่อใจเต็ม ไม่ใช่เมื่อใจหมด”<br>• จาก “รักต้องไม่เห็นแก่ตัว” → “ความรักเริ่มจากการเห็นคุณค่าของตัวเองก่อน”`,
            healing: `• วาด “แผนที่หัวใจ” ของตัวเอง — ใครอยู่ตรงไหน มีพื้นที่พอหรือยัง?<br>• ฝึก “No with love” — ปฏิเสธด้วยความรัก<br>• สร้างขอบเขตที่ชัดเจน แม้กับคนที่คุณรักที่สุด`,
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR <= 0) {
        return {
            code: 'C',
            name: 'หัวใจเปิด อบอุ่นแต่ไม่เปราะ',
            description: 'คุณให้ความรักได้อย่างอิสระ โดยไม่หลงลืมตัวเอง รู้จักเมตตาอย่างมีขอบเขต และสามารถยอมรับความไม่สมบูรณ์ของตนเองและผู้อื่นได้',
            color: '#43A047',
            examples: `• เข้าใจความเจ็บปวดของคนอื่นโดยไม่แบกมัน<br>• ให้อภัยง่าย โดยไม่ลืมดูแลตัวเอง<br>• ไม่กลัวความใกล้ชิด หรือความห่างเหิน`,
            mindsetShift: `• จาก “ฉันรักได้เมื่อเขาเปลี่ยน” → “ฉันรักได้แม้เขาจะยังเป็นแบบนั้น”<br>• จาก “ฉันรักจนหมดใจ” → “ฉันรักด้วยความเต็มในใจ ไม่ใช่หมดจากใจ”`,
            healing: `•	สร้าง Space ให้ตัวเองและผู้อื่นได้พักใจในความสัมพันธ์<br>• ให้เวลากับกิจกรรมที่ “เลี้ยงหัวใจ” เช่น ปลูกต้นไม้ ทำอาหารให้คนรัก<br>• เขียน Gratitude Journal ให้กับตัวเองและผู้อื่น`,
        };
    }
    
    if (AVG >= 2.5 && AVG <= 3.4 && VAR <= 1) {
        return {
            code: 'B',
            name: 'ใจเริ่มอ่อนโยน',
            description: 'คุณเริ่มเข้าใจว่าการปิดใจไม่ใช่ทางออกของความเจ็บปวด แม้ยังมีความกลัว คุณก็เริ่มเลือก “ความรัก” มากกว่า “การหลบหนี”',
            color: '#43A047',
            examples: `• เริ่มขอโทษคนอื่น หรือให้อภัยตัวเองได้บางส่วน<br>• กล้าบอกความรู้สึก แม้จะยังกลัวผลตอบรับ<br>• อยู่กับตัวเองได้มากขึ้น ไม่รู้สึกโดดเดี่ยวเท่าเดิม`,
            mindsetShift: `• จาก “ฉันยังไม่รักตัวเองพอ” → “ทุกวันที่ฉันฟังใจตัวเอง คือความรักรูปแบบหนึ่ง”<br>• จาก “ฉันกลัวจะเสียใจอีก” → “ความรักไม่ใช่การควบคุมผลลัพธ์ แต่คือการเปิดใจต่อปัจจุบัน”`,
            healing: `•	ฟังเพลงที่ทำให้ใจอบอุ่น แล้วเขียนความรู้สึกหลังฟัง<br>• ฝึก Loving-kindness Meditation — ส่งความรักไปยังตัวเองและผู้อื่น<br>• เขียน “คำพูดที่ฉันอยากได้ยินจากคนที่รัก” แล้วพูดให้ตัวเองฟัง`,
        };
    }

    if(AVG <= 2.4 && VAR <= 1) {
        return {
        code: 'A',
        name: 'หัวใจปิดอยู่',
        description: 'คุณอาจรู้สึกว่าไม่สามารถเปิดใจรับหรือให้ความรักได้อย่างแท้จริง อาจกลัวการถูกปฏิเสธ เคยบาดเจ็บทางใจ หรือรู้สึกไม่สมควรได้รับความรัก',
        color: '#43A047',
        examples: `• รู้สึกไม่เชื่อว่าความรักแท้มีจริง<br>• มักปฏิเสธความหวังดีของคนอื่น<br>• รู้สึกโดดเดี่ยวแม้อยู่ในความสัมพันธ์`,
        mindsetShift: `• จาก “ฉันไม่คู่ควรกับความรัก” → “หัวใจของฉันมีค่าต่อการได้รับและให้”<br>• จาก “ฉันกลัวเจ็บอีกครั้ง” → “หัวใจที่แท้แกร่งคือหัวใจที่ยังกล้ารักแม้เคยแตกสลาย”`,
        healing: `• วางมือตรงกลางอก หายใจเข้าออกพร้อมพูดว่า “ฉันเปิดใจ”<br>• เขียนจดหมายถึงตัวเองในวัยที่เคยเจ็บปวด แล้วให้อภัย<br>• อยู่ใกล้สิ่งที่อ่อนโยน เช่น ต้นไม้ สัตว์เลี้ยง หรือเด็กเล็ก`,
      
    };
    }
    
  
}
function getSection5(AVG, VAR, hasHighScore, scores) {
    if (VAR >= 3.0) {
        return {
            code: 'F',
            name: 'เสียงที่ย้อนแย้ง',
            description: 'ข้างในอาจคิดอย่างหนึ่ง แต่พูดออกมาอีกอย่างหนึ่งเพราะกลัวการขัดแย้ง, การไม่เป็นที่ยอมรับ หรือเพราะยังไม่รู้จัก “เสียงที่แท้จริง” ของตน',
            color: '#1E88E5',
            examples: `• มักพูดในสิ่งที่คนอื่นอยากได้ยิน<br>• พูดแล้วรู้สึกผิด รู้ว่าไม่ตรงกับความรู้สึกข้างใน<br>• มีหลาย “ตัวตนในการพูด” จนบางครั้งรู้สึกหลงทาง`,
            mindsetShift: `• จาก “พูดแบบนี้ดีกว่า เขาจะไม่โกรธ” → “ฉันสามารถพูดด้วยความจริงและเมตตาได้พร้อมกัน”<br>• จาก “ฉันไม่รู้ว่าเสียงไหนคือฉันจริง ๆ” → “ฉันกำลังเรียนรู้ที่จะรวมเสียงภายในให้กลมกลืน”`,
            healing: `•	เขียนบทสนทนาระหว่าง “เสียงในใจ” กับ “เสียงที่พูดออกมา”<br>• ฝึก Shadow Voice — พูดความรู้สึกที่ปกติไม่กล้าพูดออกมาในห้องส่วนตัว<br>• เลือก 1 ความจริงต่อวันที่จะ “พูดจากหัวใจ” แม้เป็นเรื่องเล็ก`
        };
    }
    
    if (AVG >= 4.3 && hasHighScore) {
        return {
            code: 'E',
            name: 'เสียงที่กลบความเงียบภายใน',
            description: 'คุณอาจสื่อสารเก่งจนกลายเป็น “พูดเพื่อไม่ให้เงียบ” พลังจักระคอนั้นล้นออกมา อาจทำให้การฟังและการไตร่ตรองลดลง',
            color: '#1E88E5',
            examples: `• พูดเร็วมากจนคนฟังตามไม่ทัน<br>• รู้สึกไม่สบายใจเมื่อเงียบ หรือต้องอยู่กับความนิ่ง<br>• ขัดจังหวะผู้อื่นโดยไม่รู้ตัว`,
            mindsetShift: `• จาก “ฉันต้องพูดเพื่อเชื่อมโยง” → “บางครั้งความเงียบคือสะพานที่แท้จริง”<br>• จาก “ฉันต้องรีบบอกก่อนจะลืม” → “ฉันสามารถหายใจ และคัดเลือกสิ่งที่ลึกที่สุด”`,
            healing: `•	ฝึกพูด “น้อยลงแต่ลึกขึ้น” — สังเกตก่อนพูดทุกครั้ง<br>• ฝึกเงียบวันละ 15 นาทีโดยไม่ใช้โทรศัพท์หรือสื่อใด<br>• ตั้ง “Silent Practice Time” สัปดาห์ละครั้ง 2 ชั่วโมง`
        };
    }

    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR > 0.5 && VAR < 2.0) {
        return {
            code: 'D',
            name: 'เสียงไม่เท่ากันทุกวัน',
            description: 'คุณอาจพูดได้ดีในบางช่วง แต่กลับรู้สึกอึดอัดในบางสถานการณ์ พลังจักระนี้ยังขึ้น ๆ ลง ๆ จากอารมณ์และความเชื่อเดิม ๆ',
            color: '#1E88E5',
            examples: `• วันหนึ่งพูดคล่อง อีกวันกลับเงียบไปทั้งวัน<br>• มีบางสถานการณ์ที่ “พูดไม่ได้” เหมือนมีอะไรจุกคอ<br>• พูดความจริงได้บ้าง แต่กลัวการถูกเข้าใจผิดหรือถูกตัดสิน`,
            mindsetShift: `• จาก “ฉันสื่อสารได้แค่บางเรื่อง” → “ทุกการพูดคือการฝึกให้เสียงฉันชัดขึ้น”<br>• จาก “ฉันพูดไม่ดีพอ” → “ฉันไม่ได้พูดเพื่อพิสูจน์ แต่เพื่อเปิดเผยใจ”`,
            healing: `•	ฝึกเขียนความรู้สึกเป็นประโยคสั้น ๆ แล้วอ่านออกเสียง<br>• ออกเสียง Om หรือเสียงสั่นสะเทือนคอวันละ 3 นาที<br>• ลองเต้น/เคลื่อนไหวพร้อมเปล่งเสียง — เพื่อปลดปล่อยพลังจากคอที่อั้น`,
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR <= 0) {
        return {
            code: 'C',
            name: 'เสียงที่กลมกลืนกับหัวใจ',
            description: 'คุณสามารถสื่อสารอย่างตรงไปตรงมา โดยมีเมตตาและตระหนักรู้ ฟังอย่างลึกซึ้ง พูดจากความจริง และสร้างพื้นที่ปลอดภัยผ่านคำพูด',
            color: '#1E88E5',
            examples: `• กล้าพูดในสิ่งที่เชื่อ แม้ไม่ตรงกับคนส่วนใหญ่<br>• เป็นที่ปรึกษาที่ดี เพราะฟังอย่างตั้งใจและพูดอย่างเข้าใจ<br>• รู้ว่าเวลาใดควรพูด เวลาใดควรเงียบ`,
            mindsetShift: `• จาก “ฉันต้องพูดให้ทุกคนเห็นด้วย” → “ฉันพูดเพื่อความจริง ไม่ใช่เพื่อชนะ”<br>• จาก “ฉันต้องอธิบายทุกอย่าง” → “บางครั้งความเงียบก็เป็นภาษาที่ลึกที่สุด”`,
            healing: `•	ฝึก "การฟังอย่างไร้เงื่อนไข" กับคนสนิท<br>• อ่านอะไรสักอย่างออกเสียงให้ตัวเองฟัง<br>• สอนคนอื่นอย่างตั้งใจ — เพราะการถ่ายทอดช่วยปรับจูนจักระคออย่างยอดเยี่ยม`,
        };
    }
    
    if (AVG >= 2.5 && AVG <= 3.4 && VAR <= 1) {
        return {
            code: 'B',
            name: 'เริ่มเอ่ยความจริง',
            description: 'คุณเริ่มเชื่อว่าเสียงของตัวเองมีค่า แม้ยังรู้สึกเปราะบางในการเปิดเผยความรู้สึกหรือแนวคิด เสียงเริ่มเปล่ง แต่ยังต้องฝึกความกล้าทางพลังงาน',
            color: '#1E88E5',
            examples: `• เริ่มกล้าพูดสิ่งที่เคยเก็บไว้ แม้ยังกลัวการเข้าใจผิด<br>• มีบางครั้งที่พูดความจริงออกไปแล้วรู้สึกโล่งใจ<br>• เริ่มฝึกฟังผู้อื่นจริง ๆ มากขึ้น โดยไม่ตัดสิน`,
            mindsetShift: `• จาก “กลัวจะพูดผิด” → “การพูดอย่างแท้จริง ไม่ใช่ความถูกต้องแต่คือความสัตย์”<br>• จาก “จะมีใครเข้าใจฉันไหม” → “ฉันพูดเพื่อเข้าใจตัวเอง ก่อนจะรอให้ใครเข้าใจ”`,
            healing: `•	ตั้งเวลา 10 นาที/วัน พูดสิ่งที่รู้สึกออกมาคนเดียวหน้ากระจก<br>• ลองเขียนจดหมาย (ส่งหรือไม่ส่งก็ได้) ถึงคนที่อยากพูดความในใจ<br>• ฝึกหายใจลึกก่อนพูด — เพื่อเรียก “เสียงจากศูนย์กลาง” ไม่ใช่จากความกลัว`,
        };
    }

    if(AVG <= 2.4 && VAR <= 1) {
        return {
        code: 'A',
        name: 'เสียงที่ไม่กล้าเปล่ง',
        description: 'คุณอาจรู้สึกว่าเสียงของตัวเองไม่มีคุณค่า หรือกลัวการพูดเพราะกลัวถูกตัดสิน มีพลังในการสื่อสารอยู่ภายใน แต่ยังถูกเก็บกดจากอดีตหรือความกลัวที่ฝังลึก',
        color: '#1E88E5',
        examples: `• ไม่กล้าพูดในที่ประชุม หรือเก็บความรู้สึกไว้จนแน่นในอก<br>• มักตอบว่า “อะไรก็ได้” แม้มีความคิดเห็นชัดเจน<br>• กลัวการแสดงออกหรือการเป็นจุดสนใจ`,
        mindsetShift: `• จาก “สิ่งที่ฉันพูดไม่สำคัญ” → “การพูดความจริงของฉันคือของขวัญแก่โลก”<br>• จาก “ฉันไม่รู้จะพูดอะไรดี” → “เมื่อฉันฟังใจตัวเอง เสียงนั้นจะชัดขึ้นเรื่อย ๆ”`,
        healing: `•	ฝึกเขียน Journal ทุกเช้าแบบไม่ต้องแก้ไขคำ — ให้เสียงภายในได้พูด<br>• อ่านบทกลอนหรือบทสวดออกเสียง 3 นาทีทุกวัน<br>• ใช้ Affirmation: “เสียงของฉันมีพลัง” ขณะมองกระจก`,
      
    };
    }
    
  
}
function getSection6(AVG, VAR, hasHighScore, scores) {
    if (VAR >= 3.0) {
        return {
            code: 'F',
            name: 'สับสนในภาพที่เห็น',
            description: 'บางครั้งคุณมีภาพชัดเจนในใจมาก แต่บางครั้งกลับไม่รู้ว่า “เสียงไหนคือเสียงจริง” นี่คือช่วงที่ต้องหาความมั่นใจใน “ผู้รับรู้” ไม่ใช่แค่ใน “ข้อมูลที่รับรู้”',
            color: '#3949AB',
            examples: `• มีภาพฝันแรงกล้า แต่ลังเลเมื่อจะเริ่ม<br>• เชื่อลางในบางเรื่องมาก แต่ปฏิเสธมันในเรื่องอื่น<br>• สลับระหว่างเชื่อใจตัวเอง → ไม่มั่นใจ → วนกลับมาอีกครั้ง`,
            mindsetShift: `• จาก “บางทีฉันก็แม่น บางทีก็ไม่” → “ญาณคือสิ่งที่พัฒนาได้เหมือนกล้ามเนื้อ”<br>• จาก “ฉันไม่แน่ใจว่าเห็นจริงหรือคิดไปเอง” → “ฉันจะอยู่กับภาพนั้น โดยไม่เร่งตัดสิน”`,
            healing: `•	ใช้การเขียนภาพฝัน หรือ Dream Journal เป็นเครื่องมือค่อย ๆ สำรวจ<br>• ฝึกสังเกตความรู้สึก “เมื่อรู้สิ่งใด” ว่ารู้แบบนิ่ง หรือรู้แบบตื่นเต้น<br>• สร้างพิธีกรรมเชื่อมต่อญาณ เช่น จุดเทียนหน้ากระจก พูดกับจิตภายใน`
        };
    }
    
    if (AVG >= 4.3 && hasHighScore) {
        return {
            code: 'E',
            name: 'มองเห็นมากจนลืมเหยียบพื้น',
            description: 'พลังตาที่สามอาจเปิดมากจนจิตลอย ไม่อยู่กับโลกความจริง อาจติดภาพฝัน ตีความลางมากเกินไป จนไม่กล้าตัดสินใจบนพื้นฐานที่มั่นคง',
            color: '#3949AB',
            examples: `• ทำนายสิ่งต่าง ๆ ตลอดเวลา จนลังเลจะลงมือทำอะไรจริงจัง<br>• เชื่อว่าทุกอย่างมีนัยยะซ่อนเร้น แม้เป็นเรื่องเล็ก<br>• หลีกเลี่ยงความรับผิดชอบโดยอ้างว่ารอ “สัญญาณจากจักรวาล”`,
            mindsetShift: `• จาก “ฉันต้องรอสัญญาณ” → “ฉันคือสัญญาณที่จักรวาลรอให้ลงมือ”<br>• จาก “ฉันรู้สิ่งที่คนอื่นไม่รู้” → “สิ่งที่รู้จะมีพลังก็ต่อเมื่อใช้ให้เกิดผลจริง”`,
            healing: `•	ฝึก Grounding ทุกเช้า เช่น เดินบนดิน หายใจรู้น้ำหนักตัว<br>• วางแผนงานด้วย “ลงมือทำ 1 อย่าง” ในสิ่งที่ฝันไว้<br>• จำกัดเวลาทำนาย/จินตนาการ เพื่อคืนสมดุลให้กับกายภาพ`
        };
    }

    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR > 0.5 && VAR < 2.0) {
        return {
            code: 'D',
            name: 'ม่านบังตา',
            description: 'คุณอาจเห็นภาพฝัน หรือมีลางบ่อย ๆ แต่บางครั้งใช้ผิดจังหวะ บางทีตีความมากเกิน หรือใช้ญาณจนลืมดูข้อมูลที่แท้จริง',
            color: '#3949AB',
            examples: `• บางวันรู้ลึกชัดมาก บางวันกลับสับสนจนจับอะไรไม่อยู่<br>• ตัดสินใจจากความรู้สึก แต่บางครั้งพลาดเพราะตีความผิด<br>• รู้ว่ามีญาณ แต่ยังไม่ไว้วางใจพอที่จะใช้กับเรื่องสำคัญ`,
            mindsetShift: `• จาก “ฉันยังไม่แม่นพอ” → “ญาณไม่ใช่เรื่องแม่นยำ แต่คือการฝึกฟังอย่างลึก”<br>• จาก “ฉันรู้สึกแบบนี้เลยต้องทำ” → “ฉันจะเช็คเสียงในใจซ้ำด้วยความนิ่งก่อนลงมือ”`,
            healing: `•	เขียน 2 คอลัมน์: สิ่งที่ “รู้สึก” vs สิ่งที่ “เห็นจริง” เพื่อสร้างสมดุล<br>• ฝึก “ถอย 1 วันก่อนตัดสินใจเรื่องใหญ่” ให้เกิดการกลั่น<br>• ใช้กลิ่นหอม เช่น ลาเวนเดอร์ หรือสมุนไพรเพื่อดึงสติกลับมา`,
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR <= 0) {
        return {
            code: 'C',
            name: 'ตาที่สามเปิดในโลกจริง',
            description: 'คุณสามารถรับรู้สัญญาณภายในได้อย่างกลมกลืนกับโลกภายนอกใช้ทั้งสัญชาตญาณ เหตุผล และความเข้าใจเชิงจิตวิญญาณอย่างสมดุล',
            color: '#3949AB',
            examples: `• ตัดสินใจจาก “ความรู้ลึกในใจ” ไม่ใช่เพราะกลัวหรือกดดัน<br>• เห็นความเชื่อมโยงระหว่างเหตุการณ์ต่าง ๆ ได้ลึกซึ้ง<br>• วางใจในจังหวะของจักรวาล โดยไม่หลงไปกับความเพ้อฝัน`,
            mindsetShift: `• จาก “ทำไมฉันเห็นอะไรมากกว่าคนอื่น” → “ฉันเห็นเพราะฉันพร้อมรับผิดชอบต่อสิ่งที่รู้”<br>• จาก “ญาณของฉันแม่นแค่บางที” → “ญาณที่แท้คือสิ่งที่นำเราเข้าหาความกลมกลืน ไม่ใช่แค่การทำนาย”`,
            healing: `•	ฝึกภาวนา หรือใช้มนตราเพื่อเชื่อมกับภายใน<br>• เขียนบันทึก “ญาณที่เกิดขึ้นจริง” เพื่อสะท้อนการเติบโต<br>• แชร์การตื่นรู้กับผู้อื่น เพื่อเปลี่ยนเป็นปัญญาร่วม`,
        };
    }
    
    if (AVG >= 2.5 && AVG <= 3.4 && VAR <= 1) {
        return {
            code: 'B',
            name: 'เริ่มเห็นแสงลางๆ',
            description: 'คุณเริ่มรับรู้เสียงจากภายในบ้างแล้ว แม้ยังมีความไม่มั่นใจ อยู่ในช่วงเปลี่ยนผ่านระหว่าง “ใช้เหตุผลนำ” → “ใช้ทั้งใจและญาณร่วมกัน”',
            color: '#3949AB',
            examples: `• เริ่มรู้ว่า “บางอย่างรู้ได้โดยไม่ต้องมีเหตุผล”<br>• เคยมีลางสังหรณ์ที่แม่น แต่ยังไม่กล้าไว้ใจ<br>• เริ่มฝึกสมาธิ สังเกตฝัน หรือรับรู้สัญญาณรอบตัวมากขึ้น`,
            mindsetShift: `• จาก “ฉันอาจคิดไปเอง” → “บางครั้งสิ่งที่รู้สึกก็คือความรู้จริง”<br>• จาก “รอให้ชัดก่อนจึงตัดสินใจ” → “ความนิ่งทำให้สิ่งที่คลุมเครือค่อย ๆ กระจ่าง”`,
            healing: `•	ฝึกสมาธิแบบจ้องเทียน (Trataka) หรือหลับตาฟังเสียงภายใน<br>• เขียน “ภาพอนาคต” ที่รู้สึกอยู่ลึก ๆ แม้ยังไม่เป็นจริง<br>• วาดภาพจากจินตนาการ โดยไม่ต้องสวยหรือมีโครงเรื่อง`,
        };
    }

    if(AVG <= 2.4 && VAR <= 1) {
        return {
        code: 'A',
        name: 'มองไม่เห็นทาง',
        description: 'คุณอาจรู้สึกว่าสับสน ไม่รู้ทิศทาง หรือไม่ไว้ใจเสียงจากภายในญาณยังถูกบดบังด้วยความกลัว ความคิดฟุ้ง หรือการยึดติดกับตรรกะมากเกินไป',
        color: '#3949AB',
        examples: `• ตัดสินใจยาก รู้สึกว่าสิ่งต่าง ๆ “ยังไม่ชัด”<br>• มักพึ่งความเห็นของคนอื่นตลอด ไม่ไว้ใจความรู้สึกตัวเอง<br>• ปฏิเสธหรือกลัวความลึกลับ เช่น ลางสังหรณ์ ฝัน หรือสัญญาณบางอย่าง`,
        mindsetShift: `• จาก “ฉันไม่รู้จะเลือกทางไหน” → “ทุกทางเริ่มจากความนิ่งภายใน”<br>• จาก “ความรู้สึกของฉันไม่น่าเชื่อถือ” → “สัญชาตญาณคือของขวัญจากจิตวิญญาณ”`,
        healing: `•	ฝึก “สังเกตความคิด” วันละ 5 นาที โดยไม่ตัดสิน<br>• ลองวาดสิ่งที่เห็นในใจหลังตื่นนอน<br>• ฝึกถามตัวเองคำถามเปิด เช่น “ถ้าไม่มีความกลัว ฉันจะทำอะไร?”`,
      
    };
    }
    
  
}
function getSection7(AVG, VAR, hasHighScore, scores) {
    if (VAR >= 3.0) {
        return {
            code: 'F',
            name: 'ศรัทธาที่กลัวศรัทธา',
            description: 'คุณรู้สึกถึงการเชื่อมต่อ แต่ใจยังกลัวจะ “ยอม” ให้กับสิ่งที่ควบคุมไม่ได้ จิตมีความลึกซึ้ง แต่ยังมีเงาของ Ego ที่ต้องการ “เข้าใจทุกอย่างก่อนเชื่อ”',
            color: '#8E24AA',
            examples: `• อยากมีศรัทธา แต่ต้องวิเคราะห์ทุกอย่างก่อนจึงจะวางใจ<br>• ภาวนาแล้วรู้สึกดีมาก แต่กลับไม่อยากทำต่อ เพราะกลัวหลุดจากตัวตนเดิม<br>• กลัวการ “สูญ” หรือสภาวะที่ควบคุมไม่ได้ แม้จะใฝ่หามัน`,
            mindsetShift: `• จาก “ฉันจะศรัทธา ถ้าพิสูจน์ได้” → “ศรัทธาคือสิ่งที่เราวางไว้ก่อนการพิสูจน์”<br>• จาก “ฉันกลัวจะหายไป” → “เมื่อฉันยอมละตัวตน ฉันกลับเต็มไปด้วยแสง”`,
            healing: `•	ฝึก “ยอมให้ความไม่รู้เป็นครู” เช่น การเฝ้าดูลมหายใจโดยไม่ต้องควบคุม<br>• พูดคุยกับผู้มีประสบการณ์ตื่นรู้ เพื่อรู้ว่าคุณไม่ได้เดินทางลำพัง<br>• สร้างบทสนทนาในใจระหว่าง Ego กับจิตที่รู้ เพื่อให้เกิดความเข้าใจ`
        };
    }
    
    if (AVG >= 4.3 && hasHighScore) {
        return {
            code: 'E',
            name: 'หลุดลอยจากร่าง',
            description: 'คุณอาจมีสภาวะตื่นรู้สูงมาก แต่ขาดการ Grounding กับโลก อยู่ในโลกแห่งความว่าง นิพพาน หรืออุดมคติ จนหลีกเลี่ยงภารกิจจริงในโลกนี้',
            color: '#8E24AA',
            examples: `• ชอบอยู่คนเดียวในสมาธิ ไม่สนใจปัญหาทางโลก<br>• เชื่อว่า “ทุกอย่างคือมายา” จนไม่รับผิดชอบต่อการกระทำ<br>• รู้สึกว่า “ไม่อยากกลับมาอยู่ในโลกนี้” หลังจากฝึกภาวนา`,
            mindsetShift: `• จาก “โลกนี้ไม่มีอะไรจริง” → “ความว่างที่แท้คือการกลับมาเติมเต็มโลก”<br>• จาก “ฉันไม่เป็นส่วนหนึ่งของโลกนี้” → “ฉันมาเพื่อเป็นช่องทางแห่งแสงในโลกนี้”`,
            healing: `•	เชื่อมกับจักระฐาน: ทำสวน เดินดิน กอดต้นไม้<br>• ใช้พลังแห่งความตื่นรู้เพื่อช่วยผู้อื่นอย่างเป็นรูปธรรม เช่น สอน ฟัง ช่วยเหลือ<br>• ออกกำลังกายหนัก ๆ สัปดาห์ละ 1–2 ครั้ง เพื่อดึงจิตกลับเข้าร่าง`
        };
    }

    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR > 0.5 && VAR < 2.0) {
        return {
            code: 'D',
            name: 'แสงกระพริบ',
            description: 'คุณเชื่อมกับจักรวาลได้ในบางช่วง แต่ยังไม่มั่นคง บางครั้งรู้สึกปลอดโปร่งมาก แต่บางครั้งกลับรู้สึกกลวงเปล่า',
            color: '#8E24AA',
            examples: `• มีช่วงเวลาที่ลึกซึ้งกับจักรวาล แต่ไม่ยืดเยื้อ<br>• เข้าใจบางสัจธรรม แต่ยังรู้สึกโดดเดี่ยว<br>• รู้ว่าต้องปล่อยวาง แต่ไม่รู้ว่าจะ “เชื่อมกับสิ่งสูงสุด” อย่างไร`,
            mindsetShift: `• จาก “ทำไมฉันถึงเชื่อมได้แค่บางครั้ง” → “ศรัทธาก็มีจังหวะของมัน”<br>• จาก “บางครั้งรู้สึกถึงพระเจ้า บางครั้งไม่” → “การไม่รู้สึกก็อาจเป็นส่วนหนึ่งของการสื่อสาร”`,
            healing: `•	ฝึกภาวนาหรือสมาธิอย่างมีจังหวะที่แน่นอน<br>• เขียนบันทึก “ช่วงเวลาที่รู้สึกเชื่อม” เพื่อกลับไปทบทวน<br>• ละบางสิ่งชั่วคราว เช่น โซเชียล มีเดีย เพื่อให้จิตมีที่ว่างรับแสง`,
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR <= 0) {
        return {
            code: 'C',
            name: 'หลอมรวมกับแสง',
            description: 'คุณสามารถเชื่อมต่อกับสภาวะสูงสุดโดยไม่ลอยตัว รู้ว่าตัวตนไม่ใช่เพียงร่างกาย แต่ไม่ละเลยโลกวัตถุหรือชีวิตจริง',
            color: '#8E24AA',
            examples: `• มีสภาวะสงบลึกแม้ในสถานการณ์ท้าทาย<br>• สามารถ “อยู่กับความว่าง” โดยไม่ต้องกลัว<br>• ทำสิ่งต่าง ๆ ด้วยจิตแห่งการอุทิศ ไม่ใช่การแสดงออกของอัตตา`,
            mindsetShift: `• จาก “ฉันรู้แล้ว” → “สิ่งที่ฉันรู้คือเพียงเศษเสี้ยวของแสงที่ไร้ขอบเขต”<br>• จาก “ฉันตื่นแล้ว” → “ฉันตื่นในแต่ละลมหายใจ ไม่ใช่เพียงครั้งเดียว”`,
            healing: `•	ฝึก “อุทิศผลบุญ” ทุกครั้งหลังจบกิจกรรม เช่น ภาวนา ทำงาน ช่วยผู้อื่น<br>• อ่านหรือฟังธรรมะที่ช่วยให้กลับสู่ความถ่อมตน<br>• สร้าง Moment of Stillness วันละ 1 ครั้ง เพื่อเตือนตัวเองว่าทุกอย่างคือพร`,
        };
    }
    
    if (AVG >= 2.5 && AVG <= 3.4 && VAR <= 1) {
        return {
            code: 'B',
            name: 'กำลังเปิดสู่จักรวาล',
            description: 'คุณเริ่มเชื่อว่ามีบางสิ่งที่ยิ่งใหญ่กว่าความคิดของตน ศรัทธาเริ่มงอกเงย แม้ยังไม่มั่นใจว่ากำลังสื่อสารกับอะไรแน่',
            color: '#8E24AA',
            examples: `• เริ่มสังเกตสัญญาณที่ “บังเอิญเกินไป”<br>• สนใจเรื่องพลังงาน จิตวิญญาณ หรือคำภาวนา<br>• มีช่วงเวลาที่รู้สึกสงบลึก แม้จะสั้น ๆ`,
            mindsetShift: `• จาก “ฉันอาจแค่คิดไปเอง” → “บางครั้งใจเรารู้สิ่งที่ปัญญายังตามไม่ทัน”<br>• จาก “ฉันยังไม่รู้จักพระเจ้า” → “การเปิดใจก็คือการเริ่มต้นรู้จัก”`,
            healing: `•	ภาวนาแบบไม่ต้องใช้คำ — เพียงเปิดใจและวางใจในความเงียบ<br>• นั่งเงียบวันละ 3 นาที โดยไม่พยายามควบคุมความคิด<br>• หาที่โล่ง เช่น ท้องฟ้า หรือยอดเขา เพื่อสัมผัส “ความกว้าง” ของจักรวาล`,
        };
    }

    if(AVG <= 2.4 && VAR <= 1) {
        return {
        code: 'A',
        name: 'ตัดขาดจากแสง',
        description: 'คุณอาจรู้สึกแยกขาดจากจักรวาล หรือไม่เชื่อว่าสิ่งศักดิ์สิทธิ์นั้นมีอยู่ จิตยังวนอยู่กับความคิด ความกลัว หรือการยึดมั่นในสิ่งที่ควบคุมได้เท่านั้น',
        color: '#8E24AA',
        examples: `• รู้สึกโดดเดี่ยว แม้จะอยู่ท่ามกลางผู้คน<br>• ไม่เชื่อว่าการภาวนา หรือศรัทธาจะเปลี่ยนแปลงอะไรได้จริง<br>• กลัวสิ่งที่ควบคุมไม่ได้ เช่น ความตาย ความเปลี่ยนแปลง หรือความว่าง`,
        mindsetShift: `• จาก “ไม่มีใครช่วยฉันได้” → “จักรวาลอยู่ตรงนี้เสมอ เมื่อใจพร้อมเปิด”<br>• จาก “ฉันเชื่อตัวเองเท่านั้น” → “พลังที่สูงกว่าไม่ใช่ศัตรูของอัตตา แต่คือแสงที่อยู่เหนือมัน”`,
        healing: `•	เริ่มวันด้วยการยกมือขึ้นเหนือหัว แล้วพูดว่า “ฉันเปิดใจรับแสง”<br>• อ่านบทกวีหรือคำภาวนาที่ให้พลังกับจิต<br>• ฟังดนตรีที่สร้างความสงบ เช่น binaural beats, เสียงระฆังธรรมะ`,
      
    };
    }
    
  
}
function getSection8(AVG, VAR, hasHighScore, scores) {
    if (VAR >= 3.0) {
        return {
            code: 'F',
            name: 'ระหว่างพันธะกับความกลัว',
            description: 'คุณรู้ว่ามีพลังบางอย่างเรียกหา แต่ลึก ๆ ก็กลัวว่าจะต้องเปลี่ยนแปลงมากเกินไป อยากเดินทางวิญญาณ แต่กลัวจะต้องทิ้งความมั่นคงในโลกนี้',
            color: '#D3AF37',
            examples: `• บางวันมั่นใจในภารกิจตนเองมาก บางวันไม่รู้จะทำอะไร<br>• สนใจเรื่องพลังกรรม แต่รู้สึกว่ามันใหญ่เกินควบคุม<br>• สับสนระหว่าง “เดินตามเสียงวิญญาณ” กับ “ดูแลชีวิตจริงให้มั่นคง”`,
            mindsetShift: `• จาก “ถ้าฉันเดินตามวิญญาณ ฉันอาจเสียสิ่งสำคัญ” → “การฟังเสียงวิญญาณจะนำฉันสู่สิ่งที่แท้จริงกว่า”<br>• จาก “ฉันยังไม่กล้า” → “ความกลัวคือประตูด่านแรกของพันธะที่แท้”`,
            healing: `•	เขียนจดหมายถึง “ตัวตนกล้าหาญ” ของคุณ<br>• ฝึกยอมให้มี “ช่วงไม่รู้” โดยไม่รีบหาเหตุผล<br>• ปรึกษาผู้รู้เรื่องดวงวิญญาณ/จุดมุ่งหมาย เพื่อคลี่คลายความสับสน`
        };
    }
    
    if (AVG >= 4.3 && hasHighScore) {
        return {
            code: 'E',
            name: 'หมกมุ่นกับชะตา',
            description: 'คุณอาจมีความรู้สึกลึกว่า “ฉันมีหน้าที่ใหญ่” จนทำให้กดดันตัวเองหรือแยกตัวจากโลก เชื่อว่าทุกอย่างต้องมีความหมาย จนไม่เปิดพื้นที่ให้กับชีวิตธรรมดา',
            color: '#D3AF37',
            examples: `• ใช้เรื่องพันธะกรรมหรือภารกิจเป็นเหตุผลไม่ทำสิ่งที่ควรทำ<br>• รู้สึกว่าชีวิต “ธรรมดาเกินไป” และไม่ใช่เส้นทางแท้<br>• กดดันตัวเองให้ต้อง “รู้ทุกอย่าง” หรือ “ช่วยคนทุกคน”`,
            mindsetShift: `• จาก “ฉันต้องทำสิ่งยิ่งใหญ่” → “แค่การมีชีวิตอย่างอ่อนโยนก็อาจเป็นภารกิจที่ยิ่งใหญ่ที่สุด”<br>• จาก “ฉันเกิดมาเพื่อ…” → “ฉันถูกสร้างขึ้นเพื่อรักและเรียนรู้ ไม่ใช่แค่ ‘ทำ’ ภารกิจใด”`,
            healing: `•	กลับมาสู่กิจกรรมธรรมดา เช่น ทำอาหาร ปลูกต้นไม้<br>• ถามตนเองว่า “ฉันกำลังรับใช้พันธะ หรือกำลังหลบซ่อนอยู่ในมัน?”<br>• ฝึก “อยู่กับสิ่งเล็ก” เช่น รอยยิ้ม หยดน้ำ ใบไม้ เพื่อให้ชีวิตกลับสู่ความสมดุล`
        };
    }

    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR > 0.5 && VAR < 2.0) {
        return {
            code: 'D',
            name: 'เห็นเส้นทางแต่ยังลังเล',
            description: 'คุณอาจรู้สึกถึงภารกิจลึกในใจ แต่ยังมีความกลัว ความสงสัย หรือแรงต้านจากภายนอก พลังจากดวงดาววิญญาณเริ่มส่องมา แต่คุณยังไม่เปิดใจรับเต็มที่',
            color: '#D3AF37',
            examples: `• มีแรงบันดาลใจบางอย่าง แต่ยังไม่กล้าทำจริง<br>• รู้ว่าอะไรคือสิ่งที่ต้องทำ แต่รู้สึก “ยังไม่พร้อม”<br>• กลัวว่าจะถูกตัดสินหากเดินตามเสียงข้างใน`,
            mindsetShift: `• จาก “ฉันไม่แน่ใจว่าจะเดินเส้นทางนี้ดีไหม” → “เส้นทางจะมั่นขึ้นเมื่อฉันกล้าเดินแม้เพียงก้าวเล็ก ๆ”<br>• จาก “ฉันยังไม่รู้ว่าพันธะของฉันคืออะไร” → “ฉันไม่จำเป็นต้องรู้ทั้งหมด แค่เริ่มรับใช้สิ่งที่มี”`,
            healing: `•	สร้าง Ritual เล็ก ๆ เพื่อเชื่อมกับพลังสูง เช่น จุดเทียนขาวทุกเช้า<br>• เขียนจดหมายถึง “ตัวฉันในอนาคตที่ทำตามเสียงวิญญาณแล้ว”<br>• ปรึกษา Mentor ทางจิตวิญญาณ หรือครูที่ไว้วางใจได้`,
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR <= 0) {
        return {
            code: 'C',
            name: 'เชื่อมกับเส้นทางวิญญาณ',
            description: 'คุณรับรู้ได้ว่าชีวิตของคุณคือการเดินทางที่มีความหมายลึกกว่าที่ตาเห็น ไม่เพียงรู้จุดมุ่งหมาย แต่คุณเริ่มดำเนินชีวิตให้สอดคล้องกับเสียงจากเบื้องลึกนั้น',
            color: '#D3AF37',
            examples: `• รู้ว่า “สิ่งที่ฉันทำ” คือการเข้าถึงบางอย่างที่ใหญ่กว่าตัวเอง<br>• สามารถให้อภัยอดีต เพราะเข้าใจว่าเป็นส่วนของบทเรียน<br>• รู้สึกถึงการนำทางจากพลังงานที่สูงขึ้น โดยไม่หลงตัวเอง`,
            mindsetShift: `• จาก “ฉันต้องหาความหมายชีวิต” → “ฉันคือความหมายในทุกลมหายใจ”<br>• จาก “ใครคือผู้ให้เส้นทางแก่ฉัน” → “ฉันเองคือแสงแห่งวิญญาณที่กำลังส่องนำผู้อื่น”`,
            healing: `•	หมั่นภาวนาเพื่อขอคำนำทางจาก Soul Star<br>• ช่วยผู้อื่นด้วยความตั้งใจ ไม่หวังผลตอบแทน<br>• ทบทวนเส้นทางชีวิตเป็นระยะ เพื่อเช็กว่าตรงกับเป้าหมายวิญญาณหรือไม่`,
        };
    }
    
    if (AVG >= 2.5 && AVG <= 3.4 && VAR <= 1) {
        return {
            code: 'B',
            name: 'เริ่มระลึกพันธะ',
            description: 'คุณเริ่มรู้สึกถึงแรงดึงบางอย่างในชีวิต เหมือนมี "จุดหมาย" ลึก ๆ ที่กำลังรอให้คุณตอบรับ แม้ยังไม่ชัดเจน แต่หัวใจเริ่มรู้ว่ามีภารกิจที่เหนือกว่าความต้องการของอัตตา',
            color: '#D3AF37',
            examples: `• เริ่มสนใจเรื่อง Akashic Record, วิถีกรรม, หรือดวงวิญญาณ<br>• สังเกตว่า “ความบังเอิญ” หลายครั้งอาจไม่ใช่แค่เรื่องบังเอิญ<br>• มีอารมณ์ความรู้สึกบางอย่างที่อธิบายไม่ได้ เหมือนเคยเกิดขึ้นมาก่อน`,
            mindsetShift: `• จาก “ฉันไม่แน่ใจว่าอะไรคือเส้นทางของฉัน” → “เส้นทางจะชัดขึ้นเมื่อฉันเดินต่อ”<br>• จาก “ฉันยังสับสน” → “การสับสนก็เป็นส่วนหนึ่งของการระลึก”`,
            healing: `•	เขียนคำถามถึง “ตัวฉันระดับวิญญาณ” แล้วรอฟังคำตอบในใจเงียบ<br>• ฝึก “ภาวนาถามคำตอบในฝัน” ก่อนนอน<br>• เริ่มบันทึก “เหตุการณ์ที่ดูมีความหมายลึก” เพื่อสังเกต Pattern วิญญาณ`,
        };
    }

    if(AVG <= 2.4 && VAR <= 1) {
        return {
        code: 'A',
        name: 'หลงทางในชะตา',
        description: 'คุณอาจรู้สึกติดอยู่กับอดีต ความผิดพลาด หรือความเจ็บปวดที่ยังไม่ได้รับการคลี่คลาย การสื่อสารกับเป้าหมายวิญญาณถูกบดบังด้วยความสับสน ความรู้สึกผิด หรือความไม่เชื่อในตนเอง',
        color: '#D3AF37',
        examples: `• รู้สึกว่า “ชีวิตวนลูปเดิม ๆ” หรือ “ทำไมฉันต้องเจอเรื่องนี้ซ้ำแล้วซ้ำอีก”<br>• เคยเจ็บหนักในอดีต และยังไม่ให้อภัยทั้งตัวเองและผู้อื่น<br>• ไม่รู้สึกว่าตนมีเป้าหมายใด ๆ ที่แท้จริง`,
        mindsetShift: `• จาก “อดีตของฉันคือเงาหนัก” → “อดีตคือครูที่ต้องการให้ฉันรับรู้ ไม่ใช่แบกไว้”<br>• จาก “ฉันไม่มีพันธกิจพิเศษอะไร” → “การเยียวยาตัวเองคือพันธกิจแรกของวิญญาณ”`,
        healing: `•	ฝึกเขียนจดหมายถึง “ตัวฉันในอดีต” เพื่อให้อภัย<br>• ใช้ Crystal เช่น Selenite หรือ Amethyst ช่วยเปิดพลัง Soul Star<br>• วางมือตรงเหนือศีรษะ และพูดว่า “ฉันเปิดรับแสงแห่งการปลดพันธะ”`,
      
    };
    }
    
  
}
function getSection9(AVG, VAR, hasHighScore, scores) {
    if (VAR >= 3.0) {
        return {
            code: 'F',
            name: 'สวิงระหว่างรากกับการลอย',
            description: 'คุณอาจมีทั้งช่วงที่ “อยู่กับโลกมากเกินไป” และช่วงที่ “อยากหนีจากโลก” จิตของคุณกำลังหาความสมดุลระหว่างการหยั่งรากกับการบิน',
            color: '#8B0000',
            examples: `• บางวันอยากเป็นนักบวช, บางวันอยากเปิดธุรกิจ<br>• รู้สึกเบื่อโลกบ่อย แต่ก็กลัวการตาย<br>• วางแผนเรื่องทรัพย์สิน แต่บางครั้งอยากละทิ้งหมด`,
            mindsetShift: `• จาก “ฉันต้องเลือกระหว่างโลกกับวิญญาณ” → “ฉันคือวิญญาณที่เลือกมาเกิดในโลก”<br>• จาก “ฉันไม่มีจุดยืน” → “การเปลี่ยนแปลงคือการเติบโตของราก”`,
            healing: `•	เขียนไดอารี่วันละหน้า: ถามตัวเองว่า “วันนี้ฉันอยู่กับโลกหรือหนีจากมัน?”<br>• ฝึกทำอาหารด้วยตนเองทุกสัปดาห์<br>• เชื่อมการภาวนากับการลงมือ เช่น ภาวนาแล้วลงมือเก็บห้อง`
        };
    }
    
    if (AVG >= 4.3 && hasHighScore) {
        return {
            code: 'E',
            name: 'ติดหล่มความมั่นคง',
            description: 'คุณมีพลังหยั่งรากแน่นหนา แต่แข็งทื่อ อาจกลัวการเปลี่ยนแปลง หรือรู้สึกไม่ปลอดภัยเมื่อสิ่งรอบตัวไม่เหมือนเดิม',
            color: '#8B0000',
            examples: `• ยึดติดกับบ้าน ครอบครัว หรือวิถีชีวิตที่ “เคยทำมา”<br>• ไม่กล้าเปลี่ยนแปลงอาชีพ หรือวิธีดำเนินชีวิต<br>• มองคนรุ่นใหม่/แนวคิดใหม่ด้วยความกลัวมากกว่าความเปิดใจ`,
            mindsetShift: `• จาก “ฉันต้องยึดไว้” → “บางครั้งการปล่อยให้ไหล คือการยึดรากที่ลึกกว่า”<br>• จาก “สิ่งนี้มั่นคงดีอยู่แล้ว” → “รากที่แท้ยืดหยุ่น ไม่ใช่แข็งทื่อ”`,
            healing: `•	ทดลองทำสิ่งใหม่ในพื้นที่ปลอดภัย เช่น เปลี่ยนเส้นทางกลับบ้าน<br>• ฝึก “ปลง” กับความไม่แน่นอน เช่น เดินทางโดยไม่วางแผน<br>• สำรวจว่าอะไรคือ “สิ่งที่ฉันกลัวจะเสีย” แล้วเปิดใจคุยกับมัน`
        };
    }

    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR > 0.5 && VAR < 2.0) {
        return {
            code: 'D',
            name: 'มีราก แต่ยังไม่ลึก',
            description: 'คุณอาจดูเหมือนเชื่อมต่อกับธรรมชาติและโลกภายนอกได้ดี แต่ภายในยังมีจุดที่ไม่แน่น — อาจเป็นการ “พยายามหยั่งราก” ผ่านกิจกรรม แต่จิตยังไม่วางลงจริง',
            color: '#8B0000',
            examples: `• สนใจธรรมชาติ แต่ยังใช้อุปกรณ์ดิจิทัลมาก<br>• ดูแลร่างกายดี แต่รู้สึก “ห่างเหิน” กับมัน<br>• อยู่กับครอบครัวได้ แต่ยังรู้สึกว่าไม่เข้าใจตนเองในบริบทของตระกูล`,
            mindsetShift: `• จาก “ฉันอยู่กับโลกแล้ว” → “ฉันกำลังเรียนรู้การอยู่กับโลกจากภายใน”<br>• จาก “ฉันเชื่อมกับรากแล้ว” → “ฉันยอมให้รากนั้นเติบโตอย่างอ่อนโยน ไม่เร่งรัด”`,
            healing: `•	ฝึก Body Scan Meditation: สังเกตอวัยวะต่าง ๆ ด้วยความเมตตา<br>• ทำ Timeline บรรพบุรุษ/ครอบครัว: สำรวจว่ามีพลังใดส่งต่อมา<br>• ตัดกิจกรรมที่ทำให้ “หลุดลอย” เช่น Overthinking หรือ scrolling มือถือ`,
        };
    }
    
    if (AVG >= 3.0 && AVG <= 4.2 && VAR <= 0) {
        return {
            code: 'C',
            name: 'หยั่งรากมั่นคงบนโลก',
            description: 'คุณมีความสัมพันธ์กับโลก ร่างกาย และความเป็นจริงได้อย่างลึกซึ้งจิตวิญญาณของคุณ “อยู่ในโลกนี้โดยไม่ติดโลก” — เป็นภาวะของการหยั่งรากพร้อมการยอมรับ',
            color: '#8B0000',
            examples: `• ใช้ชีวิตเรียบง่าย มี Ritural กับธรรมชาติประจำวัน<br>• เห็นคุณค่าในสิ่งเล็ก ๆ เช่น ดิน น้ำ แสงแดด<br>• รู้ว่าร่างกายคือวัดแห่งจิตวิญญาณ จึงดูแลอย่างถ่อมตน`,
            mindsetShift: `• จาก “ฉันต้องทำให้โลกดีขึ้น” → “การอยู่กับโลกอย่างถ่อมตนก็เปลี่ยนโลกได้”<br>• จาก “ฉันแค่ผ่านโลกนี้” → “ฉันคือผู้ปลูกพลังแห่งการมีอยู่บนโลก”`,
            healing: `•	เดินตามจังหวะของธรรมชาติ เช่น ตื่นตามแสงแดด<br>• ตั้งโต๊ะบูชาธรรมชาติในบ้าน เช่น น้ำใส หิน ต้นไม้<br>• ให้ความรักกับร่างกายทุกวัน: นวด ทาครีม สัมผัสเบา ๆ`,
        };
    }
    
    if (AVG >= 2.5 && AVG <= 3.4 && VAR <= 1) {
        return {
            code: 'B',
            name: 'เริ่มกลับคืนสู่ผืนดิน',
            description: 'คุณเริ่มรู้สึกว่าการกลับสู่ร่างกาย พื้นฐาน และธรรมชาติ คือการเยียวยาจิตใจแม้ยังไม่แน่นแฟ้นกับโลกนี้ แต่คุณเริ่มยอมรับว่ารากคือพลัง',
            color: '#8B0000',
            examples: `• เริ่มสนใจสมุนไพร, เกษตร, หรือการเชื่อมต่อกับโลกธรรมชาติ<br>• กลับมาดูแลร่างกายหรืออาหารมากขึ้น<br>• หยุดหลีกหนี “เรื่องพื้นฐาน” เช่น เงิน สุขภาพ ที่เคยละเลย`,
            mindsetShift: `• จาก “ฉันเป็นคนจิตวิญญาณ เลยไม่อินกับโลกนี้” → “ยิ่งจิตวิญญาณสูง ยิ่งต้องหยั่งรากลึก”<br>• จาก “ชีวิตธรรมดาน่าเบื่อ” → “สิ่งธรรมดานี่แหละที่ลึกที่สุด”`,
            healing: `•	ฝึก “รู้ตัวระหว่างกิจกรรมธรรมดา” เช่น ล้างจาน ตากผ้า<br>• เชื่อมโยงกับสายเลือดของคุณ: พูดคุยกับครอบครัว, อ่านประวัติบรรพบุรุษ<br>• ใช้เวลาทำงานกับผืนดิน อย่างน้อยสัปดาห์ละ 1 ครั้ง`,
        };
    }

    if(AVG <= 2.4 && VAR <= 1) {
        return {
        code: 'A',
        name: 'ไร้ราก ไร้จุดยืน',
        description: 'คุณอาจรู้สึกว่าโลกนี้ไม่น่าอยู่ ไม่สอดคล้อง หรือไม่มีที่ให้คุณหยั่งรากเหมือน “ลอยอยู่ในหัว” ตลอดเวลา ร่างกายเหมือนไม่ใช่บ้านของจิต',
        color: '#8B0000',
        examples: `• คิดมาก ว้าวุ่น หลุดลอย ไม่อยู่กับปัจจุบัน<br>• มีปัญหาเรื่องร่างกาย เช่น ขี้เกียจ เคลื่อนไหวช้า หรือหมดแรง<br>• วางแผนเก่งแต่ไม่ค่อยลงมือ เพราะขาด “พลังจากพื้นดิน”`,
        mindsetShift: `• จาก “ฉันไม่แน่ใจว่าโลกนี้เป็นที่ของฉัน” → “ฉันเลือกมาเกิด และโลกนี้คือที่ฝึกวิญญาณของฉัน”<br>• จาก “ฉันอยู่กับพลังงานสูง ๆ ได้ดีกว่า” → “พลังงานสูงต้องมีฐานรองรับ”`,
        healing: `•	Grounding ทุกวัน: เดินเท้าเปล่า โอบต้นไม้ หายใจเข้าท้อง<br>• รับประทานอาหารสด ปรุงน้อย ดิน-น้ำ-ไฟ-ลมครบ<br>• ทำกิจกรรมทางกายแบบหนักแน่น เช่น ปลูกต้นไม้ ทำความสะอาด เช็ดพื้น`,
      
    };
    }
    
  
}



// Default category (fallback)
function getDefaultCategory() {
    return {
        code: 'A',
        name: 'ต้องการการประเมิน',
        description: 'ข้อมูลไม่เพียงพอในการประเมิน',
        emoji: '❓',
        color: '#6B7280'
    };
}

// Updated showResult function call
// เปลี่ยนการเรียก function ใน showResult()
// const category = determineCategory(AVG, VAR, hasHighScore, sectionAnswers, sectionNum);

// Display results for all sections
function displayResults(sectionsData) {
    document.getElementById('question-page').style.display = 'none';
    document.getElementById('navigation-buttons').style.display = 'none';
    document.getElementById('result-page').style.display = 'block';
    
    // Create detailed results display
    const resultHtml = `
        <div style="text-align: left; max-height: 90%; overflow-y: auto; margin-bottom: 20px;">
            ${sectionsData.map(section => `
                <div style="margin-bottom: 25px; padding: 15px; border-radius: 10px; background: ${section.category.color}15; border-left: 4px solid ${section.category.color};">
                    <h3 style="margin: 0 0 10px 0; color: ${section.category.color}; display: flex; align-items: center; gap: 10px; font-weight: 500;">
                        จักระที่ ${section.section} - ${section.name}
                    </h3>
                    <div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;">
                       สภาวะจักระของคุณ: ${section.category.name}
                    </div>
                    <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
                        ${section.category.description}
                    </div>
                    <div style="margin-top: 20px; font-size: 16px; font-weight: 500;">
                    ตัวอย่างชีวิตจริง:
                    </div>
                     <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
                        ${section.category.examples}
                    </div>
                    <div style="margin-top: 20px; font-size: 16px; font-weight: 500;">
                    วิธีปรับความคิด:
                    </div>
                    <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
                        ${section.category.mindsetShift}
                    </div>
                    <div style="margin-top: 20px; font-size: 16px; font-weight: 500;">
                    แนวทางเยียวยา:
                    </div>
                    <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
                        ${section.category.healing}
                    </div>
                    <div style="font-size: 12px; color: #888;">
                        score: ${section.scores.Q1}, ${section.scores.Q2}, ${section.scores.Q3} | 
                        AVG: ${section.AVG.toFixed(2)} | 
                        VAR: ${section.VAR.toFixed(2)}
                    </div>
                </div>
            `).join('')}
        </div>
    `;
    resultHtmlGlobal = resultHtml;

//     const section = sectionsData[0]; // เอาเฉพาะตัวแรก

//     const resultHtmlShow = `
//     <div style="text-align: left; overflow-y: auto; margin-bottom: 20px;">
//         <div style="margin-bottom: 25px; padding: 15px; border-radius: 10px; background: ${section.category.color}15; border-left: 4px solid ${section.category.color};">
//             <h3 style="margin: 0 0 10px 0; color: ${section.category.color}; display: flex; align-items: center; gap: 10px; font-weight: 500;">
//                 จักระที่ ${section.section} - ${section.name}
//             </h3>
//             <div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;">
//                 สภาวะจักระของคุณ:: ${section.category.name}
//             </div>
//             <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
//                 ${section.category.description}
//             </div>
//             <div style="margin-top: 20px; font-size: 16px; font-weight: 500;">
//             ตัวอย่างชีวิตจริง:
//             </div>
//              <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
//                 ${section.category.examples}
//             </div>
//             <div style="margin-top: 20px; font-size: 16px; font-weight: 500;">
//             วิธีปรับความคิด:
//             </div>
//             <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
//                 ${section.category.mindsetShift}
//             </div>
//             <div style="margin-top: 20px; font-size: 16px; font-weight: 500;">
//             แนวทางเยียวยา:
//             </div>
//             <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
//                 ${section.category.healing}
//             </div>
//             <div style="font-size: 12px; color: #888;">
//                 score: ${section.scores.Q1}, ${section.scores.Q2}, ${section.scores.Q3} | 
//                 AVG: ${section.AVG.toFixed(2)} | 
//                 VAR: ${section.VAR.toFixed(2)}
//             </div>
//         </div>
//     </div>
// `;

const resultHtmlShow = `
  <div style="text-align: left; max-height: 90%; overflow-y: auto; margin-bottom: 20px;">
    ${sectionsData.map((section, index) => {
      const isBlur = index >= 2;
      const sectionHtml = `
        <div class="show-all-results" style="margin-bottom: 25px; padding: 15px; border-radius: 10px; background: ${section.category.color}15; border-left: 4px solid ${section.category.color}; ${isBlur ? 'filter: blur(4px); pointer-events: none;' : ''}">
          <h3 style="margin: 0 0 10px 0; color: ${section.category.color}; display: flex; align-items: center; gap: 10px; font-weight: 500;">
              จักระที่ ${section.section} - ${section.name}
          </h3>
          <div style="font-size: 18px; font-weight: 500; margin-bottom: 5px;">
             สภาวะจักระของคุณ: ${section.category.name}
          </div>
          <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
              ${section.category.description}
          </div>
          <div style="margin-top: 20px; font-size: 16px; font-weight: 500;">
          ตัวอย่างชีวิตจริง:
          </div>
          <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
              ${section.category.examples}
          </div>
          <div style="margin-top: 20px; font-size: 16px; font-weight: 500;">
          วิธีปรับความคิด:
          </div>
          <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
              ${section.category.mindsetShift}
          </div>
          <div style="margin-top: 20px; font-size: 16px; font-weight: 500;">
          แนวทางเยียวยา:
          </div>
          <div style="font-size: 14px; color: #666; margin-bottom: 10px;">
              ${section.category.healing}
          </div>
          <div style="font-size: 12px; color: #888;">
              score: ${section.scores.Q1}, ${section.scores.Q2}, ${section.scores.Q3} |
               AVG: ${section.AVG.toFixed(2)} |
               VAR: ${section.VAR.toFixed(2)}
          </div>
        </div>
      `;
      
      // แทรกปุ่มหลัง section ที่ 2 (index 1)
      if (index === 1) {
        return sectionHtml + `
          <div style="text-align: center; margin: 30px 0;">
            <button class="restart-btn" onclick="sentEmail()">
        <i class="fas fa-paper-plane" style="font-size: 18px; color: #fff"></i>    
        ส่งผลลัพธ์ฉบับเต็มทาง E-mail
        </button>
          </div>
        `;
      }
      
      return sectionHtml;
    }).join('')}
  </div>
`;
// แสดงผลลัพธ์ทั้งหมด

    document.getElementById('result-page').innerHTML = `
        <div class="logo" style="text-align: center; font-size: 20px; margin-bottom: 20px;">ผลการทดสอบจักระทั้ง 9 ของคุณ</div>
        ${resultHtmlShow}
       
        <button class="full-btn" onclick="copyLink()" style="display: none">
        <i class="fas fa-share-nodes mr-2"></i>
        แชร์แบบทดสอบให้เพื่อน
        </button>
          <button  onclick="copyLink()" id="retryButton" style="margin-top: 20px; display: none; width: 100%; background: #28496F;
                        color: white;
                        border: none;
                        padding: 15px 40px;
                        border-radius: 10px;
                        cursor: pointer;
                        font-size: 16px;
                        font-weight: bold;
                        letter-spacing: 0.5px;
                        transition: all 0.3s ease;
                        font-family: 'Mitr', sans-serif;
                        font-weight: 500;" class="submit-btn">
            <i class="fas fa-share-nodes mr-2"></i>
        แชร์แบบทดสอบให้เพื่อน</button>
    
    `;
}

    // <button class="sendemail-btn" onclick="sentEmail()" style="margin-top: 10px; display: none; width: 100%;">
    //     <i class="fas fa-paper-plane" style="font-size: 18px; color: #fff"></i>    
    //     ส่งผลลัพธ์ทาง E-mail
    //     </button>
// Restart quiz
// function restartQuiz() {
//     currentQuestionIndex = 0;
//     answers = [];
    
//     document.getElementById('question-page').style.display = 'flex';
//     document.getElementById('navigation-buttons').style.display = 'flex';
//     document.getElementById('result-page').style.display = 'none';
    
//     initQuiz();
// }
function showFullResultsWithClass() {
    // เพิ่ม CSS class เพื่อลบ blur
    const style = document.createElement('style');
    style.textContent = `
        .show-all-results div[style*="filter: blur"] {
            filter: none !important;
            pointer-events: auto !important;
        }
    `;
    document.head.appendChild(style);
    
    // เพิ่ม class ให้ result page
    const resultPage = document.getElementById('result-page');
    if (resultPage) {
        resultPage.classList.add('show-all-results');
    }
    
    // ซ่อนปุ่ม
    const fullBtn = document.querySelector('.full-btn');
    if (fullBtn) {
        fullBtn.style.display = 'none';
    }
    
    const shareBtn = document.querySelector('.submit-btn');
    if (shareBtn) {
        shareBtn.style.display = 'block';
    }

    const sendEmailBtn = document.querySelector('.sendemail-btn');
    if (sendEmailBtn) {
        sendEmailBtn.style.display = 'block';
    }

    const restartBtn = document.querySelector('.restart-btn');
    if (restartBtn) {
        restartBtn.style.display = 'none';
    }

    const popup = document.querySelector('.popup-overlay');
    if (popup) {
        popup.style.display = 'none';
    }

}

        function sentEmail() {
            // Create popup overlay
            const overlay = document.createElement('div');
            overlay.className = 'popup-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 1000;
                backdrop-filter: blur(5px);
            `;

            // Create popup content
            const popup = document.createElement('div');
            popup.style.cssText = `
                background: white;
                padding: 0;
                border-radius: 20px;
                width: 90%;
                max-width: 420px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                text-align: center;
                overflow: hidden;
                animation: slideIn 0.3s ease-out;
            `;

            popup.innerHTML = `
                <style>
                    @keyframes slideIn {
                        from { transform: scale(0.8) translateY(-50px); opacity: 0; }
                        to { transform: scale(1) translateY(0); opacity: 1; }
                    }
                    .email-input {
                        width: 100%;
                        padding: 15px 20px;
                        border: none;
                        background: #F2F2F2;
                        border-radius: 12px;
                        font-size: 16px;
                        margin-bottom: 15px;
                        box-sizing: border-box;
                        outline: none;
                        transition: all 0.3s ease;
                    }
                    .email-input:focus {
                        background: #F2F2F2;
                        transform: translateY(-2px);
                        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                        border: 1px solid #28496F;
                    }
                    .email-input::placeholder {
                        color: #6B7280;
                        opacity: 0.8;
                    }
                    .submit-btn {
                        background: #28496F;
                        color: white;
                        border: none;
                        padding: 15px 40px;
                        border-radius: 10px;
                        cursor: pointer;
                        font-size: 16px;
                        font-weight: bold;
                        letter-spacing: 0.5px;
                        transition: all 0.3s ease;
                        margin: 10px 5px;
                        font-family: 'Mitr', sans-serif;
                        font-weight: 500;
                    }
                    .submit-btn:hover {
                        background: #28496F;
                        transform: translateY(-2px);
                       
                    }
                    .cancel-btn {
                        background: #F8F9FA;
                        color: #6B7280;
                        border: 2px solid #E5E7EB;
                        padding: 13px 30px;
                        border-radius: 10px;
                        cursor: pointer;
                        font-size: 16px;
                        transition: all 0.3s ease;
                        margin: 10px 5px;
                    }
                    .cancel-btn:hover {
                        background: #E5E7EB;
                        transform: translateY(-2px);
                    }
                </style>
                
                <!-- Header Section -->
                <div style="background: linear-gradient(135deg, #FFA726 0%, #FFD966 100%); padding: 40px 30px; position: relative;">
              
                    <!-- Email Icon -->
                    <div style="background: rgba(255,255,255,0.2); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px);">
                        <div style="">
                            <i class="fas fa-envelope-open-text" style="font-size: 40px; color: #fff"></i>
                        
                        </div>
                    </div>
                    
                    <h3 style="color: white; margin: 0 0 8px 0; font-size: 28px; font-weight: 400;  font-family: 'Mitr', sans-serif !important;">ส่งผลลัพธ์ฉบับเต็มทาง E-mail</h3>

                </div>
                
                <!-- Form Section -->
                <div style="padding: 30px;" id="form-section">
                    <input type="text" id="name" placeholder="Enter your name" class="email-input">
                    <input type="email" id="email" placeholder="Enter your email" class="email-input">
                    
                    <div style="margin-top: 25px;">
                        <button onclick="sendEmailData()" class="submit-btn">SUBMIT</button>
                        <button onclick="closeEmailPopup()" class="cancel-btn">Cancel</button>
                    </div>
                    
                    <div class="msg"></div>
               
                </div>
           <!-- Loading Overlay -->
                 <div class="loading-overlay" id="loadingOverlay">
                     <div class="loading-modal">
                       <div class="loading-text">Please wait...</div>
                       <div class="spinner"></div>
                    </div>
                 </div>

                 <div id="successContainer" style="display: none; text-align: center; margin-bottom: 40px;">
                    <div id="successMessage" style="font-size: 30px; color: green; font-family: 'Mitr', sans-serif; margin-top: 20px">ส่งอีเมลสำเร็จแล้ว!</div>
                    <button  onclick="showFullResultsWithClass()" id="retryButton" style="margin-top: 20px; display: block; width: 80%; margin: 20px auto;" class="submit-btn">
                   
                    แสดงผลลัพธ์ทั้งหมด</button>
                </div>
             
            `;

            overlay.appendChild(popup);
            document.body.appendChild(overlay);

            // Store overlay reference for closing
            window.emailOverlay = overlay;

            // Close on overlay click
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    closeEmailPopup();
                }
            });
        }

        function closeEmailPopup() {
            if (window.emailOverlay) {
                document.body.removeChild(window.emailOverlay);
                window.emailOverlay = null;
            }
        }
        function copyLink() {
            navigator.clipboard.writeText(window.location.href);
            showCopyNotification();
        }

        function showCopyNotification() {
    // สร้าง notification element
    const notification = document.createElement('div');
    notification.innerHTML = `
        <div style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: slideIn 0.3s ease-out;
        ">
            <span>✓</span>
            <span style="font-family: 'Mitr', sans-serif;">คัดลอกลิงก์แล้ว!</span>
        </div>
    `;
    
    // เพิ่ม CSS animation
    if (!document.getElementById('copy-notification-style')) {
        const style = document.createElement('style');
        style.id = 'copy-notification-style';
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(notification);
    
    // ลบ notification หลัง 3 วินาที
    setTimeout(() => {
        notification.firstElementChild.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}
     function showLoading() {
            $('#loadingOverlay').fadeIn(300);
            $('.submit-btn').prop('disabled', true);
        }

        function hideLoading() {
            $('#loadingOverlay').fadeOut(300);
            $('.submit-btn').prop('disabled', false);
        }

        function showMessage(message, type = 'success') {
            $('.msg')
                .removeClass('success error')
                .addClass(type)
                .text(message)
                .fadeIn(300);
            
            // ซ่อนข้อความหลัง 5 วินาที
            setTimeout(() => {
                $('.msg').fadeOut(300);
            }, 5000);
        }

           function sendEmailData() {
            var name = $("#name");
            var email = $("#email");
          
            if(isNotEmpty(name) && isNotEmpty(email)) {
                document.getElementById("loadingOverlay").style.display = "flex";
                $.ajax({
                    url: 'send-email.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: name.val(),
                        email: email.val(),
                        header: 'header',
                        detail: resultHtmlGlobal
                    }, 
                    // error: function(xhr, status, error) {
                    //     hideLoading();
                    //     showMessage("เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง", 'error');
                    //     console.error('Ajax Error:', error);
                    // }
                });
                     setTimeout(function () {
                // ปิด loading
                document.getElementById("loadingOverlay").style.display = "none";
                document.getElementById("name").value = "";
                document.getElementById("email").value = "";

                // แสดงข้อความสำเร็จ
                const successContainer = document.getElementById("successContainer");
                const successMessage = document.getElementById("successMessage");
                const retryButton = document.getElementById("retryButton");
                const formSection = document.getElementById("form-section");

                successContainer.style.display = "block";
                successMessage.style.display = "block";
                formSection.style.display = "none";

                // รอ 2 วิแล้วโชว์ปุ่ม
                setTimeout(function () {
                    retryButton.style.display = "inline-block";
                }, 2000);
            }, 5000);
            };


        }


        function isNotEmpty(caller) {
            if(caller.val() == "") {
                caller.css('border', '1px solid red');
                return false;
            }
            else caller.css('border', '');

            return true;
        }

        // async function sendEmailData() {
        //     const name = document.getElementById('userName').value.trim();
        //     const email = document.getElementById('userEmail').value.trim();
        //     const statusDiv = document.getElementById('emailStatus');

        //     // Validation
        //     if (!name) {
        //         statusDiv.innerHTML = '<p style="color: #e74c3c;">❌ กรุณาใส่ชื่อของคุณ</p>';
        //         return;
        //     }

        //     if (!email || !email.includes('@')) {
        //         statusDiv.innerHTML = '<p style="color: #e74c3c;">❌ กรุณาใส่อีเมลที่ถูกต้อง</p>';
        //         return;
        //     }

        //     statusDiv.innerHTML = '<p style="color: #3498db;">📤 กำลังส่งอีเมล...</p>';

        //     try {
        //         const response = await fetch('send_email.php', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //             },
        //             body: JSON.stringify({
        //                 name: name,
        //                 email: email,
        //                 result: window.currentResult // Store result globally when calculated
        //             })
        //         });

        //         const result = await response.json();

        //         if (result.success) {
        //             statusDiv.innerHTML = '<p style="color: #27ae60; margin-top: 20px; font-size: 30px">✅ ส่งอีเมลสำเร็จแล้ว!</p>';
        //             setTimeout(() => {
        //                 closeEmailPopup();
        //             }, 2000);
        //         } else {
        //             statusDiv.innerHTML = `<p style="color: #e74c3c;">❌ ${result.message}</p>`;
        //         }
        //     } catch (error) {
        //         statusDiv.innerHTML = '<p style="color: #e74c3c;">❌ เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง</p>';
        //         console.error('Error:', error);
        //     }
        // }

    
// Start quiz when page loads
document.addEventListener('DOMContentLoaded', initQuiz);
</script>

<!-- <script type="text/javascript">
      
</script> -->
</body>
</html>