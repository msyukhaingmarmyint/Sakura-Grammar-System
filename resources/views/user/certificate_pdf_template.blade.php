<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* PDF specific setup */
        @page { margin: 0; }
        body { 
            font-family: 'Helvetica', sans-serif; 
            margin: 0; 
            padding: 0;
            background-color: #f8f9ff;
        }

        /* The Card Container */
        .certificate-card {
            width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            border: 15px solid #e9ecff; /* Replaces the thin border */
            padding: 40px;
            text-align: center;
            position: relative;
        }

        /* Typography */
        .certificate-brand {
            font-size: 38px;
            font-weight: bold;
            color: #ff7c9d;
            margin-bottom: 20px;
        }

        .certificate-title {
            letter-spacing: 4px;
            font-weight: bold;
            color: #444;
            text-transform: uppercase;
            margin: 10px 0;
        }

        .topic-title {
            font-size: 26px;
            color: #ff7c9d;
            margin: 20px 0;
            font-style: italic;
        }

        .certificate-name {
            font-size: 34px;
            font-weight: bold;
            color: #000;
            margin: 15px 0;
            border-bottom: 2px solid #e9ecff;
            display: inline-block;
            padding: 0 50px;
        }

        .score-box {
            font-size: 20px;
            margin-top: 30px;
        }

        .date-box {
            font-size: 16px;
            margin-top: 10px;
            color: #666;
        }

        /* Decorative "Sakura" Corners */
        .corner {
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #fce4ec;
            opacity: 0.5;
        }
        .top-left { top: -10px; left: -10px; }
        .bottom-right { bottom: -10px; right: -10px; }
    </style>
</head>
<body>
    <div class="certificate-card">
        <div class="corner top-left"></div>
        
        <div class="certificate-brand">Sakura Grammar</div>

        <div class="certificate-title">Certificate of</div>
        
        <div class="topic-title">"{{ $topic }}"</div>

        <p>This certificate is proudly presented to</p>

        <div class="certificate-name">
            {{ $student_name }}
        </div>

        <p>for successfully passing the certification exam</p>

        <div class="score-box">
            Score: <strong>{{ $score }} / 50</strong>
        </div>

        <div class="date-box">
            Date: <strong>{{ $date }}</strong>
        </div>

        <div class="corner bottom-right"></div>
    </div>
</body>
</html>