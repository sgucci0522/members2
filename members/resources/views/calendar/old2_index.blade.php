<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダー</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            width: 14.28%;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        td {
            height: 60px;
        }
        .current-month {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>カレンダー - {{ $currentMonth->format('Y年m月') }}</h1>
    <h2>期間 {{ $startOfMonth2 }} ～ {{ $endOfMonth }} {{ $firstDayOfWeek }}  kubun {{ $kubun }} add {{ $add }}</h2>　
    <!-- 前月、翌月ボタン -->
    <div>
        <a href="{{ route('calendar.index.offset', ['monthOffset' => $monthOffset - 1]) }}">＜ 前月</a>
        <a href="{{ route('calendar.index.offset', ['monthOffset' => $monthOffset + 1]) }}">翌月 ＞</a>
    </div>

    <table>
        <thead>
	    <tr>
		
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
        </thead>
        <tbody>
            @php
                $dayCounter = 0;
            @endphp
            <tr>
                @for ($i = 0; $i < $firstDayOfWeek; $i++)
                    <td></td>
                    @php
                        $dayCounter++;
		    @endphp
		@endfor
                @foreach ($daysInMonth as $day)
                    @php
                        $dayCounter++;
                    @endphp
                    <td>
                        <span>{{ $day->day }}</span>
                    </td>
                    @if ($dayCounter % 7 == 0)
                        </tr><tr>
                    @endif
                @endforeach
            </tr>
        </tbody>
    </table>
</body>
</html>

